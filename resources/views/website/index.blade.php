@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@php
    $img = asset('assets/website/images');
@endphp

@section('content')
<section class="hero bg-warm paper-grain">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow-row anim-hero-line">An author's library</p>
            <h1 class="display-h1 anim-hero-h1" style="margin-top:24px">Stories, ideas <span class="text-italic-accent">&amp;</span> the long quiet work of writing.</h1>
            <p class="text-lead anim-hero-lead" style="margin-top:32px">I'm <strong>Patrick Okeke</strong> — a writer tracing the lines between culture, technology and the inner craft of building a thinking life. Welcome to my shelf.</p>
            <div class="cta-row anim-hero-cta" style="margin-top:40px">
                <a href="{{ route('books') }}" class="btn-primary">Explore the Books <span aria-hidden="true">→</span></a>
                <a href="{{ route('about') }}" class="btn-link">Meet the author</a>
            </div>
            <dl class="hero-stats anim-hero-stats">
                <div><dt>Published</dt><dd>0</dd></div>
                <div><dt>Upcoming</dt><dd>0</dd></div>
                <div><dt>Years writing</dt><dd>0</dd></div>
            </dl>
        </div>
        <div class="hero-visual anim-hero-visual">
            <div class="hero-img-main">
                <img src="{{ $img }}/hero-desk-wD6VNrHk.jpg" alt="A writer's desk: open hardcover book, fountain pen and brass lamp" width="1600" height="1200">
            </div>
            <div class="hero-float hero-float--bl">
                <img src="{{ $img }}/book-blurred-lines-odPx23y8.png" alt="" width="400" height="600">
            </div>
            <div class="hero-float hero-float--tr">
                <img src="{{ $img }}/book-ceos-tiktok-BTyhDE6Y.png" alt="" width="400" height="600">
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split-grid">
        <div data-anim="left">
            <div class="portrait-wrap portrait-wrap--gray portrait-wrap--anim portrait-wrap--ken">
                <img src="{{ $img }}/author-portrait-DvaXpeCp.jpg" alt="Portrait of Patrick Okeke at his writing desk" width="1024" height="1280" loading="lazy">
            </div>
        </div>
        <div class="split-grid__content" data-anim="right" data-delay="120">
            <p class="eyebrow">About the author</p>
            <h2 class="display-h2" style="margin-top:16px">Writing is how I think out loud — slowly, on paper.</h2>
            <div class="prose-block">
                <p class="text-body">For more than a decade, I've written books and essays at the seam where culture meets technology, where individual identity meets collective story. My work is an attempt to take the noise of the present and translate it into something a reader can hold in their hands.</p>
                <p class="text-body">Each book on this shelf is a small argument with the world. Some are practical, some are personal, all of them are honest.</p>
            </div>
            <a href="{{ route('about') }}" class="btn-link" style="margin-top:32px;display:inline-flex">Read the full story <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>

<section class="section section--border-y section--muted">
    <div class="container">
        <div class="section-head" data-anim="fade">
            <div>
                <p class="eyebrow">Featured</p>
                <h2 class="display-h2" style="margin-top:12px">From the shelf</h2>
            </div>
            <a href="{{ route('books') }}" class="btn-link">View all books →</a>
        </div>
        <div class="books-grid books-grid--4">
            @foreach($books as $book)
                @include('website.partials.book-card', ['book' => $book, 'animDelay' => $loop->index * 90])
            @endforeach
        </div>
    </div>
</section>

@include('website.partials.forthcoming', ['intro' => 'Books currently being written, edited or quietly tested on early readers.'])

@include('website.partials.newsletter')
@endsection
