@extends('layouts.master')
@section('content')
    <div class="px-4 md:px-16">
        <div class="pl-4 mt-5 mb-4 border-l-4 border-yellow-500">
            <h1 class="lg:text-3xl text-2xl font-bold text-[#a1c181]">SEARCH RESULTS</h1>
        </div>

        <div class="mx-3 mt-5">
            <!-- Responsive grid for all devices -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <!-- Product Loop -->
                @forelse ($products as $product)
                    <a href="{{ route('viewproduct', $product->id) }}" class="flex flex-col">
                        <!-- Product card with responsive design -->
                        <div
                            class="overflow-hidden transition-transform duration-200 border rounded-lg shadow-lg hover:scale-105">
                            <img src="{{ asset('images/products/' . $product->photopath) }}" alt="{{ $product->name }}"
                                class="object-cover w-full h-64">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ Str::limit($product->name, 20) }}</h3>
                                <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
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
                                {{-- Display the stars for average rating --}}
                                <div class="flex items-center mt-2">
                                    <div class="flex items-center">
                                        @php
                                            // Use the average rating calculated from the model
                                            $averageRating = $product->reviews_avg_rating ?? 0; // Use 0 if no reviews
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
                                    <span class="ml-2 text-sm text-gray-400">{{ $product->reviews->count() }} reviews</span>
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
        </div>
    </div>

    {{-- paginalition link --}}
    <div class="mt-10">
        {{ $products->links() }}

    </div>

@endsection
