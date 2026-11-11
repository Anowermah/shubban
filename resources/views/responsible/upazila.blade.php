@extends('layouts.app')

@section('content')
@php
    $managerList = $managers ?? $responsiblePersons ?? [];
@endphp
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">{{ __('messages.upazila_responsible') }}</h1>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.designation') }}</th>
                                    <th>{{ __('messages.upazila') }}</th>
                                    <th>{{ __('messages.phone') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th class="text-center">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($managerList as $manager)
                                    <tr>
                                        <td class="fw-semibold">{{ $manager->name }}</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">{{ $manager->designation }}</span></td>
                                        <td>{{ $manager->area }}</td>
                                        <td>
                                            @if($manager->phone)
                                                <a href="tel:{{ $manager->phone }}" class="text-decoration-none">
                                                    <i class="fas fa-phone-alt me-1 text-success"></i>{{ $manager->phone }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($manager->email)
                                                <a href="mailto:{{ $manager->email }}" class="text-decoration-none">
                                                    <i class="fas fa-envelope me-1 text-primary"></i>{{ $manager->email }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#managerModal{{ $manager->id }}">
                                                <i class="fas fa-eye me-1"></i>{{ __('messages.view_details') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">{{ __('messages.no_data_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manager Details Modals -->
@foreach($managerList as $manager)
    <div class="modal fade" id="managerModal{{ $manager->id }}" tabindex="-1" aria-labelledby="managerModalLabel{{ $manager->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 bg-success bg-opacity-10">
                    <h5 class="modal-title fw-bold text-dark" id="managerModalLabel{{ $manager->id }}">{{ __('messages.responsible_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row align-items-center">
                        @if($manager->image)
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img src="{{ asset('storage/' . $manager->image) }}" alt="{{ $manager->name }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 220px; object-fit: cover;">
                            </div>
                        @endif
                        <div class="col">
                            <div class="mb-3">
                                <h3 class="fw-bold mb-1">{{ $manager->name }}</h3>
                                <p class="text-success fw-semibold mb-0">{{ $manager->designation }}</p>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small"><strong>{{ __('messages.upazila') }}:</strong></p>
                                    <p class="fw-semibold">{{ $manager->area }}</p>
                                </div>
                                @if($manager->address)
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small"><strong>{{ __('messages.address') }}:</strong></p>
                                        <p class="fw-semibold">{{ $manager->address }}</p>
                                    </div>
                                @endif
                                @if($manager->phone)
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small"><strong>{{ __('messages.phone') }}:</strong></p>
                                        <p>
                                            <a href="tel:{{ $manager->phone }}" class="text-decoration-none fw-semibold text-dark">
                                                <i class="fas fa-phone-alt me-1 text-success"></i>{{ $manager->phone }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                @if($manager->email)
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small"><strong>{{ __('messages.email') }}:</strong></p>
                                        <p>
                                            <a href="mailto:{{ $manager->email }}" class="text-decoration-none fw-semibold text-dark">
                                                <i class="fas fa-envelope me-1 text-primary"></i>{{ $manager->email }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    @if($manager->phone)
                        <a href="tel:{{ $manager->phone }}" class="btn btn-success rounded-pill px-4">
                            <i class="fas fa-phone-alt me-1"></i>সরাসরি কল
                        </a>
                    @endif
                    <button type="button" class="btn btn-light rounded-pill px-3 border" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
