@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Upload Media
@endsection

@section('page-name')
    Upload Media
@endsection

<div class="row">
    <div class="col-md-12 ">
        <div class="card p-4">


            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- File Upload Form -->
            <form action="{{route('processUploadMedia')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Files</label>
                    <input type="file" name="filename[]" class="form-control" multiple required
                        accept="image/*,video/*,.csv,.docx,.pdf,.rar">
                    <small class="text-muted">Max file size per file: 10MB</small>
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
    </div>


@endsection
