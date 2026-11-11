@extends('admin.layouts.app')

@section('title', 'যোগাযোগ বার্তাসমূহ')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">যোগাযোগ বার্তাসমূহ</h1>
</div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>তারিখ</th>
                            <th>নাম</th>
                            <th>ফোন</th>
                            <th>ইমেইল</th>
                            <th>বিষয়</th>
                            <th>অ্যাকশন</th>
                            <th>স্ট্যাটাস</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> দেখুন
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বার্তাটি মুছে ফেলতে চান?')">
                                        <i class="fas fa-trash"></i> মুছুন
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contacts->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endsection
