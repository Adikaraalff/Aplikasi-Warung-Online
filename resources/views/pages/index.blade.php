<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung AS</title>
    <link href="{{ asset('assets/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/js/tiny-slider.js') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: white;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #2d2d2d;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .featured-section {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 50px;
            padding: 0 20px;
        }

        .form-control {
            width: 350px;
        }

        .img-categori {
            width: 50px;
        }

        .img-categori:hover {
            transform: scale(1.2);
        }

        .card:hover {
            border: 2px solid #2d2d2d;
        }

        /* Responsive styles for different screen sizes */
        /* Small screens (mobile phones) */
        @media (max-width: 767px) {
            .container {
                padding: 10px;
            }

            .featured-section {
                display: flex;
                flex-direction: column;
            }
        }

        /* Medium screens (tablets) */
        @media (min-width: 768px) and (max-width: 991px) {
            .container {
                padding: 15px;
            }

            .featured-section {
                display: flex;
                flex-direction: column;
            }
        }

        /* Large screens (desktops) */
        @media (min-width: 992px) {
            .container {
                padding: 20px;
            }

            .featured-section {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="#">Warung AS<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    @auth
                        @php
                            $user = Auth::user();
                        @endphp
                        @if ($user->hasRole('Client'))
                            <li><a class="nav-link" href="{{ route('dashboard.client') }}"><img
                                        src="{{ asset('assets/img/user.svg') }}"></a></li>
                        @else
                            <li><a class="nav-link" href="{{ route('dashboard') }}"><img
                                        src="{{ asset('assets/img/user.svg') }}"></a></li>
                        @endif
                    @else
                        <!-- If the user is not logged in, you can provide a link to the login page or handle it as you see fit -->
                        <li><a class="nav-link" href="{{ route('login') }}"><img
                                    src="{{ asset('assets/img/user.svg') }}"></a></li>
                    @endauth
                    <li>
                        <a class="nav-link" href="{{ route('carts.show') }}">
                            <img src="{{ asset('assets/img/cart.svg') }}">
                            <span class="cart-count">0</span>
                            <!-- Tambahkan elemen ini untuk menampilkan jumlah item -->
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Warung AS, <span clsas="d-block">Food and Beverage</span></h1>
                        <p class="mb-4">Sedia Makanan dan Minuman.</p>
                        <p><a href="" class="btn btn-secondary me-2">Beli Sekarang</a><a href="#"
                                class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('assets/img/pngtree-food-stall-design-png-image_6142308.png') }}"
                            class="img-fluid" width="480px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Product Sections -->
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($Product as $p)
                <!-- I assume your variable is $products, adjust accordingly -->
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 mb-5">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img class="card-img-top" src="{{ asset('image/' . $p->file) }}" alt="{{ $p->nama_products }}"
                            style="height: 150px; object-fit: cover;" />
                        <!-- Product details -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder">{{ $p->nama_products }}</h5>
                                <!-- Product description -->
                                <p>{{ $p->keterangan }}</p>
                                <!-- Product Price -->
                                <h6>Rp{{ number_format($p->price, 0, ',', '.') }}</h6>
                                <!-- Add to cart button -->
                                <form class="add-to-cart-form" data-product-id="{{ $p->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_users" value="{{ Auth::id() }}">
                                    <input type="hidden" name="id_products" value="{{ $p->id }}">
                                    <input type="number" name="amount" value="1" min="1">
                                    <button type="submit" class="btn btn-primary"
                                        @guest onclick="event.preventDefault(); window.location.href='{{ route('register') }}';" @endguest>
                                        <i class="fas fa-cart-plus"></i>Keranjang</button>
                                    <!-- Buy button -->
                                    <button type="submit" class="btn btn-success"
                                        @guest onclick="event.preventDefault(); window.location.href='{{ route('register') }}';" @endguest>
                                        Beli</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Handle click event on the "Keranjang" button
            $('.add-to-cart-form').submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form associated with the button
                var form = $(this);

                // Perform an AJAX request to add the item to the cart
                $.ajax({
                    type: 'POST',
                    url: '{{ route('carts.add-to-cart') }}',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Update the cart icon in the navbar
                            updateCartIcon(response.cartCount);
                            alert('Product added to cart!');
                        } else {
                            alert('Failed to add product to cart.');
                        }
                    },
                    error: function() {
                        alert('Error adding product to cart.');
                    }
                });
            });

            // You need to implement this function to update the cart icon
            function updateCartIcon(cartCount) {
                // Implement logic to update the cart icon in the navbar
                // This may involve fetching the current cart count from the server
                // and updating the cart icon with the new count
                $('.cart-count').text(cartCount);
            }
        });
    </script>

</body>

</html>
