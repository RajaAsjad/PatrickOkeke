@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@php
    $img = asset('assets/website/images');
@endphp

@section('content')
<section class="page-hero bg-warm paper-grain">
    <div class="container--narrow">
        <p class="eyebrow anim-page-eyebrow">About</p>
        <h1 class="display-h1 anim-page-h1" style="margin-top:16px">A writer of <span class="text-italic-accent">small</span> arguments and <span class="text-italic-accent">long</span> attention.</h1>
        <p class="text-lead anim-page-lead" style="margin-top:32px">Patrick Okeke is a Nigerian-born author whose books examine the invisible scaffolding of modern life — from cultural identity to creator economies, from intelligence to influence.</p>
    </div>
</section>

<section class="section--sm">
    <div class="container--narrow">
        <div class="split-grid split-grid--portrait-first">
            <aside>
                <div data-anim="scale">
                    <div class="portrait-wrap portrait-wrap--anim">
                        <img src="{{ $img }}/author-portrait-DvaXpeCp.jpg" alt="Portrait of Patrick Okeke" width="1024" height="1280" loading="lazy">
                    </div>
                </div>
                <dl class="meta-list" data-anim="fade" data-delay="200">
                    <div><dt>Born</dt><dd>Lagos, Nigeria</dd></div>
                    <div><dt>Lives</dt><dd>Between Lagos &amp; Lisbon</dd></div>
                    <div><dt>Writes about</dt><dd>Culture · Technology · Craft</dd></div>
                    <div><dt>First published</dt><dd>2015</dd></div>
                </dl>
            </aside>
            <div>
                <p class="pull-quote" data-anim="rise">I started writing because I wanted to understand things slowly. The world keeps insisting we move at the speed of feeds; books are how I refuse.</p>
                <div class="prose-block" data-anim="fade" data-delay="100">
                    <p class="text-body">My early years were spent in Lagos, surrounded by stories that refused to fit into single categories — markets that doubled as theatres, prayers that doubled as politics, friendships that doubled as economies. That refusal of neat lines became the guiding thread of my work.</p>
                    <p class="text-body">Today I write across four loose territories: cultural identity, technology and creators, the inner life of builders, and the ethics of attention. The books talk to each other. Read in any order, they form a single ongoing argument: that craft, care and slowness are not nostalgic luxuries but radical tools.</p>
                    <p class="text-body">When I am not writing I am usually reading, walking, or quietly arguing with a draft. I publish independently because I want the reader, not the algorithm, to be the editor I write toward.</p>
                </div>
                <h2 class="display-h2" style="margin-top:48px;font-size:1.875rem" data-anim="fade">Selected praise</h2>
                <blockquote class="quote" data-anim="left" data-delay="80">
                    <p>&ldquo;A patient, unfashionable thinker — exactly what we need more of.&rdquo;</p>
                    <footer>— The Quiet Review</footer>
                </blockquote>
                <blockquote class="quote" data-anim="right" data-delay="160">
                    <p>&ldquo;Okeke writes the way good architects build: nothing wasted, everything load-bearing.&rdquo;</p>
                    <footer>— Field Notes Quarterly</footer>
                </blockquote>
                <div class="cta-row" data-anim="up" data-delay="120">
                    <a href="{{ route('books') }}" class="btn-primary">Browse the books →</a>
                    <a href="{{ route('contact') }}" class="btn-link">Get in touch</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
