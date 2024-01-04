@php
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>Dashboard</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is an easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA, and PECR. -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryvalidate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
    @if ($user->hasRole('Client'))
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
            id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard"
                    target="_blank">
                    <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
            <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        @if ($user->hasRole('Client'))
                            <a class="nav-link text-white active bg-gradient-primary"
                                href="{{ route('dashboard.client') }}">
                            @else
                                <a class="nav-link text-white active bg-gradient-primary"
                                    href="{{ route('dashboard') }}">
                        @endif
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account
                            pages
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('client.profile') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('logout') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">login</i>
                            </div>
                            <span class="nav-link-text ms-1">Sign out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    @else
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
            id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard"
                    target="_blank">
                    <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
            <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('products.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Product</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('kategoris.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">receipt_long</i>
                            </div>
                            <span class="nav-link-text ms-1">Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management
                            Roles
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('roles.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">view_in_ar</i>
                            </div>
                            <span class="nav-link-text ms-1">Role</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('users.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                            </div>
                            <span class="nav-link-text ms-1">User</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account
                            pages
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="#">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('logout') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">login</i>
                            </div>
                            <span class="nav-link-text ms-1">Sign out</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="#">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">notifications</i>
                            </div>
                            <span class="nav-link-text ms-1">Notifications</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    @endif
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach(function(navLink) {
                navLink.addEventListener("click", function() {
                    // Hapus kelas "active" dari semua elemen dengan kelas "nav-link"
                    navLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });

                    // Tambahkan kelas "active" pada tombol yang diklik
                    this.classList.add("active");
                });
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
</body>

</html>
