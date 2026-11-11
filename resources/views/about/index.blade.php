@extends('layouts.app')

@section('title', __('messages.about_us'))

@section('page-styles')
    @include('layouts.styles.about')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">{{ __('messages.about_us') }}</h1>
            <p class="text-center mb-5">{{ __('messages.about_description') }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ __('messages.our_mission') }}</h3>
                    <p>{{ __('messages.mission_description') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ __('messages.our_vision') }}</h3>
                    <p>{{ __('messages.vision_description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ __('messages.our_history') }}</h3>
                    <p>{{ __('messages.history_description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>{{ __('messages.our_values') }}</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="value-item mb-4">
                                <i class="fas fa-book-open fa-2x text-primary mb-3"></i>
                                <h4>{{ __('messages.value_1_title') }}</h4>
                                <p>{{ __('messages.value_1_description') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="value-item mb-4">
                                <i class="fas fa-hands-helping fa-2x text-primary mb-3"></i>
                                <h4>{{ __('messages.value_2_title') }}</h4>
                                <p>{{ __('messages.value_2_description') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="value-item mb-4">
                                <i class="fas fa-heart fa-2x text-primary mb-3"></i>
                                <h4>{{ __('messages.value_3_title') }}</h4>
                                <p>{{ __('messages.value_3_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
