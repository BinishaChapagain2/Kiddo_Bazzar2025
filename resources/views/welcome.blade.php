@extends('layouts.master')
@section('content')
    {{-- slider  --}}



    <!-- In welcome.blade.php -->

    <!-- Slider main container -->
    <div class="w-full h-64 md:h-96 lg:h-[500px] swiper mySwiper">
        <!-- Swiper Wrapper -->
        <div class="mt-0 swiper-wrapper">

            @foreach ($banners as $banner)
                <div class="swiper-slide">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('images/banners/' . $banner->photopath) }}" alt="Big Sale Event"
                            class="object-cover w-full h-full">
                        <!-- Overlay for text -->
                        <div class="absolute inset-0 opacity-75 bg-gradient-to-t from-black via-transparent"></div>
                        <!-- Banner details (Centered Text) -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white">
                            <h1 class="mb-2 text-xl font-bold text-[#9a031fdd] sm:text-3xl md:text-4xl lg:text-5xl">
                                {{ $banner->name }}</h1>
                            <p class="mb-4 text-sm text-[#9a031fdd] sm:text-lg md:text-xl lg:text-2xl">
                                {{ $banner->description }}
                            </p>

                            <div class="flex flex-col mt-4 space-y-2 sm:flex-row sm:space-y-0 sm:space-x-4">

                                <!-- Check if category is not null -->
                                @if ($banner->category)
                                    <a href="{{ route('categoryproduct', $banner->category->id) }}"
                                        class="px-4 py-2 text-sm font-semibold text-[#9a031fdd] transition-transform duration-300 bg-blue-600 rounded-lg shadow-lg sm:px-6 sm:py-3 sm:text-base hover:bg-blue-700 hover:scale-105">
                                        {{ $banner->category->name }}
                                    </a>
                                @else
                                    <!-- Default text if category is not assigned -->
                                    <span class="px-4 py-2 text-sm font-semibold text-gray-600">No Category</span>
                                @endif

                                {{-- <!-- Link to Category -->
                                <a href="{{ route('categoryproduct', $banner->category->id) }}"
                                    class="px-4 py-2 text-sm font-semibold text-[#9a031fdd] transition-transform duration-300 bg-blue-600 rounded-lg shadow-lg sm:px-6 sm:py-3 sm:text-base hover:bg-blue-700 hover:scale-105">
                                    {{ $banner->category->name }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>


    <!-- Swiper JS initialization -->
    <script>
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>


    {{-- category heading --}}

    <div class="px-2 mt-5">
        <div class="pl-2 mb-4 border-l-4 border-yellow-500">
            <h1 class="lg:text-3xl text-xl font-bold text-[#9a031fdd]">CATEGORIES</h1>
            <p class="text-sm text-gray-600 lg:text-lg">Explore our wide range of products by category.
            </p>
        </div>
    </div>

    <div class="flex gap-4 py-2 overflow-x-auto no-scrollbar">
        @foreach ($categories as $category)
            <!-- Category -->
            <a href="{{ route('categoryproduct', $category->id) }}">
                <div class="flex flex-col items-center w-24 text-center">
                    <div
                        class="relative flex items-center justify-center w-16 h-16  overflow-hidden bg-[#fb8b24] rounded-lg shadow-lg">
                        {{-- Custom Frame for Image  --}}
                        <div class="absolute rounded-lg "></div>
                        <img src="{{ asset('images/categories/' . $category->photopath) }}" alt="{{ $category->name }}"
                            class="object-cover w-full h-full ">
                    </div>
                    <p class="mt-2 text-sm font-semibold text-gray-600 ">{{ Str::limit($category->name, 10) }}</p>
                    <!-- Truncate for long names -->
                </div>
            </a>
        @endforeach
    </div>

    <!-- Tailwind CSS Custom Styles -->
    <style>
        /* Hide default scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>


    <div class="px-2 mt-5">
        <div class="pl-2 mb-4 border-l-4 border-yellow-500">
            <h1 class="lg:text-3xl text-xl font-bold text-[#9a031fdd]">NEW ARRIVALS</h1>
            <p class="text-sm text-gray-600 lg:text-lg">Discover our latest collection! Unveiling fresh styles and must-have
                products.
            </p>
        </div>


    </div>

    <!-- Container for horizontal scrolling on small and medium devices -->
    <!-- Container for horizontal scrolling on small and medium devices -->
    <div class="mx-3 mt-5 overflow-x-auto hide-scrollbar">
        <!-- For small and medium devices, use flex for horizontal scrolling; for large devices, use grid -->
        <div class="flex gap-2 sm:flex-nowrap lg:grid lg:grid-cols-4">
            <!-- Product Loop -->
            @foreach ($products as $product)
                <a href="{{ route('viewproduct', $product->id) }}" class="flex-shrink-0 lg:col-span-1">
                    <!-- Product card with responsive min-width -->
                    <div class="overflow-hidden mt-2 border rounded-lg shadow-lg min-w-[16rem] max-w-[18rem]">
                        <img src="{{ asset('images/products/' . $product->photopath) }}" alt="{{ $product->name }}"
                            class="object-cover w-full h-64">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ Str::limit($product->name, 20) }}</h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($product->description, 20) }}</p>
                            <div class="mt-2">
                                <span class="text-lg font-bold text-gray-900">Rs. {{ $product->price }}</span>
                                @if ($product->discounted_price)
                                    <span class="text-sm text-gray-400 line-through">Rs.
                                        {{ $product->discounted_price }}</span>
                                    <span
                                        class="text-sm font-bold text-red-500">({{ round((($product->discounted_price - $product->price) / $product->discounted_price) * 100) }}%
                                        OFF)</span>
                                @endif
                            </div>
                            <!-- Star Ratings -->
                            <div class="flex items-center mt-2">
                                <div class="flex items-center">
                                    @php
                                        $averageRating = $product->reviews_avg_rating ?? 0;
                                        $fullStars = floor($averageRating);
                                        $halfStars = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStars);
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class='text-yellow-500 bx bxs-star'></i>
                                    @endfor

                                    @if ($halfStars)
                                        <i class='text-yellow-500 bx bxs-star-half'></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class='text-yellow-500 bx bx-star'></i>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-yellow-500">{{ number_format($averageRating, 1) }}</span>
                                <span class="ml-2 text-sm text-gray-400">{{ $product->reviews->count() }} reviews</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- banner section --}}

    <div class="relative  mt-2 w-full h-64 md:h-96 lg:h-[500px]">
        <img src="{{ asset('images/banners/kid4.webp') }}" alt="Sale Banner" class="object-cover w-full h-full">

        <div class="absolute inset-0 opacity-75 bg-gradient-to-t from-black via-transparent"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center text-white">
            <h1 class="mb-2 text-2xl font-bold tracking-wide sm:text-3xl md:text-5xl lg:text-6xl">
                Mega Sale – Up to 70% Off!
            </h1>

            <p class="max-w-xl mb-6 text-base leading-relaxed sm:text-lg md:text-xl lg:text-2xl">
                Exclusive deals on top products – Limited time only!
            </p>

            <a href="#"
                class="px-6 py-3 text-base font-semibold transition-transform duration-300 transform bg-red-600 rounded-lg shadow-lg hover:bg-red-700 hover:scale-105">
                Shop Now
            </a>

            <span
                class="mt-8 text-sm font-semibold tracking-wider text-gray-200 uppercase sm:text-base md:text-lg lg:text-xl opacity-90">
                Explore by Categories
            </span>
        </div>
    </div>


    <div class="px-2 mt-5 ">
        <div class="pl-2 mb-4 ">
            <h1 class="lg:text-3xl text-xl font-bold text-[#9a031fdd]">SHOP BY CATEGORIES</h1>
            <p class="text-sm text-gray-600 lg:text-lg">Check out our top picks for you! Handpicked products that you’ll
                love.</p>
        </div>
    </div>

    <!-- Container for horizontal scrolling on small and medium devices -->
    <div class="grid w-full grid-cols-1 gap-6 px-4 ">
        @foreach ($categories as $category)
            <div class="mb-8">
                <h2 class="pl-2 mb-4 text-2xl font-semibold border-l-4 border-yellow-500">{{ $category->name }}</h2>

                <!-- For small and medium devices, use flex for horizontal scrolling; for large devices, use grid -->
                <div
                    class="flex w-full space-x-2 overflow-x-scroll lg:space-x-2 lg:overflow-hidden md:space-x-6 sm:flex-nowrap lg:grid lg:grid-cols-4 lg:gap-2">
                    <!-- Product Loop -->
                    @foreach ($category->products as $product)
                        <a href="{{ route('viewproduct', $product->id) }}" class="block min-w-[16rem]">
                            <div class="overflow-hidden border rounded-lg shadow-lg">
                                <img src="{{ asset('images/products/' . $product->photopath) }}"
                                    alt="{{ $product->name }}" class="object-cover w-full h-64">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold ">{{ Str::limit($product->name, 20) }}</h3>
                                    <p class="text-sm text-gray-500">{{ Str::limit($product->description, 20) }}</p>
                                    <div class="mt-2">
                                        <span class="text-lg font-bold text-gray-900">Rs. {{ $product->price }}</span>
                                        @if ($product->discounted_price)
                                            <span class="text-sm text-gray-400 line-through">Rs.
                                                {{ $product->discounted_price }}</span>
                                            <span
                                                class="text-sm font-bold text-red-500">({{ round((($product->discounted_price - $product->price) / $product->discounted_price) * 100) }}%
                                                OFF)</span>
                                        @endif
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="flex items-center mt-2">
                                        <div class="flex items-center">
                                            @php
                                                $averageRating = $product->reviews_avg_rating ?? 0;
                                                $fullStars = floor($averageRating);
                                                $halfStars = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - ($fullStars + $halfStars);
                                            @endphp
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class='text-yellow-500 bx bxs-star'></i>
                                            @endfor
                                            @if ($halfStars)
                                                <i class='text-yellow-500 bx bxs-star-half'></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class='text-yellow-500 bx bx-star'></i>
                                            @endfor
                                        </div>
                                        <span
                                            class="ml-2 text-sm text-yellow-500">{{ number_format($averageRating, 1) }}</span>
                                        <span class="ml-2 text-sm text-gray-400">{{ $product->reviews->count() }}
                                            reviews</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>


    {{-- last banner  --}}

    <div class="relative w-full h-64 md:h-96 lg:h-[500px]">
        <img src="{{ asset('images/banners/kid5.webp') }}" alt="Sale Banner" class="object-cover w-full h-full">
        <div class="absolute inset-0 opacity-80 bg-gradient-to-t from-black via-transparent"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white">
            <h1 class="mb-2 text-xl font-bold sm:text-3xl md:text-4xl lg:text-5xl">Mega Sale – Up to 70% Off!</h1>
            <p class="mb-4 text-sm sm:text-lg md:text-xl lg:text-2xl">Exclusive deals on top products – Limited time only!
            </p>
            <a href="#"
                class="px-4 py-2 text-sm font-semibold transition-transform duration-300 bg-red-600 rounded-lg shadow-lg sm:px-6 sm:py-3 sm:text-base hover:bg-red-700 hover:scale-105">
                Explore Now
            </a>
            <span class="mt-4 text-xs font-semibold uppercase sm:text-sm md:text-base lg:text-lg">
                Explore by Categories
            </span>
        </div>


    </div>


























    <!-- Add this CSS to hide the scrollbar while allowing horizontal scrolling -->
    <style>
        /* Hide the scrollbar but keep the horizontal scrolling */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
            /* For Chrome, Safari, and Opera */
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .swiper-slide img {
            transition: transform 0.5s ease;
        }

        .swiper-slide:hover img {
            transform: scale(1.05);
        }
    </style>
@endsection
