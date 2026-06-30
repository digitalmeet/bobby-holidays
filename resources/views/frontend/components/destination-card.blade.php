<article class="destination-card">
    <a href="{{ str_starts_with($image, 'http') || str_starts_with($image, '/storage') ? $image : asset($image) }}" class="glightbox" data-gallery="destinations">
        <img src="{{ str_starts_with($image, 'http') || str_starts_with($image, '/storage') ? $image : asset($image) }}" alt="{{ $title }}">
    </a>
    <div class="card-body-pad">
        <div class="destination-meta">
            <span><i class="fa-solid fa-location-dot"></i> {{ $location }}</span>
            <span><i class="fa-solid fa-clock"></i> {{ $duration }}</span>
        </div>
        <h3 class="h5 fw-bold mb-2">{{ $title }}</h3>
        <p class="text-muted mb-3">{{ $description }}</p>
        <a class="btn-outline-brand" href="{{ $url ?? route('frontend.contact') }}">Explore <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</article>
