@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@section('content')
    <section class="page-hero">
        <div class="container-pns">
            <h1>Pricing</h1>
            <p>Every property is different. We build a scope and schedule that fits yours.</p>
        </div>
    </section>

    <section class="section-pns">
        <div class="container-pns text-center">
            <h2 class="mb-3">Get a quote today</h2>
            <p class="sub mx-auto" style="max-width: 560px;">Need a walk-through before booking? No problem. Call or text
                and we will respond in less than 24 hours.</p>
            <a href="tel:+13016370818" class="btn-pns-gold me-2 mb-2"><i class="fas fa-phone me-2"></i>301 637 0818</a>
            <a href="tel:+13013631154" class="btn-pns-outline mb-2"><i class="fas fa-phone me-2"></i>Main: 301 363 1154</a>
            <div class="mt-4">
                <a href="{{ url('/#contact-quote') }}" class="btn-pns-outline">Use the contact form</a>
            </div>
        </div>
    </section>
@endsection
