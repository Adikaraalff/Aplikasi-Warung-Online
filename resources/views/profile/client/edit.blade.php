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
                                    <h4>Edit Profile</h4>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <form method="POST" action="{{ route('clients.update', $client->id)}}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $client->nama }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ $client->email }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ $client->email }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                                    <input type="date" name="tanggal_lahir" value="{{ $client->tanggal_lahir }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">Nomor HP:</label>
                                    <input type="text" name="no_hp" value="{{ $client->no_hp }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea name="alamat" class="form-control" required>{{ $client->alamat }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('client.profile') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection
