<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $products = Product::where('status', 'show')
            // ->where('stock', '>', 0) // Ensure stock is greater than 0
            ->with(['reviews', 'reviews:id,product_id,rating']) // Load reviews and only necessary fields
            ->withAvg('reviews', 'rating') // Calculate the average rating
            ->latest()
            ->limit(8)
            ->get();
        $banners = banner::all();









        return view('welcome', compact('products', 'categories', 'banners'));
    }




    public function about()
    {
        return view('aboutpage');
    }

    // Define the contact method
    public function whyKiddoBazzar()
    {
        return view('whyKiddoBazzar');
    }

    //  term and consition
    public function termandcondition()
    {
        return view('termandcondition');
    }




    public function viewproduct($id)
    {
        $product = Product::where('status', 'Show')->find($id);
        $relatedproducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        // Fetch reviews for the current product
        $reviews = $product->reviews()->orderBy('rating', 'desc')->get();

        // Calculate the average rating for the current product
        $averageRating = $product->averageRating();

        // Calculate average ratings for related products
        $relatedProductRatings = [];
        foreach ($relatedproducts as $relatedProduct) {
            $relatedProductRatings[$relatedProduct->id] = $relatedProduct->averageRating();
        }

        return view('viewproduct', compact('product', 'relatedproducts', 'reviews', 'averageRating', 'relatedProductRatings'));
    }


    public function categoryProduct(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);


        // Initial query to get products for the category with reviews
        $query = Product::where('category_id', $categoryId)
            ->where('status', 'show')
            ->with(['reviews', 'reviews:id,product_id,rating']) // Eager load reviews
            ->withAvg('reviews', 'rating');

        // Calculate average rating

        // Apply filters based on user inputs
        if ($request->filled('season')) {
            $query->where('season', $request->season);
        }
        if ($request->filled('age_range')) {
            $query->where('age_range', $request->age_range);
        }
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }
        if ($request->filled('product_type')) {
            $query->where('product_type', $request->product_type);
        }

        // Filter by rating if provided
        if ($request->filled('rating')) {
            $query->having('reviews_avg_rating', '>=', $request->rating);
        }

        // Get the filtered products with pagination
        $products = $query->paginate(5);

        // Fetch unique values for filters
        $seasons = Product::where('category_id', $categoryId)->pluck('season')->unique();
        $ageRanges = Product::where('category_id', $categoryId)->pluck('age_range')->unique();
        $brands = Product::where('category_id', $categoryId)->pluck('brand')->unique();
        $sizes = Product::where('category_id', $categoryId)->pluck('size')->unique();
        $productTypes = Product::where('category_id', $categoryId)->pluck('product_type')->unique();

        // Get unique rating values for filtering
        $ratings = Review::pluck('rating')->unique()->sortDesc();

        return view('categoryproduct', compact('category', 'products', 'seasons', 'ageRanges', 'brands', 'sizes', 'productTypes', 'ratings'));
    }


    public function checkout($cartid)
    {
        $cart = Cart::find($cartid);
        if ($cart->product->discounted_price == '') {
            $cart->total = $cart->product->price * $cart->qty;
        } else {
            $cart->total = $cart->product->discounted_price * $cart->qty;
        }
        return view('checkout', compact('cart'));
    }


    public function search(Request $request)
    {
        $qry = $request->search;

        // Query to fetch products with their reviews and average rating
        $products = Product::where('name', 'like', '%' . $qry . '%')

            ->orWhere('description', 'like', '%' . $qry . '%')
            ->with(['reviews', 'reviews:id,product_id,rating']) // Eager load reviews
            ->withAvg('reviews', 'rating') // Calculate average rating
            ->paginate(20); // Add pagination with 10 items per page


        return view('search', compact('products'));
    }
}
