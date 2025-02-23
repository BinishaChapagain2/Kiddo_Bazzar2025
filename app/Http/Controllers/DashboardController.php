<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        $order = Order::count();
        $pending = Order::where('status', 'Pending')->count();
        $processing = Order::where('status', 'Processing')->count();
        $shipping = Order::where('status', 'Shipping')->count();
        $delivered = Order::where('status', 'Delivered')->count();
        return view('dashboard', compact('categories', 'products', 'pending', 'processing', 'shipping', 'delivered', 'users', 'order'));
    }
    //report
    public function report()
    {
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        $order = Order::count();
        $pending = Order::where('status', 'Pending')->count();
        $processing = Order::where('status', 'Processing')->count();
        $shipping = Order::where('status', 'Shipping')->count();
        $delivered = Order::where('status', 'Delivered')->count();


        return view('report', compact('categories', 'products', 'pending', 'processing', 'shipping', 'delivered', 'users', 'order'));
    }
}
