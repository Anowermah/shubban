@extends('admin.layouts.app')

@section('title', 'নতুন কর্মকর্তা যোগ করুন')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">নতুন কর্মকর্তা যোগ করুন</h1>
        <a href="{{ route('admin.officials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> ফিরে যান
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">নাম</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="designation">পদবি</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                   id="designation" name="designation" value="{{ old('designation') }}" required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="education">শিক্ষাগত যোগ্যতা</label>
                            <textarea class="form-control @error('education') is-invalid @enderror" 
                                      id="education" name="education" rows="3" required>{{ old('education') }}</textarea>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="experience">অভিজ্ঞতা</label>
                            <textarea class="form-control @error('experience') is-invalid @enderror" 
                                      id="experience" name="experience" rows="3" required>{{ old('experience') }}</textarea>
                            @error('experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expertise">বিশেষ দক্ষতা</label>
                            <select class="form-control select2 @error('expertise') is-invalid @enderror" 
                                    id="expertise" name="expertise[]" multiple required>
                                <option value="">দক্ষতা নির্বাচন করুন</option>
                                @foreach(old('expertise', []) as $expertise)
                                    <option value="{{ $expertise }}" selected>{{ $expertise }}</option>
                                @endforeach
                            </select>
                            @error('expertise')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="responsibilities">দায়িত্বসমূহ</label>
                            <select class="form-control select2 @error('responsibilities') is-invalid @enderror" 
                                    id="responsibilities" name="responsibilities[]" multiple required>
                                <option value="">দায়িত্ব নির্বাচন করুন</option>
                                @foreach(old('responsibilities', []) as $responsibility)
                                    <option value="{{ $responsibility }}" selected>{{ $responsibility }}</option>
                                @endforeach
                            </select>
                            @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">ইমেইল</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">ফোন</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="office">অফিস</label>
                            <input type="text" class="form-control @error('office') is-invalid @enderror" 
                                   id="office" name="office" value="{{ old('office') }}" required>
                            @error('office')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">ছবি</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">ক্রম</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', 0) }}" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                       id="is_active" name="is_active" value="1" 
                                       {{ old('is_active') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">সক্রিয়?</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> সংরক্ষণ করুন
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: 'টাইপ করুন...'
        });
    });
</script>
@endsection
