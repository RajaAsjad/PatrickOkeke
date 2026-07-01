@php
    $navActive = match (true) {
        request()->routeIs('index') => 'home',
        request()->routeIs('about') => 'about',
        request()->routeIs('books') => 'books',
        request()->routeIs('contact') => 'contact',
        default => '',
    };
@endphp

<header class="site-header" id="nav">
    <div class="site-header__inner">
        <a href="{{ route('index') }}">
            <img src="{{ asset('public/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}"
                alt="logo" width="135" height="50" decoding="async">
        </a>
        <nav>
            <ul class="site-nav">
                <li><a href="{{ route('index') }}" class="{{ $navActive === 'home' ? 'act' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ $navActive === 'about' ? 'act' : '' }}">About</a></li>
                <li><a href="{{ route('books') }}" class="{{ $navActive === 'books' ? 'act' : '' }}">Books</a></li>
                <li><a href="{{ route('contact') }}" class="{{ $navActive === 'contact' ? 'act' : '' }}">Contact</a></li>
            </ul>
        </nav>
        <button type="button" class="menu-btn" onclick="tmm()" aria-label="Toggle menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg>
        </button>
    </div>
</header>

<div class="mm" id="mm">
    <div class="mm-head">
        <a href="{{ route('index') }}">
            <img src="{{ asset('public/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}"
                alt="logo" width="135" height="50" decoding="async">
        </a>
        <button type="button" class="mm-close" onclick="tmm()" aria-label="Close menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18"></path><path d="M6 6l12 12"></path></svg>
        </button>
    </div>
    <div class="mm-links">
        <a href="{{ route('index') }}" onclick="tmm()">Home</a>
        <a href="{{ route('about') }}" onclick="tmm()">About</a>
        <a href="{{ route('books') }}" onclick="tmm()">Books</a>
        <a href="{{ route('contact') }}" onclick="tmm()">Contact</a>
    </div>
</div>
