@extends('dashboard.layouts.master')

@section('main-content')

    {{-- breadcrumbs here --}}
@section('page-title')
    Profile
@endsection
@section('page-name')
    Profile
@endsection


<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            <div class="card-body">

            
               
                @if ($loggedUserData->profile_pic)
                <img src="{{ asset($loggedUserData->profile_pic) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            @else
                <img src="{{ asset('dashboard/assets/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="default-profile-image">
            @endif
                {{-- <h4 class="mb-1 mt-2 text-capitalize"><?php //echo $userData['first_name'] . ' ' . $userData['last_name'];
                ?></h4> --}}
                <h4 class="mb-1 mt-2 text-capitalize">{{ $loggedUserData->first_name }}
                    {{ $loggedUserData->last_name }}</h4>
                <p class="text-muted text-capitalize">{{ $loggedUserData->Role->name }}</p>


                <!-- Button to trigger modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profilePictureModal">
                    Change Profile Picture
                </button>

                <!-- Modal -->
                <div class="modal fade" id="profilePictureModal" tabindex="-1"
                    aria-labelledby="profilePictureModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="profilePictureForm" enctype="multipart/form-data" method="post"
                            action="{{ route('profile.upload') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="profilePictureModalLabel">Upload New Profile Picture
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        onclick="clearProfileInput()"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="file" name="profile_picture" id="profile_picture"
                                        class="form-control" accept="image/*" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="clearProfileInput()">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="text-start mt-3">
                    <p class="text-muted mb-2"><strong>First Name :</strong> <span
                            class="ms-2 text-capitalize">{{ $loggedUserData->first_name }}</span></p>
                    <p class="text-muted mb-2"><strong>Last Name :</strong> <span
                            class="ms-2 text-capitalize">{{ $loggedUserData->last_name }}</span></p>
                    <p class="text-muted mb-2"><strong>Email :</strong> <span
                            class="ms-2 ">{{ $loggedUserData->email }}</span></p>
                    <p class="text-muted mb-2"><strong>Role :</strong> <span
                            class="ms-2 text-capitalize">{{ $loggedUserData->role->name }}</span></p>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->



    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">

        <div class="card p-4">
            <form action="{{ route('updateProfile') }}" method="post">
                @csrf
                <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i> Personal Info
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="first_name"
                                placeholder="Enter first name" value="{{ $loggedUserData->first_name }}">
                            @if ($errors->has('first_name'))
                                <p class="text-danger mt-2"> {{ $errors->first('first_name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter last name"
                                name="last_name" value="{{ $loggedUserData->last_name }}">
                            @if ($errors->has('last_name'))
                                <p class="text-danger mt-2"> {{ $errors->first('last_name') }}</p>
                            @endif
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="useremail" placeholder="Enter email"
                                name="email" @readonly(true) value="{{ $loggedUserData->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Role</label>
                            {{-- <select name="userRole" id="userRole" class="form-control">
                                                <option value="" disabled selected>Choose Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        @if (isset($loggedUserData->role->id) && $loggedUserData->role->id == $role->id) selected @endif>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select> --}}
                            <input type="text" name="role" id="userRole" class="form-control" @readonly(true)
                                placeholder="User Role" value="{{ $loggedUserData->role->name }}">
                        </div>
                    </div>

                </div> <!-- end row -->


                <div class="text-end">
                    <a href="{{ route('changePassword') }}" class="btn btn-primary mt-2">Change Password</a>
                    <button type="submit" class="btn btn-warning  mt-2"><i class="ri-save-line"></i>
                        Save</button>
                </div>
            </form>
        </div> <!-- end card -->
    </div> <!-- end col -->
    <!-- content -->
@endsection
