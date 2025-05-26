@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    View Task Details
@endsection

@section('page-name')
    View Task Details
@endsection

<div class="container">

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    {{-- <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-fill fs-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-attachment-line me-1'></i>Attachment
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-edit-box-line me-1'></i>Edit
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-file-copy-2-line me-1'></i>Mark as Duplicate
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item text-danger">
                                <i class='ri-delete-bin-line me-1'></i>Delete
                            </a>
                        </div>
                        <!-- end dropdown menu-->
                    </div>
                    <!-- end dropdown--> --}}

                    <div class="form-check float-start">
                        <input type="checkbox" class="form-check-input" @if ($task->status == 'completed') checked @endif
                            id="completedCheck" />
                        <label class="form-check-label" for="completedCheck">
                            Mark as completed
                        </label>
                    </div>
                    <!-- end form-check-->
                    <div class="clearfix"></div>

                    <h4 class="mt-2">View Assigned Tasks</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <!-- assignee -->
                            <p class="mt-2 mb-1 text-muted">Assigned To</p>
                            <div class="d-flex align-items-start">
                                <img src="{{ asset('dashboard/assets/images/users/avatar-9.jpg') }}" alt="Arya S"
                                    class="rounded-circle me-2" height="24" />
                                <div class="w-100">
                                    <h5 class="mt-1">
                                        @foreach ($task->assignedusers as $users)
                                            {{ $users->employee->first_name }},
                                        @endforeach
                                    </h5>
                                </div>
                            </div>
                            <!-- end assignee -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-4">
                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted">Task Name</p>
                            <div class="d-flex align-items-start">
                                <i class="ri-briefcase-line fs-18 text-success me-1"></i>
                                <div class="w-100">
                                    <h5 class="mt-1">
                                        {{ $task->task_title }}
                                    </h5>
                                </div>
                            </div>
                            <!-- end due date -->
                        </div>

                        <div class="col-md-4">
                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted">Due Date</p>
                            <div class="d-flex align-items-start">
                                <i class="ri-calendar-todo-line fs-18 text-success me-1"></i>
                                <div class="w-100">
                                    <h5 class="mt-1">
                                        {{ $task->due_date }}
                                    </h5>
                                </div>
                            </div>
                            <!-- end due date -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <h5 class="mt-3">Details:</h5>

                    <div class="task-description">
                        {!! $task->description !!}
                    </div>

                    @if (isset($user_permissions))

                        @if ($user_permissions->contains('permission_id', 4))
                            <div class="text-end mt-4">
                                @if ($task->status == 'open')
                                    <a href="javascript:void(0);" class="btn btn-secondary disabled">Opened</a>
                                @else
                                    <a href="{{ route('changeTaskStatusOpen', $task->id) }}"
                                        class="btn btn-primary">Mark as
                                        Opened</a>
                                @endif

                                @if ($task->status == 'completed')
                                    <a href="javascript:void(0);" class="btn btn-secondary disabled">Already
                                        Completed</a>
                                @else
                                    <a href="{{ route('changeTaskStatus', $task->id) }}" class="btn btn-primary">Mark as
                                        Complete</a>
                                @endif
                            </div>
                        @endif
                    @endif

                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->

        </div>
        <!-- end col -->

        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-more-fill fs-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-attachment-line me-1'></i>Attachment
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-edit-box-line me-1'></i>Edit
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='ri-file-copy-2-line me-1'></i>Mark as Duplicate
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item text-danger">
                                <i class='ri-delete-bin-line me-1'></i>Delete
                            </a>
                        </div>
                        <!-- end dropdown menu-->
                    </div> --}}
                    <!-- end dropdown-->

                    <h5 class="card-title fs-16 mb-3">Attachments</h5>

                    <!-- Preview -->
                    <div class="dropzone-previews mt-3" id="file-previews"></div>

                    <!-- file preview template -->
                    <div class="d-none" id="uploadPreviewTemplate">
                        <div class="card mb-1 mb-0 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light"
                                            alt="" />
                                    </div>
                                    <div class="col ps-0">
                                        <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                        <p class="mb-0" data-dz-size></p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end file preview template -->

                    @if (count($files) == 0)
                        <div class="mt-2">
                            <p class="mb-0">No Files Attached</p>
                        </div>
                    @endif

                    @foreach ($files as $index => $attachment)
                        <div class="card mb-1 shadow-none border">
                            <div class="p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title bg-primary-subtle text-primary rounded text-capitalize">
                                                    {{ $extension[$index] }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col ps-2">
                                            <a href="{{ asset($attachment) }}" download="{{ basename($attachment) }}"
                                                class="text-muted fw-bold">
                                                {{ Str::limit(Str::after($attachment, 'uploads/'), 20, '...') }}
                                            </a>
                                            <p class="mb-0">
                                                {{-- {{ number_format(filesize(public_path($attachment)) / 1024, 2) }} KB</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Download Button -->

                                        <a href="{{ asset($attachment) }}" download="{{ basename($attachment) }}"
                                            class="btn btn-link fs-16 text-muted">
                                            <i class="ri-download-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
