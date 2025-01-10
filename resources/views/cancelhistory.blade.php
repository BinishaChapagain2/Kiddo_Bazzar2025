@extends('layouts.master')

@section('content')
    <div class="container px-6 py-12 mx-auto">
        <h1 class="px-6 mb-8 text-3xl font-bold text-[#9a031f] border-l-8 border-yellow-500">My History</h1>

        @if ($ordershistory->isEmpty())
            <div class="p-6 mb-8 text-yellow-800 bg-yellow-100 border-l-8 border-yellow-500 rounded-lg shadow">
                <p class="text-lg">You have no orders history yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ordershistory as $order)
                    <div
                        class="p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-lg hover:shadow-xl hover:scale-105">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt="Product Image"
                                class="object-cover w-24 h-24 border border-gray-200 rounded-lg">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    {{ $order->product->name ?? 'Product not available' }}</h2>
                                <p class="text-sm text-gray-600">Order ID: #{{ $order->id }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm"><strong>Quantity:</strong> {{ $order->qty }}</p>
                            <p class="text-sm"><strong>Price:</strong> Rs.{{ number_format($order->price, 2) }}</p>
                            <p class="text-sm"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                            <p class="text-sm"><strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
                            {{-- <p class="mt-2 text-sm font-semibold">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-bold rounded-full
                                    {{ $order->status == 'Pending' ? 'bg-yellow-500 text-white' : ($order->status == 'Shipping' ? 'bg-blue-500 text-white' : ($order->status == 'Processing' ? 'bg-orange-500 text-white' : ($order->status == 'Completed' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'))) }}">
                                    {{ $order->status }}
                                </span>
                            </p> --}}
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <button onclick="showPopup('{{ $order->id }}')"
                                class="px-4 py-2 text-white transition bg-red-600 rounded hover:bg-red-700">Delete
                                History</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Popup Modal --}}
    <div class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-900 bg-opacity-50 backdrop-blur-sm"
        id="popup">
        <form action="{{ route('cancelhistory.destroy', '') }}" method="POST" class="p-8 bg-white rounded-lg shadow-lg">
            @csrf
            @method('DELETE')
            <h3 class="mb-6 text-lg font-semibold text-gray-800">Are you sure you want to remove your order history?</h3>
            <input type="hidden" id="dataid" name="dataid">
            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Yes,
                    Cancel</button>
                <button type="button" onclick="hidePopup()"
                    class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">No, Keep It</button>
            </div>
        </form>
    </div>

    <script>
        function showPopup(id) {
            document.getElementById('popup').classList.remove('hidden');
            document.getElementById('popup').classList.add('flex');
            document.getElementById('dataid').value = id;
        }

        function hidePopup() {
            document.getElementById('popup').classList.add('hidden');
            document.getElementById('popup').classList.remove('flex');
        }
    </script>
@endsection
