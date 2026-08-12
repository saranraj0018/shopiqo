<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Fetch products with all necessary relations
        $this->data['products'] = Product::with([
            'product_variant',
            'product_variant.variantValues',
            'product_gallery_image',
            'admin',
            'wishlists',
            'reviews',
            'leastPricedVariant'
        ])->where('status', 'active')->limit(6)->get();
        return view('frontend.shop')->with($this->data);
    }

    public function show($id)
    {
        $decryptedId = decrypt($id);
        $this->data['product'] = Product::with([
            'product_variant',
            'product_variant.variantValues',
            'product_gallery_image',
            'admin',
            'wishlists',
            'reviews',
            'leastPricedVariant'
        ])->where('id', $decryptedId)->first();

        return view('frontend.productpage', $this->data);
    }
}
