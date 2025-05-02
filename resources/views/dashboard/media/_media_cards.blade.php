@foreach ($media as $item)
    @php
        $extension = strtolower(pathinfo($item->filename, PATHINFO_EXTENSION));
        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp']);
        $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv']);
    @endphp

    <div class="col-md-4 col-lg-3 mb-3">
        <div class="card text-center shadow-sm border p-3 rounded-3 position-relative">

            <form action="{{ route('media.delete', $item->id) }}" method="POST"
                style="position: absolute; top: 8px; right: 15px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger p-1" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            @if ($isImage)
                {{-- Show image preview --}}
                <div class="d-flex justify-content-center align-items-center rounded bg-light text-primary fw-bold mx-auto"
                    style="width: 80px; height: 80px; font-size: 14px; overflow: hidden;">
                    <img src="{{ asset('dashboard/uploads/' . $item->filename) }}" alt=""
                        style="max-width: 100%; max-height: 100%;">
                </div>
            @else
                {{-- Show file extension text --}}
                <div class="d-flex justify-content-center align-items-center rounded bg-light text-primary fw-bold mx-auto"
                    style="width: 80px; height: 80px; font-size: 14px;">
                    {{ strtoupper($extension) }}
                </div>
            @endif


            <p class="mt-3 mb-1 text-truncate fw-semibold text-dark" style="max-width: 180px;">
                {{ $item->filename }}</p>
            <small class="text-muted d-block">{{ number_format($item->size / 1024, 2) }} KB</small>

            <div class="d-flex justify-content-around">
                <a href="{{ asset('storage/media/' . $item->filename) }}" class="btn btn-danger mt-2" download>
                    Download
                </a>
                @if ($isImage)
                    <button type="button" class="btn btn-primary px-4 mt-2" data-bs-toggle="modal"
                        data-bs-target="#imageModal{{ $loop->index }}">
                        View
                    </button>
                @elseif($isVideo)
                    <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                        data-bs-target="#videoModal{{ $loop->index }}">
                        View
                    </button>
                @endif
            </div>
        </div>
    </div>

    @if ($isImage)
        <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('dashboard/uploads/' . $item->filename) }}" class="img-fluid"
                            alt="Image Preview">
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($isVideo)
        <div class="modal fade" id="videoModal{{ $loop->index }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Video Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <video controls class="w-100">
                            <source src="{{ asset('storage/media/' . $item->filename) }}"
                                type="video/{{ $extension }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
