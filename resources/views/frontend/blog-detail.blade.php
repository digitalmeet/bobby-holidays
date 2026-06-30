@extends('frontend.layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' — UniWorld Holidays Blog')
@section('meta_description', $post->meta_description ?? $post->excerpt ?? '')
@section('og_image_meta')
@if($post->featured_image)<meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">@endif
@endsection

@section('content')
    @include('frontend.components.page-banner', ['title' => $post->title, 'subtitle' => ucfirst($post->category ?? 'Blog')])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    {{-- Meta --}}
                    <div class="d-flex flex-wrap gap-3 mb-4 text-muted small">
                        <span><i class="fa-solid fa-calendar me-1"></i> {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}</span>
                        @if($post->category)
                            <span><i class="fa-solid fa-tag me-1"></i> {{ ucfirst($post->category) }}</span>
                        @endif
                        @if($post->read_time_minutes)
                            <span><i class="fa-solid fa-clock me-1"></i> {{ $post->read_time_minutes }} min read</span>
                        @endif
                        @if($post->author)
                            <span><i class="fa-solid fa-user me-1"></i> {{ $post->author->name }}</span>
                        @endif
                    </div>

                    {{-- Featured Image --}}
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-4 w-100">
                    @endif

                    {{-- Content --}}
                    <div class="content-body">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags --}}
                    @if($post->tags && count($post->tags))
                        <div class="mt-4 pt-4 border-top">
                            <strong class="me-2">Tags:</strong>
                            @foreach($post->tags as $tag)
                                <span class="badge bg-light text-dark me-1">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- CTA --}}
                    <div class="mt-5 p-4 bg-light rounded text-center">
                        <h5>Planning a trip?</h5>
                        <p class="text-muted mb-3">Let our experts create a personalised itinerary for you.</p>
                        <a href="{{ route('frontend.contact') }}" class="btn-brand"><i class="fa-solid fa-paper-plane me-1"></i> Get Free Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Posts --}}
    @if(isset($relatedPosts) && $relatedPosts->count())
        <section class="section-padding bg-soft">
            <div class="container">
                @include('frontend.components.section-heading', ['kicker' => 'Related Posts', 'title' => 'More from this category', 'text' => ''])
                <div class="row g-4">
                    @foreach($relatedPosts as $related)
                        <div class="col-lg-4 col-md-6">
                            @include('frontend.components.blog-card', [
                                'image' => $related->featured_image ? asset('storage/' . $related->featured_image) : asset('assets/frontend/images/blog-family-trip.svg'),
                                'title' => $related->title,
                                'date' => $related->published_at?->format('d M Y') ?? '',
                                'category' => ucfirst($related->category ?? ''),
                                'description' => $related->excerpt ?? str($related->content)->stripTags()->limit(100),
                                'url' => route('frontend.blog.show', $related->slug),
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
