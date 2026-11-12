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
            $this->data['product_lists'] = Product::with('product_variant', 'product_variant.variantValues', 'product_gallery_image','admin', 'bulkProducts', 'bulkProducts.variants')->get();
        }else{
            $this->data['category'] = Category::whereNull('parent_id')->where('status', 1)->where('created_by', $admin->id)->get();
            $this->data['variants'] = AttributeType::with('get_variant_value')->where('created_by', $admin->id)->get();
            $this->data['product_lists'] = Product::with('product_variant', 'product_variant.variantValues', 'product_gallery_image','admin', 'bulkProducts', 'bulkProducts.variants')->where('created_by', $admin->id)->get();
        }
        return view('admin.product.view_product')->with($this->data);
    }

    public function getVariantValues($id)
    {
        $values = AttributeValue::where('attribute_id', $id)->get();
        return response()->json($values);
    }

    public function getSecondaryValues($id)
    {
        $values = AttributeValue::where('attribute_id', '!=', $id)->get();
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
                'production_min_days' => 'nullable|integer|min:0',
                'production_max_days' => 'nullable|integer|min:0|gte:production_min_days',
                'sample_days'         => 'nullable|integer|min:0',
                'packaging_units'     => 'nullable|string|max:255',
                'print_capability'    => 'nullable|array',
                'print_capability.*'  => 'string|max:50',
            ];

            if ($request->product_type === 'single') {
                $rules += [
                    'single_regular_price' => 'required|numeric|min:0',
                    'single_sale_price'    => 'nullable|numeric|min:0|lte:single_regular_price',
                    'single_stock'         => 'required|integer|min:0',
                ];
            }

            if ($request->product_type === 'variant') {
                $rules['variant_groups'] = 'required|array|min:1';
            }

            if ($request->product_type === 'bulk') {
                $rules['bulk'] = 'required|array|min:1';
                // Falls back to this whenever an ordered quantity doesn't land
                // inside any of the tiered ranges below (too small or too large).
                $rules['bulk_base_regular_price'] = 'required|numeric|min:0';
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
            $product->production_min_days = $request->production_min_days;
            $product->production_max_days = $request->production_max_days;
            $product->sample_days     = $request->sample_days;
            $product->packaging_units = $request->packaging_units;
            $product->print_capability = !empty($request->print_capability)
                ? implode(',', $request->print_capability)
                : null;
            $product->created_by      = Auth::guard('admin')->id();

            // Single product values
            if ($request->product_type == 'single') {
                $product->regular_price   = $request->single_regular_price;
                $product->sale_price      = $request->single_sale_price ?? 0;
                $product->per_piece_price = null;
                $product->stock           = $request->single_stock;
            } elseif ($request->product_type == 'bulk') {
                $product->regular_price   = 0;
                $product->sale_price      = 0;
                // Fallback whenever an ordered quantity doesn't land inside
                // any of the tiered ranges below (too small or too large).
                $product->per_piece_price = $request->bulk_base_regular_price;
                $product->stock           = 0;
            } else {
                $product->regular_price   = 0;
                $product->sale_price      = 0;
                $product->per_piece_price = null;
                $product->stock           = 0;
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
                // Variants and bulk tiers are always fully replaced on save,
                // same as the gallery below — delete the old rows first.
                $variantIds = ProductVariant::where('product_id', $product->id)->pluck('id');
                if ($variantIds->isNotEmpty()) {
                    // Gallery images attached to a specific variant have to go
                    // before the variant itself — the FK has no cascade. Ones
                    // the client kept get recreated in VARIANT SAVE below
                    // against the fresh variant id, same storage file reused.
                    ProductGalleryImage::whereIn('variant_id', $variantIds)->delete();

                    ProductVariantValue::whereIn('product_variant_id', $variantIds)->delete();
                    ProductVariant::whereIn('id', $variantIds)->delete();
                }

                $bulkProductIds = BulkProduct::where('product_id', $product->id)->pluck('id');
                if ($bulkProductIds->isNotEmpty()) {
                    BulkProductVariant::whereIn('bulk_product_id', $bulkProductIds)->delete();
                    BulkProduct::whereIn('id', $bulkProductIds)->delete();
                }

                // Only "variant" has no use for these — "single" and "bulk"
                // both already set them correctly above, so don't stomp on
                // the bulk per-piece price that was just saved.
                if ($request->product_type == 'variant') {
                    $product->update([
                        'regular_price'    => 0,
                        'sale_price'       => 0,
                        'per_piece_price'  => null,
                        'stock'            => 0
                    ]);
                }
            }

            /* -------------------- GALLERY DELETE -------------------- */
            // Only the product-level gallery (variant_id NULL) — the
            // per-variant gallery is fully replaced in VARIANT SAVE below.
            $oldImages = ProductGalleryImage::where('product_id', $product->id)
                ->whereNull('variant_id')
                ->pluck('image_path')
                ->toArray();
            $keepImages = array_filter($request->existing_gallery ?? []);
            $deleteImages = array_diff($oldImages, $keepImages);
            if (!empty($deleteImages)) {
                ProductGalleryImage::where('product_id', $product->id)
                    ->whereNull('variant_id')
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

                $existingImages = ProductGalleryImage::where('product_id', $product->id)
                    ->whereNull('variant_id')
                    ->pluck('image_path');
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

            /* -------------------- VARIANT SAVE --------------------
             * One card ("group") per primary value (e.g. one per color) —
             * the cover image and gallery are uploaded once per group and
             * shared by every ProductVariant row nested inside it, instead
             * of re-uploading the same photo for every size. Both images
             * are attached to the group's first row (arbitrary but
             * consistent — the frontend looks images up by that row's id
             * via variant_id, not by size). */
            if ($request->product_type == 'variant' && !empty($request->variant_groups)) {

                foreach ($request->variant_groups as $groupKey => $group) {

                    $groupImage = $group['existing_image'] ?? null;
                    if ($request->hasFile("variant_groups.$groupKey.image")) {
                        $file = $request->file("variant_groups.$groupKey.image");
                        $img_name = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('variants/', $img_name, 'public');
                        $groupImage = 'variants/' . $img_name;
                    }

                    $firstVariantId = null;

                    foreach ($group['rows'] ?? [] as $row) {
                        $productVariant = new ProductVariant();
                        $productVariant->product_id = $product->id;
                        $productVariant->regular_price = $row['regular_price'];
                        $productVariant->sale_price = $row['sale_price'];
                        $productVariant->pri_attribute_id = $request->primary_variant;
                        $productVariant->stock = $row['stock'];
                        $productVariant->cover_image = $groupImage;
                        $productVariant->save();

                        $firstVariantId ??= $productVariant->id;

                        if (!empty($group['primary_value'])) {
                            $pro_variant_value = new ProductVariantValue();
                            $pro_variant_value->product_variant_id = $productVariant->id;
                            $pro_variant_value->attribute_id = $request->primary_variant;
                            $pro_variant_value->attribute_value_id = $group['primary_value'];
                            $pro_variant_value->save();
                        }

                        if (!empty($row['secondary_value'])) {
                            $secondary = AttributeValue::find($row['secondary_value']);
                            if ($secondary) {
                                $pro_variant_value = new ProductVariantValue();
                                $pro_variant_value->product_variant_id = $productVariant->id;
                                $pro_variant_value->attribute_id = $secondary->attribute_id;
                                $pro_variant_value->attribute_value_id = $row['secondary_value'];
                                $pro_variant_value->save();
                            }
                        }
                    }

                    if (!$firstVariantId) {
                        continue;
                    }

                    // Gallery images for this group — new uploads plus
                    // whichever existing ones the admin didn't remove.
                    if ($request->hasFile("variant_groups.$groupKey.gallery_images")) {
                        foreach ($request->file("variant_groups.$groupKey.gallery_images") as $galleryImage) {
                            $gimg_name = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                            $galleryImage->storeAs('gallery_images/', $gimg_name, 'public');
                            $variantGalleryImage = new ProductGalleryImage();
                            $variantGalleryImage->product_id = $product->id;
                            $variantGalleryImage->variant_id = $firstVariantId;
                            $variantGalleryImage->image_path = 'gallery_images/' . $gimg_name;
                            $variantGalleryImage->save();
                        }
                    }

                    foreach (array_filter($group['existing_gallery'] ?? []) as $keptPath) {
                        $variantGalleryImage = new ProductGalleryImage();
                        $variantGalleryImage->product_id = $product->id;
                        $variantGalleryImage->variant_id = $firstVariantId;
                        $variantGalleryImage->image_path = $keptPath;
                        $variantGalleryImage->save();
                    }
                }
            }

            /* -------------------- BULK SAVE -------------------- */
            if ($request->product_type === 'bulk' && !empty($request->bulk)) {
                foreach ($request->bulk as $index => $bulkData) {
                    $bp                = new BulkProduct();
                    $bp->product_id    = $product->id;
                    $bp->minimum       = $bulkData['minimum'];
                    $bp->maximum       = $bulkData['maximum'];
                    $bp->regular_price = $bulkData['regular_price'];
                    $bp->sale_price    = $bulkData['sale_price'] ?? 0;
                    $bp->save();

                    if (!empty($request->bulk_attributes)) {
                        foreach ($request->bulk_attributes as $attributeTypeId => $valueIds) {
                            foreach ($valueIds as $valueId) {
                                $bpv                     = new BulkProductVariant();
                                $bpv->bulk_product_id    = $bp->id;
                                $bpv->attribute_id       = (int) $attributeTypeId;
                                $bpv->attribute_value_id = (int) $valueId;
                                $bpv->save();
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
