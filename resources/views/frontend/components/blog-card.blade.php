<article class="blog-card">
    <img src="{{ asset($image) }}" alt="{{ $title }}">
    <div class="card-body-pad">
        <div class="blog-meta">
            <span><i class="fa-solid fa-calendar"></i> {{ $date }}</span>
            <span><i class="fa-solid fa-tag"></i> {{ $category }}</span>
        </div>
        <h3 class="h5 fw-bold mb-2">{{ $title }}</h3>
        <p class="text-muted mb-3">{{ $description }}</p>
        <a class="btn-outline-brand" href="{{ $url ?? route('frontend.blog') }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</article>
