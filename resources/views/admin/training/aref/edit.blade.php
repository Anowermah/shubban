@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">আরেফ রেজিস্ট্রেশন সম্পাদনা</h1>
        <a href="{{ route('admin.training.aref.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> তালিকায় ফিরে যান
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.training.aref.update', $registration->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">নাম</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $registration->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="father_name" class="form-label">পিতার নাম</label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                               id="father_name" name="father_name" value="{{ old('father_name', $registration->father_name) }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="mother_name" class="form-label">মাতার নাম</label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                               id="mother_name" name="mother_name" value="{{ old('mother_name', $registration->mother_name) }}" required>
                        @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_of_birth" class="form-label">জন্ম তারিখ</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                               id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $registration->date_of_birth) }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="blood_group" class="form-label">রক্তের গ্রুপ</label>
                        <select class="form-select @error('blood_group') is-invalid @enderror" 
                                id="blood_group" name="blood_group">
                            <option value="">নির্বাচন করুন</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                                <option value="{{ $group }}" {{ old('blood_group', $registration->blood_group) == $group ? 'selected' : '' }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>
                        @error('blood_group')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">লিঙ্গ</label>
                        <select class="form-select @error('gender') is-invalid @enderror" 
                                id="gender" name="gender" required>
                            <option value="male" {{ old('gender', $registration->gender) == 'male' ? 'selected' : '' }}>পুরুষ</option>
                            <option value="female" {{ old('gender', $registration->gender) == 'female' ? 'selected' : '' }}>মহিলা</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label">মোবাইল</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" 
                               id="mobile" name="mobile" value="{{ old('mobile', $registration->mobile) }}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">ইমেইল</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $registration->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact" class="form-label">জরুরি যোগাযোগ</label>
                        <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                               id="emergency_contact" name="emergency_contact" 
                               value="{{ old('emergency_contact', $registration->emergency_contact) }}" required>
                        @error('emergency_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="emergency_relation" class="form-label">সম্পর্ক</label>
                        <input type="text" class="form-control @error('emergency_relation') is-invalid @enderror" 
                               id="emergency_relation" name="emergency_relation" 
                               value="{{ old('emergency_relation', $registration->emergency_relation) }}" required>
                        @error('emergency_relation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mt-4">বর্তমান ঠিকানা</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="present_village" class="form-label">গ্রাম</label>
                        <input type="text" class="form-control @error('present_village') is-invalid @enderror" 
                               id="present_village" name="present_village" 
                               value="{{ old('present_village', $registration->present_village) }}" required>
                        @error('present_village')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="present_post" class="form-label">পোস্ট</label>
                        <input type="text" class="form-control @error('present_post') is-invalid @enderror" 
                               id="present_post" name="present_post" 
                               value="{{ old('present_post', $registration->present_post) }}" required>
                        @error('present_post')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="present_thana" class="form-label">থানা</label>
                        <input type="text" class="form-control @error('present_thana') is-invalid @enderror" 
                               id="present_thana" name="present_thana" 
                               value="{{ old('present_thana', $registration->present_thana) }}" required>
                        @error('present_thana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="present_district" class="form-label">জেলা</label>
                        <input type="text" class="form-control @error('present_district') is-invalid @enderror" 
                               id="present_district" name="present_district" 
                               value="{{ old('present_district', $registration->present_district) }}" required>
                        @error('present_district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mt-4">স্থায়ী ঠিকানা</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="permanent_village" class="form-label">গ্রাম</label>
                        <input type="text" class="form-control @error('permanent_village') is-invalid @enderror" 
                               id="permanent_village" name="permanent_village" 
                               value="{{ old('permanent_village', $registration->permanent_village) }}" required>
                        @error('permanent_village')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="permanent_post" class="form-label">পোস্ট</label>
                        <input type="text" class="form-control @error('permanent_post') is-invalid @enderror" 
                               id="permanent_post" name="permanent_post" 
                               value="{{ old('permanent_post', $registration->permanent_post) }}" required>
                        @error('permanent_post')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="permanent_thana" class="form-label">থানা</label>
                        <input type="text" class="form-control @error('permanent_thana') is-invalid @enderror" 
                               id="permanent_thana" name="permanent_thana" 
                               value="{{ old('permanent_thana', $registration->permanent_thana) }}" required>
                        @error('permanent_thana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="permanent_district" class="form-label">জেলা</label>
                        <input type="text" class="form-control @error('permanent_district') is-invalid @enderror" 
                               id="permanent_district" name="permanent_district" 
                               value="{{ old('permanent_district', $registration->permanent_district) }}" required>
                        @error('permanent_district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mt-4">পেশাগত তথ্য</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="organization_name" class="form-label">প্রতিষ্ঠানের নাম</label>
                        <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                               id="organization_name" name="organization_name" 
                               value="{{ old('organization_name', $registration->organization_name) }}">
                        @error('organization_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="designation" class="form-label">পদবি</label>
                        <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                               id="designation" name="designation" 
                               value="{{ old('designation', $registration->designation) }}">
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="joining_date" class="form-label">যোগদানের তারিখ</label>
                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror" 
                               id="joining_date" name="joining_date" 
                               value="{{ old('joining_date', $registration->joining_date) }}">
                        @error('joining_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="organization_address" class="form-label">প্রতিষ্ঠানের ঠিকানা</label>
                        <input type="text" class="form-control @error('organization_address') is-invalid @enderror" 
                               id="organization_address" name="organization_address" 
                               value="{{ old('organization_address', $registration->organization_address) }}">
                        @error('organization_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label">ছবি</label>
                        @if($registration->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $registration->photo) }}" 
                                     alt="Current Photo" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        <small class="text-muted">নতুন ছবি আপলোড করলে পুরনো ছবি মুছে যাবে</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> আপডেট করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
