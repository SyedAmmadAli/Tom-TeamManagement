@extends('dashboard.layouts.master')

@section('main-content')
    <!-- Start Content-->

@section('page-title')
    Create Instagram Post
@endsection

@section('page-name')
    Create Instagram Post
@endsection

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('instagram.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="message" class="form-label">Post Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="media" class="form-label">Upload Media (Image/Video)</label>
                        <input type="file" class="form-control" id="media" name="media" accept="image/*,video/*" >
                    </div>

                    <button type="submit" class="btn btn-primary">Post to Instagram</button>
                </form>
            </div>
        </div>
    </div>


@endsection
