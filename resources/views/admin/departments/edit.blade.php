@extends('admin.layouts.app')

@section('title', 'বিভাগ সম্পাদনা করুন')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="mb-0">বিভাগ সম্পাদনা করুন</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> ফিরে যান
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.departments.update', $department) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Main Information -->
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>মূল তথ্য</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">বিভাগের নাম <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                    id="name" name="name" value="{{ old('name', $department->name) }}" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="order" class="form-label">ক্রম <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                                    id="order" name="order" value="{{ old('order', $department->order) }}" min="0" required>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="description" class="form-label">বিভাগের বিবরণ ও পরিচিতি <span class="text-danger">*</span></label>
                                                <textarea class="form-control tinymce-editor @error('description') is-invalid @enderror" 
                                                    id="description" name="description" rows="5">{{ old('description', $department->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Department Head Information -->
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0"><i class="fas fa-user-tie me-2"></i>বিভাগীয় প্রধানের তথ্য</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="head" class="form-label">বিভাগীয় প্রধান <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('head') is-invalid @enderror" 
                                                    id="head" name="head" value="{{ old('head', $department->head) }}" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="designation" class="form-label">পদবি <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                                    id="designation" name="designation" value="{{ old('designation', $department->designation) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0"><i class="fas fa-address-card me-2"></i>যোগাযোগের তথ্য</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">ইমেইল <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                        id="email" name="email" value="{{ old('email', $department->email) }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">ফোন <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                        id="phone" name="phone" value="{{ old('phone', $department->phone) }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="location" class="form-label">অবস্থান <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                                        id="location" name="location" value="{{ old('location', $department->location) }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Status and Staff Count -->
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0"><i class="fas fa-cog me-2"></i>অন্যান্য তথ্য</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="staff_count" class="form-label">কর্মী সংখ্যা <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                <input type="number" class="form-control @error('staff_count') is-invalid @enderror" 
                                                    id="staff_count" name="staff_count" value="{{ old('staff_count', $department->staff_count) }}" min="0" required>
                                            </div>
                                        </div>

                                        <div class="form-check form-switch mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                                                {{ old('is_active', $department->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">সক্রিয়?</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Responsibilities -->
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0"><i class="fas fa-tasks me-2"></i>দায়িত্বসমূহ</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="responsibilities-container">
                                            @foreach($department->responsibilities as $responsibility)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="responsibilities[]" 
                                                    value="{{ $responsibility }}" required>
                                                @if($loop->first)
                                                    <button type="button" class="btn btn-success add-responsibility">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger remove-responsibility">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-save me-2"></i>আপডেট করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Add new responsibility field
        $('.add-responsibility').click(function() {
            var newField = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="responsibilities[]" 
                        placeholder="দায়িত্ব লিখুন" required>
                    <button type="button" class="btn btn-danger remove-responsibility">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            `;
            $('#responsibilities-container').append(newField);
        });

        // Remove responsibility field
        $(document).on('click', '.remove-responsibility', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endpush

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    border-bottom: 1px solid rgba(0,0,0,.125);
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.input-group-text {
    background-color: #f8f9fa;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.text-danger {
    color: #dc3545;
}
</style>
@endsection
