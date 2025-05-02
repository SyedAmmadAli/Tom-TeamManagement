@extends('dashboard.layouts.master')

@section('main-content')
    <!-- Start Content-->

@section('page-title')
    Add User
@endsection

@section('page-name')
    Add User
@endsection

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card p-4">

                <form action="{{ route('processCreateUser') }}" method="post">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="Enter First Name">
                        @if ($errors->has('first_name'))
                            <p class="text-danger mt-2"> {{ $errors->first('first_name') }}</p>
                        @endif
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="Enter Last Name">
                        @if ($errors->has('last_name'))
                            <p class="text-danger mt-2"> {{ $errors->first('last_name') }}</p>
                        @endif
                    </div>


                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email address">
                        @error('email')
                            <p class="text-danger mt-2"> {{ $errors->first('email') }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="password"
                            placeholder="Enter current password">
                        @if ($errors->has('password'))
                            <p class="text-danger mt-2"> {{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Enter confirmed password">
                        @error('password_confirmation')
                            <p class="text-danger mt-2"> {{ $errors->first('password_confirmation') }}</p>
                        @enderror
                    </div>


                    <!-- Role -->
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select name="role_id" id="userRole" class="form-control">
                            <option value="" disabled selected>Choose Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>


                        @error('email')
                            <p class="text-danger mt-2"> {{ $errors->first('email') }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" id="sbtn" name="sbtn" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
