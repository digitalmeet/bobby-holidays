<article class="package-card">
    <img src="{{ asset($image) }}" alt="{{ $title }}">
    <div class="card-body-pad">
        <div class="package-meta">
            <span><i class="fa-solid fa-calendar-days"></i> {{ $duration }}</span>
            <span><i class="fa-solid fa-user-group"></i> {{ $type }}</span>
        </div>
        <h3 class="h5 fw-bold mb-2">{{ $title }}</h3>
        <p class="text-muted mb-3">{{ $description }}</p>
        <div class="d-flex align-items-center justify-content-between gap-3">
            <span class="package-price">{{ $price }}</span>
            <a class="btn-brand" href="{{ $url ?? route('frontend.package.show') }}">Details</a>
        </div>
    </div>
</article>
