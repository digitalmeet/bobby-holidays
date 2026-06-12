@extends('frontend.layouts.app')

@section('title', 'Blog - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Blog'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Travel Blog',
                'title' => 'Ideas, checklists, and destination tips',
                'text' => 'Static blog previews are ready to map to post titles, slugs, thumbnails, and excerpts later.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-family-trip.svg', 'title' => 'How to plan a family holiday without stress', 'date' => '08 Jun 2026', 'category' => 'Planning', 'description' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time.', 'url' => route('frontend.blog.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-passport.svg', 'title' => 'Visa documents travellers should prepare early', 'date' => '08 Jun 2026', 'category' => 'Visa', 'description' => 'A practical checklist for smoother international trip preparation.', 'url' => route('frontend.blog.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-honeymoon.svg', 'title' => 'Best honeymoon ideas for beach lovers', 'date' => '08 Jun 2026', 'category' => 'Honeymoon', 'description' => 'Beach destinations with privacy, romance, and memorable local experiences.', 'url' => route('frontend.blog.show')])</div>
            </div>
        </div>
    </section>
@endsection
