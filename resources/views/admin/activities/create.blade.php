@extends('admin.layouts.app')

@section('title', 'নতুন কার্যক্রম যোগ করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">নতুন কার্যক্রম যোগ করুন</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">শিরোনাম</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">বিবরণ <span class="text-danger">*</span></label>
                            <textarea class="form-control tinymce-editor @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">ছবি</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*" required>
                            <small class="text-muted">সর্বোচ্চ ফাইল সাইজ: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                                <label class="form-check-label" for="status">সক্রিয়</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">সেভ করুন</button>
                        <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary">বাতিল করুন</a>
                    </form>
                </div>
            </div>
        @endsection
