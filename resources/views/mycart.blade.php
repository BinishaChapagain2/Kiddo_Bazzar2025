@extends('layouts.master')
@section('content')
    <div class="px-4 md:px-16">
        <div class="pl-2 mt-5 border-l-4 border-yellow-500">
            <h1 class="text-2xl text-[#9a031fdd] font-bold">My Cart</h1>
            <p class="text-gray-600">Products in Cart</p>
        </div>

        <div class="mt-5 overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left border-b border-gray-300">Product Image</th>
                        <th class="p-4 text-left border-b border-gray-300">Product Name</th>
                        <th class="p-4 text-center border-b border-gray-300">Quantity</th>
                        <th class="p-4 text-right border-b border-gray-300">Price</th>
                        <th class="p-4 text-right border-b border-gray-300">Total</th>
                        <th class="p-4 text-center border-b border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr class="text-center transition duration-200 hover:bg-gray-50">
                            <td class="p-2 border-b border-gray-100">
                                <img src="{{ asset('images/products/' . $cart->product->photopath) }}"
                                    alt="{{ $cart->product->name }}" class="h-24 mx-auto">
                            </td>
                            <td class="p-2 text-left border-b border-gray-100">{{ $cart->product->name }}</td>
                            <td class="p-2 border-b border-gray-100">
                                <input type="number" value="{{ $cart->qty }}"
                                    class="w-16 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    readonly>
                            </td>
                            <td class="p-2 text-right border-b border-gray-100">
                                @if ($cart->product->discounted_price)
                                    <span class="font-semibold text-red-600">{{ $cart->product->discounted_price }}</span>
                                    <span
                                        class="block text-xs text-gray-400 line-through">{{ $cart->product->price }}</span>
                                @else
                                    <span class="font-semibold">{{ $cart->product->price }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right border-b border-gray-100">{{ $cart->total }}</td>
                            <td class="p-2 border-b border-gray-100">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('checkout', $cart->id) }}"
                                        class="px-3 py-1 text-white transition bg-yellow-600 rounded-lg ">Checkout</a>

                                    {{-- a tag for delete --}}
                                    <a href="{{ route('cart.destroy', $cart->id) }}"
                                        class="px-3 py-1 text-white transition bg-[#9a031fdd] rounded-lg ">Delete</a>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
