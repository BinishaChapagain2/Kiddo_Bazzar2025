@extends('layouts.master')

@section('content')
    <div class="checkout-container"
        style="display: flex; gap: 20px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
        <!-- Product Information Section -->
        <div class="product-info"
            style="flex: 1 1 100%; max-width: 100%; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 20px;">Product Information</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <img src="{{ asset('images/products/' . $product->photopath) }}" alt="{{ $product->name }} "
                    style="height: 150px; width: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <div style="flex: 1;">
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Quantity:</strong> {{ $qty }}</p>
                    <p><strong>Discount Price:</strong> <span style="color: red;">Rs. {{ $price }}</span></p>
                    <p><strong>Total Price:</strong> Rs. {{ $total }}</p>
                    <p><strong>Description:</strong> Description for {{ $product->name }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Options Section -->
        <div class="payment-options "
            style="flex: 1 1 100%; max-width: 100%;  background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 20px;">Payment Options</h3>

            <!-- Cash on Delivery -->
            <form action="{{ route('buynow.placeOrder') }}" method="POST" style="margin-bottom: 20px;">
                @csrf
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
                <input type="hidden" name="address" value="{{ auth()->user()->address }}">
                <input type="hidden" name="payment_method" value="COD">
                <button type="submit" class="bg-[#9a031fdd]"
                    style="display: block; width: 100%; padding: 10px;  color: #fff; border: none; border-radius: 4px; font-size: 16px;">
                    {{-- icon of Cash on Delivery --}}
                    <i class='bx bx-package' style="font-size: 20px; margin-right: 10px;"></i>
                    Place
                    Order</button>
            </form>

            <!-- eSewa Payment -->
            <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                <input type="hidden" id="amount" name="amount" value="{{ $total }}" required>
                <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
                <input type="hidden" id="total_amount" name="total_amount" value="{{ $total }}" required>
                <input type="hidden" id="transaction_uuid" name="transaction_uuid" required>
                <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                <input type="hidden" id="qty" name="qty" value="{{ $qty }}" required>
                <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                <input type="hidden" id="success_url" name="success_url"
                    value="{{ route('buynow.store', [$product->id, $qty]) }}" required>
                <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
                <input type="hidden" id="signed_field_names" name="signed_field_names"
                    value="total_amount,transaction_uuid,product_code" required>
                <input type="hidden" id="signature" name="signature" required>
                <button type="submit"
                    style="display: block; width: 100%; padding: 10px; background-color: #2CB742; color: #fff; border: none; border-radius: 4px; font-size: 16px;">
                    {{-- icon of eSewa --}}
                    <i class='bx bx-wallet' style="font-size: 20px; margin-right: 10px;"></i>
                    Pay
                    with eSewa</button>
            </form>
        </div>
    </div>

    @php
        // Generate transaction_uuid and signature for eSewa payment gateway integration unique to each transaction
        $transaction_uuid = auth()->id() . time();
        $totalamount = $total;
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

    <style>
        /* Responsive Styling */
        @media (min-width: 768px) {

            .product-info,
            .payment-options {
                flex: 1 1 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 767px) {

            .product-info,
            .payment-options {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection
