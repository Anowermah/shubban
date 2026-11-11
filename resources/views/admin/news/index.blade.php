@extends('admin.layouts.app')

@section('title', 'সংবাদ তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">সংবাদ তালিকা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন সংবাদ যোগ করুন
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
                                    <th>ছবি</th>
                                    <th>শিরোনাম</th>
                                    <th>বিবরণ</th>
                                    <th>তারিখ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($news ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->image) }}" 
                                                 alt="{{ $item->title }}" width="50">
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Str::limit($item->description, 100) }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status ? 'success' : 'warning' }}">
                                                {{ $item->status ? 'প্রকাশিত' : 'অপ্রকাশিত' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.news.edit', $item->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $item->id) }}" 
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
                                        <td colspan="7" class="text-center">কোন সংবাদ পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($news) && $news->hasPages())
                        <div class="mt-4">
                            {{ $news->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
