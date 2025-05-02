@extends('dashboard.layouts.master')

@section('page-title', 'Generated Prompt')
@section('page-name', 'Prompt from Image')

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4 shadow">
            <h3 class="mb-4 text-primary">📄 Prompt Generated from Image</h3>

            @if($formattedReply)
                <div id="prompt-content" class="alert alert-success" style="white-space: pre-line; line-height: 1.6;">
                    {!! $formattedReply !!}
                </div>
            @else
                <div class="alert alert-warning">
                    No prompt was generated. Please try again with a different image.
                </div>
            @endif

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('chatgpt') }}" class="btn btn-primary">
                   Back to Upload
                </a>
                <button onclick="copyPrompt()" class="btn btn-outline-success">
                   Copy Prompt
                </button>
            </div>

            <div id="copy-alert" class="mt-2 text-success" style="display: none;">
                ✅ Prompt copied to clipboard!
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for copying to clipboard --}}
<script>
    function copyPrompt() {
        const content = document.getElementById('prompt-content').innerText;

        navigator.clipboard.writeText(content).then(() => {
            document.getElementById('copy-alert').style.display = 'block';
            setTimeout(() => {
                document.getElementById('copy-alert').style.display = 'none';
            }, 2000);
        }).catch(err => {
            alert('Failed to copy prompt');
            console.error(err);
        });
    }
</script>
@endsection
