@extends('admin.layouts.app')

@section('title', 'মন্তব্য তালিকা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">মন্তব্য তালিকা</h1>
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
                                    <th>সংবাদ</th>
                                    <th>নাম</th>
                                    <th>ইমেইল</th>
                                    <th>মন্তব্য</th>
                                    <th>তারিখ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('news.show', $comment->news) }}">
                                                {{ Str::limit($comment->news->title, 30) }}
                                            </a>
                                        </td>
                                        <td>{{ $comment->name }}</td>
                                        <td>{{ $comment->email }}</td>
                                        <td>{{ Str::limit($comment->comment, 50) }}</td>
                                        <td>{{ $comment->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $comment->status ? 'success' : 'warning' }}">
                                                {{ $comment->status ? 'অনুমোদিত' : 'অননুমোদিত' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(!$comment->status)
                                                <form action="{{ route('admin.comments.approve', $comment) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('admin.comments.destroy', $comment) }}" 
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
                                        <td colspan="8" class="text-center">কোন মন্তব্য পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($comments->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $comments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endsection
