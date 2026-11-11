@extends('admin.layouts.app')

@section('title', 'কর্মকর্তা ব্যবস্থাপনা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">কর্মকর্তা ব্যবস্থাপনা</h1>
                <a href="{{ route('admin.officials.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> নতুন কর্মকর্তা
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="officialsTable">
                            <thead>
                                <tr>
                                    <th style="width: 80px">ক্রম</th>
                                    <th style="width: 80px">ছবি</th>
                                    <th>নাম</th>
                                    <th>পদবি</th>
                                    <th>যোগাযোগ</th>
                                    <th style="width: 100px">অবস্থা</th>
                                    <th style="width: 120px">পদক্ষেপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($officials as $official)
                                <tr>
                                    <td class="align-middle">{{ $official->order }}</td>
                                    <td class="align-middle">
                                        <img src="{{ $official->image_url }}" 
                                             alt="{{ $official->name }}" 
                                             class="rounded-circle"
                                             width="40" height="40"
                                             style="object-fit: cover;">
                                    </td>
                                    <td class="align-middle">{{ $official->name }}</td>
                                    <td class="align-middle">{{ $official->designation }}</td>
                                    <td class="align-middle">
                                        <div><i class="fas fa-envelope me-1 text-muted"></i> {{ $official->email }}</div>
                                        <div><i class="fas fa-phone me-1 text-muted"></i> {{ $official->phone }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge rounded-pill bg-{{ $official->is_active ? 'success' : 'danger' }}">
                                            {{ $official->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.officials.edit', $official) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="সম্পাদনা করুন">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.officials.destroy', $official) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('আপনি কি {{ $official->name }}-কে মুছে ফেলতে চান?')"
                                                        title="মুছে ফেলুন">
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
        @endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,.1);
    }

    .table th {
        font-weight: 500;
        background-color: #f8f9fa;
        border-bottom-width: 1px;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    .btn-group .btn + form {
        margin-left: -1px;
    }

    .btn-group form:not(:last-child) .btn {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .btn-group form:not(:first-child) .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#officialsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/bn.json'
        },
        order: [[0, 'asc']],
        pageLength: 25,
        columnDefs: [
            { orderable: false, targets: [1, 6] }
        ]
    });
});
</script>
@endpush
