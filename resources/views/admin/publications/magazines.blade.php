@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">ম্যাগাজিন সমূহ</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">সকল ম্যাগাজিন</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMagazineModal">
                <i class="fas fa-plus"></i> নতুন ম্যাগাজিন যোগ করুন
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>শিরোনাম</th>
                            <th>ইস্যু নম্বর</th>
                            <th>প্রকাশনার তারিখ</th>
                            <th>মূল্য</th>
                            <th>স্ট্যাটাস</th>
                            <th style="width: 150px;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($magazines as $magazine)
                        <tr>
                            <td>{{ $magazine->title }}</td>
                            <td>{{ $magazine->issue_number }}</td>
                            <td>{{ $magazine->publication_date->format('d/m/Y') }}</td>
                            <td>{{ $magazine->price ? '৳'.number_format($magazine->price, 2) : 'বিনামূল্যে' }}</td>
                            <td>
                                <span class="badge {{ $magazine->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $magazine->status == 'published' ? 'প্রকাশিত' : 'খসড়া' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.publications.magazines.show', $magazine) }}" 
                                       class="btn btn-sm btn-info" title="বিস্তারিত দেখুন">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.publications.magazines.edit', $magazine) }}" 
                                       class="btn btn-sm btn-primary" title="সম্পাদনা করুন">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.publications.magazines.destroy', $magazine) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি এই ম্যাগাজিনটি মুছে ফেলতে চান?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="মুছে ফেলুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">কোন ম্যাগাজিন পাওয়া যায়নি</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $magazines->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Add Magazine Modal -->
<div class="modal fade" id="addMagazineModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">নতুন ম্যাগাজিন যোগ করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.publications.magazines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">শিরোনাম</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ইস্যু নম্বর</label>
                                <input type="text" class="form-control" name="issue_number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">প্রকাশনার তারিখ</label>
                                <input type="date" class="form-control" name="publication_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">মূল্য</label>
                                <input type="number" class="form-control" name="price" step="0.01" min="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">কভার ইমেজ</label>
                                <input type="file" class="form-control" name="cover_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">পিডিএফ ফাইল</label>
                                <input type="file" class="form-control" name="pdf_file" accept=".pdf">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">বিবরণ</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">স্ট্যাটাস</label>
                                <select class="form-control" name="status" required>
                                    <option value="draft">খসড়া</option>
                                    <option value="published">প্রকাশিত</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
