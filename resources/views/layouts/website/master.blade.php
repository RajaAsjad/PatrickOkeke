<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('keywords')">
    @php
        $fav = trim($home_page_data['header_favicon'] ?? '');
    @endphp
    @if ($fav !== '')
        <link rel="icon" href="{{ asset('admin/assets/images/page/' . $fav) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset('assets/website/favicon-po.svg') }}" type="image/svg+xml">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/website/css/author.css') }}">
    @stack('styles')
</head>
<body>
    <div class="site-wrap">
        @include('layouts.website.header')

        <main class="site-main">
            @yield('content')
        </main>

        @include('layouts.website.footer')
    </div>

    <script src="{{ asset('assets/website/js/author.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
