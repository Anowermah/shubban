@extends('admin.layouts.app')

@section('title', 'নতুন আর্কাইভ যোগ করুন')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">নতুন আর্কাইভ যোগ করুন</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.gallery-archives.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> আর্কাইভ তালিকা
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.gallery-archives.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">শিরোনাম <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">বিবরণ <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="year">বছর <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('year') is-invalid @enderror" 
                                   id="year" 
                                   name="year" 
                                   value="{{ old('year', date('Y')) }}" 
                                   required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cover_image">কভার ছবি</label>
                            <input type="file" 
                                   class="form-control-file @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" 
                                   name="cover_image">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="status" 
                                       name="status" 
                                       value="1" 
                                       {{ old('status', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">সক্রিয়</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">আর্কাইভ তৈরি করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
