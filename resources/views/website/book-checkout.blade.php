@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Secure checkout for '.$book->title)

@push('styles')
<style>
.checkout-wrap {
    min-height: calc(100vh - 80px);
    display: grid;
    grid-template-columns: 1fr;
}
@media (min-width: 900px) {
    .checkout-wrap { grid-template-columns: 1fr 1fr; }
}
.checkout-book {
    padding: 48px 32px 64px;
    background: var(--gradient-warm);
    border-bottom: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    justify-content: center;
}
@media (min-width: 900px) {
    .checkout-book {
        padding: 64px 56px;
        border-bottom: none;
        border-right: 1px solid var(--border);
        position: sticky;
        top: 72px;
        min-height: calc(100vh - 72px);
    }
}
.checkout-book__inner { max-width: 420px; margin: 0 auto; width: 100%; }
.checkout-book__cover {
    width: 160px;
    border-radius: 8px;
    box-shadow: var(--shadow-book);
    margin-bottom: 28px;
    animation: hero-blur-in 1s cubic-bezier(.16,1,.32,1) .1s both;
}
.checkout-book__title {
    font-family: var(--ff-display);
    font-size: clamp(1.75rem, 3vw, 2.25rem);
    font-weight: 600;
    line-height: 1.15;
    animation: hero-rise .8s cubic-bezier(.16,1,.32,1) .2s both;
}
.checkout-book__sub {
    margin-top: 8px;
    font-style: italic;
    color: var(--muted-foreground);
    animation: hero-fade .8s ease .35s both;
}
.checkout-book__desc {
    margin-top: 20px;
    font-size: .95rem;
    line-height: 1.6;
    color: color-mix(in oklab, var(--foreground) 75%, transparent);
    animation: hero-fade .8s ease .45s both;
}
.checkout-book__price {
    margin-top: 32px;
    font-family: var(--ff-display);
    font-size: 2rem;
    font-weight: 600;
    animation: hero-rise .75s cubic-bezier(.16,1,.32,1) .55s both;
}
.checkout-form-panel {
    padding: 48px 32px 80px;
    background: var(--card);
    display: flex;
    flex-direction: column;
    justify-content: center;
}
@media (min-width: 900px) {
    .checkout-form-panel { padding: 64px 56px; }
}
.checkout-form__inner { max-width: 440px; margin: 0 auto; width: 100%; }
.checkout-form__heading {
    font-family: var(--ff-display);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 8px;
    animation: hero-rise .7s cubic-bezier(.16,1,.32,1) .15s both;
}
.checkout-form__sub {
    font-size: .875rem;
    color: var(--muted-foreground);
    margin-bottom: 32px;
    animation: hero-fade .7s ease .25s both;
}
.checkout-field {
    margin-bottom: 20px;
    animation: hero-rise .7s cubic-bezier(.16,1,.32,1) both;
}
.checkout-field:nth-child(1) { animation-delay: .3s; }
.checkout-field:nth-child(2) { animation-delay: .38s; }
.checkout-field:nth-child(3) { animation-delay: .46s; }
.checkout-field label {
    display: block;
    font-size: .8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: var(--muted-foreground);
    margin-bottom: 8px;
}
.checkout-field input {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--background);
    transition: border-color .2s, box-shadow .2s;
}
.checkout-field input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px color-mix(in oklab, var(--accent) 20%, transparent);
}
#card-element {
    padding: 16px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--background);
    transition: border-color .2s, box-shadow .2s;
}
#card-element.StripeElement--focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px color-mix(in oklab, var(--accent) 20%, transparent);
}
#card-errors {
    color: #b91c1c;
    font-size: .85rem;
    margin-top: 10px;
    min-height: 1.2em;
}
.checkout-pay-btn {
    width: 100%;
    margin-top: 28px;
    padding: 16px 24px;
    border: none;
    border-radius: 9999px;
    background: var(--accent);
    color: var(--accent-foreground);
    font-size: .95rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: transform .2s, filter .2s, opacity .2s;
    animation: hero-rise .7s cubic-bezier(.16,1,.32,1) .54s both;
}
.checkout-pay-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    filter: brightness(1.05);
}
.checkout-pay-btn:disabled {
    opacity: .65;
    cursor: not-allowed;
}
.checkout-pay-btn .spinner {
    width: 18px;
    height: 18px;
    border: 2px solid color-mix(in oklab, var(--accent-foreground) 30%, transparent);
    border-top-color: var(--accent-foreground);
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: none;
}
.checkout-pay-btn.is-loading .spinner { display: block; }
.checkout-pay-btn.is-loading .btn-text { opacity: .7; }
@keyframes spin { to { transform: rotate(360deg); } }
.checkout-secure {
    margin-top: 20px;
    text-align: center;
    font-size: .78rem;
    color: var(--muted-foreground);
    animation: hero-fade .7s ease .62s both;
}
.checkout-secure svg { vertical-align: -2px; margin-right: 4px; }
.checkout-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .85rem;
    color: var(--muted-foreground);
    margin-bottom: 28px;
    transition: color .2s;
    animation: hero-fade .6s ease .05s both;
}
.checkout-back:hover { color: var(--accent); }
</style>
@endpush

