@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full max-h-screen overflow-y-auto">
        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5 text-[#9a031f] lg:font-bold lg:text-4xl">Categories</span>
        </div>
        <hr class="my-2 border-b-2 border-yellow-500">

        <div class="mx-5">
            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-5">
                @csrf
                @method('PUT')

                <!-- Priority Input -->
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <input type="text" placeholder="Enter Priority" name="priority" class="w-full p-2 my-2"
                    value="{{ old('priority', $category->priority) }}">
                @error('priority')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <!-- Category Name Input -->
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" placeholder="Enter Category Name" name="name" class="w-full p-2 my-2"
                    value="{{ old('name', $category->name) }}">
                @error('name')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <!-- Photo Input -->
                <label for="photopath" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photopath" class="w-full p-2 my-2">
                @error('photopath')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <!-- Current Photo Display -->
                <p>Current photo:</p>
                <img src="{{ asset('images/categories/' . $category->photopath) }}" alt=""
                    class="object-cover w-16 h-16">

                <!-- Form Actions -->
                <div class="flex justify-center gap-4 mt-4">
                    <input type="submit" value="Update Category"
                        class="px-5 py-3 text-white bg-blue-600 rounded-lg cursor-pointer">
                    <a href="{{ route('category.index') }}" class="px-10 py-3 text-white bg-red-600 rounded-lg">Exit</a>
                </div>
            </form>
        </div>
    </div>
@endsection
