@extends('layouts.master')

@section('content')
    <div class="container px-4 mx-auto lg:px-12">
        <div class="pl-2 my-6 border-l-4 border-yellow-500">
            <h1 class=" lg:text-3xl text-xl font-bold text-[#9a031fdd]">{{ $category->name }} Products</h1>
            <p class="text-base text-gray-600 lg:text-xl">Explore our exclusive range of {{ $category->name }} products.</p>
        </div>


        <!-- Filter Section -->
        <!-- Filter Section -->
        <div
            class="flex flex-col justify-between p-4 mb-5 border rounded-lg shadow-md bg-gray-50 lg:flex-row lg:items-center lg:gap-6">
            <form action="{{ route('categoryproduct', $category->id) }}" method="GET" class="flex flex-wrap w-full gap-4">
                <div class="flex items-center w-full lg:w-auto">
                    <label for="season" class="mr-2 text-sm font-semibold text-gray-700">Season:</label>
                    <select name="season" id="season"
                        class="w-full lg:w-48 p-2 text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Season</option>
                        @foreach ($seasons as $season)
                            <option value="{{ $season }}" {{ request('season') == $season ? 'selected' : '' }}>
                                {{ $season }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center w-full lg:w-auto">
                    <label for="age_range" class="mr-2 text-sm font-semibold text-gray-700">Age:</label>
                    <select name="age_range" id="age_range"
                        class="w-full lg:w-48 p-2 text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Age Range</option>
                        @foreach ($ageRanges as $ageRange)
                            <option value="{{ $ageRange }}" {{ request('age_range') == $ageRange ? 'selected' : '' }}>
                                {{ $ageRange }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center w-full lg:w-auto">
                    <label for="brand" class="mr-2 text-sm font-semibold text-gray-700">Brand:</label>
                    <select name="brand" id="brand"
                        class="w-full lg:w-48 p-2  text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                {{ $brand }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="flex items-center w-full lg:w-auto">
                    <label for="rating" class="mr-2 text-sm font-semibold text-gray-700">Rating:</label>
                    <select name="rating" id="rating"
                        class="w-full lg:w-48 p-2 text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Rating</option>
                        @foreach ($ratings as $rating)
                            <option value="{{ $rating }}" {{ request('rating') == $rating ? 'selected' : '' }}>Above
                                {{ $rating }} ★
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="flex items-center w-full lg:w-auto">
                    <label for="size" class="mr-2 text-sm font-semibold text-gray-700">Size:</label>
                    <select name="size" id="size"
                        class="w-full lg:w-48 p-2 text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>
                                {{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center w-full lg:w-auto">
                    <label for="product_type" class="mr-2 text-sm font-semibold text-gray-700">Type:</label>
                    <select name="product_type" id="product_type"
                        class="w-full lg:w-48 p-2 text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#80a359]">
                        <option value="">Select Type</option>
                        @foreach ($productTypes as $productType)
                            <option value="{{ $productType }}"
                                {{ request('product_type') == $productType ? 'selected' : '' }}>{{ $productType }}
                            </option>
                        @endforeach
                    </select>
                </div>






                <div class="flex items-center w-full lg:w-auto">
                    <button type="submit"
                        class="w-full px-4 py-2 mt-2 text-white transition-all duration-200 bg-[#9a031fdd] rounded-lg shadow lg:w-auto lg:mt-0 hover:bg-yellow-600">
                        Filter
                    </button>
                </div>
            </form>
        </div>


        <!-- Product Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($products as $rproduct)
                <a href="{{ route('viewproduct', $rproduct->id) }}" class="flex-shrink-0">
                    <!-- Product card with fixed min-width for small/medium devices -->
                    <div class="overflow-hidden  border rounded-lg shadow-lg min-w-[16rem]">
                        <img src="{{ asset('images/products/' . $rproduct->photopath) }}" alt="{{ $rproduct->name }}"
                            class="object-cover w-full h-64">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ Str::limit($rproduct->name, 20) }}</h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($rproduct->description, 20) }}</p>
                            <div class="mt-2">
                                <span class="text-lg font-bold text-gray-900">Rs. {{ $rproduct->price }}</span>
                                @if ($rproduct->discounted_price)
                                    <span class="text-sm text-gray-400 line-through">Rs.
                                        {{ $rproduct->discounted_price }}</span>
                                    <span
                                        class="text-sm font-bold text-red-500">({{ round((($rproduct->discounted_price - $rproduct->price) / $rproduct->discounted_price) * 100) }}%
                                        OFF)</span>
                                @endif
                            </div>
                            {{-- Display the stars for average rating --}}
                            <div class="flex items-center mt-2">
                                <div class="flex items-center">
                                    @php
                                        // Use the average rating calculated from the model
                                        $averageRating = $rproduct->reviews_avg_rating ?? 0; // Use 0 if no reviews
                                        $fullStars = floor($averageRating);
                                        $halfStars = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStars);
                                    @endphp

                                    {{-- Full stars --}}
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class='text-yellow-500 bx bxs-star'></i>
                                    @endfor

                                    {{-- Half star --}}
                                    @if ($halfStars)
                                        <i class='text-yellow-500 bx bxs-star-half'></i>
                                    @endif

                                    {{-- Empty stars --}}
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class='text-yellow-500 bx bx-star'></i>
                                    @endfor
                                </div>

                                {{-- Average rating and review count --}}
                                <span class="ml-2 text-sm text-yellow-500">{{ number_format($averageRating, 1) }}</span>
                                <span class="ml-2 text-sm text-gray-400">{{ $rproduct->reviews->count() }} reviews</span>
                            </div>

                        </div>
                    </div>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center h-full py-20 -mt-8">
                    <img src="{{ asset('images/noproduct.webp') }}" alt="No Products Found" class="w-40 h-40 mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">No Products Found</h1>
                    <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 mt-4 text-white bg-yellow-500 rounded hover:bg-yellow-600">Go Back to Home</a>
                </div>
            @endforelse
        </div>


        {{-- paginalition link --}}
        <div class="mt-10">
            {{ $products->links() }}

        </div>



    </div>


@endsection
