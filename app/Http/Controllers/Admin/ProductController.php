<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use App\Models\BulkProduct;
use App\Models\BulkProductVariant;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGalleryImage;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() && $request->get_sub_category) {
            $sub_category = Category::where('parent_id', $request->category_id)->where('status', 1)->get();
            return response()->json([
                'success' => true,
                'sub_category' => $sub_category
            ]);
        }
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        if($admin->role_id == 1){
            $this->data['category'] = Category::whereNull('parent_id')->where('status', 1)->get();
            $this->data['variants'] = AttributeType::with('get_variant_value')->get();
            $this->data['product_lists'] = Product::with('product_variant', 'product_variant.variantValues', 'product_gallery_image','admin')->get();
        }else{
            $this->data['category'] = Category::whereNull('parent_id')->where('status', 1)->where('created_by', $admin->id)->get();
            $this->data['variants'] = AttributeType::with('get_variant_value')->where('created_by', $admin->id)->get();
            $this->data['product_lists'] = Product::with('product_variant', 'product_variant.variantValues', 'product_gallery_image','admin')->where('created_by', $admin->id)->get();
        }
        return view('admin.product.view_product')->with($this->data);
    }

    public function getVariantValues($id)
    {
        $values = AttributeValue::where('attribute_type_id', $id)->get();
        return response()->json($values);
    }

    public function getSecondaryValues($id)
    {
        $values = AttributeValue::where('attribute_type_id', '!=', $id)->get();
        return response()->json($values);
    }

    public function saveProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'product_name' => 'required|string|max:255',
                'category_id'  => 'required|exists:categories,id',
                'product_type' => 'required|in:single,variant,bulk',
                'product_code'   =>  'required|unique:products,product_code,' . $request->product_id,
            ];

            if ($request->product_type === 'single') {
                $rules += [
                    'single_regular_price' => 'required|numeric|min:0',
                    'single_sale_price'    => 'nullable|numeric|min:0|lte:single_regular_price',
                    'single_stock'         => 'required|integer|min:0',
                ];
            }

            if ($request->product_type === 'variant') {
                $rules['variants'] = 'required|array|min:1';
            }

            if ($request->product_type === 'bulk') {
                $rules['bulk'] = 'required|array|min:1';
            }

            if (empty($request->product_id)) {
                $rules['main_image'] = 'required|image';
            } else {
                $rules['main_image'] = 'nullable|image';
            }

            $request->validate($rules);

            /* -------------------- SAVE PRODUCT -------------------- */
            $product = empty($request->product_id) ? new Product() : Product::findOrFail($request->product_id);
            $product->category_id     = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name            = $request->product_name;
            $product->product_type    = $request->product_type;
            $product->product_code    = $request->product_code;
            $product->description     = $request->description ?? '';
            $product->created_by      = Auth::guard('admin')->id();

            // Single product values
            if ($request->product_type == 'single') {
                $product->regular_price = $request->single_regular_price;
                $product->sale_price    = $request->single_sale_price ?? 0;
                $product->stock         = $request->single_stock;
            } else {
                $product->regular_price = 0;
                $product->sale_price    = 0;
                $product->stock         = 0;
            }

            /* -------------------- MAIN IMAGE -------------------- */
            if ($request->hasFile('main_image')) {
                $img_name = time() . '_' . $request->file('main_image')->getClientOriginalName();
                $request->file('main_image')->storeAs('main_image/', $img_name, 'public');
                $product->main_image = 'main_image/' . $img_name;
            } elseif ($request->existing_main) {
                $product->main_image = $request->existing_main;
            }

            $product->save();

            /* -------------------- TYPE SWITCH CLEANUP -------------------- */
            if (!empty($request->product_id)) {
                $variantIds = ProductVariant::where('product_id', $product->id)->pluck('id');
                // Delete variants
                if ($variantIds->isNotEmpty()) {
                    ProductVariantValue::whereIn('product_variant_id', $variantIds)->delete();
                    ProductVariant::whereIn('id', $variantIds)->delete();
                }
                // Reset single fields if not single
                if ($request->product_type != 'single') {
                    $product->update([
                        'regular_price' => 0,
                        'sale_price'    => 0,
                        'stock'         => 0
                    ]);
                }
            }

            /* -------------------- GALLERY DELETE -------------------- */
            $oldImages = ProductGalleryImage::where('product_id', $product->id)
                ->pluck('image_path')
                ->toArray();
            $keepImages = array_filter($request->existing_gallery ?? []);
            $deleteImages = array_diff($oldImages, $keepImages);
            if (!empty($deleteImages)) {
                ProductGalleryImage::where('product_id', $product->id)
                    ->whereIn('image_path', $deleteImages)
                    ->delete();

                foreach ($deleteImages as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }

            /* -------------------- GALLERY ADD -------------------- */
            if ($request->hasFile('gallery_images')) {

                $existingImages = ProductGalleryImage::where('product_id', $product->id)->pluck('image_path');
                $existingHashes = [];

                foreach ($existingImages as $imgPath) {
                    $fullPath = storage_path('app/public/' . $imgPath);
                    if (file_exists($fullPath)) {
                        $existingHashes[] = md5_file($fullPath);
                    }
                }

                foreach ($request->file('gallery_images') as $image) {
                    $newHash = md5_file($image->getRealPath());

                    if (in_array($newHash, $existingHashes)) {
                        continue;
                    }

                    $gimg_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('gallery_images/', $gimg_name, 'public');
                    $save_product_gallery = new ProductGalleryImage();
                    $save_product_gallery->product_id = $product->id;
                    $save_product_gallery->image_path = 'gallery_images/' . $gimg_name;
                    $save_product_gallery->save();

                    $existingHashes[] = $newHash;
                }
            }

            /* -------------------- VARIANT SAVE -------------------- */
            if ($request->product_type == 'variant' && !empty($request->variants)) {

                foreach ($request->variants as $key => $variant) {

                    $variantImage = $variant['existing_image'] ?? null;

                    if ($request->hasFile("variants.$key.image")) {
                        $file = $request->file("variants.$key.image");
                        $img_name = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('variants/', $img_name, 'public');
                        $variantImage = 'variants/' . $img_name;
                    }

                    $productVariant = new ProductVariant();
                    $productVariant->product_id = $product->id;
                    $productVariant->regular_price = $variant['regular_price'];
                    $productVariant->sale_price = $variant['sale_price'];
                    $productVariant->pri_attribute_id = $request->primary_variant;
                    $productVariant->stock = $variant['stock'];
                    $productVariant->cover_image = $variantImage;
                    $productVariant->save();

                    if (!empty($variant['primary_value'])) {
                        $attributeId = $request->primary_variant;
                        $pro_variant_value = new ProductVariantValue();
                        $pro_variant_value->product_variant_id = $productVariant->id;
                        $pro_variant_value->attribute_id = $attributeId;
                        $pro_variant_value->attribute_value_id = $variant['primary_value'];
                        $pro_variant_value->save();
                    }

                    if (!empty($variant['secondary_value'])) {
                        $secondary = AttributeValue::find($variant['secondary_value']);
                        if ($secondary) {
                            $pro_variant_value = new ProductVariantValue();
                            $pro_variant_value->product_variant_id = $productVariant->id;
                            $pro_variant_value->attribute_id = $secondary->attribute_id;
                            $pro_variant_value->attribute_value_id = $variant['secondary_value'];
                            $pro_variant_value->save();
                        }
                    }
                }
            }

            /* -------------------- BULK SAVE -------------------- */
            if ($request->product_type === 'bulk' && !empty($request->bulk)) {
                foreach ($request->bulk as $index => $bulkData) {
                    $pv                = new ProductVariant();
                    $pv->product_id    = $product->id;
                    $pv->minimum       = $bulkData['minimum'];
                    $pv->maximum       = $bulkData['maximum'];
                    $pv->regular_price = $bulkData['regular_price'];
                    $pv->sale_price    = $bulkData['sale_price'] ?? 0;
                    $pv->pri_attribute_id = null;
                    $pv->stock            = 0;
                    $pv->cover_image      = null;
                    $pv->save();

                    if (!empty($request->bulk_attributes)) {
                        foreach ($request->bulk_attributes as $attributeTypeId => $valueIds) {
                            foreach ($valueIds as $valueId) {
                                $pvv                     = new ProductVariantValue();
                                $pvv->product_variant_id = $pv->id;
                                $pvv->attribute_id        = (int) $attributeTypeId;
                                $pvv->attribute_value_id  = (int) $valueId;
                                $pvv->save();
                            }
                        }
                    }
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
