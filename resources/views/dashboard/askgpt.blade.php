@extends('dashboard.layouts.master')

@section('page-title')
    Ask GPT
@endsection

@section('page-name')
    Ask GPT
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <form id="askgpt-form" action="{{ route('ask.chatgpt') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="question-input" class="form-label">Text Prompt</label>
                    <input type="text" name="prompt" id="question-input" class="form-control" placeholder="Describe what to change in the image..." required>
                </div>

                <div class="mb-3">
                    <label for="image-upload" class="form-label">Upload Image (PNG with transparency)</label>
                    <input type="file" name="image" id="image-upload" accept="image/png" class="form-control" required>
                    <small class="text-muted">Must be a PNG image with transparent areas (inpainting only works on transparent regions).</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
           
            <div id="response-container" class="mt-4">
                @if(request()->has('image_url') && request()->get('image_url') != null)
                    <a href="{{ request()->get('image_url') }}" target="_blank" class="btn btn-success">
                        View Image
                    </a>
                @endif
            
                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        <strong>Error:</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            
            
        </div>
    </div>
</div>
@endsection
