@extends('dashboard.layouts.master')

@section('main-content')
    {{-- breadcrumbs here --}}
@section('page-title')
    Edit User
@endsection
@section('page-name')
    Edit User
@endsection


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card p-4">

                <form action="{{ route('processEditUser', $user->id) }}" method="post">
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
                        <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}"
                            name="first_name" placeholder="Enter First Name">
                        @if ($errors->has('first_name'))
                            <p class="text-danger mt-2"> {{ $errors->first('first_name') }}</p>
                        @endif
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ $user->last_name }}" placeholder="Enter Last Name">
                        @if ($errors->has('last_name'))
                            <p class="text-danger mt-2"> {{ $errors->first('last_name') }}</p>
                        @endif
                    </div>


                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" readonly
                            value="{{ $user->email }}" placeholder="Enter email address">
                        @error('email')
                            <p class="text-danger mt-2"> {{ $errors->first('email') }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select name="role_id" id="userRole" class="form-control">
                            <option value="" disabled selected>Choose Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if (isset($user->role) && $user->role->id == $role->id) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('role_id')
                            <p class="text-danger mt-2"> {{ $errors->first('role_id') }}</p>
                        @enderror
                    </div>


                    <!-- Status -->
                    <div class="mb-3">
                        <label for="userStatus" class="form-label">Status</label>
                        <select name="status" id="userStatus" class="form-control">
                            <option value="" disabled selected>User Status</option>
                            <option value="1" @if (isset($user->status) && $user->status == 1) selected @endif>Active
                            </option>
                            <option value="0" @if (isset($user->status) && $user->status == 0) selected @endif>Block
                            </option>
                        </select>

                        @error('status')
                            <p class="text-danger mt-2"> {{ $errors->first('status') }}</p>
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
