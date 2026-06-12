@extends('layouts.admin.app')
@section('title', $page_title ?? 'Dashboard')

@push('css')
    <style>
        .pg-dash {
            --dash-ember: #a85a32;
            --dash-ember-deep: #7c4a2d;
            --dash-ember-light: #c9845c;
            --dash-cream: #f5f3f0;
            --dash-ink: #1c1917;
            --dash-muted: #78716c;
            width: 100%;
            min-height: calc(100vh - 100px);
            background: linear-gradient(180deg, var(--dash-cream) 0%, #ebe6df 100%);
            padding: 0 1.5rem 2.5rem;
            margin: 0;
        }

        .pg-dash__banner {
            width: 100%;
            margin: 15px auto 2.5rem;
            padding: 3.5rem 2rem;
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(168, 90, 50, 0.12);
            box-shadow: 0 8px 32px rgba(28, 25, 23, 0.07);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .pg-dash__banner::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 55% at 75% 25%, rgba(168, 90, 50, 0.14) 0%, transparent 58%),
                radial-gradient(ellipse 55% 45% at 15% 85%, rgba(124, 74, 45, 0.08) 0%, transparent 52%);
            animation: pgDashMesh 18s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes pgDashMesh {
            0% { transform: translate(0, 0) scale(1); opacity: 0.85; }
            100% { transform: translate(-12px, 14px) scale(1.04); opacity: 1; }
        }

        .pg-dash__welcome {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .pg-dash__welcome-title {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            font-size: clamp(2rem, 5vw, 3.25rem);
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin: 0;
            color: var(--dash-ink) !important;
            background: none !important;
            -webkit-text-fill-color: unset !important;
            animation: welcomeFloat 3.5s ease-in-out infinite;
        }

        @keyframes welcomeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .pg-dash__welcome-subtitle {
            font-size: clamp(0.8rem, 2vw, 0.95rem);
            font-weight: 600;
            margin: 1rem 0 0;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--dash-ember) !important;
        }

        .pg-dash__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            width: 100%;
        }

        .pg-dash__card {
            background: #fff;
            border-radius: 12px;
            padding: 1.75rem 1.5rem;
            text-decoration: none;
            color: inherit;
            display: block;
            border: 1px solid rgba(168, 90, 50, 0.1);
            box-shadow: 0 4px 20px rgba(28, 25, 23, 0.05);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(24px);
            animation: cardFadeIn 0.6s ease forwards;
        }

        .pg-dash__card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--dash-ember-deep), var(--dash-ember-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }

        .pg-dash__card:nth-child(1) { animation-delay: 0.1s; }
        .pg-dash__card:nth-child(2) { animation-delay: 0.2s; }

        @keyframes cardFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .pg-dash__card:hover {
            transform: translateY(-6px);
            border-color: rgba(168, 90, 50, 0.3);
            box-shadow: 0 16px 40px rgba(28, 25, 23, 0.1);
            color: inherit;
            text-decoration: none;
        }

        .pg-dash__card:hover::after {
            transform: scaleX(1);
        }

        .pg-dash__card-icon {
            width: 56px;
            height: 56px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            background: linear-gradient(135deg, var(--dash-ember-deep) 0%, var(--dash-ember) 100%) !important;
            color: #fff !important;
            box-shadow: 0 6px 18px rgba(168, 90, 50, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: pgIconGlow 3s ease-in-out infinite;
        }

        .pg-dash__card-icon i {
            color: #fff !important;
        }

        @keyframes pgIconGlow {
            0%, 100% { box-shadow: 0 6px 18px rgba(168, 90, 50, 0.28); }
            50% { box-shadow: 0 8px 26px rgba(168, 90, 50, 0.45); }
        }

        .pg-dash__card:hover .pg-dash__card-icon {
            transform: scale(1.08);
            animation: none;
            box-shadow: 0 10px 28px rgba(168, 90, 50, 0.45);
        }

        .pg-dash__card-value {
            font-size: 2.35rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            color: var(--dash-ember-deep) !important;
            background: none !important;
            -webkit-text-fill-color: unset !important;
            transition: color 0.3s ease;
        }

        .pg-dash__card:hover .pg-dash__card-value {
            color: var(--dash-ember) !important;
        }

        .pg-dash__card-label {
            font-size: 0.94rem;
            font-weight: 600;
            color: var(--dash-muted);
            margin: 0;
        }

        @media (max-width: 1200px) {
            .pg-dash__grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 576px) {
            .pg-dash { padding: 0 1rem 1.5rem; }
            .pg-dash__banner { padding: 2rem 1.25rem; margin-bottom: 1.5rem; }
            .pg-dash__grid { grid-template-columns: 1fr; gap: 1rem; }
            .pg-dash__card { padding: 1.25rem; }
            .pg-dash__card-value { font-size: 1.75rem; }
        }
    </style>
@endpush

@section('content')
    <section class="content pg-dash">
        @php
            $contactUsIndex = Route::has('contactus.index') ? route('contactus.index') : '#';
            $bookIndex = Route::has('book.index') ? route('book.index') : '#';
        @endphp

        <div class="pg-dash__banner">
            <div class="pg-dash__welcome">
                <h1 class="pg-dash__welcome-title">Welcome,<br>Patrick Okeke</h1>
                <p class="pg-dash__welcome-subtitle">Author site — admin desk</p>
            </div>
        </div>

        <div class="pg-dash__grid">
            <a href="{{ $contactUsIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $contactUsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Contact Messages</div>
            </a>

            <a href="{{ $bookIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-book" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $bookTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Books</div>
            </a>
        </div>
    </section>
@endsection
