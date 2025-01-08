@extends('layouts.master')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">
                {{ __('Reset Your Password') }}
            </h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                    <x-text-input id="email" class="block w-full p-2 mt-1 border rounded-md " type="email"
                        name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                    <x-text-input id="password" class="block w-full p-2 mt-1 border rounded-md " type="password"
                        name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-semibold" />
                    <x-text-input id="password_confirmation" class="block w-full p-2 mt-1 border rounded-md "
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <div class="flex items-center justify-center">
                    <x-primary-button class="transition duration-300 ease-in-out bg-[#9a031fdd]">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-[#a1c181] hover:underline">
                        {{ __('Remember your password? Login here.') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
