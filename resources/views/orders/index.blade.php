@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full max-h-screen px-4 overflow-y-auto sm:px-8">
        {{-- Header Section --}}
        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5 text-[#9a031f] lg:font-bold lg:text-4xl">Orders</span>
        </div>
        <hr class="my-2 border-b-2 border-yellow-500">

        {{-- Orders Table --}}
        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full text-gray-800 table-auto">
                <thead>
                    <tr class="text-gray-900 bg-gray-200">
                        <th class="p-2 border"> Date</th>
                        <th class="p-2 border"> Image</th>
                        <th class="p-2 border">Product </th>
                        <th class="p-2 border"> Customer</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Address</th>
                        <th class="p-2 border">Rate</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Total</th>
                        <th class="p-2 border">Payment </th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="text-center ">
                            <td class="p-2 ">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="p-2 ">
                                <img src="{{ asset('images/products/' . $order->product->photopath) }}"
                                    alt="{{ $order->product->name }}" class="object-cover w-20 h-20 mx-auto rounded-md">
                            </td>
                            <td class="p-2 ">{{ $order->product->name }}</td>
                            <td class="p-2 ">{{ $order->name }}</td>
                            <td class="p-2 ">{{ $order->phone }}</td>
                            <td class="p-2 ">{{ $order->address }}</td>
                            <td class="p-2 ">{{ $order->price }}</td>
                            <td class="p-2 ">{{ $order->qty }}</td>
                            <td class="p-2 ">{{ $order->qty * $order->price }}</td>
                            <td class="p-2 ">{{ $order->payment_method }}</td>
                            <td class="p-2 ">{{ $order->status }}</td>
                            <td class="p-2 ">
                                <div class="grid gap-1 md:flex md:space-x-2">
                                    <a href="{{ route('order.status', [$order->id, 'Pending']) }}"
                                        class="px-2 py-1 text-xs text-white bg-blue-600 rounded-lg md:text-sm">Pending</a>
                                    <a href="{{ route('order.status', [$order->id, 'Processing']) }}"
                                        class="px-2 py-1 text-xs text-white bg-green-600 rounded-lg md:text-sm">Processing</a>
                                    <a href="{{ route('order.status', [$order->id, 'Shipping']) }}"
                                        class="px-2 py-1 text-xs text-white rounded-lg bg-amber-600 md:text-sm">Shipping</a>
                                    <a href="{{ route('order.status', [$order->id, 'Delivered']) }}"
                                        class="px-2 py-1 text-xs text-white bg-red-600 rounded-lg md:text-sm">Delivered</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
