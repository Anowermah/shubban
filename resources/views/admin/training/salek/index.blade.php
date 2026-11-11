@extends('admin.layouts.app')

@section('title', 'সালেক প্রশিক্ষণ তালিকা')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">সালেক প্রশিক্ষণ তালিকা</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.training.salek.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> নতুন রেজিস্ট্রেশন
                        </a>
                        <a href="{{ route('admin.training.salek.download.all') }}" class="btn btn-success">
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
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal" data-id="{{ $registration->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.training.salek.edit', $registration->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.training.salek.download', $registration->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteRegistration({{ $registration->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $registration->id }}" action="{{ route('admin.training.salek.destroy', $registration->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">রেজিস্ট্রেশন বিস্তারিত</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="registrationPhoto" src="" alt="Photo" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>নাম:</th>
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
                            <tr>
                                <th>বর্তমান ঠিকানা:</th>
                                <td>
                                    <span id="registrationPresentVillage"></span>,
                                    <span id="registrationPresentPost"></span>,
                                    <span id="registrationPresentThana"></span>,
                                    <span id="registrationPresentDistrict"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>স্থায়ী ঠিকানা:</th>
                                <td>
                                    <span id="registrationPermanentVillage"></span>,
                                    <span id="registrationPermanentPost"></span>,
                                    <span id="registrationPermanentThana"></span>,
                                    <span id="registrationPermanentDistrict"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>প্রতিষ্ঠানের নাম:</th>
                                <td id="registrationOrganizationName"></td>
                            </tr>
                            <tr>
                                <th>পদবি:</th>
                                <td id="registrationDesignation"></td>
                            </tr>
                            <tr>
                                <th>যোগদানের তারিখ:</th>
                                <td id="registrationJoiningDate"></td>
                            </tr>
                            <tr>
                                <th>প্রতিষ্ঠানের ঠিকানা:</th>
                                <td id="registrationOrganizationAddress"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            
            $.get(`/admin/training/salek/${id}`, function(response) {
                $('#registrationPhoto').attr('src', "{{ asset('storage') }}/" + response.photo);
                $('#registrationName').text(response.name);
                $('#registrationFatherName').text(response.father_name);
                $('#registrationMotherName').text(response.mother_name);
                $('#registrationDateOfBirth').text(response.date_of_birth);
                $('#registrationBloodGroup').text(response.blood_group);
                $('#registrationGender').text(response.gender);
                $('#registrationMobile').text(response.mobile);
                $('#registrationEmail').text(response.email);
                $('#registrationPresentVillage').text(response.present_village);
                $('#registrationPresentPost').text(response.present_post);
                $('#registrationPresentThana').text(response.present_thana);
                $('#registrationPresentDistrict').text(response.present_district);
                $('#registrationPermanentVillage').text(response.permanent_village);
                $('#registrationPermanentPost').text(response.permanent_post);
                $('#registrationPermanentThana').text(response.permanent_thana);
                $('#registrationPermanentDistrict').text(response.permanent_district);
                $('#registrationOrganizationName').text(response.organization_name);
                $('#registrationDesignation').text(response.designation);
                $('#registrationJoiningDate').text(response.joining_date);
                $('#registrationOrganizationAddress').text(response.organization_address);
            });
        });
    });

    function deleteRegistration(id) {
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            text: "এই রেজিস্ট্রেশন মুছে ফেলা হবে!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'হ্যাঁ, মুছে ফেলুন!',
            cancelButtonText: 'না'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush
