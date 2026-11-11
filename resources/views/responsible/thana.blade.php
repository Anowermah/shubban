@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">{{ __('messages.thana_responsible') }}</h1>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.designation') }}</th>
                                    <th>{{ __('messages.thana') }}</th>
                                    <th>{{ __('messages.phone') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($managers as $manager)
                                    <tr>
                                        <td>{{ $manager->name }}</td>
                                        <td>{{ $manager->designation }}</td>
                                        <td>{{ $manager->area }}</td>
                                        <td>
                                            <a href="tel:{{ $manager->phone }}" class="text-decoration-none">
                                                <i class="fas fa-phone-alt me-1"></i>{{ $manager->phone }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $manager->email }}" class="text-decoration-none">
                                                <i class="fas fa-envelope me-1"></i>{{ $manager->email }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#managerModal{{ $manager->id }}">
                                                <i class="fas fa-eye me-1"></i>{{ __('messages.view_details') }}
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Manager Details Modal -->
                                    <div class="modal fade" id="managerModal{{ $manager->id }}" tabindex="-1" aria-labelledby="managerModalLabel{{ $manager->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="managerModalLabel{{ $manager->id }}">{{ __('messages.responsible_details') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @if($manager->image)
                                                            <div class="col-md-4 text-center mb-3">
                                                                <img src="{{ asset('storage/' . $manager->image) }}" alt="{{ $manager->name }}" class="img-fluid rounded" style="max-height: 200px;">
                                                            </div>
                                                        @endif
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <h4>{{ $manager->name }}</h4>
                                                                <p class="text-muted mb-0">{{ $manager->designation }}</p>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>{{ __('messages.thana') }}:</strong></p>
                                                                    <p>{{ $manager->area }}</p>
                                                                </div>
                                                                @if($manager->address)
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1"><strong>{{ __('messages.address') }}:</strong></p>
                                                                        <p>{{ $manager->address }}</p>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>{{ __('messages.phone') }}:</strong></p>
                                                                    <p>
                                                                        <a href="tel:{{ $manager->phone }}" class="text-decoration-none">
                                                                            <i class="fas fa-phone-alt me-1"></i>{{ $manager->phone }}
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>{{ __('messages.email') }}:</strong></p>
                                                                    <p>
                                                                        <a href="mailto:{{ $manager->email }}" class="text-decoration-none">
                                                                            <i class="fas fa-envelope me-1"></i>{{ $manager->email }}
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('messages.no_data_found') }}</td>
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

@if(count($managers) > 0)
    @section('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const managerModals = document.querySelectorAll('[id^="managerModal"]');
            managerModals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    // Add any additional JavaScript functionality here if needed
                });
            });
        });
    </script>
    @endsection
@endif
@endsection
