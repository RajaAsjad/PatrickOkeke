@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@section('content')
    <section class="page-hero">
        <div class="container-pns">
            <h1>Cleaning services</h1>
            <p>Choose a category to see what is included and how often we can visit.</p>
        </div>
    </section>

    <section class="section-pns">
        <div class="container-pns">
            <ul class="nav nav-tabs service-tabs flex-nowrap overflow-auto" id="serviceTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-res" data-bs-toggle="tab" data-bs-target="#pane-res"
                        type="button" role="tab">Residential</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-com" data-bs-toggle="tab" data-bs-target="#pane-com" type="button"
                        role="tab">Commercial</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-ret" data-bs-toggle="tab" data-bs-target="#pane-ret" type="button"
                        role="tab">Retail</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-post" data-bs-toggle="tab" data-bs-target="#pane-post" type="button"
                        role="tab">Post-construction</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-move" data-bs-toggle="tab" data-bs-target="#pane-move" type="button"
                        role="tab">Move in / out</button>
                </li>
            </ul>
            <div class="tab-content service-tab-content" id="serviceTabsContent">
                <div class="tab-pane fade show active" id="pane-res" role="tabpanel">
                    <p>Imagine taking the leg work out of maintaining your sanctuary! Our cleaners are timely in
                        handling whichever rooms you prefer. Floor care, surfaces, toilet cleaning, as well as cleaning
                        blinds and ceiling fans are all included in your clean. Stove, refrigerator, and baseboard
                        cleanings are available as an add-on.</p>
                    <p class="mb-0"><strong>Frequency:</strong> Daily, biweekly, or monthly.</p>
                </div>
                <div class="tab-pane fade" id="pane-com" role="tabpanel">
                    <p>We ensure your commercial space is tidy from back to front. This includes dust mopping, floor
                        mopping, scrubber floor care, wipe-down surfaces, restroom care for all restrooms, window and door
                        cleaning, and emptying trash bins.</p>
                    <p class="mb-0"><strong>Frequency:</strong> Daily, weekly, or multiple times a week.</p>
                </div>
                <div class="tab-pane fade" id="pane-ret" role="tabpanel">
                    <p>Retail janitorial for stores, franchises, and shops — your sales floor and restrooms reflect your
                        brand. We provide dust mopping, floor mopping, scrubber floor care, wipe-down surfaces, restroom
                        care for all restrooms, window and door cleaning, and emptying trash bins.</p>
                    <p class="mb-0"><strong>Frequency:</strong> Daily, weekly, or multiple times a week.</p>
                </div>
                <div class="tab-pane fade" id="pane-post" role="tabpanel">
                    <p>Our experienced cleaners are no stranger to getting the job done. Need a whole construction site
                        clean? Call us — we have already got it covered.</p>
                    <p class="mb-0"><strong>Frequency:</strong> As needed.</p>
                </div>
                <div class="tab-pane fade" id="pane-move" role="tabpanel">
                    <p>No need to stress about getting your property ready for the next tenant. We quickly and efficiently
                        make sure all surfaces are shiny, floors are spotless, and walls are presentable — for
                        apartments, homes, and duplexes.</p>
                    <p class="mb-0"><strong>Frequency:</strong> As needed.</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ url('/#contact-quote') }}" class="btn-pns-gold">Get a free quote + walk-through</a>
            </div>
        </div>
    </section>
@endsection
