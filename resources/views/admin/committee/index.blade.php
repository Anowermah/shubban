@extends('admin.layouts.app')

@section('title', 'কমিটি সদস্য তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">কমিটি সদস্য তালিকা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.committee.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন সদস্য যোগ করুন
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="5%">ক্রম</th>
                                    <th width="15%">ছবি</th>
                                    <th width="20%">নাম</th>
                                    <th width="20%">পদবী</th>
                                    <th width="15%">মোবাইল</th>
                                    <th width="10%">অবস্থান</th>
                                    <th width="15%">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if($member->image && Storage::disk('public')->exists($member->image))
                                                <img src="{{ asset('storage/' . $member->image) }}" 
                                                     alt="{{ $member->name }}" 
                                                     class="img-thumbnail"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded-circle"
                                                     style="width: 60px; height: 60px; margin: 0 auto;">
                                                    <i class="fas fa-user text-secondary" style="font-size: 24px;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->designation }}</td>
                                        <td>{{ $member->phone ?: 'N/A' }}</td>
                                        <td class="text-center">{{ $member->order }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.committee.edit', $member->id) }}" 
                                               class="btn btn-sm btn-info me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.committee.destroy', $member->id) }}" 
                                                  method="POST" 
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি এই সদস্যকে মুছে ফেলতে চান?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">কোন কমিটি সদস্য পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($members->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $members->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
