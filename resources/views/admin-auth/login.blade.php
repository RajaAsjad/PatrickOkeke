@extends('admin-auth.layouts.app')

@section('title', 'Admin login')

@section('content')
    <div class="admin-auth-bg" aria-hidden="true">
        <div class="admin-auth-bg__grain"></div>
    </div>

    <div class="admin-auth-portal">
        <div class="admin-auth-card">
            <header class="admin-auth-card__header">
                <span class="admin-auth-card__mark" aria-hidden="true">PO</span>
                <h1 class="admin-auth-card__name">Patrick Okeke</h1>
                <p class="admin-auth-card__panel">Admin Panel</p>
                <p class="admin-auth-card__intro">Sign in to manage books, orders, and site content.</p>
            </header>

            <form method="POST" action="{{ route('admin.authenticate') }}" class="admin-auth-form" novalidate>
                @csrf
                <input type="hidden" name="user_type" value="Admin">

                <div class="admin-auth-field">
                    <label for="email" class="admin-auth-label">{{ __('Email Address') }}</label>
                    <div class="admin-auth-input-wrap">
                        <svg class="admin-auth-input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        </svg>
                        <input id="email" class="admin-auth-input" type="email" name="email" value="{{ old('email') }}"
                            placeholder="you@example.com" autocomplete="email" autofocus required>
                    </div>
                    @error('email')
                        <span class="admin-auth-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-auth-field">
                    <label for="password" class="admin-auth-label">{{ __('Password') }}</label>
                    <div class="admin-auth-input-wrap">
                        <svg class="admin-auth-input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input id="password" class="admin-auth-input admin-auth-input--password" type="password" name="password"
                            placeholder="Enter your password" autocomplete="current-password" required>
                        <button type="button" class="admin-auth-toggle-pw" id="togglePassword" aria-label="Show password">
                            <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" hidden>
                                <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"></path>
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"></path>
                                <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"></path>
                                <path d="m2 2 20 20"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="admin-auth-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-auth-options">
                    <label class="admin-auth-remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <button type="submit" class="admin-auth-submit">{{ __('Log in') }}</button>
            </form>

            <p class="admin-auth-foot">
                <a href="{{ route('index') }}" target="_blank" rel="noopener">
                    <span aria-hidden="true">←</span> Back to website
                </a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    var btn = document.getElementById('togglePassword');
    var input = document.getElementById('password');
    if (!btn || !input) return;

    btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        btn.querySelector('.icon-eye').hidden = !show;
        btn.querySelector('.icon-eye-off').hidden = show;
    });
})();
</script>
@endpush
