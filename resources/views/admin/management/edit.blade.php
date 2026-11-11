@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">দায়িত্বশীল সম্পাদনা করুন</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> পিছনে যান
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('admin.management.update', $management) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">নাম <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $management->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">পদবি <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('designation') is-invalid @enderror" 
                           id="designation" 
                           name="designation" 
                           value="{{ old('designation', $management->designation) }}" 
                           required>
                    @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">দায়িত্বের স্তর <span class="text-danger">*</span></label>
                    <select class="form-select @error('level') is-invalid @enderror" 
                            id="level" 
                            name="level" 
                            required>
                        <option value="">দায়িত্বের স্তর নির্বাচন করুন</option>
                        <option value="central" {{ old('level', $management->level) == 'central' ? 'selected' : '' }}>কেন্দ্রীয়</option>
                        <option value="district" {{ old('level', $management->level) == 'district' ? 'selected' : '' }}>জেলা</option>
                        <option value="upazila" {{ old('level', $management->level) == 'upazila' ? 'selected' : '' }}>উপজেলা</option>
                        <option value="thana" {{ old('level', $management->level) == 'thana' ? 'selected' : '' }}>থানা</option>
                        <option value="branch" {{ old('level', $management->level) == 'branch' ? 'selected' : '' }}>শাখা</option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="area" class="form-label">এলাকা <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('area') is-invalid @enderror" 
                           id="area" 
                           name="area" 
                           value="{{ old('area', $management->area) }}" 
                           required>
                    @error('area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">ফোন <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $management->phone) }}" 
                           required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">ইমেইল</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $management->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">ঠিকানা <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" 
                              name="address" 
                              rows="3" 
                              required>{{ old('address', $management->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">ছবি</label>
                    @if($management->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $management->image) }}" 
                                 alt="{{ $management->name }}" 
                                 class="img-thumbnail" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" 
                           class="form-control @error('image') is-invalid @enderror" 
                           id="image" 
                           name="image" 
                           accept="image/*">
                    <small class="form-text text-muted">নতুন ছবি আপলোড না করলে আগের ছবিটি থেকে যাবে।</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">ক্রম <span class="text-danger">*</span></label>
                    <input type="number" 
                           class="form-control @error('order') is-invalid @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $management->order) }}" 
                           min="1" 
                           required>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">আপডেট করুন</button>
            </form>
        </div>
    </div>
</div>
@endsection
