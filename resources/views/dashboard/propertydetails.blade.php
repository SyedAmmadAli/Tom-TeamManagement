@extends('dashboard.layouts.master')

@section('page-title')
    Generate Property Description
@endsection

@section('page-name')
    Generate Description
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <form id="askgpt-form" action="{{ route('propertyDetailResponse') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="propert_type" class="form-label">Property type:</label>
                        <input name="propert_type" id="propert_type" class="form-control" placeholder="Please describe (e.g., single-family house, apartment, villa)" required>
                        
                        <!-- Display error for 'propert_type' -->
                        @error('propert_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="location" class="form-label">Location:</label>
                        <input name="location" id="location" class="form-control" placeholder="Please describe (e.g., district, special features of the surroundings)" required>
                        
                        <!-- Display error for 'location' -->
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="plot_size" class="form-label">Plot Size in m<sup>2</sup></label>
                        <input name="plot_size" id="plot_size" class="form-control" placeholder="Please describe plot size in square meters" required>
                        
                        <!-- Display error for 'plot_size' -->
                        @error('plot_size')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="living_area" class="form-label">Living Area in m<sup>2</sup></label>
                        <input name="living_area" id="living_area" class="form-control" placeholder="Please describe living area size in square meters" required>
                        
                        <!-- Display error for 'living_area' -->
                        @error('living_area')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="other_details" class="form-label">Other Details</label>
                        <textarea name="details" id="other_details" class="form-control" placeholder="Amenities, Year Of Construction, Conditions, Highlights" required></textarea>
                        
                        <!-- Display error for 'prompt' -->
                        @error('prompt')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Tone of Text</label>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_tone" id="tone_classic" value="classic" required>
                            <label class="form-check-label" for="tone_classic">Classic</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_tone" id="tone_sales" value="sales-oriented" required>
                            <label class="form-check-label" for="tone_sales">Sales Oriented</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_tone" id="tone_exclusive" value="exclusive" required>
                            <label class="form-check-label" for="tone_exclusive">Exclusive</label>
                        </div>
                        
                        <!-- Display error for 'text_tone' -->
                        @error('text_tone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="image-upload" class="form-label">Upload Image (PNG with transparency)</label>
                        <input type="file" name="image" id="image-upload" accept="image/jpeg,image/png" class="form-control">
                        <small class="text-muted">Upload a high-quality image of the property (front, interior, or aerial view).</small>
                        
                        <!-- Display error for 'image' -->
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-3 form-check">
                        <!-- Hidden input to ensure 'false' is sent if checkbox is unchecked -->
                        <input type="hidden" name="shorten_text" value="0">
                        
                        <!-- Checkbox input -->
                        <input type="checkbox" class="form-check-input" name="shorten_text" id="shorten_text" value="1" {{ old('shorten_text') ? 'checked' : '' }}>
                        
                        <label class="form-check-label" for="shorten_text">Shorten Text</label>

                        <!-- Display error for 'shorten_text' -->
                        @error('shorten_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                

                <div id="response-container" class="mt-4">
                    @if (request()->has('image_url') && request()->get('image_url') != null)
                        <a href="{{ request()->get('image_url') }}" target="_blank" class="btn btn-success">
                            View Image
                        </a>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            <strong>Error:</strong> {{ session('error') }}
                        </div>
                    @endif
                </div>


            </div>
        {{-- </div> --}}
    @endsection
