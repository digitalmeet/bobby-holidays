@extends('frontend.layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' — UniWorld Holidays Blog')
@section('meta_description', $post->meta_description ?? $post->excerpt ?? '')
@section('og_image_meta')
@if($post->featured_image)<meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">@endif
@endsection

@push('head')
<style>
    .blog-toc-sticky { position: sticky; top: 150px; }
</style>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $post->title }}",
    "description": "{{ str($post->excerpt ?? $post->content ?? '')->stripTags()->limit(160) }}",
    "datePublished": "{{ ($post->published_at ?? $post->created_at)->toW3cString() }}",
    "dateModified": "{{ $post->updated_at->toW3cString() }}",
    @if($post->featured_image)
    "image": "{{ asset('storage/' . $post->featured_image) }}",
    @endif
    "author": {
        "@type": "Person",
        "name": "{{ $post->author->name ?? 'UniWorld Holidays' }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "{{ setting('company_name', 'UniWorld Holidays') }}",
        "url": "{{ url('/') }}"
    }
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}"},
        {"@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ route('frontend.blog') }}"},
        {"@type": "ListItem", "position": 3, "name": "{{ $post->title }}"}
    ]
}
</script>
@endpush

@section('content')
    <div id="reading-progress"></div>

    {{-- Hero --}}
    @if($post->featured_image)
        <div class="blog-hero" style="background-image:url('{{ asset('storage/' . $post->featured_image) }}');">
            <div class="blog-hero-overlay"></div>
            <div class="blog-hero-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <nav aria-label="breadcrumb" class="mb-3">
                                <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:rgba(255,255,255,0.4);">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white-50 text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.blog') }}" class="text-white-50 text-decoration-none">Blog</a></li>
                                    <li class="breadcrumb-item active text-white">{{ Str::limit($post->title, 40) }}</li>
                                </ol>
                            </nav>
                            @if($post->category)
                                <span class="blog-category-badge">{{ ucfirst($post->category) }}</span>
                            @endif
                            <h1 class="blog-hero-title">{{ $post->title }}</h1>
                            <div class="blog-hero-meta">
                                <span><i class="fa-solid fa-calendar"></i> {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}</span>
                                @if($post->read_time_minutes)
                                    <span><i class="fa-solid fa-clock"></i> {{ $post->read_time_minutes }} min read</span>
                                @endif
                                @if($post->author)
                                    <span><i class="fa-solid fa-user"></i> {{ $post->author->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('frontend.components.page-banner', ['title' => $post->title, 'subtitle' => ucfirst($post->category ?? 'Blog')])
    @endif

    <section class="section-padding">
        <div class="container">
            <div class="row g-5 justify-content-center">

                {{-- Share sidebar (desktop) --}}
                <div class="col-lg-1 d-none d-lg-flex justify-content-end">
                    <div class="blog-share-sidebar">
                        <span class="blog-share-label">Share</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="blog-share-btn whatsapp" title="Share on WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <button class="blog-share-btn copy-link" onclick="copyBlogLink(this)" title="Copy link">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>
                </div>

                {{-- Main content --}}
                <div class="col-lg-7">

                    {{-- Author card --}}
                    <div class="blog-author-card">
                        <div class="blog-author-avatar">
                            {{ strtoupper(substr($post->author->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold" style="color:#1a3a4a;font-size:14px;">{{ $post->author->name ?? 'UniWorld Holidays' }}</div>
                            <div class="text-muted" style="font-size:13px;">
                                {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}
                                @if($post->read_time_minutes)
                                    &nbsp;·&nbsp; {{ $post->read_time_minutes }} min read
                                @endif
                            </div>
                        </div>
                        @if($post->category)
                            <span class="ms-auto blog-tag">{{ ucfirst($post->category) }}</span>
                        @endif
                    </div>

                    {{-- TOC (mobile) --}}
                    <div id="toc-mobile" class="toc-card d-lg-none mb-4" style="display:none!important;">
                        <h6><i class="fa-solid fa-list me-2"></i>In this article</h6>
                        <ul class="toc-list" id="toc-list-mobile"></ul>
                    </div>

                    {{-- Content --}}
                    <div class="content-body" id="blog-content">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags --}}
                    @if($post->tags && count($post->tags))
                        <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2 align-items-center">
                            <span class="text-muted small fw-semibold me-1"><i class="fa-solid fa-tags me-1"></i>Tags:</span>
                            @foreach($post->tags as $tag)
                                <span class="blog-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Mobile share --}}
                    <div class="d-flex gap-3 align-items-center mt-4 pt-3 border-top d-lg-none">
                        <span class="text-muted small fw-semibold">Share:</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="blog-share-btn whatsapp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <button class="blog-share-btn copy-link" onclick="copyBlogLink(this)">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>

                    {{-- CTA --}}
                    <div class="blog-cta-block">
                        <div class="mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:rgba(255,255,255,0.15);">
                                <i class="fa-solid fa-paper-plane fa-lg text-white"></i>
                            </span>
                        </div>
                        <h5 class="text-white fw-bold mb-2">Planning a trip?</h5>
                        <p class="mb-4" style="color:rgba(255,255,255,0.75);">Let our experts create a personalised itinerary just for you — free of charge.</p>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-light fw-bold px-5" style="border-radius:8px;color:#064f68;">
                            <i class="fa-solid fa-paper-plane me-2"></i> Get Free Quote
                        </a>
                    </div>
                </div>

                {{-- TOC sidebar (desktop) --}}
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="blog-toc-sticky">
                        <div class="toc-card" id="toc-desktop" style="display:none;">
                            <h6><i class="fa-solid fa-list me-2"></i>In this article</h6>
                            <ul class="toc-list" id="toc-list-desktop"></ul>
                        </div>
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

@push('scripts')
<script>
// Reading progress
(function() {
    const bar = document.getElementById('reading-progress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (docHeight > 0 ? (scrollTop / docHeight) * 100 : 0) + '%';
    }, { passive: true });
})();

// Back to top
(function() {
    const btn = document.querySelector('.go-top-btn');
    if (!btn) return;
    window.addEventListener('scroll', function() {
        btn.classList.toggle('is-visible', window.scrollY > 300);
    }, { passive: true });
    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();

// Copy link
function copyBlogLink(btn) {
    navigator.clipboard.writeText(window.location.href).then(function() {
        const icon = btn.querySelector('i');
        icon.className = 'fa-solid fa-check';
        setTimeout(function() { icon.className = 'fa-solid fa-link'; }, 2000);
    });
}

// Auto Table of Contents
(function() {
    const content = document.getElementById('blog-content');
    if (!content) return;
    const headings = content.querySelectorAll('h2, h3');
    if (headings.length < 2) return;

    const desktopList = document.getElementById('toc-list-desktop');
    const mobileList = document.getElementById('toc-list-mobile');
    const desktopCard = document.getElementById('toc-desktop');
    const mobileCard = document.getElementById('toc-mobile');

    headings.forEach(function(h, i) {
        if (!h.id) h.id = 'heading-' + i;
        const li = document.createElement('li');
        li.className = h.tagName === 'H3' ? 'toc-h3' : '';
        li.innerHTML = '<a href="#' + h.id + '">' + h.textContent + '</a>';
        if (desktopList) desktopList.appendChild(li.cloneNode(true));
        if (mobileList) mobileList.appendChild(li);
    });

    if (desktopCard) desktopCard.style.display = 'block';
    if (mobileCard) mobileCard.style.removeProperty('display');

    // Active TOC link on scroll
    const allLinks = document.querySelectorAll('.toc-list a');
    window.addEventListener('scroll', function() {
        let current = '';
        headings.forEach(function(h) {
            if (window.scrollY >= h.offsetTop - 180) current = h.id;
        });
        allLinks.forEach(function(a) {
            a.classList.toggle('active', a.getAttribute('href') === '#' + current);
        });
    }, { passive: true });
})();
</script>
@endpush
@endsection
