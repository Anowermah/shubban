@extends('admin.layouts.app')

@section('title', 'সদস্য তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">সদস্য তালিকা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.members.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন সদস্য যোগ করুন
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ক্রম</th>
                                    <th>নাম</th>
                                    <th>মোবাইল</th>
                                    <th>ঠিকানা</th>
                                    <th>সদস্যপদ</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members ?? [] as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->phone }}</td>
                                        <td>{{ $member->address }}</td>
                                        <td>{{ $member->membership_type }}</td>
                                        <td>
                                            <a href="{{ route('admin.members.edit', $member->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.members.destroy', $member->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">কোন সদস্য পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($members) && $members->hasPages())
                        <div class="mt-4">
                            {{ $members->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
