<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - এডমিন প্যানেল</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @stack('styles')

    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .75rem 1rem;
        }
        .sidebar .nav-link:hover {
            color: rgba(255,255,255,.95);
            background: rgba(255,255,255,.05);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .main-content {
            min-height: 100vh;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 position-fixed sidebar">
                <div class="py-4 px-3 mb-4 bg-dark">
                    <div class="text-center">
                        <h5 class="text-white">এডমিন প্যানেল</h5>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard.index') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> ড্যাশবোর্ড
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.training.*') ? 'active' : '' }}" 
                       href="#trainingSubmenu" 
                       data-bs-toggle="collapse">
                        <i class="fas fa-graduation-cap me-2"></i> প্রশিক্ষণ
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.training.*') ? 'show' : '' }}" id="trainingSubmenu">
                        <a class="nav-link ms-3 {{ request()->routeIs('admin.training.aref.*') ? 'active' : '' }}" 
                           href="{{ route('admin.training.aref.index') }}">
                            <i class="fas fa-angle-right me-2"></i> আরেফ
                        </a>
                        <a class="nav-link ms-3 {{ request()->routeIs('admin.training.saleh.*') ? 'active' : '' }}" 
                           href="{{ route('admin.training.saleh.index') }}">
                            <i class="fas fa-angle-right me-2"></i> সালেহ
                        </a>
                        <a class="nav-link ms-3 {{ request()->routeIs('admin.training.rageb.*') ? 'active' : '' }}" 
                           href="{{ route('admin.training.rageb.index') }}">
                            <i class="fas fa-angle-right me-2"></i> রাগেব
                        </a>
                        <a class="nav-link ms-3 {{ request()->routeIs('admin.training.salek.*') ? 'active' : '' }}" 
                           href="{{ route('admin.training.salek.index') }}">
                            <i class="fas fa-angle-right me-2"></i> সালেক
                        </a>
                    </div>
                    <a class="nav-link" href="{{ route('admin.logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> লগআউট
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 main-content">
                <div class="py-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
