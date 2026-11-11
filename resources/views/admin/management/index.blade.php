@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.management.create') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-plus"></i> নতুন যুক্ত করুন
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ছবি</th>
                    <th>নাম</th>
                    <th>পদবি</th>
                    <th>এলাকা</th>
                    <th>ফোন</th>
                    <th>ইমেইল</th>
                    <th>ঠিকানা</th>
                    <th>ক্রম</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($managers as $manager)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($manager->image)
                                <img src="{{ asset('storage/' . $manager->image) }}" 
                                     alt="{{ $manager->name }}" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" 
                                     alt="No Image" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->designation }}</td>
                        <td>{{ $manager->area }}</td>
                        <td>{{ $manager->phone }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ $manager->address }}</td>
                        <td>{{ $manager->order }}</td>
                        <td>
                            <a href="{{ route('admin.management.edit', $manager) }}" 
                               class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.management.destroy', $manager) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি এই দায়িত্বশীলকে মুছে ফেলতে চান?');">
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
                        <td colspan="10" class="text-center">কোন দায়িত্বশীল পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
