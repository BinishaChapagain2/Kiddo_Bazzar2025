@extends('layouts.app')

@section('content')
    <div class="flex flex-col flex-1">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-center text-[#9a031f] mt-4 lg:mt-0">Dashboard</h1>
            <hr class="h-1 mt-3 bg-yellow-500">
        </div>

        <!-- Dashboard Cards Section -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <!-- Card: Total Categories -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-category text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Total Categories</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $categories }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Total Products -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-box text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Total Products</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $products }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Total Orders -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-receipt text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Total Orders</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $order }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Total Users -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-user text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Total Users</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $users }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Pending Orders -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-hourglass text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Pending Orders</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $pending }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Processing Orders -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-loader text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Processing Orders</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $processing }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Total Shipping -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-truck text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Total Shipping</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $shipping }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Completed Orders -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                <div class="flex items-center space-x-4">
                    <i class="bx bx-check-circle text-5xl text-[#9a031f]"></i>
                    <div class="flex flex-col text-center lg:text-left">
                        <h2 class="text-xl font-semibold text-[#9a031f]">Completed Orders</h2>
                        <p class="text-4xl font-bold text-[#9a031f]">{{ $delivered }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
