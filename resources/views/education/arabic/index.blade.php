@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">{{ __('messages.arabic_language') }}</h1>
            <p class="lead text-center mb-5">{{ __('messages.arabic_language_intro') }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Coming Soon</h5>
                    <p class="card-text">We are currently developing our Arabic Language curriculum. Please check back later.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
