@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full max-h-screen overflow-y-auto">

        {{-- Header Section --}}
        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5 text-[#9a031f] lg:font-bold lg:text-4xl">Products</span>
            <a href="{{ route('product.create') }}" class="px-3 py-1 text-white bg-yellow-500 rounded-lg">Add</a>
        </div>
        <hr class="my-2 border-b-2 border-yellow-500">

        {{-- Product Table --}}
        <div class="container px-2 py-5 text-white sm:px-5">
            <div class="overflow-x-auto bg-white rounded shadow-md">
                <table class="min-w-full text-gray-800 table-auto">
                    <thead>
                        <tr class="text-white bg-gray-400">
                            <th class="p-2 border">S.N</th>
                            <th class="p-2 border">Product Picture</th>
                            <th class="p-2 border">Product Name</th>
                            <th class="p-2 border">Description</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Age Range</th>
                            <th class="p-2 border">Size</th>
                            <th class="p-2 border">Discounted Price</th>
                            <th class="p-2 border">Stock</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Category</th>
                            <th class="p-2 border">Brand</th>
                            <th class="p-2 border">Product Type</th>
                            <th class="p-2 border">Season</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="transition duration-300 border-b bg-gray-50 hover:bg-blue-100">
                                <td class="p-2 border">{{ $loop->iteration }}</td>
                                <td class="p-2 border">
                                    <img src="{{ asset('images/products/' . $product->photopath) }}"
                                        alt="{{ $product->name }}" class="object-cover w-16 h-16">
                                </td>
                                <td class="p-2 border">{{ $product->name }}</td>
                                <td class="p-2 border">{{ Str::limit($product->description, 30) }}</td>
                                <td class="p-2 border">{{ $product->price }}</td>
                                <td class="p-2 border">{{ $product->age_range }}</td>
                                <td class="p-2 border">{{ $product->size }}</td>
                                <td class="p-2 border">{{ $product->discounted_price }}</td>
                                <td class="p-2 border">{{ $product->stock }}</td>
                                <td class="p-2 border">{{ $product->status }}</td>
                                <td class="p-2 border">{{ $product->category->name }}</td>
                                <td class="p-2 border">{{ $product->brand }}</td>
                                <td class="p-2 border">{{ $product->product_type }}</td>
                                <td class="p-2 border">{{ $product->season }}</td>
                                <td class="p-2 border">
                                    <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="w-full px-3 py-1 text-xs font-bold text-white bg-blue-600 rounded sm:w-auto sm:text-sm md:text-base lg:text-sm">Edit</a>
                                        <a href="{{ route('product.destroy', $product->id) }}"
                                            class="w-full px-3 py-1 text-xs font-bold text-white bg-red-600 rounded sm:w-auto sm:text-sm md:text-base lg:text-sm"
                                            onclick="return confirm('Are you sure to Delete?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
