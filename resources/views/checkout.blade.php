@extends('layouts.master')

@section('content')
    <div class="container py-10 mx-auto">
        <!-- Checkout Container -->
        <div class="grid max-w-4xl mx-auto bg-white rounded-lg shadow-lg lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2">

            {{-- <!-- Image on the Left Side (Full Height) -->
            <div class="relative hidden md:block">
                <img src="{{ asset('images/onlinepaymentpicture.png') }}" alt="Checkout Image"
                    class="object-cover w-full h-full rounded-l-lg">
            </div> --}}


            <!-- Product Information -->
            <div class="p-5 mb-6 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-semibold underline mb-10 text-center text-[#9a031fdd]">Product Information</h3>
                <p><strong>Product Image:</strong>
                    <img src="{{ asset('images/products/' . $cart->product->photopath) }}" alt="{{ $cart->product->name }}"
                        class="h-24 mx-auto">
                </p>

                <p><strong>Name:</strong> {{ $cart->product->name }}</p>
                <p><strong>Quantity:</strong> {{ $cart->qty }}</p>


                <p><strong>Discount Price:</strong> <span
                        class="text-[#9a031fdd]">Rs.{{ number_format($cart->product->discounted_price, 2) }}</span> </p>
                <p><strong>TotalPrice:</strong> Rs.{{ number_format($cart->total, 2) }}</p>





                <p><strong>Description:</strong> {{ $cart->product->description }}</p>

            </div>

            <!-- Payment Options on the Right Side -->
            <div class="flex flex-col justify-center p-8 rounded-r-lg bg-gray-50">




                <!-- Cash on Delivery Option -->
                <div class="p-5 mb-6 bg-white rounded-lg shadow-md">
                    <h3 class="flex items-center mb-4 text-xl font-semibold text-yellow-600">
                        <i class="mr-2 text-2xl bx bx-package"></i> Cash On Delivery
                    </h3>
                    <form action="{{ route('order.storecod') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-5 py-3 text-white transition duration-300 bg-yellow-500 rounded-lg hover:bg-yellow-600">
                            Cash On Delivery
                        </button>
                    </form>
                </div>

                <!-- eSewa Payment Option -->
                <div class="p-5 bg-white rounded-lg shadow-md">
                    <h3 class="flex items-center mb-4 text-xl font-semibold text-[#039a05ed]">
                        <i class="mr-2 text-2xl bx bx-wallet"></i> Pay with eSewa
                    </h3>
                    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                        <input type="hidden" id="amount" name="amount" value="{{ $cart->total }}" required>
                        <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
                        <input type="hidden" id="total_amount" name="total_amount" value="{{ $cart->total }}" required>
                        <input type="hidden" id="transaction_uuid" name="transaction_uuid" required>
                        <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0"
                            required>
                        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0"
                            required>
                        <input type="hidden" id="success_url" name="success_url"
                            value="{{ route('order.store', $cart->id) }}" required>
                        <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
                        <input type="hidden" id="signed_field_names" name="signed_field_names"
                            value="total_amount,transaction_uuid,product_code" required>
                        <input type="hidden" id="signature" name="signature" required>
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-5 py-3 text-white transition duration-300 bg-[#039a05d0] rounded-lg hover:bg-[#039a05]">
                            Pay with eSewa
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
