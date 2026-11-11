@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">{{ __('messages.upcoming_events') }}</h1>
        </div>
    </div>

    @if($events->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($events as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->getTranslation('title', app()->getLocale()) }}">
                @else
                <img src="{{ asset('images/event-placeholder.jpg') }}" class="card-img-top" alt="{{ $event->getTranslation('title', app()->getLocale()) }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $event->getTranslation('title', app()->getLocale()) }}</h5>
                    <p class="card-text text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $event->getTranslation('location', app()->getLocale()) }}
                    </p>
                    <p class="card-text">
                        <i class="fas fa-calendar"></i> 
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        @if($event->end_date && $event->end_date != $event->start_date)
                        - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                        @endif
                    </p>
                    <p class="card-text">
                        <i class="fas fa-clock"></i> 
                        {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                        @if($event->end_time)
                        - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                        @endif
                    </p>
                    <p class="card-text">{{ Str::limit($event->getTranslation('description', app()->getLocale()), 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('events.show', $event->slug) }}" class="btn btn-outline-primary">
                            {{ __('messages.view_details') }}
                        </a>
                        @if($event->registration_required)
                        <a href="{{ route('events.register', $event->slug) }}" class="btn btn-primary">
                            {{ __('messages.register_now') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
    @else
    <div class="text-center">
        <p class="lead">{{ __('messages.no_upcoming_events') }}</p>
    </div>
    @endif
</div>
@endsection
