@extends('layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="card-header pb-0">
                                    <h4>Tambah Product</h4>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_products">Nama Product:</label>
                                    <input type="text" class="form-control" id="nama_products" name="nama_products"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>

                                <div class="form-group">
                                    <label for="id_kategoris">Kategori:</label>
                                    <select name="id_kategoris" class="form-control">
                                        <?php
                                        foreach ($kategori as $ka) {
                                            echo "<option value='" . $ka['id'] . "'>" . $ka['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan:</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="file">Gambar:</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
@endsection
