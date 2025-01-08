<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Professional eCommerce website for kids' products including toys, clothes, and accessories.">
    <title>Kiddo_Bazzar</title>

    <!-- Tailwind CSS & Boxicons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- swiper js  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- swiper js --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('images/kiddo_bazzar_logo.png') }}" type="image/png">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        /* Custom Font */
        body {

            font-family: 'Poppins', sans-serif;
        }

        /* Hover effect for product card */
        .product-card:hover .hover-zoom {
            transform: scale(1.05);
        }

        /* Smooth Fade-in Effect */
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-50">
    @include('layouts.alert')


    <!-- Header -->
    <header class="sticky top-0 z-50 w-full bg-white shadow-md">
        <div class="flex items-center justify-between w-full px-4 mx-auto max-w-7xl">
            <!-- Logo -->
            <a class="text-3xl font-bold text-orange-500" href="{{ route('home') }}">
                <img src="{{ asset('images/kiddo_bazzar_logo.png') }}" alt="kiddobazzaricon" class="h-12 lg:h-16">
            </a>

            {{-- Search Bar (Visible on all screen sizes) --}}
            <div class="flex items-center justify-between bg-gray-100 rounded-full lg:flex">
                <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                    <input type="search"
                        class="w-40 px-2 py-2 bg-transparent rounded-full sm:w-60 md:w-80 lg:w-96 focus:outline-none"
                        placeholder="Your Child Favourite Clothes....." name="search"
                        value="{{ request()->query('search') }}">
                    <button class="flex items-center justify-center px-2 py-2" type="submit">
                        <i class="text-gray-600 bx bx-search"></i>
                    </button>
                </form>
            </div>



            <!-- Mobile Menu Button (Visible on small screens) -->
            <div class="flex items-center lg:hidden">
                <button id="mobile-menu-button">
                    <i class='text-lg text-gray-600 bx bx-menu-alt-right'></i>
                </button>
            </div>

            <!-- Icons (Hidden on small screens, visible on large screens) -->
            <div class="items-center hidden space-x-8 lg:flex">
                <!-- Cart Icon -->

                <a href="{{ route('mycart') }}" class="relative text-gray-600 hover:text-[#9a031fdd]">
                    <i class='text-2xl bx bx-cart'></i>
                    @auth
                        @if (auth()->user()->cart->count() > 0)
                            <span
                                class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs text-white bg-[#9a031fdd] rounded-full">
                                {{ auth()->user()->cart->count() }}
                            </span>
                        @endif
                    @endauth
                </a>


                <!-- Auth Section (User Profile) -->
                @auth
                    <div class="relative group">
                        <!-- Profile Picture auth -->
                        <div class="relative inline-block">
                            @if (auth()->user()->profilePicture)
                                <img class="object-cover w-10 h-10 rounded-full cursor-pointer"
                                    src="{{ asset('images/profilePictures/' . auth()->user()->profilePicture) }}"
                                    alt="User Profile">
                            @else
                                <div
                                    class="flex items-center justify-center w-10 h-10 text-white bg-[#9a031fdd] rounded-full cursor-pointer">
                                    <span class="font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>


                        <div
                            class="absolute right-0 hidden w-40 bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700 group-hover:block">
                            <a href="{{ route('myorder') }}"
                                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="bx bxs-shopping-bag text-[#9a031fdd] mr-2"></i> My Orders
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="bx bxs-user text-[#9a031fdd] mr-2"></i> My Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full px-4 py-2 text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="bx bxs-log-out-circle text-[#9a031fdd] mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register for unauthenticated users -->

                    <div class="hidden sm:block">
                        <span>
                            <a href="{{ route('login') }}" class="text-[#9a031fdd]"> <i class='bx bx-log-in'></i> Login</a>
                        </span>
                        <strong>/</strong>
                        <span>
                            <a href="{{ route('register') }}" class="text-yellow-500">

                                Register</a>
                        </span>
                    </div>
                @endauth
            </div>
        </div>

        {{-- <!-- Mobile Dropdown Menu (Hidden by default, shown when the menu icon is clicked) -->
        <div class="hidden p-4 lg:hidden" id="mobile-menu  z-50">
            <ul>
                <li><a href="{{ route('home') }}" class="block py-2">Home</a></li>
                <li><a href="{{ route('mycart') }}" class="block py-2">My Cart</a></li>
                @auth
                    <li><a href="{{ route('profile.edit') }}" class="block py-2">My Profile</a></li>
                    <li><a href="{{ route('myorder') }}" class="block py-2">My Orders</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-2 text-left">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="block py-2">Login</a></li>
                    <li><a href="{{ route('register') }}" class="block py-2">Register</a></li>
                @endauth
            </ul>
        </div> --}}

        {{-- <!-- Mobile Search Bar (only visible on mobile) -->
        <div class="p-4 bg-gray-100 lg:hidden">
            <input type="text" class="w-full px-4 py-2 bg-transparent rounded-full" placeholder="Search products...">
        </div> --}}

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden p-6 bg-white shadow-lg lg:hidden">
            <ul>
                <li><a href="#" class="block py-1 text-gray-600 hover:text-[#c59953] border">Home</a>
                </li>
                <li><a href="#" class="block py-1 text-gray-600 hover:text-[#c59953]">Shop</a></li>
                <li><a href="#" class="block py-1 text-gray-600 hover:text-[#c59953]">Categories</a></li>
                <li><a href="#" class="block py-1 text-gray-600 hover:text-[#c59953]">Contact</a></li>
                <li><a href="{{ route('mycart') }}" class="block py-1 text-gray-600 hover:text-[#c59953]">MyCart</a>
                </li>

                @guest
                    <li><a href="{{ route('login') }}" class="block py-1 text-gray-600 hover:text-[#c59953]">Login</a>
                    </li>
                    <li><a href="{{ route('register') }}"
                            class="block py-1 text-gray-600 hover:text-[#c59953]">Register</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('myorder') }}" class="block py-1 text-gray-600 hover:text-[#c59953]">My
                            Orders</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="block py-1 text-gray-600 hover:text-[#c59953]">My
                            Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="block py-1 text-gray-600 hover:text-[#c59953] w-full text-left">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </header>




    @yield('content')



    <!-- Footer -->
    <footer class="px-8 py-8 bg-[#9a031fdd] text-white mt-10">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                <!-- Logo and Social Icons -->
                <div class="-ml-0 lg:-ml-10">
                    <a href="#" aria-label="Kiddo Bazzar Home">
                        <img src="{{ asset('images/kiddo_bazzar_logo.png') }}" alt="Kiddo Bazzar Logo"
                            class="w-40 mb-6 sm:w-52" loading="lazy" />
                    </a>
                    <ul class="flex space-x-4 text-2xl sm:text-3xl">
                        <li>
                            <a href="#" aria-label="Facebook" class="transition-colors hover:text-blue-600">
                                <i class="bx bxl-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-label="TikTok" class="transition-colors hover:text-black">
                                <i class="bx bxl-tiktok"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-label="Instagram" class="transition-colors hover:text-red-600">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-label="WhatsApp" class="transition-colors hover:text-green-600">
                                <i class="bx bxl-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold tracking-wide underline">Our Categories</h4>
                    <ul class="space-y-3">
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('categoryproduct', $category->id) }}"
                                    class="text-sm transition-colors md:text-base hover:text-white">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Account -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold tracking-wide underline">Account</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="text-sm transition-colors md:text-base hover:text-white">My
                                Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('mycart') }}"
                                class="text-sm transition-colors md:text-base hover:text-white">My Cart
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('myorder') }}"
                                class="text-sm transition-colors md:text-base hover:text-white">My
                                Order</a>
                        </li>

                    </ul>
                </div>

                <!-- Information -->
                <div class="-ml-0 lg:-ml-10">
                    <h4 class="mb-4 text-lg font-semibold tracking-wide underline">Information</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('aboutpage') }}"
                                class="text-sm transition-colors md:text-base hover:text-white">About
                                Us</a>
                        </li>
                        <li>
                            <a href="{{ route('whyKiddoBazzar') }}"
                                class="text-sm transition-colors md:text-base hover:text-white">Why
                                Kiddo Bazzar?</a>
                        </li>

                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="mb-8 -ml-0 lg:-ml-10 lg:mb-12">
                    <h4 class="mb-6 text-lg font-semibold tracking-wide underline lg:text-xl">Contact Us</h4>
                    <ul class="space-y-3 lg:space-y-4">
                        <!-- Address -->
                        <li class="flex items-start lg:items-center">
                            <span class="font-medium ">Address:</span>
                            <a href="#"
                                class="mt-1 ml-2 text-sm transition-colors md:text-base hover:text-white">
                                Narayanghat
                            </a>
                        </li>
                        <!-- Phone Number -->
                        <li class="flex items-start lg:items-center">
                            <span class="font-medium ">Phone:</span>
                            <a href="tel:+977-9845678901"
                                class="mt-1 ml-2 text-sm transition-colors md:text-base hover:text-white">
                                +977-9845678901
                            </a>
                        </li>
                        <!-- Email -->
                        <li class="flex items-start lg:items-center">
                            <span class="font-medium ">Email:</span>
                            <a href="mailto:info@kiddobazzar.com"
                                class="mt-1 ml-2 text-sm transition-colors md:text-base hover:text-white">
                                info@kiddobazzar.com
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="my-10 border-gray-300" />

            <div class="flex flex-col items-center justify-between md:flex-row">
                <ul class="flex mb-6 space-x-6 text-sm md:mb-0 md:text-base">
                    <li>
                        <a href="{{ route('termandcondition') }}" class="transition-colors hover:text-white">Terms of
                            Service</a>
                    </li>


                </ul>
                <p class="text-sm text-center md:text-right">
                    © {{ date('Y') }} Kiddo Bazzar. All rights reserved. | Developed by:
                    <a href="#" class="underline hover:text-gray-300">Binisha Chapagain</a>
                </p>
            </div>
        </div>
    </footer>


    <!-- Boxicons Script -->
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- JavaScript to toggle search bar and menu -->
    <script>
        // Toggle mobile search bar
        document.getElementById('mobile-search-button').addEventListener('click', function() {
            document.getElementById('mobile-search-bar').classList.toggle('hidden');
        });
    </script>

</body>

</html>
