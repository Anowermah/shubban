@extends('admin.layouts.app')

@section('title', 'বার্তা বিস্তারিত')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">বার্তা বিস্তারিত</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> সব বার্তা
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">তারিখ:</div>
                        <div class="col-md-9">{{ $contact->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">নাম:</div>
                        <div class="col-md-9">{{ $contact->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ফোন:</div>
                        <div class="col-md-9">{{ $contact->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ইমেইল:</div>
                        <div class="col-md-9">{{ $contact->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">বিষয়:</div>
                        <div class="col-md-9">{{ $contact->subject }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">বার্তা:</div>
                        <div class="col-md-9">{{ $contact->message }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বার্তাটি মুছে ফেলতে চান?')">
                        <i class="fas fa-trash"></i> বার্তা মুছুন
                    </button>
                </form>
            </div>
        @endsection
