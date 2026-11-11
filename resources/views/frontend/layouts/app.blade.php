<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.header')
</head>
<body>
    @include('frontend.layouts.navbar')

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
