{{-- error 500 --}}
@extends('layouts.master')
@section('content')
    {{-- generate internal server error and redirect to homepage link --}}
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-9xl text-[#9a031f] font-bold">500</h1>
            <h2 class="text-3xl text-[#9a031f] font-semibold">Internal Server Error</h2>
            <a href="{{ route('home') }}" class="px-4 py-2 mt-4 text-white bg-[#9a031f] rounded hover:bg-[#9a031f]">Back to
                Home</a>
        </div>
    </div>
@endsection
