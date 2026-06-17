@extends('layouts.website.master')
@section('title', $page_title)

@push('styles')
<style>
.purchase-success {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 24px;
    background: var(--gradient-warm);
}
.purchase-success__card {
    max-width: 560px;
    width: 100%;
    text-align: center;
    padding: 56px 40px;
    background: var(--card);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-soft);
    animation: hero-rise .85s cubic-bezier(.16,1,.32,1) .1s both;
}
.purchase-success__icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 24px;
    border-radius: 50%;
    background: color-mix(in oklab, var(--accent) 15%, transparent);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: hero-blur-in .9s cubic-bezier(.16,1,.32,1) .25s both;
}
.purchase-success__icon svg { color: var(--accent); }
.purchase-success__actions {
    margin-top: 36px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
}
.purchase-success__download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    border-radius: 9999px;
    background: var(--accent);
    color: var(--accent-foreground);
    font-weight: 600;
    font-size: .95rem;
    transition: transform .2s, filter .2s;
    animation: hero-rise .75s cubic-bezier(.16,1,.32,1) .45s both;
}
.purchase-success__download:hover {
    transform: translateY(-2px);
    filter: brightness(1.05);
}
.purchase-success__download svg {
    animation: arrow-bounce 1.2s ease infinite;
}
@keyframes arrow-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(4px); }
}
</style>
@endpush

@section('content')
<section class="purchase-success paper-grain">
    <div class="purchase-success__card">
        <div class="purchase-success__icon" aria-hidden="true">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>
        <p class="eyebrow">Thank you</p>
        <h1 class="display-h2" style="margin-top:12px">Your purchase is complete</h1>
        <p class="text-lead text-balance" style="margin:20px auto 0">
            You now have access to <strong>{{ $book->title }}</strong>. Download your copy below and save the link if you need it again.
        </p>
        <div class="purchase-success__actions">
            <a href="{{ route('book.download', $order->download_token) }}" class="purchase-success__download">
                Download {{ strtoupper($book->file_type) }}
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M19 12l-7 7-7-7"/>
                </svg>
            </a>
            <a href="{{ route('books') }}" class="muted-link">Browse more books</a>
        </div>
        <p class="text-balance" style="margin-top:32px;font-size:.9rem;color:var(--muted-foreground)">
            A receipt was sent to {{ $order->customer_email }}.
        </p>
    </div>
</section>
@endsection
