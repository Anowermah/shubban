@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">কমিটি</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <p class="lead">কমিটি সম্পর্কিত তথ্য দেখতে নিচের লিঙ্কে ক্লিক করুন</p>
                        <a href="{{ route('central.committee') }}" class="btn btn-primary">কেন্দ্রীয় কমিটি দেখুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
