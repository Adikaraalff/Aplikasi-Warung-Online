@extends('pages.layout')
@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout Success</title>
        {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Tambahkan stylesheet tambahan jika diperlukan -->
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
                background-color: #28a745;
                color: #ffffff;
            }

            .card-body {
                padding: 20px;
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
                            <h4 class="mb-0">Checkout Success</h4>
                        </div>
                        <div class="card-body">
                            <p>Your order has been successfully processed.</p>

                            <!-- Display the order details and confirmation number dynamically -->
                            <p>Your order number: # {{ $uuid }}</p>
                            <p>Items you purchased:</p>
                            <ul>
                                @foreach ($carts as $item)
                                    <li>{{ $item->product->nama_products }}</li>
                                @endforeach
                            </ul>

                            <!-- Additional information if needed -->
                            <p>Thank you for shopping at Warung AS.</p>

                            <!-- Back button -->
                            <a href="{{ route('carts.index') }}" class="btn btn-primary">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Tambahkan script tambahan jika diperlukan -->

    </body>

    </html>
