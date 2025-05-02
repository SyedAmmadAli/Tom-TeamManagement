@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    View User
@endsection

@section('page-name')
    View User
@endsection
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">View All Users</h4>
                    <p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </p>
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>First</th>
                                <th>Last</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($allusers as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    {{-- <td>{{$user->status}}</td> --}}
                                    <td>

                                        @if ($user->status == 1)
                                            Active
                                        @else
                                            Block
                                        @endif

                                    </td>

                                    <td>
                                        <a href="{{ route('editUser', $user->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('deleteUser', $user->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

@endsection
