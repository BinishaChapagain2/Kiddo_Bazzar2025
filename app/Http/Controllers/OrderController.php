<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, $cartid)
    {
        $data = $request->data;
        $data = base64_decode($data);
        $data = json_decode($data);
        if ($data->status == 'Delivered') {
            //store order here
            $cart = Cart::find($cartid);

            if (!$cart) {
                return redirect(route('home'))->with('success', 'Order placed successfully');
            }

            $data = [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                // check discount price or not of the product and calculate the total price in the price
                'price' => $cart->product->discounted_price ? $cart->product->discounted_price * $cart->qty : $cart->product->price * $cart->qty,

                'payment_method' => 'Esewa',
                'name' => $cart->user->name,
                'phone' => $cart->user->phone,
                'address' => $cart->user->address,

            ];



            Order::create($data);
            $cart->delete();
            return redirect(route('home'))->with('success', 'Order placed successfully');
        }
    }

    public function storecod(Request $request)
    {


        $cart = Cart::find($request->cart_id);

        //fetch the product details from the cart
        $product = Product::find($cart->product_id);

        //check if the product is out of stock


        if ($cart->qty > $product->stock) {
            return back()->with('success', 'Product is out of stock');
        }




        $data = [
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $cart->qty,
            'price' => $cart->product->discounted_price ? $cart->product->discounted_price * $cart->qty : $cart->product->price * $cart->qty,
            'payment_method' => 'Cash On Delivery',
            'name' => $cart->user->name,
            'phone' => $cart->user->phone,
            'address' => $cart->user->address,
        ];


        Order::create($data);

        //update the stock of the product
        $product->stock = $product->stock - $cart->qty;
        $product->save();



        $cart->delete();
        return redirect(route('home'))->with('success', 'Order placed successfully')->with('successdelivered', 'Order is placed successfully');

        // ->with('successdelivered', 'Order is placed successfully')
    }



    public function status($id, $status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();

        // Send mail to user
        $data = [
            'name' => $order->name,
            'status' => $status,
        ];

        Mail::send('mail.order', $data, function ($message) use ($order) {
            $message->to($order->user->email, $order->name)
                ->subject('Order Status');
        });

        // If the order is delivered, set a session alert
        if ($status == 'Delivered') {
            return redirect('home')->with('successdelivered', 'Your order has been delivered successfully.');
        }

        return back()->with('success', 'Order is now ' . $status);
    }


    public function myorder()
    {
        // Fetch orders for the logged-in user
        // fetch where status not equal to cancelled all
        $orders = Order::where('user_id', Auth::id())->where('status', '!=', 'Cancelled')->latest()->get();

        // Pass the orders to the Blade view
        return view('myorder', compact('orders'));
    }


    public function orderhistory()
    {
        $ordershistory = Order::where('status', 'Cancelled')->latest()->get();
        return view('cancelhistory', compact('ordershistory'));
    }

    public function orderhistorydestroy(Request $request)
    {
        $order = Order::find($request->dataid);
        $order->delete();
        return back()->with('success', 'Order history deleted successfully');
    }




    public function destroy(Request $request)
    {
        //  deleted the order if the status is pending
        $order = Order::find($request->dataid);
        if ($order->status == 'Pending') {
            // after the order is deleted, increase the stock of the product
            $product = Product::find($order->product_id);
            $product->stock = $product->stock + $order->qty;
            $product->save();

            // i want to change the status of the order to cancelled
            $order->status = 'Cancelled';
            $order->save();
            return back()->with('success', 'Order Cancelled successfully');
        } else {
            return back()->with('success', 'Order cannot be Cancelled, Please contact with seller for more information');
        }
    }
}
