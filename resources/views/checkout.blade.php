@extends('layouts.master')

@section('content')
    <div class="container py-12 mx-auto">
        <!-- Checkout Container -->
        <div
            class="grid max-w-5xl mx-auto overflow-hidden bg-white shadow-2xl rounded-2xl lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2">
            <!-- Product Information -->
            <div class="p-8 bg-gray-100">
                <h3 class="text-2xl font-bold text-center text-[#9a031f] mb-8">Product Overview</h3>
                <div class="flex flex-col items-center gap-4">
                    <img src="{{ asset('images/products/' . $cart->product->photopath) }}" alt="{{ $cart->product->name }}"
                        class="object-cover w-40 h-40 shadow-md rounded-xl">
                    <p class="text-lg font-medium">{{ $cart->product->name }}</p>
                    <p class="text-sm text-gray-600">{{ $cart->product->description }}</p>
                    <p class="text-lg font-semibold">Quantity: <span class="text-gray-800">{{ $cart->qty }}</span></p>
                    <p class="text-lg font-semibold">Discount Price: <span
                            class="text-green-600">Rs.{{ number_format($cart->product->discounted_price, 2) }}</span></p>
                    <p class="text-xl font-bold">Total: <span
                            class="text-red-600">Rs.{{ number_format($cart->total, 2) }}</span></p>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="flex flex-col justify-center p-10 bg-white">
                <!-- Cash on Delivery Option -->
                <div class="p-6 mb-8 transition duration-300 shadow-lg bg-gray-50 rounded-xl hover:shadow-2xl">
                    <h3 class="flex items-center mb-4 text-xl font-bold text-yellow-600">
                        <i class="mr-2 text-3xl bx bx-package"></i> Cash On Delivery
                    </h3>
                    <form action="{{ route('order.storecod') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                        <button type="submit"
                            class="w-full py-3 font-semibold text-white transition duration-300 bg-yellow-500 rounded-lg hover:bg-yellow-600">
                            Confirm COD Order
                        </button>
                    </form>
                </div>

                <!-- eSewa Payment Option -->
                <div class="p-6 transition duration-300 shadow-lg bg-gray-50 rounded-xl hover:shadow-2xl">
                    <h3 class="flex items-center mb-4 text-xl font-bold text-green-600">
                        <i class="mr-2 text-3xl bx bx-wallet"></i> Pay with eSewa
                    </h3>
                    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                        <input type="hidden" id="amount" name="amount" value="{{ $cart->total }}">
                        <input type="hidden" id="tax_amount" name="tax_amount" value="0">
                        <input type="hidden" id="total_amount" name="total_amount" value="{{ $cart->total }}">
                        <input type="hidden" id="transaction_uuid" name="transaction_uuid">
                        <input type="hidden" id="product_code" name="product_code" value="EPAYTEST">
                        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0">
                        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0">
                        <input type="hidden" id="success_url" name="success_url"
                            value="{{ route('order.store', $cart->id) }}">
                        <input type="hidden" id="failure_url" name="failure_url" value="https://google.com">
                        <input type="hidden" id="signed_field_names" name="signed_field_names"
                            value="total_amount,transaction_uuid,product_code">
                        <input type="hidden" id="signature" name="signature">
                        <button type="submit"
                            class="w-full py-3 font-semibold text-white transition duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                            Pay Securely with eSewa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php
        $transaction_uuid = auth()->id() . time();
        $totalamount = $cart->total;
        $productcode = 'EPAYTEST';
        $datastring =
            'total_amount=' . $totalamount . ',transaction_uuid=' . $transaction_uuid . ',product_code=' . $productcode;
        $secret = '8gBm/:&EnhH.1/q';
        $signature = hash_hmac('sha256', $datastring, $secret, true);
        $signature = base64_encode($signature);
    @endphp

    <script>
        document.getElementById('transaction_uuid').value = '{{ $transaction_uuid }}';
        document.getElementById('signature').value = '{{ $signature }}';
    </script>
@endsection
