@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">আরেফ রেজিস্ট্রেশন তালিকা</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">মোট রেজিস্ট্রেশন</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $registrations->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">এই মাসের রেজিস্ট্রেশন</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $registrations->where('created_at', '>=', now()->startOfMonth())->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">পুরুষ শিক্ষার্থী</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $registrations->where('gender', 'male')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">মহিলা শিক্ষার্থী</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $registrations->where('gender', 'female')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">রেজিস্ট্রেশন তালিকা</h6>
            <a href="{{ route('admin.training.aref.download.all') }}" class="btn btn-sm btn-success">
                <i class="fas fa-download"></i> তালিকা ডাউনলোড
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="registrationTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ক্রমিক</th>
                            <th>নাম</th>
                            <th>মোবাইল</th>
                            <th>জেলা</th>
                            <th>শিক্ষাগত যোগ্যতা</th>
                            <th>রেজিস্ট্রেশন তারিখ</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registration->name }}</td>
                            <td>{{ $registration->mobile }}</td>
                            <td>{{ $registration->present_district }}</td>
                            <td>{{ $registration->last_education }}</td>
                            <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-info view-details" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="{{ $registration->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.training.aref.edit', ['id' => $registration->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.training.aref.download', ['registration' => $registration->id]) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('admin.training.aref.destroy', ['id' => $registration->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই রেজিস্ট্রেশন মুছতে চান?');">
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

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">রেজিস্ট্রেশন বিস্তারিত</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="registrationDetails">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                <img id="registrationPhoto" src="" alt="Registration Photo" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 150px;">নাম</th>
                                    <td id="detailName"></td>
                                </tr>
                                <tr>
                                    <th>পিতার নাম</th>
                                    <td id="detailFatherName"></td>
                                </tr>
                                <tr>
                                    <th>মাতার নাম</th>
                                    <td id="detailMotherName"></td>
                                </tr>
                                <tr>
                                    <th>জন্ম তারিখ</th>
                                    <td id="detailDateOfBirth"></td>
                                </tr>
                                <tr>
                                    <th>রক্তের গ্রুপ</th>
                                    <td id="detailBloodGroup"></td>
                                </tr>
                                <tr>
                                    <th>লিঙ্গ</th>
                                    <td id="detailGender"></td>
                                </tr>
                                <tr>
                                    <th>মোবাইল</th>
                                    <td id="detailMobile"></td>
                                </tr>
                                <tr>
                                    <th>ইমেইল</th>
                                    <td id="detailEmail"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">বর্তমান ঠিকানা</h6>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 100px;">গ্রাম</th>
                                    <td id="detailPresentVillage"></td>
                                </tr>
                                <tr>
                                    <th>পোস্ট</th>
                                    <td id="detailPresentPost"></td>
                                </tr>
                                <tr>
                                    <th>থানা</th>
                                    <td id="detailPresentThana"></td>
                                </tr>
                                <tr>
                                    <th>জেলা</th>
                                    <td id="detailPresentDistrict"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">স্থায়ী ঠিকানা</h6>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 100px;">গ্রাম</th>
                                    <td id="detailPermanentVillage"></td>
                                </tr>
                                <tr>
                                    <th>পোস্ট</th>
                                    <td id="detailPermanentPost"></td>
                                </tr>
                                <tr>
                                    <th>থানা</th>
                                    <td id="detailPermanentThana"></td>
                                </tr>
                                <tr>
                                    <th>জেলা</th>
                                    <td id="detailPermanentDistrict"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h6 class="border-bottom pb-2">পেশাগত তথ্য</h6>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">প্রতিষ্ঠানের নাম</th>
                                    <td id="detailOrganizationName"></td>
                                </tr>
                                <tr>
                                    <th>পদবি</th>
                                    <td id="detailDesignation"></td>
                                </tr>
                                <tr>
                                    <th>যোগদানের তারিখ</th>
                                    <td id="detailJoiningDate"></td>
                                </tr>
                                <tr>
                                    <th>প্রতিষ্ঠানের ঠিকানা</th>
                                    <td id="detailOrganizationAddress"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                <a href="#" id="modalDownloadBtn" class="btn btn-success">
                    <i class="fas fa-download"></i> ডাউনলোড
                </a>
                <a href="#" id="modalEditBtn" class="btn btn-warning">
                    <i class="fas fa-edit"></i> সম্পাদনা
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    .border-left-primary {
        border-left: .25rem solid #4e73df!important;
    }
    .border-left-success {
        border-left: .25rem solid #1cc88a!important;
    }
    .border-left-info {
        border-left: .25rem solid #36b9cc!important;
    }
    .border-left-warning {
        border-left: .25rem solid #f6c23e!important;
    }
    .text-gray-300 {
        color: #dddfeb!important;
    }
    .text-gray-800 {
        color: #5a5c69!important;
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #e3e6f0;
        border-radius: .35rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#registrationTable').DataTable({
        "language": {
            "lengthMenu": "প্রতি পেজে _MENU_ টি এন্ট্রি",
            "zeroRecords": "কোন তথ্য পাওয়া যায়নি",
            "info": "মোট _PAGES_ পেজের মধ্যে _PAGE_ নং পেজ দেখাচ্ছে",
            "infoEmpty": "কোন তথ্য পাওয়া যায়নি",
            "infoFiltered": "(_MAX_ টি এন্ট্রির মধ্যে থেকে ফিল্টার করা হয়েছে)",
            "search": "অনুসন্ধান:",
            "paginate": {
                "first": "প্রথম",
                "last": "শেষ",
                "next": "পরবর্তী",
                "previous": "পূর্ববর্তী"
            }
        }
    });

    // View Details Modal
    $('.view-details').click(function() {
        const id = $(this).data('id');
        
        // Fetch registration details
        $.ajax({
            url: `/admin/training/aref/${id}`,
            method: 'GET',
            success: function(data) {
                $('#registrationPhoto').attr('src', `/storage/${data.photo}`);
                $('#detailName').text(data.name);
                $('#detailFatherName').text(data.father_name);
                $('#detailMotherName').text(data.mother_name);
                $('#detailDateOfBirth').text(data.date_of_birth);
                $('#detailBloodGroup').text(data.blood_group || 'উল্লেখ নেই');
                $('#detailGender').text(data.gender === 'male' ? 'পুরুষ' : 'মহিলা');
                $('#detailMobile').text(data.mobile);
                $('#detailEmail').text(data.email || 'উল্লেখ নেই');
                
                // Present Address
                $('#detailPresentVillage').text(data.present_village);
                $('#detailPresentPost').text(data.present_post);
                $('#detailPresentThana').text(data.present_thana);
                $('#detailPresentDistrict').text(data.present_district);
                
                // Permanent Address
                $('#detailPermanentVillage').text(data.permanent_village);
                $('#detailPermanentPost').text(data.permanent_post);
                $('#detailPermanentThana').text(data.permanent_thana);
                $('#detailPermanentDistrict').text(data.permanent_district);
                
                // Professional Info
                $('#detailOrganizationName').text(data.organization_name || 'উল্লেখ নেই');
                $('#detailDesignation').text(data.designation || 'উল্লেখ নেই');
                $('#detailJoiningDate').text(data.joining_date || 'উল্লেখ নেই');
                $('#detailOrganizationAddress').text(data.organization_address || 'উল্লেখ নেই');

                // Update modal buttons
                $('#modalDownloadBtn').attr('href', `/admin/training/aref/${id}/download`);
                $('#modalEditBtn').attr('href', `/admin/training/aref/${id}/edit`);
            },
            error: function(xhr) {
                alert('দুঃখিত, তথ্য লোড করা যায়নি।');
            }
        });
    });
});
</script>
@endpush

@endsection
