<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('frontend.home')->with($this->data);
   }
}
