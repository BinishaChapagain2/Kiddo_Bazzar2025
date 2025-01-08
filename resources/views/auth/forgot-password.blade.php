@extends('layouts.master')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
            <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">
                {{ __('Reset Your Password') }}
            </h2>

            <div class="mb-4 text-sm text-center text-gray-600">
                {{ __('Forgot  password? Enter your email to get a reset link.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                    <x-text-input id="email" class="block w-full mt-1 border rounded-md " type="email" name="email"
                        :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <div class="flex items-center text-center">
                    <x-primary-button class="bg-yellow-500 w-max hover:bg-yellow-600">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-[#9a031fdd] hover:underline">
                        {{ __('Remembered your password? Login here.') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
