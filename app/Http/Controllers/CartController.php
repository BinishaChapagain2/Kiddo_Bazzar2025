<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // validate the input data
        $data = $request->validate([
            'product_id' => 'required',
            'qty' => 'required'
        ]);



        // Sets the current users id as user_id

        $data['user_id'] = Auth::id();


        // check if product is already in cart if already in cart update quantity else make a new cart entry for a product

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $data['product_id'])->first();
        if ($cart) {
            $cart->qty = $data['qty'];
            $cart->save();
            return back()->with('success', 'Cart Updated successfully');
        }

        Cart::create($data);
        return back()->with('success', 'Product added to cart successfully');
    }

    public function mycart()
    {
        // retrieve the user cart item in descending order

        $carts = Cart::where('user_id', Auth::id())->latest()->get();

        // calculate the total price of the product in the cart based on the quantity, uses the products price if no discount is available
        foreach ($carts as $cart) {
            if ($cart->product->discounted_price == '') {
                $cart->total = $cart->product->price * $cart->qty;
            } else {
                $cart->total = $cart->product->discounted_price * $cart->qty;
            }
        }
        return view('mycart', compact('carts'));
    }

    public function destroy($id)
    {
        // Finds the cart item by id and deletes it
        Cart::find($id)->delete();
        return back()->with('success', 'Product removed from cart successfully');
    }
}
