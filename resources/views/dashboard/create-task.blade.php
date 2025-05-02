@extends('dashboard.layouts.master')

@section('main-content')


    <!-- Start Content-->
    <div class="container-fluid">

        {{-- breadcrumbs here --}}
    @section('page-title')
        Create Task
    @endsection
    @section('page-name')
        Create Task
    @endsection

    <div class="row">
        <div class="col-12">
            <div class="card p-4">

                <form action="{{ route('process-CreateTask') }}" method="post" enctype="multipart/form-data">
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

                    <!-- Task Title -->
                    <div class="mb-3">
                        <label for="task_title" class="form-label">Task Title</label>
                        <input type="text" class="form-control" id="task_title" name="task_title"
                            placeholder="Enter Task title">
                        @if ($errors->has('task_title'))
                            <p class="text-danger mt-2"> {{ $errors->first('task_title') }}</p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="quill-editor" style="height: 200px;"></div>
                        <input type="hidden" name="description" id="description">
                        @if ($errors->has('description'))
                            <p class="text-danger mt-2"> {{ $errors->first('description') }}</p>
                        @endif
                    </div>

                    <!-- User -->
                    <div class="mb-3">
                        <label for="assigned_employee" class="form-label">Select User</label>
                        <select name="assigned_employee[]" id="assigned_employee"
                            class="select2 form-control select2-multiple form-control" data-toggle="select2"
                            multiple="multiple" data-placeholder="Choose ...">
                            {{-- <option value="" disabled selected>Choose User</option> --}}
                            @foreach ($allusers as $user)
                                <option value="{{ $user->id }}" class="text-capitalized">
                                    {{ $user->first_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_employee')
                            <p class="text-danger mt-2"> {{ $errors->first('assigned_employee') }}</p>
                        @enderror
                    </div>

                    <!-- priority -->
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="" disabled selected>Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>

                        @error('priority')
                            <p class="text-danger mt-2"> {{ $errors->first('priority') }}</p>
                        @enderror
                    </div>

                    <!-- due_date -->
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date"
                            placeholder="Enter Last Name">
                        @if ($errors->has('due_date'))
                            <p class="text-danger mt-2"> {{ $errors->first('due_date') }}</p>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option value="" disabled selected>Status</option>
                            <option value="open">Open</option>
                            <option value="in_progress">In_progress</option>
                            {{-- <option value="completed">Completed</option> --}}
                        </select>
                        @if ($errors->has('status'))
                            <p class="text-danger mt-2"> {{ $errors->first('status') }}</p>
                        @endif
                    </div>


                    <!-- Attachment -->
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment Files</label>

                        <!-- Toggle buttons -->
                        <div class="d-flex mb-3">
                            <!-- Button for Media Gallery -->
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#mediaGalleryModal">
                                Choose from Media Gallery
                            </button>
                            <!-- Button for Upload Files Directly -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#uploadFileModal">
                                Upload Files Directly
                            </button>
                        </div>

                        <!-- Modal for Media Gallery -->
                        <div class="modal fade" id="mediaGalleryModal" tabindex="-1"
                            aria-labelledby="mediaGalleryModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediaGalleryModalLabel">Select from Media Gallery
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" id="mediaGalleryModalBody">
                                            <!-- Media items will be dynamically loaded here -->

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="selectMediaBtn"
                                            data-bs-dismiss="modal">Select</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Upload Files Directly -->
                        <div class="modal fade" id="uploadFileModal" tabindex="-1"
                            aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadFileModalLabel">Upload Files Directly</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- File upload input -->
                                        <input type="file" multiple class="form-control" id="attachment"
                                            name="filename[]">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            onclick="clearFileInput()">Close</button>
                                        <button type="button" class="btn btn-primary"
                                            id="uploadFileButton">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="selectedMediaSection">
                            <h5>Selected Files:</h5>
                            <div class="d-flex flex-wrap" id="selectedMediaDisplay">
                                <!-- Selected files will be shown here -->
                            </div>
                        </div>


                        @if ($errors->has('attachments.*'))
                            @foreach ($errors->get('attachments.*') as $messages)
                                @foreach ($messages as $message)
                                    <div class="error-message">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                    </div>

                    <!-- Include Bootstrap's JS and CSS (if not already included) -->
                    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
                        rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}




                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" id="sbtn" name="sbtn" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize the Quill editor
            var quill = new Quill('#quill-editor', {
                theme: 'snow'
            });

            // Set the Quill content to the hidden input field before form submission
            $('form').on('submit', function() {
                var descriptionContent = quill.root.innerHTML;
                $('#description').val(descriptionContent);
            });

            // Initialize Select2 for the assigned employee dropdown
            $('#assigned_employee').select2({
                theme: "classic",
                placeholder: "Choose Users...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    {{-- @endsection --}}
@endsection
