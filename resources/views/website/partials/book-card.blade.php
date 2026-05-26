@php
    $imgBase = asset('assets/website/images');
    $animType = $animType ?? 'scale';
    $animDelay = $animDelay ?? 0;
@endphp
<article class="book-card" data-anim="{{ $animType }}" data-delay="{{ $animDelay }}">
    <div class="book-card__cover">
        <div class="book-card__spine" aria-hidden="true"></div>
        <div class="book-card__img">
            <img src="{{ $imgBase }}/{{ $book['cover'] }}" alt="{{ $book['title'] }} book cover" loading="lazy">
        </div>
    </div>
    <div class="book-card__meta">
        <span>{{ $book['category'] }}</span>
        <span class="sep" aria-hidden="true"></span>
        <span>{{ $book['year'] }}</span>
    </div>
    <h3 class="book-card__title display-h3">{{ $book['title'] }}</h3>
    <p class="book-card__subtitle text-balance">{{ $book['subtitle'] }}</p>
    <p class="book-card__desc text-balance">{{ $book['description'] }}</p>
    <div class="book-card__actions">
        <a href="#" class="btn-link">Purchase<span aria-hidden="true">→</span></a>
        <a href="#" class="muted-link">Read excerpt</a>
    </div>
</article>
