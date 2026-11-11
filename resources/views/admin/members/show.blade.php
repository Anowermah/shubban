@extends('admin.layouts.app')

@section('title', 'সদস্য বিস্তারিত')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">সদস্য বিস্তারিত</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-info me-2">
                        <i class="fas fa-edit"></i> সম্পাদনা
                    </a>
                    <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> ফিরে যান
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5>নাম</h5>
                            <p>{{ $member->name }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h5>ইমেইল</h5>
                            <p>{{ $member->email }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h5>মোবাইল নম্বর</h5>
                            <p>{{ $member->phone }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h5>স্ট্যাটাস</h5>
                            <p>
                                @if($member->status)
                                    <span class="badge bg-success">সক্রিয়</span>
                                @else
                                    <span class="badge bg-danger">নিষ্ক্রিয়</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-12">
                            <h5>ঠিকানা</h5>
                            <p>{{ $member->address }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>তৈরি হয়েছে</h5>
                            <p>{{ $member->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>আপডেট হয়েছে</h5>
                            <p>{{ $member->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
