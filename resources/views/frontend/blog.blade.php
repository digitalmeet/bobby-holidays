@extends('frontend.layouts.app')

@section('title', 'Travel Guides & Planning Advice | UniWorld Holidays')
@section('meta_description', 'Read practical destination guides, seasonal advice, visa planning resources and holiday ideas from the UniWorld Holidays travel team.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Travel Journal', 'subtitle' => 'Useful destination insight and practical planning guidance'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.blog-card', [
                            'image' => media_url($post->featured_image, 'assets/frontend/images/demo/destination-kashmir.webp'),
                            'title' => $post->title,
                            'date' => $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y'),
                            'category' => ucfirst($post->category ?? 'General'),
                            'description' => $post->excerpt ?? str($post->content)->stripTags()->limit(120),
                            'url' => route('frontend.blog.show', $post->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-kashmir.webp', 'title' => 'How to plan a family holiday without stress', 'date' => '08 Jun 2026', 'category' => 'Planning', 'description' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time.', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-dubai.webp', 'title' => 'Visa documents travellers should prepare early', 'date' => '08 Jun 2026', 'category' => 'Visa', 'description' => 'A practical checklist for smoother international trip preparation.', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-maldives.webp', 'title' => 'Best honeymoon ideas for beach lovers', 'date' => '08 Jun 2026', 'category' => 'Honeymoon', 'description' => 'Beach destinations with privacy, romance, and memorable local experiences.', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
            @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $posts->links() }}</div>
            @endif
        </div>
    </section>
@endsection
