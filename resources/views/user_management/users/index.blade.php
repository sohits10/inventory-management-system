@extends('layouts.app')
@section('title', 'User List')

@section('content')
    <div class="wrapper" id="app">
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title ps-3">Home</div>
                    <div class="pe-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">User List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card radius-10">
                    <div class="card-title d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-0">
                            <i class="bx bx-menu"></i>
                            <h6 class="mb-0">User List</h6>
                        </div>
                        <div class="ms-3 mt-1">
                                <a href="{{ route('users.create') }}" class="btn btn-outline-success position-relative px-4">
                                    <i class="bx bx-plus-circle align-middle"></i> Create
                                </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('users.index') }}" class="row g-3">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ request('email') }}">
                                </div>
                            </div>
                            
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-outline-success px-5" type="submit">
                                    <i class="bx bx-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <!-- End Search Form -->

                        <!-- User Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm ms-1"><i class="bx bx-edit"></i> Edit</a>
                                                        <form action="{{ route('users.deactivate', $user->id) }}" method="POST" class="ms-1">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="bx bx-trash-alt"></i> Deactivate
                                                            </button>
                                                        </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End User Table -->

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                        <!-- End Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
