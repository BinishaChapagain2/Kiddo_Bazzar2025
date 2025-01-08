@extends('layouts.master')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 space-y-8 bg-white ">

        <!-- Profile Header -->
        <div class="p-6 dark:bg-gray-800 sm:p-8">
            <h2 class="text-2xl lg:text-3xl font-bold text-center text-[#9a031fdd]">
                {{ __('My Profile Information') }}
            </h2>
        </div>

        <!-- Update Profile Information Form -->
        <div class="p-6 bg-white shadow-md dark:bg-gray-800 sm:p-8">
            <div class="w-full">

                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password Form -->
        <div class="p-6 bg-white shadow-md dark:bg-gray-800 sm:p-8">
            <div class="w-full">

                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account Form -->
        <div class="p-6 bg-white shadow-md dark:bg-gray-800 sm:p-8">
            <div class="w-full">

                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
