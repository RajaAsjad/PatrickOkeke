@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@section('content')
<section class="page-hero bg-warm paper-grain">
    <div class="container--narrow">
        <p class="eyebrow anim-page-eyebrow">Correspondence</p>
        <h1 class="display-h1 anim-page-h1" style="margin-top:16px">Write to me. I read every letter.</h1>
        <p class="text-lead anim-page-lead" style="margin-top:24px">The best way to reach me is the slow way — a thoughtful note, answered when the desk allows.</p>
    </div>
</section>

<section class="section--sm">
    <div class="container--narrow">
        <div class="split-grid">
            <div class="contact-blocks">
                <div class="contact-block" data-anim="left" data-delay="0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <h2 class="display-h3">Office</h2>
                    <p>4445 Willard Ave, Ste. 600<br>Chevy Chase, MD 20815</p>
                </div>
                <div class="contact-block" data-anim="left" data-delay="100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path><rect x="2" y="4" width="20" height="16" rx="2"></rect></svg>
                    <h2 class="display-h3">Email</h2>
                    <p>General inquiries and correspondence.</p>
                    <a href="mailto:info@baezepi.com">info@baezepi.com</a>
                </div>
                <div class="contact-block" data-anim="left" data-delay="200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 19v3"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><rect x="9" y="2" width="6" height="13" rx="3"></rect></svg>
                    <h2 class="display-h3">Phone</h2>
                    <p>
                        <a href="tel:+13016370818">301 637 0818</a><br>
                        <span style="font-size:.75rem;text-transform:uppercase;letter-spacing:.15em;color:var(--muted-foreground)">Main line</span><br>
                        <a href="tel:+13013631154">301 363 1154</a>
                    </p>
                </div>
                <div class="contact-block" data-anim="left" data-delay="300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18h-5"></path><path d="M18 14h-8"></path><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2"></path><rect width="8" height="4" x="10" y="6" rx="1"></rect></svg>
                    <h2 class="display-h3">Fax</h2>
                    <p><a href="tel:+12272560003">227 256 0003</a></p>
                </div>
            </div>
            <form class="contact-form" action="#" method="post" data-anim="blur" data-delay="150">
                @csrf
                <p class="eyebrow">Send a note</p>
                <h2 class="display-h2" style="margin-top:12px;font-size:1.875rem">A short letter</h2>
                <div class="fields">
                    <label>
                        <span>Your name</span>
                        <input type="text" name="name" required autocomplete="name">
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required autocomplete="email">
                    </label>
                    <label>
                        <span>Subject</span>
                        <input type="text" name="subject">
                    </label>
                    <label>
                        <span>Message</span>
                        <textarea name="message" rows="6" required></textarea>
                    </label>
                    <button type="submit" class="btn-primary">Send letter →</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
