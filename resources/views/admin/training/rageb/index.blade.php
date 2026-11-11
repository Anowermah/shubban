@extends('admin.layouts.app')

@section('title', 'রাগেব প্রশিক্ষণ তালিকা')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">রাগেব প্রশিক্ষণ তালিকা</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.training.rageb.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> নতুন রেজিস্ট্রেশন
                        </a>
                        <a href="{{ route('admin.training.rageb.download.all') }}" class="btn btn-success">
                            <i class="fas fa-download"></i> সব ডাউনলোড
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ক্রমিক</th>
                                    <th>নাম</th>
                                    <th>পিতার নাম</th>
                                    <th>মোবাইল</th>
                                    <th>ঠিকানা</th>
                                    <th>ছবি</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $registration->name }}</td>
                                    <td>{{ $registration->father_name }}</td>
                                    <td>{{ $registration->mobile }}</td>
                                    <td>{{ $registration->present_district }}</td>
                                    <td>
                                        @if($registration->photo)
                                        <img src="{{ asset('storage/'.$registration->photo) }}" alt="Photo" class="img-thumbnail" width="50">
                                        @else
                                        <span class="badge badge-warning">No Photo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $registration->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.training.rageb.download', $registration->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <form action="{{ route('admin.training.rageb.destroy', $registration->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">রেজিস্ট্রেশন বিস্তারিত</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img id="registrationPhoto" src="" alt="ছবি" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th style="width: 200px;">নাম:</th>
                                <td id="registrationName"></td>
                            </tr>
                            <tr>
                                <th>পিতার নাম:</th>
                                <td id="registrationFatherName"></td>
                            </tr>
                            <tr>
                                <th>মাতার নাম:</th>
                                <td id="registrationMotherName"></td>
                            </tr>
                            <tr>
                                <th>জন্ম তারিখ:</th>
                                <td id="registrationDateOfBirth"></td>
                            </tr>
                            <tr>
                                <th>রক্তের গ্রুপ:</th>
                                <td id="registrationBloodGroup"></td>
                            </tr>
                            <tr>
                                <th>লিঙ্গ:</th>
                                <td id="registrationGender"></td>
                            </tr>
                            <tr>
                                <th>মোবাইল:</th>
                                <td id="registrationMobile"></td>
                            </tr>
                            <tr>
                                <th>ইমেইল:</th>
                                <td id="registrationEmail"></td>
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
                                <td id="registrationPresentVillage"></td>
                            </tr>
                            <tr>
                                <th>ডাকঘর:</th>
                                <td id="registrationPresentPost"></td>
                            </tr>
                            <tr>
                                <th>থানা:</th>
                                <td id="registrationPresentThana"></td>
                            </tr>
                            <tr>
                                <th>জেলা:</th>
                                <td id="registrationPresentDistrict"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">স্থায়ী ঠিকানা</h5>
                        <table class="table">
                            <tr>
                                <th style="width: 150px;">গ্রাম/মহল্লা:</th>
                                <td id="registrationPermanentVillage"></td>
                            </tr>
                            <tr>
                                <th>ডাকঘর:</th>
                                <td id="registrationPermanentPost"></td>
                            </tr>
                            <tr>
                                <th>থানা:</th>
                                <td id="registrationPermanentThana"></td>
                            </tr>
                            <tr>
                                <th>জেলা:</th>
                                <td id="registrationPermanentDistrict"></td>
                            </tr>
                        </table>
                    </div>
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
    $('#dataTable').DataTable();

    // View Modal
    $('#viewModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        // Get registration details via AJAX
        $.ajax({
            url: `/admin/training/rageb/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.photo) {
                    $('#registrationPhoto').attr('src', "{{ asset('storage') }}/" + response.photo);
                } else {
                    $('#registrationPhoto').attr('src', "{{ asset('images/no-photo.jpg') }}");
                }
                $('#registrationName').text(response.name || '');
                $('#registrationFatherName').text(response.father_name || '');
                $('#registrationMotherName').text(response.mother_name || '');
                $('#registrationDateOfBirth').text(response.date_of_birth || '');
                $('#registrationBloodGroup').text(response.blood_group || '');
                $('#registrationGender').text(response.gender || '');
                $('#registrationMobile').text(response.mobile || '');
                $('#registrationEmail').text(response.email || '');
                $('#registrationPresentVillage').text(response.present_village || '');
                $('#registrationPresentPost').text(response.present_post || '');
                $('#registrationPresentThana').text(response.present_thana || '');
                $('#registrationPresentDistrict').text(response.present_district || '');
                $('#registrationPermanentVillage').text(response.permanent_village || '');
                $('#registrationPermanentPost').text(response.permanent_post || '');
                $('#registrationPermanentThana').text(response.permanent_thana || '');
                $('#registrationPermanentDistrict').text(response.permanent_district || '');
            },
            error: function(xhr) {
                alert('দুঃখিত! তথ্য লোড করা যায়নি।');
            }
        });
    });
});
</script>
@endpush
