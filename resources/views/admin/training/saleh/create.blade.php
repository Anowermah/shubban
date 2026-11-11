@extends('admin.layouts.app')

@section('title', 'নতুন সালেহ প্রশিক্ষণ রেজিস্ট্রেশন')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">নতুন সালেহ প্রশিক্ষণ রেজিস্ট্রেশন</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.training.saleh.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> তালিকায় ফিরে যান
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.training.saleh.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">পিতার নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}" required>
                                    @error('father_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">মাতার নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}" required>
                                    @error('mother_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_occupation">পিতার পেশা</label>
                                    <input type="text" name="father_occupation" id="father_occupation" class="form-control @error('father_occupation') is-invalid @enderror" value="{{ old('father_occupation') }}">
                                    @error('father_occupation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">জন্ম তারিখ <span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nid">জাতীয় পরিচয়পত্র নম্বর</label>
                                    <input type="text" name="nid" id="nid" class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}">
                                    @error('nid')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blood_group">রক্তের গ্রুপ</label>
                                    <select name="blood_group" id="blood_group" class="form-control @error('blood_group') is-invalid @enderror">
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    </select>
                                    @error('blood_group')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">লিঙ্গ <span class="text-danger">*</span></label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>পুরুষ</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>মহিলা</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">মোবাইল <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required>
                                    @error('mobile')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">ইমেইল</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">বর্তমান ঠিকানা</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="present_village">গ্রাম <span class="text-danger">*</span></label>
                                            <input type="text" name="present_village" id="present_village" class="form-control @error('present_village') is-invalid @enderror" value="{{ old('present_village') }}" required>
                                            @error('present_village')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="present_post">পোস্ট <span class="text-danger">*</span></label>
                                            <input type="text" name="present_post" id="present_post" class="form-control @error('present_post') is-invalid @enderror" value="{{ old('present_post') }}" required>
                                            @error('present_post')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="present_thana">থানা <span class="text-danger">*</span></label>
                                            <input type="text" name="present_thana" id="present_thana" class="form-control @error('present_thana') is-invalid @enderror" value="{{ old('present_thana') }}" required>
                                            @error('present_thana')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="present_district">জেলা <span class="text-danger">*</span></label>
                                            <input type="text" name="present_district" id="present_district" class="form-control @error('present_district') is-invalid @enderror" value="{{ old('present_district') }}" required>
                                            @error('present_district')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">স্থায়ী ঠিকানা</h5>
                                        <div class="card-tools">
                                            <button type="button" id="copy-address" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-copy"></i> বর্তমান ঠিকানা কপি করুন
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="permanent_village">গ্রাম <span class="text-danger">*</span></label>
                                            <input type="text" name="permanent_village" id="permanent_village" class="form-control @error('permanent_village') is-invalid @enderror" value="{{ old('permanent_village') }}" required>
                                            @error('permanent_village')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_post">পোস্ট <span class="text-danger">*</span></label>
                                            <input type="text" name="permanent_post" id="permanent_post" class="form-control @error('permanent_post') is-invalid @enderror" value="{{ old('permanent_post') }}" required>
                                            @error('permanent_post')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_thana">থানা <span class="text-danger">*</span></label>
                                            <input type="text" name="permanent_thana" id="permanent_thana" class="form-control @error('permanent_thana') is-invalid @enderror" value="{{ old('permanent_thana') }}" required>
                                            @error('permanent_thana')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_district">জেলা <span class="text-danger">*</span></label>
                                            <input type="text" name="permanent_district" id="permanent_district" class="form-control @error('permanent_district') is-invalid @enderror" value="{{ old('permanent_district') }}" required>
                                            @error('permanent_district')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">শিক্ষাগত যোগ্যতা</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_education">সর্বশেষ শিক্ষাগত যোগ্যতা <span class="text-danger">*</span></label>
                                                    <input type="text" name="last_education" id="last_education" class="form-control @error('last_education') is-invalid @enderror" value="{{ old('last_education') }}" required>
                                                    @error('last_education')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="institute">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                                    <input type="text" name="institute" id="institute" class="form-control @error('institute') is-invalid @enderror" value="{{ old('institute') }}" required>
                                                    @error('institute')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="passing_year">পাসের সন <span class="text-danger">*</span></label>
                                                    <input type="text" name="passing_year" id="passing_year" class="form-control @error('passing_year') is-invalid @enderror" value="{{ old('passing_year') }}" required>
                                                    @error('passing_year')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="result">ফলাফল <span class="text-danger">*</span></label>
                                                    <input type="text" name="result" id="result" class="form-control @error('result') is-invalid @enderror" value="{{ old('result') }}" required>
                                                    @error('result')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">ছবি <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror" accept="image/*" required>
                                    @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> সংরক্ষণ করুন
                                </button>
                                <a href="{{ route('admin.training.saleh.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> বাতিল করুন
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Copy present address to permanent address
        $('#copy-address').click(function() {
            $('#permanent_village').val($('#present_village').val());
            $('#permanent_post').val($('#present_post').val());
            $('#permanent_thana').val($('#present_thana').val());
            $('#permanent_district').val($('#present_district').val());
        });
    });
</script>
@endpush
