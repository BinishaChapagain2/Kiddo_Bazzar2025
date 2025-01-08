@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full max-h-screen p-6 overflow-y-auto">

        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5  text-[#9a031f] lg:font-bold lg:text-4xl">Product
            </span>

        </div>
        <hr class="my-2 border-b-2 border-yellow-500">
        <!-- Product Form -->
        <form action="{{ route('product.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            {{-- Category Selection Dropdown --}}
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="w-full p-2 mt-1 border-gray-300 ">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Brand Input --}}
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" placeholder="Enter Brand" class="w-full p-2 my-2 rounded-lg"
                    value="{{ old('brand') }}">
                @error('brand')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product Type Input --}}
            <div>
                <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type</label>
                <input type="text" name="product_type" placeholder="Enter Product Type"
                    class="w-full p-2 my-2 rounded-lg" value="{{ old('product_type') }}">
                @error('product_type')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Season Selection Dropdown --}}
            <div>
                <label for="season" class="block text-sm font-medium text-gray-700">Season</label>
                <select name="season" id="season" class="w-full p-2 my-2 border-gray-300 ">
                    <option value="summer">Summer</option>
                    <option value="winter">Winter</option>
                    <option value="autumn">Autumn</option>
                    <option value="spring">Spring</option>
                    <option value="none">None</option>
                </select>
            </div>

            {{-- Product Name Input --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" placeholder="Enter Product Name" class="w-full p-2 my-2 "
                    value="{{ old('name') }}">
                @error('name')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description Textarea --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" cols="30" rows="5" placeholder="Enter Product Description"
                    class="w-full p-2 my-2 ">{{ old('description') }}</textarea>
                @error('description')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price Input --}}
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="price" placeholder="Enter Price" class="w-full p-2 my-2 "
                    value="{{ old('price') }}">
                @error('price')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Age Range Input --}}
            <div>
                <label for="age_range" class="block text-sm font-medium text-gray-700">Age Range</label>
                <input type="text" name="age_range" placeholder="Enter Age Range" class="w-full p-2 my-2 "
                    value="{{ old('age_range') }}">
                @error('age_range')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Size Input --}}
            <div>
                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                <input type="text" name="size" placeholder="Enter Size" class="w-full p-2 my-2 "
                    value="{{ old('size') }}">
                @error('size')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Discounted Price Input --}}
            <div>
                <label for="discounted_price" class="block text-sm font-medium text-gray-700">Discounted Price</label>
                <input type="text" name="discounted_price" placeholder="Enter Discounted Price" class="w-full p-2 my-2 "
                    value="{{ old('discounted_price') }}">
                @error('discounted_price')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stock Input --}}
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="text" name="stock" placeholder="Enter Stock" class="w-full p-2 my-2 "
                    value="{{ old('stock') }}">
                @error('stock')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Selection Dropdown --}}
            <div>

                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full my-2 border-gray-300 ">
                    <option value="show">Show</option>
                    <option value="hidden">Hide</option>
                </select>
            </div>

            {{-- Product Image Upload --}}
            <div>
                <input type="file" name="photopath" class="w-full my-2 ">
                @error('photopath')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-center mt-4 space-x-4">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Create Product</button>
                <a href="{{ route('product.index') }}" class="px-4 py-2 text-white bg-red-500 rounded-lg">Cancel</a>
            </div>
        </form>
    </div>
@endsection