@section('content')
<div class="checkout-wrap">
    <aside class="checkout-book paper-grain">
        <div class="checkout-book__inner">
            <a href="{{ route('books.show', $book->slug) }}" class="checkout-back">← Back to book</a>
            <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }}" class="checkout-book__cover">
            <p class="eyebrow">{{ $book->category }}@if($book->year) · {{ $book->year }}@endif</p>
            <h1 class="checkout-book__title">{{ $book->title }}</h1>
            @if($book->subtitle)
            <p class="checkout-book__sub">{{ $book->subtitle }}</p>
            @endif
            <p class="checkout-book__desc">{{ Str::limit($book->description, 180) }}</p>
            <p class="checkout-book__price">{{ $book->formattedPrice() }}</p>
        </div>
    </aside>

    <div class="checkout-form-panel">
        <div class="checkout-form__inner">
            <h2 class="checkout-form__heading">Complete your purchase</h2>
            <p class="checkout-form__sub">Enter your details and card information below.</p>

            <form id="checkout-form" novalidate>
                <div class="checkout-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="you@example.com" autocomplete="email">
                </div>
                <div class="checkout-field">
                    <label for="name">Name on card</label>
                    <input type="text" id="name" name="name" placeholder="Full name" autocomplete="name">
                </div>
                <div class="checkout-field">
                    <label>Card details</label>
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <button type="submit" id="pay-btn" class="checkout-pay-btn">
                    <span class="spinner" aria-hidden="true"></span>
                    <span class="btn-text">Pay {{ $book->formattedPrice() }}</span>
                </button>
            </form>

            <p class="checkout-secure">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Secured by Stripe · Your card details never touch our servers
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
(function () {
    const stripeKey = @json(config('services.stripe.key'));
    const paymentUrl = @json(route('books.payment-intent', $book->slug));
    const successBase = @json(route('books.purchase.success'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!stripeKey) return;

    const stripe = Stripe(stripeKey);
    const elements = stripe.elements({
        appearance: {
            theme: 'stripe',
            variables: {
                colorPrimary: '#a85a32',
                fontFamily: 'Inter, ui-sans-serif, system-ui, sans-serif',
                borderRadius: '8px',
            },
        },
    });

    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#1c140e',
                '::placeholder': { color: '#78716c' },
            },
            invalid: { color: '#b91c1c' },
        },
        hidePostalCode: true,
    });

    card.mount('#card-element');

    card.on('change', function (event) {
        const err = document.getElementById('card-errors');
        err.textContent = event.error ? event.error.message : '';
    });

    const form = document.getElementById('checkout-form');
    const payBtn = document.getElementById('pay-btn');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const name = document.getElementById('name').value.trim();
        const errEl = document.getElementById('card-errors');

        if (!email) {
            errEl.textContent = 'Please enter your email address.';
            return;
        }

        payBtn.disabled = true;
        payBtn.classList.add('is-loading');
        errEl.textContent = '';

        try {
            const res = await fetch(paymentUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ email, name }),
            });

            const data = await res.json();

            if (!res.ok) {
                throw new Error(data.error || data.message || 'Could not start payment.');
            }

            const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
                payment_method: {
                    card,
                    billing_details: {
                        email,
                        name: name || undefined,
                    },
                },
            });

            if (error) {
                errEl.textContent = error.message;
                payBtn.disabled = false;
                payBtn.classList.remove('is-loading');
                return;
            }

            if (paymentIntent && paymentIntent.status === 'succeeded') {
                window.location.href = successBase + '?payment_intent=' + encodeURIComponent(paymentIntent.id);
            }
        } catch (err) {
            errEl.textContent = err.message || 'Something went wrong. Please try again.';
            payBtn.disabled = false;
            payBtn.classList.remove('is-loading');
        }
    });
})();
</script>
@endpush
