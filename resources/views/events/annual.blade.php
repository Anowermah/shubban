@extends('layouts.app')

@section('title', __('messages.annual_events'))

@section('content')
<div class="annual-events-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">বার্ষিক অনুষ্ঠানসমূহ</h2>
                <p class="section-description">আমাদের প্রতিষ্ঠানের নিয়মিত বার্ষিক অনুষ্ঠানমালা</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="event-card">
                        <div class="event-icon">
                            <i class="{{ $event->icon ?? 'fas fa-calendar' }}"></i>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-description">{{ $event->description }}</p>
                            <div class="event-date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</span>
                            </div>
                            @if($event->registration_required)
                                <div class="event-action">
                                    <a href="{{ route('events.register', $event) }}" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> রেজিস্ট্রেশন করুন
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-message">
                        <i class="fas fa-calendar-times"></i>
                        <p>কোন বার্ষিক অনুষ্ঠান পাওয়া যায়নি।</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('page-styles')
<style>
.annual-events-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: calc(100vh - 100px);
}

.section-title {
    position: relative;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    text-align: center;
    color: var(--primary-color);
    font-size: 2.5rem;
    font-weight: bold;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

.section-description {
    text-align: center;
    color: #6c757d;
    font-size: 1.2rem;
    margin-bottom: 3rem;
}

.event-card {
    background: white;
    border-radius: 1.5rem;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    transition: all 0.4s ease;
    position: relative;
    padding: 2rem;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.event-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    margin-inline: auto;
    transition: all 0.4s ease;
}

.event-card:hover .event-icon {
    transform: scale(1.1) rotate(10deg);
}

.event-icon i {
    font-size: 2rem;
    color: white;
}

.event-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.event-title {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}

.event-description {
    color: #495057;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    flex-grow: 1;
    text-align: center;
}

.event-date {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    color: #6c757d;
    font-size: 1.1rem;
    padding-top: 1rem;
    border-top: 2px dashed #f8f9fa;
}

.event-date i {
    color: var(--primary-color);
}

.event-action {
    margin-top: 1.5rem;
    text-align: center;
}

.event-action .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.event-action .btn i {
    margin-right: 0.5rem;
}

.event-action .btn:hover {
    transform: scale(1.05);
}

.empty-message {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

.empty-message i {
    font-size: 4rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 1.5rem;
}

.empty-message p {
    color: #495057;
    font-size: 1.4rem;
    margin: 0;
}

@media (max-width: 991.98px) {
    .annual-events-section {
        padding: 4rem 0;
    }

    .section-title {
        font-size: 2rem;
    }

    .event-card {
        padding: 1.5rem;
    }

    .event-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 767.98px) {
    .annual-events-section {
        padding: 3rem 0;
    }

    .section-title {
        font-size: 1.75rem;
        margin-bottom: 2rem;
    }

    .event-card {
        padding: 1.25rem;
    }

    .event-icon {
        width: 60px;
        height: 60px;
    }

    .event-icon i {
        font-size: 1.5rem;
    }

    .event-title {
        font-size: 1.2rem;
    }

    .event-description {
        font-size: 1rem;
    }
}
</style>
@endsection
