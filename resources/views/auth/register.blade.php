@extends('layouts.master')


@section('content')
    <div class="w-full max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-lg">
        <!-- Logo Section -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/kiddo_bazzar_logo.png') }}" alt="Kiddo Bazzar" class="object-contain w-20 h-20">
        </div>

        <h2 class="text-xl sm:text-xl font-bold text-[#051923] text-center mb-6">Register for Kiddo Bazzar</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Profile Picture -->
            <div>
                <label for="profilePicture" class="block text-[#051923] font-medium mb-2">Profile Picture</label>
                <input type="file" id="profilePicture" name="profilePicture" value="" accept="image/*"
                    class="w-full border border-gray-300 rounded-md  text-[#051923]">
            </div>

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-[#051923] font-medium mb-2">Full Name</label>
                <input id="name"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Enter your full name" />

                {{-- error throw --}}
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-[#051923] font-medium mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    placeholder="Enter your phone number" required>
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-[#051923] font-medium mb-2">Email</label>

                <input id="email"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    type="email" name="email" :value="old('email')" required autocomplete="username"
                    placeholder="Enter your email" />

                {{-- error throw --}}
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <!-- Gender -->
            <div>
                <label class="block text-[#051923] font-medium mb-2">Gender</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="gender" value="male" class="text-[#051923] focus:ring-[#051923]"
                            required>
                        <span class="ml-2 text-[#051923]">Male</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="gender" value="female" class="text-[#051923] focus:ring-[#051923]"
                            required>
                        <span class="ml-2 text-[#051923]">Female</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="gender" value="other" class="text-[#051923] focus:ring-[#051923]"
                            required>
                        <span class="ml-2 text-[#051923]">Other</span>
                    </label>
                </div>
            </div>


            <!-- Address -->

            <div>
                <label for="address" class="block text-[#051923] font-medium mb-2">Address</label>
                <input id="address"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    type="text" name="address" required autocomplete="address" placeholder="Enter your address" />

                {{-- error throw --}}
                @error('address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>


            <!-- Password -->
            <div>
                <label for="password" class="block text-[#051923] font-medium mb-2">Password</label>

                <input id="password"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Enter your password" />


                {{-- error throw --}}
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#051923] text-[#051923]"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm your password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-2 text-white transition duration-300 bg-[#9a031fdd] rounded-md ">
                    Register
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <p class="mt-4 text-center text-yellow-500">Already have an account?
            <a href="{{ route('login') }}" class="text-[#051923] hover:underline">Login here</a>
        </p>
    </div>
@endsection
