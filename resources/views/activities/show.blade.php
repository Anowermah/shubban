@extends('layouts.app')

@section('title', $activity->title . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $activity->title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">হোম</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">কার্যক্রম</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Details Section -->
    <section class="activity-details py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="activity-content">
                        @if($activity->image)
                            <div class="activity-image mb-4">
                                <img src="{{ asset('storage/' . $activity->image) }}" 
                                     alt="{{ $activity->title }}" 
                                     class="img-fluid rounded">
                            </div>
                        @endif

                        <div class="activity-text">
                            <div class="meta-info mb-4">
                                <span class="date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $activity->created_at->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="description fs-5 lh-lg mb-4">
                                {!! strip_tags($activity->description) == $activity->description ? nl2br(e($activity->description)) : $activity->description !!}
                            </div>

                            <div class="share-buttons mt-4">
                                <h5 class="mb-3">শেয়ার করুন:</h5>
                                <div class="d-flex gap-2">
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       target="_blank" 
                                       class="btn btn-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>

                                    <!-- Twitter -->
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($activity->title) }}" 
                                       target="_blank" 
                                       class="btn btn-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>

                                    <!-- WhatsApp -->
                                    <a href="https://wa.me/?text={{ urlencode($activity->title . ' - ' . request()->url()) }}" 
                                       target="_blank" 
                                       class="btn btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>

                                    <!-- Telegram -->
                                    <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($activity->title) }}" 
                                       target="_blank" 
                                       class="btn btn-telegram">
                                        <i class="fab fa-telegram-plane"></i>
                                    </a>

                                    <!-- Copy Link -->
                                    <button type="button" 
                                            class="btn btn-copy" 
                                            onclick="copyToClipboard('{{ request()->url() }}')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('activities.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> সকল কার্যক্রম দেখুন
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .page-header {
            background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%);
            padding: 70px 0;
            color: white;
            text-align: center;
        }
        .page-header h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .breadcrumb {
            background: transparent;
            justify-content: center;
        }
        .breadcrumb-item a {
            color: white;
        }
        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.8);
        }

        .activity-content {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }
        .activity-image img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }
        .meta-info {
            color: #666;
            font-size: 0.9rem;
        }
        .meta-info i {
            margin-right: 5px;
        }
        .description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2c3e50;
            white-space: pre-line;
        }

        /* Share Buttons */
        .share-buttons .btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-facebook {
            background-color: #1877f2;
        }
        .btn-facebook:hover {
            background-color: #0d6efd;
            color: white;
        }

        .btn-twitter {
            background-color: #1da1f2;
        }
        .btn-twitter:hover {
            background-color: #0c85d0;
            color: white;
        }

        .btn-whatsapp {
            background-color: #25d366;
        }
        .btn-whatsapp:hover {
            background-color: #128c7e;
            color: white;
        }

        .btn-telegram {
            background-color: #0088cc;
        }
        .btn-telegram:hover {
            background-color: #0069a9;
            color: white;
        }

        .btn-copy {
            background-color: #6c757d;
            color: white;
        }
        .btn-copy:hover {
            background-color: #5a6268;
            color: white;
        }

        /* Toast Notification */
        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .toast {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            font-size: 14px;
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function copyToClipboard(text) {
            // Create a temporary input element
            const input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            
            // Select and copy the text
            input.select();
            document.execCommand('copy');
            
            // Remove the temporary input
            document.body.removeChild(input);
            
            // Show toast notification
            showToast('লিংক কপি করা হয়েছে!');
        }

        function showToast(message) {
            // Create toast container if it doesn't exist
            let container = document.querySelector('.toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }

            // Create and show toast
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            container.appendChild(toast);

            // Fade in
            setTimeout(() => {
                toast.style.display = 'block';
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => {
                    container.removeChild(toast);
                }, 300);
            }, 3000);
        }
    </script>
@endpush
