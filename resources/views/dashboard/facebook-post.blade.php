@extends('dashboard.layouts.master')

@section('main-content')
    <!-- Start Content-->

@section('page-title')
    Create Post
@endsection

@section('page-name')
    Create Post
@endsection


 <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                
            @if (Auth::user()->access_token == null)
                    <h4 class="text-center">Login to Facebook</h4>
                    <p class="text-center">To create a post, you need to login to your Facebook account.</p>
                    <a href="{{ route('facebook.login') }}" class="btn btn-primary">Login to Facebook</a>
                @else
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('facebook.post') }}" method="POST" enctype="multipart/form-data" id="facebookPostForm">
                        @csrf

                        <div class="mb-3">
                            <label for="postContent" class="form-label">Post Content</label>
                            <textarea class="form-control" id="postContent" name="message" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="media" class="form-label">Upload Images or Videos</label>
                            <input type="file" class="form-control" id="media" name="media[]" multiple accept="image/*,video/*">
                            <small class="text-muted">You can upload multiple images or videos</small>
                        </div>

                        <div class="mb-3">
                            <label for="scheduled_time" class="form-label">Schedule Time (Optional)</label>
                            <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time">
                        </div>

                        <input type="hidden" name="timezone" id="userTimezone">

                        <button type="submit" class="btn btn-primary">Post to Facebook</button>
                    </form>
                @endif

            </div>
        </div>
    </div>


<script>
// Get the user's local time zone
const localTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

// Set the value of the hidden input field
document.getElementById('userTimezone').value = localTimeZone;

// Optional: Submit the form using JavaScript (if needed)
document.getElementById('facebookPostForm').addEventListener('submit', function() {
    // Ensure the timezone is set before form submission
    document.getElementById('userTimezone').value = localTimeZone;
});
</script>



@endsection
