@extends('layouts.master')

@section('content')
    <div class="bg-[#F5F5F5] py-5">
        <div class="container px-4 mx-auto text-center">




            <div>
                <h1 class="text-3xl font-semibold text-[#9a031fdd] mb-6 pl-2">
                    <a href="{{ route('home') }}" class="text-[#9a031fdd]">Home</a> / About Us
                </h1>
            </div>

            <!-- Image Section -->

            <img src="{{ asset('images/firstsliderpic.webp') }}" alt="About Us Image"
                class="top-0 object-cover w-full rounded-lg h-96">



            <!-- Description Section -->
            <div class="mt-12">
                <p class="max-w-full text-lg leading-relaxed text-justify text-gray-700 ">
                    Welcome to <strong class="text-[#9a031fdd]">Kiddo Bazar</strong>, your one-stop online destination for
                    everything your little ones need! Whether you're shopping for stylish kids' clothing, fun toys,
                    educational materials, or unique accessories, we have it all. Our aim is to offer a wide selection of
                    high-quality products that ensure your child’s happiness and well-being.
                </p>
            </div>

            <!-- Mission Section -->
            <div class="mt-16">
                <h3 class="text-3xl font-semibold text-[#9a031fdd] mb-4">Our Mission</h3>
                <p class="max-w-full text-lg leading-relaxed text-justify text-gray-700">
                    At <strong class="text-[#9a031fdd]">Kiddo Bazar</strong>, our mission is simple – to bring joy to your
                    child's life by providing a range of high-quality, safe, and fun products that parents can trust. We
                    believe that children deserve the best, and that's why we work with top brands to bring you the latest
                    and greatest in children's fashion, toys, and more.
                </p>
            </div>

            <!-- Vision Section -->
            <div class="mt-16">
                <h3 class="text-3xl font-semibold text-[#9a031fdd] mb-4">Our Vision</h3>
                <p class="max-w-full text-lg leading-relaxed text-justify text-gray-700">
                    Our vision is to be the go-to destination for parents looking for high-quality, affordable, and
                    stylish products for their children. We want to make shopping for kids' items easy and enjoyable, so
                    you can spend more time making memories with your little ones.
                </p>

            </div>



        </div>


    </div>
@endsection
