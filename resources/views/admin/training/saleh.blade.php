@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">সালেহ রেজিস্ট্রেশন তালিকা</h1>
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
            <a href="{{ route('admin.training.saleh.download.all') }}" class="btn btn-sm btn-success">
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
                                    <button type="button" class="btn btn-sm btn-info view-details" 
                                            data-id="{{ $registration->id }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailsModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.training.saleh.download', $registration->id) }}" 
                                       class="btn btn-sm btn-success" 
                                       target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
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
                    <!-- Details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
@endsection

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
            "info": "মোট _PAGES_ পেজের মধ্যে _PAGE_ নং পেজ",
            "infoEmpty": "কোন তথ্য পাওয়া যায়নি",
            "infoFiltered": "(মোট _MAX_ টি এন্ট্রি থেকে ফিল্টার করা হয়েছে)",
            "search": "খুঁজুন:",
            "paginate": {
                "first": "প্রথম",
                "last": "শেষ",
                "next": "পরবর্তী",
                "previous": "পূর্ববর্তী"
            }
        }
    });

    // View Details Button Click Handler
    $('.view-details').click(function() {
        const id = $(this).data('id');
        
        // Fetch registration details
        $.get(`/admin/training/saleh/${id}`, function(data) {
            if(data.success) {
                const registration = data.registration;
                
                let detailsHtml = `
                    <div class="row">
                        <div class="col-md-3">
                            ${registration.photo ? 
                                `<img src="${registration.photo}" class="img-thumbnail" style="max-width: 150px;">` : 
                                '<p class="text-muted">ছবি নেই</p>'
                            }
                        </div>
                        <div class="col-md-9">
                            <h4>${registration.name}</h4>
                            <p><strong>পেশা:</strong> ${registration.designation || 'N/A'}</p>
                            <p><strong>এন.আই.ডি:</strong> ${registration.nid || 'N/A'}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>ব্যক্তিগত তথ্য</h5>
                            <p><strong>জন্ম তারিখ:</strong> ${registration.date_of_birth}</p>
                            <p><strong>রক্তের গ্রুপ:</strong> ${registration.blood_group || 'N/A'}</p>
                            <p><strong>লিঙ্গ:</strong> ${registration.gender === 'male' ? 'পুরুষ' : 'মহিলা'}</p>
                            <p><strong>পিতার নাম:</strong> ${registration.father_name}</p>
                            <p><strong>পিতার পেশা:</strong> ${registration.father_occupation || 'N/A'}</p>
                            <p><strong>মাতার নাম:</strong> ${registration.mother_name}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>যোগাযোগের তথ্য</h5>
                            <p><strong>মোবাইল:</strong> ${registration.mobile}</p>
                            <p><strong>ইমেইল:</strong> ${registration.email || 'N/A'}</p>
                            <p><strong>জরুরি যোগাযোগ:</strong> ${registration.emergency_contact}</p>
                            <p><strong>সম্পর্ক:</strong> ${registration.emergency_relation}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>বর্তমান ঠিকানা</h5>
                            <p>${registration.present_village}</p>
                            <p>${registration.present_post}</p>
                            <p>${registration.present_thana}</p>
                            <p>${registration.present_district}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>স্থায়ী ঠিকানা</h5>
                            <p>${registration.permanent_village}</p>
                            <p>${registration.permanent_post}</p>
                            <p>${registration.permanent_thana}</p>
                            <p>${registration.permanent_district}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>শিক্ষাগত যোগ্যতা</h5>
                            <p><strong>সর্বশেষ শিক্ষাগত যোগ্যতা:</strong> ${registration.last_education}</p>
                            <p><strong>প্রতিষ্ঠান:</strong> ${registration.institute}</p>
                            <p><strong>পাসের সন:</strong> ${registration.passing_year}</p>
                            <p><strong>ফলাফল:</strong> ${registration.result}</p>
                        </div>
                    </div>
                `;
                
                $('#registrationDetails').html(detailsHtml);
            } else {
                alert('তথ্য লোড করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।');
            }
        });
    });
});
</script>
@endpush
