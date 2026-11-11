@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                @else
                <img src="{{ asset('images/event-placeholder.jpg') }}" class="card-img-top" alt="{{ $event->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $event->title }}</h1>
                    
                    <div class="event-meta my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <strong>{{ __('messages.location') }}:</strong>
                                    {{ $event->location }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar text-primary"></i>
                                    <strong>{{ __('messages.date') }}:</strong>
                                    {{ Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    @if($event->end_date && $event->end_date != $event->start_date)
                                    - {{ Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                    @endif
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>{{ __('messages.time') }}:</strong>
                                    {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                    @if($event->end_time)
                                    - {{ Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($event->is_annual)
                                <div class="badge bg-info mb-2">
                                    <i class="fas fa-calendar-check"></i> {{ __('messages.annual_event') }}
                                </div>
                                @endif
                                @if($event->registration_required)
                                <div class="badge bg-warning mb-2">
                                    <i class="fas fa-user-plus"></i> {{ __('messages.registration_required') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="event-description">
                        <h5 class="mb-3">{{ __('messages.event_description') }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                    </div>

                    @if($event->registration_required)
                    <div class="text-center mt-4">
                        <a href="{{ route('events.register', $event) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i> {{ __('messages.register_now') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
