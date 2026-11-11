@extends('admin.layouts.app')

@section('title', 'সেটিংস')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">ওয়েবসাইট জেনারেল সেটিংস</h1>
                    <p class="text-secondary small mb-0">মৌলিক তথ্য, যোগাযোগ ও সামাজিক যোগাযোগ মাধ্যম সেটিংস</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.homepage.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-layer-group me-1"></i> হোমপেজ কন্ট্রোল
                    </a>
                    <a href="{{ route('admin.theme.index') }}" class="btn btn-outline-warning text-dark fw-semibold">
                        <i class="fas fa-palette me-1"></i> কালার ও মোড
                    </a>
                    <a href="{{ route('admin.pwa.index') }}" class="btn btn-outline-primary fw-semibold">
                        <i class="fas fa-mobile-alt me-1"></i> PWA অ্যাপ কন্ট্রোল
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">ওয়েবসাইট সেটিংস</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="site_title" class="form-label">ওয়েবসাইট টাইটেল</label>
                                    <input type="text" class="form-control @error('site_title') is-invalid @enderror" 
                                           id="site_title" name="site_title" value="{{ old('site_title', $settings->site_title ?? '') }}">
                                    @error('site_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="site_description" class="form-label">ওয়েবসাইট বিবরণ</label>
                                    <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                              id="site_description" name="site_description" rows="3">{{ old('site_description', $settings->site_description ?? '') }}</textarea>
                                    @error('site_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">যোগাযোগের ইমেইল</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                           id="contact_email" name="contact_email" value="{{ old('contact_email', $settings->contact_email ?? '') }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">যোগাযোগের ফোন</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                           id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone ?? '') }}">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_address" class="form-label">যোগাযোগের ঠিকানা</label>
                                    <textarea class="form-control @error('contact_address') is-invalid @enderror" 
                                              id="contact_address" name="contact_address" rows="3">{{ old('contact_address', $settings->contact_address ?? '') }}</textarea>
                                    @error('contact_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="logo" class="form-label">লোগো</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                           id="logo" name="logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if(isset($settings->logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">সেটিংস আপডেট করুন</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">সামাজিক মিডিয়া লিংক</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.social') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="facebook_url" class="form-label">ফেসবুক</label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                           id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}">
                                    @error('facebook_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="twitter_url" class="form-label">টুইটার</label>
                                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" 
                                           id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url ?? '') }}">
                                    @error('twitter_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="youtube_url" class="form-label">ইউটিউব</label>
                                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                           id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url ?? '') }}">
                                    @error('youtube_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">সামাজিক মিডিয়া লিংক আপডেট করুন</button>
                            </form>
                        </div>
                    </div>

                    <!-- Progressive Web App (PWA) Status Card -->
                    <div class="card mt-4 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header border-0 py-3 px-3 px-md-4 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #072e20 0%, #0C4B36 100%);">
                            <span class="fw-bold d-flex align-items-center">
                                <i class="fas fa-mobile-alt text-warning me-2 fs-5"></i> প্রগ্রেসিভ ওয়েব অ্যাপ (PWA) স্ট্যাটাস
                            </span>
                            <span class="badge bg-success-subtle text-success">
                                <i class="fas fa-check-circle me-1"></i> সক্রিয় ও প্রস্তুত
                            </span>
                        </div>
                        <div class="card-body p-3 p-md-4 bg-white">
                            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                <img src="/icons/icon-96x96.png" alt="Shubban PWA" style="width: 52px; height: 52px; border-radius: 12px; background: #0C4B36; padding: 4px;">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">শুব্বান মোবাইল ও ডেস্কটপ ওয়েব অ্যাপ</h6>
                                    <p class="text-secondary font-xs mb-0">দর্শনার্থীরা অ্যান্ড্রয়েড, আইফোন বা কম্পিউটারে সরাসরি অ্যাপ হিসেবে ইনস্টল করতে পারবে।</p>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><i class="fas fa-file-code text-primary me-2"></i> ওয়েব অ্যাপ ম্যানিফেস্ট:</span>
                                    <a href="/manifest.json" target="_blank" class="badge bg-light text-primary border text-decoration-none">
                                        /manifest.json <i class="fas fa-external-link-alt font-xs ms-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><i class="fas fa-cogs text-success me-2"></i> সার্ভিস ওয়ার্কার (Service Worker):</span>
                                    <a href="/sw.js" target="_blank" class="badge bg-light text-success border text-decoration-none">
                                        /sw.js <i class="fas fa-external-link-alt font-xs ms-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><i class="fas fa-wifi text-warning me-2"></i> অফলাইন ফলব্যাক পেজ:</span>
                                    <a href="/offline.html" target="_blank" class="badge bg-light text-warning-emphasis border text-decoration-none">
                                        /offline.html <i class="fas fa-external-link-alt font-xs ms-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><i class="fas fa-icons text-danger me-2"></i> অ্যাপ আইকন ও মাস্কেবল সাইজ:</span>
                                    <span class="badge bg-success-subtle text-success">৭২x৭২ থেকে ৫১২x৫১২ মাস্কেবল প্রস্তুত</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
