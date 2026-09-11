<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\Review;
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

        // "Browse by need" cards, managed by admins
        $this->data['occasions'] = Occasion::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(6)
            ->get();

        // "What people say" — top rated, approved customer reviews
        $this->data['testimonials'] = Review::with(['user', 'product'])
            ->where('status', 1)
            ->whereNotNull('review')
            ->whereHas('user')
            ->orderByDesc('rating')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home')->with($this->data);
   }
}
