@extends('layouts.master')

@section('content')
    <div class="py-5 ">
        <div class="container px-6 mx-auto text-center text-white">
            <!-- Hero Section -->
            <div class="relative mb-16">
                <img src="{{ asset('images/diwali2.webp') }}" alt="Why Kiddo Bazar"
                    class="object-cover w-full  shadow-lg h-[500px] transform transition-all hover:scale-105">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 ">
                    <h2 class="text-5xl font-bold tracking-wide text-white drop-shadow-lg">Why Choose Kiddo Bazar?</h2>
                </div>
            </div>

            <!-- Value Proposition Section -->
            <div class="px-4 mb-12 md:px-8">
                <p class="max-w-full mx-auto text-xl leading-relaxed text-black">
                    At <strong class="text-[#9a031fdd]">Kiddo Bazar</strong>, we prioritize your child’s happiness, safety,
                    and growth. Our carefully curated selection of high-quality products, exceptional customer service, and
                    dedication to innovation make us the best choice for all your kid’s needs. Here’s why Kiddo Bazar is the
                    go-to destination for parents across the globe:
                </p>
            </div>
        </div>
    </div>

    <!-- Key Reasons Section -->
    <div class="py-20 bg-white">
        <div class="container px-6 mx-auto">
            <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
                <!-- Reason 1 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-3xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Quality & Safety First</h3>
                    <p class="text-lg text-black">
                        We ensure that all of our products meet strict safety and quality standards. From clothing to toys
                        and accessories, every product is carefully tested to guarantee your child's well-being.
                    </p>
                </div>

                <!-- Reason 2 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-2xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Affordable Prices</h3>
                    <p class="text-lg text-black">
                        We believe in providing top-notch products at competitive prices. Kiddo Bazar offers incredible
                        value for money without compromising on the quality of items we offer.
                    </p>
                </div>

                <!-- Reason 3 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-2xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Curated for Every Age</h3>
                    <p class="text-lg text-black">
                        Whether your little one is an infant or a young child, we offer a diverse range of products designed
                        for every stage of growth. We ensure that our offerings are age-appropriate and educational.
                    </p>
                </div>

                <!-- Reason 4 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-2xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Fast & Reliable Delivery</h3>
                    <p class="text-lg text-black">
                        Enjoy swift, reliable shipping services. At Kiddo Bazar, we understand the importance of timely
                        deliveries, and we ensure your order reaches you quickly and safely.
                    </p>
                </div>

                <!-- Reason 5 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-2xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Exceptional Customer Support</h3>
                    <p class="text-lg text-black">
                        We’re here to assist you! Our friendly customer support team is always ready to help with any
                        questions or concerns you may have, ensuring a hassle-free shopping experience.
                    </p>
                </div>

                <!-- Reason 6 -->
                <div class="p-8 transition duration-300 transform bg-gray-200 shadow-lg rounded-2xl hover:scale-105">
                    <h3 class="mb-4 text-2xl font-semibold text-[#9a031fdd]">Sustainable & Eco-Friendly</h3>
                    <p class="text-lg text-black">
                        We care about the planet. Kiddo Bazar is committed to offering eco-friendly products and packaging.
                        Our goal is to contribute to a better, greener future for your children.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
