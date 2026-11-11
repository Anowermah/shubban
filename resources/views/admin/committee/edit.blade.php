@extends('admin.layouts.app')

@section('title', 'কমিটি সদস্য সম্পাদনা করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">কমিটি সদস্য সম্পাদনা করুন</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.committee.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">নাম <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $member->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="designation" class="form-label">পদবী <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                           id="designation" name="designation" value="{{ old('designation', $member->designation) }}" required>
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">মোবাইল নম্বর</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $member->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">ইমেইল</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $member->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">ঠিকানা</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3">{{ old('address', $member->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">নতুন ছবি</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">বর্তমান ছবি</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $member->image) }}" 
                                             alt="{{ $member->name }}" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">ক্রম <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', $member->order) }}" required>
                                    <small class="form-text text-muted">কম নম্বর থেকে বেশি নম্বর পর্যন্ত দেখানো হবে</small>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" 
                                               name="is_active" value="1" {{ old('is_active', $member->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">সক্রিয়</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.committee.index') }}" class="btn btn-secondary">বাতিল করুন</a>
                            <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
