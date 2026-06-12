@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $book->description)

@section('content')
<section class="page-hero bg-warm paper-grain">
    <div class="container">
        <p class="eyebrow anim-page-eyebrow">{{ $book->category }} @if($book->year)— {{ $book->year }}@endif</p>
        <h1 class="display-h1 anim-page-h1" style="margin-top:16px">{{ $book->title }}</h1>
        @if($book->subtitle)
        <p class="text-lead anim-page-lead" style="margin-top:16px;font-style:italic">{{ $book->subtitle }}</p>
        @endif
    </div>
</section>

<section class="section--sm">
    <div class="container">
        <div style="display:grid;grid-template-columns:minmax(200px,280px) 1fr;gap:48px;align-items:start;">
            <div>
                <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }} cover" style="width:100%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,.12);">
            </div>
            <div>
                @if(session('error'))
                <p style="color:#b91c1c;margin-bottom:16px">{{ session('error') }}</p>
                @endif
                @if(request('cancelled'))
                <p style="color:#b45309;margin-bottom:16px">Payment was cancelled. You can try again when ready.</p>
                @endif
                <p class="text-balance" style="margin-bottom:24px">{{ $book->description }}</p>
                @if($book->excerpt && $book->excerpt !== $book->description)
                <div style="margin-bottom:32px;padding:24px;background:var(--color-muted,#f5f3f0);border-radius:8px;">
                    <p class="eyebrow" style="margin-bottom:12px">Excerpt</p>
                    <p class="text-balance">{{ $book->excerpt }}</p>
                </div>
                @endif
                <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
                    <span class="display-h3" style="margin:0">{{ $book->formattedPrice() }}</span>
                    @if($book->file_path)
                    <a href="{{ route('books.checkout', $book->slug) }}" class="btn-link">Purchase<span aria-hidden="true">→</span></a>
                    @else
                    <span class="muted-link">Coming soon</span>
                    @endif
                    <a href="{{ route('books') }}" class="muted-link">← Back to all books</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
