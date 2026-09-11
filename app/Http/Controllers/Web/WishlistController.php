<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function saveWishlist(Request $request)
    {
        $productId = $request->product_id;
        // Customers log in via the "user" guard (see UserLoginController::userAuthenticate),
        // not the default "web" guard — must check the same guard login uses.
        if (!Auth::guard('user')->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }
        $user = Auth::guard('user')->user();
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        }
        $save_wishlist = new Wishlist();
        $save_wishlist->user_id = $user->id;
        $save_wishlist->product_id = $productId;
        $save_wishlist->save();

        if ($save_wishlist) {
            return response()->json(['status' => 'added']);
        }
    }
}
