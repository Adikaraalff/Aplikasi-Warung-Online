@extends('pages.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Checkout Process</h4>
                    </div>
                    <div class="card-body">
                        <p>Review your order details and complete the checkout process.</p>

                        <!-- Check if $cartItems is not null before looping through it -->
                        @if (!is_null($cartItems) && count($cartItems) > 0)
                            <!-- Display the order items dynamically -->
                            <p>Order Summary:</p>
                            <ul>
                                @foreach ($cartItems as $cartItem)
                                    <li>{{ $cartItem->product->name }} - {{ $cartItem->amount }} pcs</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Your cart is empty.</p>
                        @endif

                        <!-- Display the total amount dynamically -->
                        <p>Total Amount: Rp{{ $totalAmount }}</p>

                        <!-- Form for additional checkout information -->
                        <form action="{{ route('checkout.process') }}" method="post">
                            @csrf
                            <!-- Add necessary form fields here (e.g., shipping address, payment method) -->

                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
                            </div>

                            <!-- Add more form fields as needed -->

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary">Complete Checkout</button>
                        </form>

                        <!-- Link to go back to the cart -->
                        <a href="{{ route('carts.index') }}" class="btn btn-secondary">Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
