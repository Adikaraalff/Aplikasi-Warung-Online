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
                                    <h4>Edit Uang Keluar</h4>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <form method="POST" action="{{ route('products.update', $Product->id) }}"
                                enctype="multipart/form-data"> <!-- Make sure to include enctype for file uploads -->
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label for="nama_products">Nama Product:</label>
                                    <input type="text" class="form-control" id="nama_products" name="nama_products"
                                        value="{{ $Product->nama_products }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ $Product->price }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Keterangan:</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        value="{{ $Product->keterangan }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="Kategori">Kategori:</label>
                                    <select class="form-control" id="Kategori" name="Kategori" required>
                                        @foreach ($Kategori as $Ka)
                                            <option value="{{ $Ka->id }}"
                                                {{ $Ka->id == $Product->id_kategoris ? 'selected' : '' }}>
                                                {{ $Ka->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file">Gambar:</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                    <img src="{{ asset('image/' . $Product->file) }}" alt="Current Image" width="100">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
