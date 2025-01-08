@extends('layouts.app')
@section('content')
    <div class="flex flex-col w-full max-h-screen overflow-y-auto ">


        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5  text-[#9a031f] lg:font-bold lg:text-4xl">Banners
            </span>

        </div>
        <hr class="my-2 border-b-2 border-yellow-500">


        <div class="mx-5">
            <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-5">
                @csrf

                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>

                <input type="text" placeholder="Enter Priority" name="priority" class="w-full p-2 my-2 "
                    value="{{ old('priority', $banner->priority) }}">
                @error('priority')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
                <label for="name" class="block text-sm font-medium text-gray-700">banner Name</label>

                <input type="text" placeholder="Enter banner Name" name="name" class="w-full p-2 my-2 "
                    value="{{ old('name', $banner->name) }}">
                @error('name')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>

                <input type="text" placeholder="Enter banner description" name="description" class="w-full p-2 my-2 "
                    value="{{ old('description', $banner->description) }}">
                @error('description')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror


                {{-- Category Selection Dropdown --}}

                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="w-full p-2 mt-1 border-gray-300 ">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $banner->category_id) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>




                <label for="banneraction" class="block text-sm font-medium text-gray-700">Banner_Action</label>

                <input type="text" placeholder="Enter banner Button_Action" name="buttonaction" class="w-full p-2 my-2 "
                    value="{{ old('buttonaction', $banner->buttonaction) }}">
                @error('buttonaction')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <label for="photopath" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photopath" class="w-full p-2 my-2">
                @error('photopath')
                    <p class="-mt-2 text-red-500">{{ $message }}</p>
                @enderror
                <p>Current photo:</p>
                <img src="{{ asset('images/banners/' . $banner->photopath) }}" alt=""
                    class="object-cover w-16 h-16">

                {{-- status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full p-2 my-2 border-gray-300 ">
                        <option value="show" @if ($banner->status == 'show') selected @endif>Show</option>
                        <option value="hidden" @if ($banner->status == 'hidden') selected @endif>Hide</option>
                    </select>
                </div>



                <div class="flex justify-center gap-4 mt-4">
                    <input type="submit" value="Update banner"
                        class="px-5 py-3 text-white bg-blue-600 rounded-lg cursor-pointer">
                    <a href="{{ route('banner.index') }}" class="px-10 py-3 text-white bg-red-600 rounded-lg">Exit</a>
                </div>
            </form>
        </div>
    @endsection
