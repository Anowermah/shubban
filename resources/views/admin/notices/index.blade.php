@extends('admin.layouts.app')

@section('title', 'নোটিশ তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">নোটিশ তালিকা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.notices.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন নোটিশ যোগ করুন
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
                                    <th>শিরোনাম</th>
                                    <th>বিবরণ</th>
                                    <th>তারিখ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notices ?? [] as $notice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $notice->title }}</td>
                                        <td>{{ Str::limit($notice->description, 100) }}</td>
                                        <td>{{ $notice->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $notice->status ? 'success' : 'danger' }}">
                                                {{ $notice->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.notices.edit', $notice->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.notices.destroy', $notice->id) }}" 
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
                                        <td colspan="6" class="text-center">কোন নোটিশ পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($notices) && $notices->hasPages())
                        <div class="mt-4">
                            {{ $notices->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
