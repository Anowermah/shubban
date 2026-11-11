@extends('layouts.app')

@push('styles')
    @yield('page-styles')
@endpush

@section('content')
<!-- Page Header Banner -->
<div class="page-header-banner py-4 py-md-5 mb-4 mb-md-5 position-relative overflow-hidden" 
     style="background: linear-gradient(135deg, #07281d 0%, #0C4B36 55%, #135841 100%); color: #fff; box-shadow: 0 6px 20px rgba(12, 75, 54, 0.15); border-bottom: 3.5px solid #FBB040;">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center gy-3">
            <div class="col-md-9 text-center text-md-start">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb mb-0 justify-content-center justify-content-md-start" style="font-size: 0.88rem;">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-white text-opacity-75 text-decoration-none">
                                <i class="fas fa-home me-1 text-warning"></i>হোম
                            </a>
                        </li>
                        @hasSection('category')
                            <li class="breadcrumb-item text-white text-opacity-75">
                                @yield('category')
                            </li>
                        @endif
                        <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </nav>
                <h1 class="page-title mb-0 text-white fw-bold fs-2" style="letter-spacing: -0.3px;">
                    @yield('title')
                </h1>
                @hasSection('subtitle')
                    <p class="page-subtitle text-white-50 font-sm mb-0 mt-2" style="max-width: 650px;">
                        @yield('subtitle')
                    </p>
                @endif
            </div>
            <div class="col-md-3 text-md-end d-none d-md-block opacity-25">
                <i class="fas fa-mosque fa-4x text-white"></i>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    @yield('page-content')
</div>

<!-- Dynamic Breadcrumb Schema for Google -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "হোম",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "@yield('title')",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>
@endsection

@push('scripts')
    @yield('page-scripts')
@endpush
