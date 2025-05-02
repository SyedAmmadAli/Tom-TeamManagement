@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Auto Enhance Image
@endsection

@section('page-name')
    Auto Enhance Image
@endsection

<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <form method="POST" action="{{ route('enhance.image') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" class="form-control" required>
                <button type="submit" class="btn btn-primary">Enhance Image</button>
            </form>
        </div>
    </div>
</div>

@endsection