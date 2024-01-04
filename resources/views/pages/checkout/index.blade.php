<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #dee2e6;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }

        .card-body {
            padding: 20px;
        }

        .btn-checkout {
            background-color: #28a745;
            color: #ffffff;
            border: none;
        }

        .btn-back {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Checkout</h4>
                    </div>
                    <div class="card-body">
                        <p>Thank you for shopping at Warung AS.</p>

                        <!-- Display the total amount dynamically -->
                        <p>Total amount of your purchase: Rp{{ $totalAmount }}</p>

                        <!-- Payment and shipping information form -->
                        <form action="{{ route('checkout.process') }}" method="post">
                            @csrf
                            <!-- Add necessary form fields here -->
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
                            </div>
                            <!-- Add more form fields as needed -->

                            <!-- Checkout button -->
                            <button type="submit" class="btn btn-success">Process Checkout</button>
                        </form>

                        <!-- Back button -->
                        <a href="{{ route('carts.index') }}" class="btn btn-primary">Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tambahkan script tambahan jika diperlukan -->

</body>

</html>
