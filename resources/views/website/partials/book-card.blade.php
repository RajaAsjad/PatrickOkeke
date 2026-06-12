@php
    $animType = $animType ?? 'scale';
    $animDelay = $animDelay ?? 0;
@endphp
<article class="book-card" data-anim="{{ $animType }}" data-delay="{{ $animDelay }}">
    <div class="book-card__cover">
        <div class="book-card__spine" aria-hidden="true"></div>
        <div class="book-card__img">
            <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }} book cover" loading="lazy">
        </div>
    </div>
    <div class="book-card__meta">
        <span>{{ $book->category }}</span>
        <span class="sep" aria-hidden="true"></span>
        <span>{{ $book->year }}</span>
    </div>
    <h3 class="book-card__title display-h3">{{ $book->title }}</h3>
    <p class="book-card__subtitle text-balance">{{ $book->subtitle }}</p>
    <p class="book-card__desc text-balance">{{ $book->description }}</p>
    <div class="book-card__actions">
        @if($book->file_path)
            <a href="{{ route('books.checkout', $book->slug) }}" class="btn-link">Purchase {{ $book->formattedPrice() }}<span aria-hidden="true">→</span></a>
        @else
            <span class="btn-link" style="opacity:.5;pointer-events:none">Coming soon</span>
        @endif
        <a href="{{ route('books.show', $book->slug) }}" class="muted-link">Read excerpt</a>
    </div>
</article>
