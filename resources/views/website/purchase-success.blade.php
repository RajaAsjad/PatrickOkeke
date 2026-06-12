@extends('layouts.website.master')
@section('title', $page_title)

@section('content')
<section class="section section--border-y">
    <div class="container" style="max-width:640px;text-align:center;padding:80px 24px;">
        <p class="eyebrow">Thank you</p>
        <h1 class="display-h2" style="margin-top:12px">Your purchase is complete</h1>
        <p class="text-lead text-balance" style="margin-top:20px">
            You now have access to <strong>{{ $book->title }}</strong>. Download your copy below — save the link if you need it again.
        </p>
        <div style="margin-top:40px;display:flex;flex-direction:column;gap:16px;align-items:center;">
            <a href="{{ route('books.download', $order->download_token) }}" class="btn-link" style="font-size:1.1rem">
                Download {{ strtoupper($book->file_type) }}<span aria-hidden="true">↓</span>
            </a>
            <a href="{{ route('books') }}" class="muted-link">Browse more books</a>
        </div>
        <p class="text-balance" style="margin-top:32px;font-size:.9rem;color:var(--color-text-muted,#78716c)">
            A receipt was sent to {{ $order->customer_email }}.
        </p>
    </div>
</section>
@endsection
