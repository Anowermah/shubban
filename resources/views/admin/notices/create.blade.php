@extends('admin.layouts.app')

@section('title', 'নতুন নোটিশ যোগ করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">নতুন নোটিশ যোগ করুন</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.notices.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">শিরোনাম</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">বিস্তারিত বিবরণ</label>
                            <textarea class="form-control tinymce-editor @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">ক্যাটাগরি</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category">
                                <option value="">ক্যাটাগরি নির্বাচন করুন</option>
                                <option value="academic" {{ old('category') == 'academic' ? 'selected' : '' }}>একাডেমিক</option>
                                <option value="admission" {{ old('category') == 'admission' ? 'selected' : '' }}>ভর্তি</option>
                                <option value="exam" {{ old('category') == 'exam' ? 'selected' : '' }}>পরীক্ষা</option>
                                <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>সাধারণ</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="file" class="form-label">ফাইল (PDF/DOC)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">ছবি</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('status') is-invalid @enderror" 
                                       id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">সক্রিয়</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">সেভ করুন</button>
                        <a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">বাতিল করুন</a>
                    </form>
                </div>
            </div>
        @endsection
