@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header text-white py-3 rounded-top" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%);">
                    <h3 class="card-title mb-0">
                        @if($courseType == 'aref')
                            আরেফ রেজিস্ট্রেশন
                        @elseif($courseType == 'saleh')
                            সালেহ রেজিস্ট্রেশন
                        @elseif($courseType == 'rageb')
                            রাগেব রেজিস্ট্রেশন
                        @elseif($courseType == 'salek')
                            সালেক রেজিস্ট্রেশন
                        @else
                            প্রশিক্ষণ রেজিস্ট্রেশন
                        @endif
                    </h3>
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

                    @error('duplicate')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    
                    @error('course_type')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <form id="registrationForm" method="POST" action="{{ route('training.register.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_type" value="{{ $courseType }}">
                        
                        <!-- Personal Information -->
                        <div class="row">
                            <h5 class="border-bottom pb-2">ব্যক্তিগত তথ্য</h5>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">নাম <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="father_name" class="form-label">পিতার নাম <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name" name="father_name" value="{{ old('father_name') }}" required>
                                @error('father_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mother_name" class="form-label">মাতার নাম <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" required>
                                @error('mother_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">জন্ম তারিখ <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">লিঙ্গ <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>পুরুষ</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>মহিলা</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="blood_group" class="form-label">রক্তের গ্রুপ</label>
                                <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                                @error('blood_group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nid" class="form-label">জাতীয় পরিচয়পত্র নম্বর</label>
                                <input type="text" class="form-control @error('nid') is-invalid @enderror" id="nid" name="nid" value="{{ old('nid') }}">
                                @error('nid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="father_occupation" class="form-label">পিতার পেশা</label>
                                <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" id="father_occupation" name="father_occupation" value="{{ old('father_occupation') }}">
                                @error('father_occupation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5 class="border-bottom pb-2 mt-4">যোগাযোগের তথ্য</h5>

                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" required placeholder="01XXXXXXXXX">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">ইমেইল</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact" class="form-label">জরুরী যোগাযোগের নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('emergency_contact') is-invalid @enderror" id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}" required placeholder="01XXXXXXXXX">
                                @error('emergency_contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emergency_relation" class="form-label">জরুরী যোগাযোগের সম্পর্ক <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('emergency_relation') is-invalid @enderror" id="emergency_relation" name="emergency_relation" value="{{ old('emergency_relation') }}" required>
                                @error('emergency_relation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Present Address -->
                        <div class="row mb-4">
                            <h5 class="border-bottom pb-2">বর্তমান ঠিকানা</h5>
                            
                            <div class="col-md-6 mb-3">
                                <label for="present_village" class="form-label">গ্রাম/মহল্লা <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('present_village') is-invalid @enderror" id="present_village" name="present_village" value="{{ old('present_village') }}" required>
                                @error('present_village')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="present_post" class="form-label">পোস্ট অফিস <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('present_post') is-invalid @enderror" id="present_post" name="present_post" value="{{ old('present_post') }}" required>
                                @error('present_post')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="present_thana" class="form-label">থানা/উপজেলা <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('present_thana') is-invalid @enderror" id="present_thana" name="present_thana" value="{{ old('present_thana') }}" required>
                                @error('present_thana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="present_district" class="form-label">জেলা <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('present_district') is-invalid @enderror" id="present_district" name="present_district" value="{{ old('present_district') }}" required>
                                @error('present_district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="same_as_present" name="same_as_present" {{ old('same_as_present') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="same_as_present">
                                        স্থায়ী ঠিকানা একই
                                    </label>
                                </div>
                            </div>

                            <div id="permanent_address_section">
                                <h5 class="border-bottom pb-2 mt-4">স্থায়ী ঠিকানা</h5>

                                <div class="col-md-6 mb-3">
                                    <label for="permanent_village" class="form-label">গ্রাম/মহল্লা <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permanent_village') is-invalid @enderror" id="permanent_village" name="permanent_village" value="{{ old('permanent_village') }}">
                                    @error('permanent_village')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="permanent_post" class="form-label">পোস্ট অফিস <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permanent_post') is-invalid @enderror" id="permanent_post" name="permanent_post" value="{{ old('permanent_post') }}">
                                    @error('permanent_post')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="permanent_thana" class="form-label">থানা/উপজেলা <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permanent_thana') is-invalid @enderror" id="permanent_thana" name="permanent_thana" value="{{ old('permanent_thana') }}">
                                    @error('permanent_thana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="permanent_district" class="form-label">জেলা <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permanent_district') is-invalid @enderror" id="permanent_district" name="permanent_district" value="{{ old('permanent_district') }}">
                                    @error('permanent_district')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="border-bottom pb-2 mt-4">শিক্ষাগত যোগ্যতা</h5>

                            <div class="col-md-6 mb-3">
                                <label for="last_education" class="form-label">সর্বশেষ শিক্ষাগত যোগ্যতা <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_education') is-invalid @enderror" id="last_education" name="last_education" value="{{ old('last_education') }}" required>
                                @error('last_education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="institute" class="form-label">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('institute') is-invalid @enderror" id="institute" name="institute" value="{{ old('institute') }}" required>
                                @error('institute')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="passing_year" class="form-label">পাসের সন <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('passing_year') is-invalid @enderror" id="passing_year" name="passing_year" value="{{ old('passing_year') }}" required>
                                @error('passing_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="result" class="form-label">ফলাফল <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('result') is-invalid @enderror" id="result" name="result" value="{{ old('result') }}" required>
                                @error('result')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="designation" class="form-label">পেশা</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation') }}">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label">ছবি <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg" required>
                                <small class="text-muted">সর্বোচ্চ 2MB</small>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4 py-2 fw-semibold" style="background: #0C4B36; border: none;">
                                <i class="fas fa-paper-plane me-1"></i> আবেদন জমা দিন
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#previewModal">
                                <i class="fas fa-eye"></i> প্রিভিউ দেখুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">রেজিস্ট্রেশন তথ্য</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <img id="previewPhoto" src="" alt="ছবি" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th style="width: 200px;">নাম:</th>
                                    <td id="previewName"></td>
                                </tr>
                                <tr>
                                    <th>পিতার নাম:</th>
                                    <td id="previewFatherName"></td>
                                </tr>
                                <tr>
                                    <th>মাতার নাম:</th>
                                    <td id="previewMotherName"></td>
                                </tr>
                                <tr>
                                    <th>জন্ম তারিখ:</th>
                                    <td id="previewDateOfBirth"></td>
                                </tr>
                                <tr>
                                    <th>রক্তের গ্রুপ:</th>
                                    <td id="previewBloodGroup"></td>
                                </tr>
                                <tr>
                                    <th>লিঙ্গ:</th>
                                    <td id="previewGender"></td>
                                </tr>
                                <tr>
                                    <th>মোবাইল:</th>
                                    <td id="previewMobile"></td>
                                </tr>
                                <tr>
                                    <th>ইমেইল:</th>
                                    <td id="previewEmail"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">বর্তমান ঠিকানা</h5>
                            <table class="table">
                                <tr>
                                    <th style="width: 150px;">গ্রাম/মহল্লা:</th>
                                    <td id="previewPresentVillage"></td>
                                </tr>
                                <tr>
                                    <th>ডাকঘর:</th>
                                    <td id="previewPresentPost"></td>
                                </tr>
                                <tr>
                                    <th>থানা:</th>
                                    <td id="previewPresentThana"></td>
                                </tr>
                                <tr>
                                    <th>জেলা:</th>
                                    <td id="previewPresentDistrict"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">স্থায়ী ঠিকানা</h5>
                            <table class="table">
                                <tr>
                                    <th style="width: 150px;">গ্রাম/মহল্লা:</th>
                                    <td id="previewPermanentVillage"></td>
                                </tr>
                                <tr>
                                    <th>ডাকঘর:</th>
                                    <td id="previewPermanentPost"></td>
                                </tr>
                                <tr>
                                    <th>থানা:</th>
                                    <td id="previewPermanentThana"></td>
                                </tr>
                                <tr>
                                    <th>জেলা:</th>
                                    <td id="previewPermanentDistrict"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                <a href="#" id="modalDownloadBtn" class="btn btn-success">
                    <i class="fas fa-download"></i> ডাউনলোড করুন
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">রেজিস্ট্রেশন সফল</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="successMessage"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">রেজিস্ট্রেশন ব্যর্থ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4>দুঃখিত! রেজিস্ট্রেশন সম্পন্ন হয়নি</h4>
                    <p class="text-muted" id="errorMessage">একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Handle same as present address checkbox
    $('#same_as_present').change(function() {
        if ($(this).is(':checked')) {
            // Copy values from present address
            $('#permanent_village').val($('#present_village').val());
            $('#permanent_post').val($('#present_post').val());
            $('#permanent_thana').val($('#present_thana').val());
            $('#permanent_district').val($('#present_district').val());
            
            // Disable permanent address fields
            $('#permanent_address_section input').prop('disabled', true);
            
            // Hide permanent address section
            $('#permanent_address_section').hide();
        } else {
            // Enable and clear permanent address fields
            $('#permanent_address_section input').prop('disabled', false).val('');
            
            // Show permanent address section
            $('#permanent_address_section').show();
        }
    });

    // Update permanent address when present address changes (if checkbox is checked)
    $('#present_village, #present_post, #present_thana, #present_district').on('input', function() {
        if ($('#same_as_present').is(':checked')) {
            var presentId = $(this).attr('id');
            var permanentId = presentId.replace('present_', 'permanent_');
            $('#' + permanentId).val($(this).val());
        }
    });

    // NID validation
    $('#nid').on('input', function() {
        let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
        if (value.length > 17) {
            value = value.slice(0, 17);
        }
        $(this).val(value);
        
        // Check if length is valid (10, 13, or 17 digits)
        if (value.length > 0 && value.length !== 10 && value.length !== 13 && value.length !== 17) {
            $(this).addClass('is-invalid');
            if (!$(this).next('.invalid-feedback').length) {
                $(this).after('<div class="invalid-feedback">জাতীয় পরিচয়পত্র নম্বর ১০, ১৩, অথবা ১৭ সংখ্যার হতে হবে</div>');
            }
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });

    // Form submission
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var formData = new FormData(this);
        
        // If same as present is checked, copy values before submit
        if ($('#same_as_present').is(':checked')) {
            formData.set('permanent_village', $('#present_village').val());
            formData.set('permanent_post', $('#present_post').val());
            formData.set('permanent_thana', $('#present_thana').val());
            formData.set('permanent_district', $('#present_district').val());
        }
        
        // Disable submit button
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> অপেক্ষা করুন...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Update PDF buttons with registration ID
                    var registrationId = response.registration_id;
                    var downloadUrl = "{{ route('training.download', ':id') }}".replace(':id', registrationId);
                    
                    // Update success modal content
                    $('#successMessage').html(`
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                            <h4>আপনার রেজিস্ট্রেশন সফলভাবে সম্পন্ন হয়েছে</h4>
                            <p class="text-muted mb-4">রেজিস্ট্রেশন ফরম ডাউনলোড করুন অথবা প্রিভিউ দেখুন</p>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#previewModal">
                                    <i class="fas fa-eye"></i> প্রিভিউ দেখুন
                                </button>
                                <a href="${downloadUrl}" class="btn btn-success">
                                    <i class="fas fa-download"></i> ডাউনলোড করুন
                                </a>
                            </div>
                        </div>
                    `);
                    
                    // Show success modal
                    $('#successModal').modal('show');
                    
                    // Reset form
                    form[0].reset();
                    
                    // Remove all error messages
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    // Show permanent address section
                    $('#permanent_address_section').show();
                    $('#permanent_address_section input').prop('disabled', false);
                } else {
                    // Show error modal
                    $('#errorMessage').text(response.message || 'দুঃখিত! একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
                    $('#errorModal').modal('show');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    
                    // Remove all previous error messages
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    
                    // Show new error messages
                    $.each(errors, function(field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        
                        // Handle array of messages
                        if (Array.isArray(messages)) {
                            var message = messages[0]; // Take first message
                            input.after('<div class="invalid-feedback">' + message + '</div>');
                        } else if (typeof messages === 'object') {
                            // Handle nested objects (like regex errors)
                            var message = '';
                            $.each(messages, function(key, value) {
                                if (typeof value === 'string') {
                                    message = value;
                                    return false; // Break the loop
                                }
                            });
                            input.after('<div class="invalid-feedback">' + message + '</div>');
                        } else {
                            // Handle single message
                            input.after('<div class="invalid-feedback">' + messages + '</div>');
                        }
                    });

                    // Show error modal with first error message
                    var firstError = Object.values(errors)[0];
                    var errorMessage = Array.isArray(firstError) ? firstError[0] : 
                                    (typeof firstError === 'object' ? Object.values(firstError)[0] : firstError);
                    $('#errorMessage').text(errorMessage || 'দুঃখিত! একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
                    $('#errorModal').modal('show');

                    // Scroll to first error
                    if ($('.is-invalid').length) {
                        $('html, body').animate({
                            scrollTop: $('.is-invalid').first().offset().top - 100
                        }, 500);
                    }

                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> আবেদন জমা দিন');
                } else {
                    // Show error modal for other errors
                    $('#errorMessage').text('দুঃখিত! একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
                    $('#errorModal').modal('show');

                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> আবেদন জমা দিন');
                }
            },
            complete: function() {
            }
        });
    });

    // Trigger change event on page load if checkbox is checked
    if ($('#same_as_present').is(':checked')) {
        $('#same_as_present').trigger('change');
    }

    // Preview modal
    $('#previewModal').on('show.bs.modal', function() {
        var name = $('#name').val();
        var fatherName = $('#father_name').val();
        var motherName = $('#mother_name').val();
        var dateOfBirth = $('#date_of_birth').val();
        var bloodGroup = $('#blood_group').val();
        var gender = $('#gender').val();
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        var presentVillage = $('#present_village').val();
        var presentPost = $('#present_post').val();
        var presentThana = $('#present_thana').val();
        var presentDistrict = $('#present_district').val();
        var permanentVillage = $('#permanent_village').val();
        var permanentPost = $('#permanent_post').val();
        var permanentThana = $('#permanent_thana').val();
        var permanentDistrict = $('#permanent_district').val();

        $('#previewName').text(name);
        $('#previewFatherName').text(fatherName);
        $('#previewMotherName').text(motherName);
        $('#previewDateOfBirth').text(dateOfBirth);
        $('#previewBloodGroup').text(bloodGroup);
        $('#previewGender').text(gender);
        $('#previewMobile').text(mobile);
        $('#previewEmail').text(email);
        $('#previewPresentVillage').text(presentVillage);
        $('#previewPresentPost').text(presentPost);
        $('#previewPresentThana').text(presentThana);
        $('#previewPresentDistrict').text(presentDistrict);
        $('#previewPermanentVillage').text(permanentVillage);
        $('#previewPermanentPost').text(permanentPost);
        $('#previewPermanentThana').text(permanentThana);
        $('#previewPermanentDistrict').text(permanentDistrict);

        // Show photo preview
        var photo = $('#photo')[0].files[0];
        if (photo) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewPhoto').attr('src', e.target.result);
            };
            reader.readAsDataURL(photo);
        } else {
            $('#previewPhoto').attr('src', '');
        }
    });
});
</script>
@endpush
