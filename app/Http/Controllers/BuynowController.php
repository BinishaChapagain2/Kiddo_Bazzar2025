<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuynowController extends Controller
{
    /**
     * Handle the Buy Now request.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buyNow(Request $request, product $product)
    {

        session([
            'buy_now_product' => [
                'product_id' => $product->id,
                'qty' => $request->qty,
                'price' => $product->price,
            ],
        ]);

        return redirect()->route('buynow.checkout');
    }

    /**
     * Show the checkout form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        $buyNowData = session('buy_now_product');

        if (!$buyNowData) {
            return redirect()->route('home')->with('success', 'No product selected for purchase.');
        }
        $product = Product::findOrFail($buyNowData['product_id']);
        $qty = $buyNowData['qty'];
        //check if product has discounted price or not if not then price will be the price of product
        if ($product->discounted_price) {
            $price = $product->discounted_price;
        } else {
            $price = $product->price;
        }

        //total price of product having quantity discounted_price
        $total = $price * $qty;



        return view('buynow.checkout', compact('product', 'qty', 'price', 'total'));
    }

    /**
     * Place the order.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function placeOrder(Request $request)
    {
        $buyNowData = session('buy_now_product');

        if (!$buyNowData) {
            return redirect()->route('home')->with('success', 'No product selected for purchase.');
        }

        // Fetch user details from the authenticated user
        $user = Auth::user();

        //if the qty of product is 0 or the product is out of stock then redirect back with error message
        if ($buyNowData['qty'] == 0 || $buyNowData['qty'] > Product::find($buyNowData['product_id'])->stock) {
            return redirect()->route('home')->with('success', 'Product is out of stock');
        }


        order::create([
            'user_id' => $user->id,
            'product_id' => $buyNowData['product_id'],
            'qty' => $buyNowData['qty'],
            'price' => $buyNowData['price'] * $buyNowData['qty'],
            'status' => 'Pending',
            'payment_method' => 'cashondelivery', // Default Payment Method
            'name' => $user->name,
            'phone' => $user->phone,
            'address' => $user->address,
        ]);

        // Clear the session
        session()->forget('buy_now_product');

        // decrease the product quantity after order placed from product table stock
        $product = Product::find($buyNowData['product_id']);
        $product->stock = $product->stock - $buyNowData['qty'];
        $product->save();


        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }



    public function store(Request $request, $productid, $qty)
    {

        $data = $request->data;
        $data = base64_decode($data);
        $data = json_decode($data);
        // Find product and validate stock availability
        $product = Product::find($productid);
        if (!$product || $request->qty > $product->stock) {
            return redirect('home')->with('success', 'Product is out of stock');
        }



        // Prepare order data
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $productid,
            'qty' => $request->qty,
            'price' => $product->price,
            'payment_method' => 'Esewa',
            'name' => Auth::user()->name,
            'phone' => Auth::user()->phone,
            'address' => Auth::user()->address,
        ];

        // Create order and adjust stock
        Order::create($data);
        //decrease the product quantity after order placed from product table stock
        $product->stock = $product->stock - $request->qty;
        $product->save();



        return redirect(route('home'))->with('success', 'Order placed successfully');
    }
}
