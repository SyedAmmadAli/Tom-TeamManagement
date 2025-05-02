@extends('dashboard.layouts.master')

@section('main-content')
@section('page-title')
    Change Password
@endsection
@section('page-name')
    Change Password
@endsection



<div class="row">
    <div class="col-12">
        <div class="card p-4">

            <form action="{{ route('processChangePass') }}" method="post">
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

                <!-- Old Password -->
                <div class="mb-3">
                    <label for="curr_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="curr_password" name="current_password"
                        placeholder="Enter current password">
                    @if ($errors->has('current_password'))
                        <p class="text-danger mt-2"> {{ $errors->first('current_password') }}</p>
                    @endif
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
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Enter confirmed password">
                    @error('password_confirmation')
                        <p class="text-danger mt-2"> {{ $errors->first('password_confirmation') }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" id="sbtn" name="sbtn" value="Submit">
                </div>
            </form>
        </div>
    </div>


@endsection
