@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@section('content')
<section class="page-hero bg-warm paper-grain">
    <div class="container">
        <p class="eyebrow anim-page-eyebrow">The library</p>
        <h1 class="display-h1 anim-page-h1" style="margin-top:16px">All the books, on one shelf.</h1>
        <p class="text-lead anim-page-lead" style="margin-top:24px">Each title is independently published and presented here in its hardcover edition. Browse, read excerpts, or request press copies.</p>
    </div>
</section>

<section class="section--sm">
    <div class="container">
        <div class="books-grid books-grid--3">
            @foreach($books as $book)
                @include('website.partials.book-card', ['book' => $book, 'animDelay' => $loop->index * 100, 'animType' => 'tilt'])
            @endforeach
        </div>
    </div>
</section>

@include('website.partials.forthcoming', ['class' => 'section--border-y section--muted'])
@endsection
