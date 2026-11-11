<nav>
    <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ asset('front/assets/images/logo.png') }}" alt="Logo"></a>
    </div>
    
    <ul class="navbar">
        <li><a href="{{ url('/') }}">হোম</a></li>
        <li><a href="{{ url('/about') }}">সম্পর্কে</a></li>
        <li class="dropdown">
            <a href="{{ url('/services') }}" class="dropbtn">সেবা</a>
            <div class="dropdown-content">
                <a href="#">সেবা ১</a>
                <a href="#">সেবা ২</a>
                <a href="#">সেবা ৩</a>
            </div>
        </li>
        <li><a href="{{ url('/contact') }}">যোগাযোগ</a></li>
    </ul>
    
    <!-- সার্চ বক্স -->
    <div class="search-box">
        <input type="text" placeholder="সার্চ করুন...">
        <button type="submit">সার্চ</button>
    </div>
</nav>