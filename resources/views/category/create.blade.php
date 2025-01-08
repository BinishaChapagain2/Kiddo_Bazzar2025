@extends('layouts.app')
@section('content')
    <div class="flex flex-col w-full max-h-screen overflow-y-auto ">


        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5  text-[#9a031f] lg:font-bold lg:text-4xl">Categories
            </span>

        </div>
        <hr class="my-2 border-b-2 border-yellow-500">


        <div class="mx-5">
            <form action="{{ route('category.store') }}" method="POST" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                    <input type="text" id="priority" name="priority" placeholder="Enter Priority"
                        class="w-full p-2 mt-1 border-gray-300 shadow-sm" value="{{ old('priority') }}">
                    @error('priority')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Category Name"
                        class="w-full p-2 mt-1 border-gray-300 shadow-sm" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="photopath" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" id="photopath" name="photopath"
                        class="w-full p-2 mt-1 border-gray-300 shadow-sm ">
                    @error('photopath')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-center gap-4 mt-4">
                    <input type="submit" value="Add Category"
                        class="px-5 py-3 text-white bg-blue-600 rounded-lg cursor-pointer">
                    <a href="{{ route('category.index') }}" class="px-10 py-3 text-white bg-red-600 rounded-lg">Exit</a>
                </div>
            </form>
        </div>
    @endsection
