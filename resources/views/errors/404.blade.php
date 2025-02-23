@extends('layouts.master')
@section('content')
    {{-- generate pagenot found and redirect to homepage link --}}
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-9xl text-[#9a031f] font-bold">404</h1>
            <h2 class="text-3xl text-[#9a031f] font-semibold">Page Not Found</h2>
            <a href="{{ route('home') }}" class="px-4 py-2 mt-4 text-white bg-[#9a031f] rounded hover:bg-[#9a031f]">Back to
                Home</a>
        </div>
    </div>
@endsection
