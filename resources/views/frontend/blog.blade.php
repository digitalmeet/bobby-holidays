@extends('frontend.layouts.app')

@section('title', 'Blog - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Blog', 'subtitle' => 'Travel ideas, tips, and destination guides'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.blog-card', [
                            'image' => $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/frontend/images/blog-family-trip.svg'),
                            'title' => $post->title,
                            'date' => $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y'),
                            'category' => ucfirst($post->category ?? 'General'),
                            'description' => $post->excerpt ?? str($post->content)->stripTags()->limit(120),
                            'url' => route('frontend.blog.show', $post->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-family-trip.svg', 'title' => 'How to plan a family holiday without stress', 'date' => '08 Jun 2026', 'category' => 'Planning', 'description' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time.', 'url' => '#'])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-passport.svg', 'title' => 'Visa documents travellers should prepare early', 'date' => '08 Jun 2026', 'category' => 'Visa', 'description' => 'A practical checklist for smoother international trip preparation.', 'url' => '#'])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-honeymoon.svg', 'title' => 'Best honeymoon ideas for beach lovers', 'date' => '08 Jun 2026', 'category' => 'Honeymoon', 'description' => 'Beach destinations with privacy, romance, and memorable local experiences.', 'url' => '#'])</div>
                @endforelse
            </div>
            @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $posts->links() }}</div>
            @endif
        </div>
    </section>
@endsection
