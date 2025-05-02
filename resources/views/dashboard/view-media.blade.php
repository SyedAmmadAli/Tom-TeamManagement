@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Media
@endsection

@section('page-name')
    View Media
@endsection

<div class="container mt-3">

    {{-- Category Filter Buttons --}}
    <div class="mb-4">
        @php
            $categories = [
                '' => 'All',
                'ratgeber' => 'Ratgeber',
                'social_Posts' => 'Social Posts',
                'social_Stories' => 'Social Stories',
                'videos' => 'Videos',
                'sonstiges' => 'Sonstiges',
            ];
        @endphp

        @foreach ($categories as $key => $label)
            <button class="btn {{ $key === '' ? 'btn-primary' : 'btn-outline-primary' }} me-2 category-btn"
                data-category="{{ $key }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Media Cards Container --}}
    <div id="mediaContainer" class="row">
        @include('dashboard.media._media_cards', ['media' => $media])
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- AJAX Script --}}
<script>
    $(document).ready(function() {
        $('.category-btn').on('click', function() {
            // Remove active class from all buttons
            $('.category-btn').removeClass('btn-primary').addClass('btn-outline-primary');

            // Add active class to clicked button
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            let category = $(this).data('category');

            $.ajax({
                url: "{{ route('media.filter.byCategory') }}",
                method: "GET",
                data: {
                    category: category
                },
                success: function(response) {
                    $('#mediaContainer').html(response);
                },
                error: function() {
                    alert('Failed to load media.');
                }
            });
        });
    });
</script>

@endsection
