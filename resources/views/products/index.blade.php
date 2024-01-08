@extends('layout')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Product</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Product</h6>
            </nav>
        </div>
    </nav>
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <div class="container mx-auto">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                                    bis_skin_checked="1">
                                    <h6 class="text-white text-capitalize ps-3">Product Table</h6>
                                </div>
                                <div class="card-header pb-0">
                                    <h4>Product</h4>
                                </div>
                                <div class="pull-right mr-2">
                                    <a class="btn btn-success" href="{{ route('products.create') }}"> Tambah Product</a>
                                    {{-- <a class="btn btn-danger" href="{{ route('lokasi_uangs-pdf') }}"> Export PDF</a> --}}
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="lokasiTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Gambar</th>
                                            <th class="text-center">Aksi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#lokasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columnDefs: [{
                    "targets": 5,
                    "data": 'file',
                    "render": function(data, type, row, meta) {
                        return '<img src="' + '{{ asset('image/') }}' + '/' + data +
                            '" alt="Image" width="50">';
                    }
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_products',
                        name: 'nama_products'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'id_kategoris',
                        name: 'id_kategoris'
                    },
                    {
                        data: 'file',
                        name: 'file',

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>

    <script>
        function deleteConfirm(url) {
            var result = confirm("Are you sure you want to delete this item?");
            if (result) {
                var csrfToken = '{{ csrf_token() }}'; // Use Laravel's csrf_token() function

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            console.log("Item deleted successfully.");
                            location.reload(); // Reload the page after successful deletion
                        } else {
                            console.error("Failed to delete item. Status: " + response.status);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to delete item. Status: " + xhr.status);
                    }
                });
            } else {
                console.log("Deletion canceled for item with url: " + url);
            }
        }
    </script>


    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
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
@endsection
