@extends('layouts.app')

@section('title', 'হোম - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@push('styles')
    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    <!-- Home Dedicated Styles -->
    <link href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : '2.0' }}" rel="stylesheet">
@endpush

@section('content')
    {{-- Dynamically render active sections according to admin order --}}
    @foreach($homeSections as $section)
        @if($section->is_active && view()->exists('frontend.home.sections.' . $section->section_key))
            @include('frontend.home.sections.' . $section->section_key, ['section' => $section])
        @endif
    @endforeach

    {{-- Notice Modals for Interactive Reading --}}
    @if(isset($notices) && $notices->isNotEmpty())
        @foreach($notices as $notice)
            <div class="modal fade" id="noticeModal{{ $notice->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="modal-header text-white" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                            <h5 class="modal-title fw-bold fs-6">
                                <i class="fas fa-bell text-warning me-2"></i> {{ $notice->title }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="d-flex align-items-center gap-3 text-muted small mb-3 pb-2 border-bottom">
                                <span><i class="far fa-calendar-alt text-success me-1"></i> প্রকাশের তারিখ: {{ $notice->created_at->format('d F, Y') }}</span>
                                @if($notice->category)
                                    <span><i class="fas fa-tag text-warning me-1"></i> {{ ucfirst($notice->category) }}</span>
                                @endif
                            </div>

                            @if($notice->image)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $notice->image) }}" alt="{{ $notice->title }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 380px;">
                                </div>
                            @endif
                            
                            <div class="notice-content text-secondary lh-base mb-3" style="font-size: 0.95rem;">
                                {!! strip_tags($notice->description) == $notice->description ? nl2br(e($notice->description)) : $notice->description !!}
                            </div>

                            @if($notice->file)
                                <div class="mt-4 p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold text-dark small">সংযুক্ত ফাইল / নোটিশ কপি:</span>
                                    <a href="{{ asset('storage/' . $notice->file) }}" class="btn btn-sm btn-success rounded-pill px-3" download>
                                        <i class="fas fa-download me-1"></i>
                                        {{ method_exists($notice, 'isPDF') && $notice->isPDF() ? 'PDF কপি ডাউনলোড' : 'ফাইল ডাউনলোড' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@push('scripts')
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "ছবি %1 / %2"
        });
    </script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
@endpush
