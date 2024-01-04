@extends('layout')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">User</h6>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                                    bis_skin_checked="1">
                                    <h6 class="text-white text-capitalize ps-3">User table</h6>
                                </div>
                                <div class="card-header pb-0">
                                    <h4>User Management</h4>
                                </div>
                                <div class="pull-right">
                                    @can('role-create')
                                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge bg-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('argon/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('argon/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('argon/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('argon/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('argon/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages, etc -->
    <script src="{{ asset('argon/js/argon-dashboard.min.js') }}"></script>
    {!! $data->render() !!}
@endsection
