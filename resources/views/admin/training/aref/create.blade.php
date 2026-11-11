@extends('admin.layouts.app')

@section('title', 'নতুন আরেফ প্রশিক্ষণ রেজিস্ট্রেশন')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">নতুন আরেফ প্রশিক্ষণ রেজিস্ট্রেশন</h1>
        <a href="{{ route('admin.training.aref.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> তালিকায় ফিরে যান
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.training.aref.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">নাম <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="father_name" class="form-label">পিতার নাম <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                               id="father_name" name="father_name" value="{{ old('father_name') }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="mother_name" class="form-label">মাতার নাম <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                               id="mother_name" name="mother_name" value="{{ old('mother_name') }}" required>
                        @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">ইমেইল</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_of_birth" class="form-label">জন্ম তারিখ</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                               id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="district" class="form-label">জেলা</label>
                        <input type="text" class="form-control @error('district') is-invalid @enderror" 
                               id="district" name="district" value="{{ old('district') }}">
                        @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="thana" class="form-label">উপজেলা / থানা</label>
                        <input type="text" class="form-control @error('thana') is-invalid @enderror" 
                               id="thana" name="thana" value="{{ old('thana') }}">
                        @error('thana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="present_address" class="form-label">বর্তমান ঠিকানা</label>
                        <textarea class="form-control @error('present_address') is-invalid @enderror" 
                                  id="present_address" name="present_address" rows="2">{{ old('present_address') }}</textarea>
                        @error('present_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="permanent_address" class="form-label">স্থায়ী ঠিকানা</label>
                        <textarea class="form-control @error('permanent_address') is-invalid @enderror" 
                                  id="permanent_address" name="permanent_address" rows="2">{{ old('permanent_address') }}</textarea>
                        @error('permanent_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.training.aref.index') }}" class="btn btn-secondary">বাতিল</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
