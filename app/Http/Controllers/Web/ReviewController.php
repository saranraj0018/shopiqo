<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Customers log in via the "user" guard (see UserLoginController::userAuthenticate),
        // not the default "web" guard — must check the same guard login uses.
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'review'     => 'required|string|max:500',
            'image'      => 'nullable|image|max:5120',
        ]);

        // One review per customer per product — resubmitting updates it
        // rather than piling up duplicates.
        $review = Review::updateOrCreate(
            [
                'user_id'    => $guard->id(),
                'product_id' => $request->product_id,
                'order_detail_id' => null,
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
                'status' => 1,
            ]
        );

        if ($request->hasFile('image')) {
            $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('reviews', $imgName, 'public');
            $review->image = 'reviews/' . $imgName;
            $review->save();
        }

        return response()->json([
            'status' => 'saved',
            'review' => [
                'name'   => $guard->user()->name,
                'rating' => $review->rating,
                'review' => $review->review,
                'image'  => $review->image ? asset('storage/' . $review->image) : null,
                'time'   => $review->created_at->diffForHumans(),
            ],
        ]);
    }
}
