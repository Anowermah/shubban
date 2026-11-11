@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">{{ __('messages.hadith_education') }}</h1>
            <p class="lead text-center mb-5">{{ __('messages.hadith_education_intro') }}</p>
        </div>
    </div>

    <div class="row">
        @foreach(__('messages.hadith_courses') as $key => $course)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course['title'] }}</h5>
                        <p class="card-text">{{ $course['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
