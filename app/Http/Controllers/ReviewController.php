<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        // Find the product
        $product = Product::findOrFail($id);

        // Create a new review
        $review = new Review();
        $review->product_id = $product->id;
        $review->user_id = Auth::id(); // Get the authenticated user ID
        $review->rating = $request->rating;
        $review->review = $request->review;

        // Save the review to the database
        $review->save();

        // Redirect back to the product page with a success message
        return redirect()->route('viewproduct', $id)->with('success', 'Review submitted successfully!');
    }
}
