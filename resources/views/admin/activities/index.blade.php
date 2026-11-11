@extends('admin.layouts.app')

@section('title', 'কার্যক্রম তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">কার্যক্রম তালিকা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.activities.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন কার্যক্রম যোগ করুন
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
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities ?? [] as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($activity->image)
                                                <img src="{{ asset('storage/' . $activity->image) }}" 
                                                     alt="{{ $activity->title }}" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">ছবি নেই</span>
                                            @endif
                                        </td>
                                        <td>{{ $activity->title }}</td>
                                        <td>{{ Str::limit($activity->description, 100) }}</td>
                                        <td>
                                            @if($activity->status)
                                                <span class="badge bg-success">সক্রিয়</span>
                                            @else
                                                <span class="badge bg-danger">নিষ্ক্রিয়</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.activities.edit', $activity->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.activities.destroy', $activity->id) }}" 
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
                                        <td colspan="6" class="text-center">কোন কার্যক্রম পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($activities) && $activities->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $activities->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
