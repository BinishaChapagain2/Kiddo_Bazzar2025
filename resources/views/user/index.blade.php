@extends('layouts.app')

@section('content')
    <div class="w-full max-h-screen px-4 overflow-y-auto sm:px-8">

        {{-- Header Section --}}
        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5 text-[#9a031f] lg:font-bold lg:text-4xl">Users</span>
        </div>
        <hr class="my-2 border-b-2 border-yellow-500">

        {{-- Users Table --}}
        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full text-gray-800 table-auto">
                <thead>
                    <tr class="text-gray-900 bg-gray-200">
                        <th class="p-2 border">S.N</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Phone Number</th>
                        <th class="p-2 border">Address</th>
                        <th class="p-2 border">Gender</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center transition duration-300 ">
                            <td class="p-2 ">{{ $loop->iteration }}</td>
                            <td class="p-2 ">{{ $user->name }}</td>
                            <td class="p-2 ">{{ $user->email }}</td>
                            <td class="p-2 ">{{ $user->phone }}</td>
                            <td class="p-2 ">{{ $user->address }}</td>
                            <td class="p-2 ">{{ $user->gender }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
