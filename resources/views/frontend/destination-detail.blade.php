@extends('frontend.layouts.app')

@section('title', ($destination->meta_title ?? $destination->name) . ' — UniWorld Holidays')
@section('meta_description', $destination->meta_description ?? $destination->short_description ?? '')
@section('og_image_meta')
@if($destination->og_image)<meta property="og:image" content="{{ asset('storage/' . $destination->og_image) }}">@endif
@endsection

@section('content')
    <div id="reading-progress"></div>

    {{-- Hero Section --}}
    @if($destination->hero_image)
        <div class="destination-hero" style="background-image:url('{{ asset('storage/' . $destination->hero_image) }}');">
            <div class="blog-hero-overlay"></div>
            <div class="container" style="position:relative;z-index:2;padding-top:80px;padding-bottom:48px;">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:rgba(255,255,255,0.5);">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white-50 text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.destinations') }}" class="text-white-50 text-decoration-none">Destinations</a></li>
                        <li class="breadcrumb-item active text-white">{{ $destination->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold text-white mb-2">{{ $destination->name }}</h1>
                <p class="text-white-50 mb-4">{{ $destination->country ?? $destination->continent }}</p>
                {{-- Stats Bar --}}
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);">
                        <i class="fa-solid fa-map-location-dot text-white"></i>
                        <span class="text-white small fw-medium">{{ $tours->total() }} {{ Str::plural('Package', $tours->total()) }}</span>
                    </div>
                    @if($destination->continent)
                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);">
                        <i class="fa-solid fa-globe text-white"></i>
                        <span class="text-white small fw-medium">{{ $destination->continent }}</span>
                    </div>
                    @endif
                    <a href="{{ route('frontend.contact') }}?destination={{ $destination->name }}"
                       class="btn fw-semibold px-4" style="background:#fff;color:#064f68;border-radius:8px;">
                        <i class="fa-solid fa-paper-plane me-1"></i> Get Custom Quote
                    </a>
                </div>
            </div>
        </div>
    @else
        @include('frontend.components.page-banner', ['title' => $destination->name, 'subtitle' => $destination->country ?? $destination->continent])
    @endif

    <section class="section-padding">
        <div class="container">
            @if($destination->short_description)
                <p class="lead text-center mb-5" style="color:#4a5568;max-width:680px;margin-left:auto;margin-right:auto;" data-aos="fade-up">{{ $destination->short_description }}</p>
            @endif

            @if($destination->description)
                <div class="row justify-content-center mb-5" data-aos="fade-up">
                    <div class="col-lg-10">
                        <div class="destination-description-card">
                            <div class="content-body">{!! $destination->description !!}</div>
                        </div>
                    </div>
                </div>
            @endif

            @if($destination->highlights && count($destination->highlights))
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-10">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <i class="fa-solid fa-star" style="color:#f59e0b;"></i>
                            <h3 class="fw-bold mb-0" style="color:#064f68;font-size:1.2rem;letter-spacing:0.3px;">Destination Highlights</h3>
                        </div>
                        <div class="row g-3">
                            @foreach($destination->highlights as $item)
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                    <div class="destination-highlight-pill">
                                        <i class="fa-solid fa-check-circle"></i>
                                        <span>{{ $item['highlight'] ?? $item }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Tours in this destination --}}
    <section class="section-padding bg-soft">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => $destination->name . ' Packages',
                'title' => 'Tours available in ' . $destination->name,
                'text' => '',
            ])
            <div class="row g-4">
                @forelse($tours as $tour)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.package-card', [
                            'image' => $tour->hero_image ? asset('storage/' . $tour->hero_image) : asset('assets/frontend/images/destination-kashmir.svg'),
                            'title' => $tour->title,
                            'duration' => $tour->duration_nights . ' Nights / ' . $tour->duration_days . ' Days',
                            'type' => ucfirst($tour->category ?? 'Tour'),
                            'description' => $tour->subtitle ?? str($tour->overview ?? '')->stripTags()->limit(100),
                            'price' => $tour->starting_price ? 'INR ' . number_format($tour->starting_price) : 'On Request',
                            'url' => route('frontend.tour.show', $tour->slug),
                        ])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No packages available for this destination yet. <a href="{{ route('frontend.contact') }}">Contact us</a> for a custom quote.</p>
                    </div>
                @endforelse
            </div>
            @if($tours->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $tours->links() }}</div>
            @endif
        </div>
    </section>

    @include('frontend.components.cta')

@push('scripts')
<script>
(function() {
    const bar = document.getElementById('reading-progress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (docHeight > 0 ? (scrollTop / docHeight) * 100 : 0) + '%';
    }, { passive: true });
    const btn = document.querySelector('.go-top-btn');
    if (btn) {
        window.addEventListener('scroll', function() { btn.classList.toggle('is-visible', window.scrollY > 300); }, { passive: true });
        btn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }
})();
</script>
@endpush
@endsection
