<article class="package-card" style="position:relative;overflow:hidden;">
    {{-- Featured Ribbon --}}
    @if(!empty($featured) && $featured)
        <div style="position:absolute;top:14px;right:-22px;z-index:3;background:#f59e0b;color:#fff;font-size:11px;font-weight:700;padding:3px 32px;transform:rotate(45deg);letter-spacing:0.5px;box-shadow:0 2px 6px rgba(0,0,0,0.15);">FEATURED</div>
    @endif

    {{-- Image with location badge --}}
    <div style="position:relative;overflow:hidden;">
        <img src="{{ str_starts_with($image, 'http') || str_starts_with($image, '/storage') ? $image : asset($image) }}"
             alt="{{ $title }}" loading="lazy" decoding="async" width="400" height="300"
             style="transition:transform 0.4s ease;width:100%;display:block;">
        @if(!empty($location))
            <div style="position:absolute;bottom:10px;left:10px;background:rgba(0,0,0,0.55);backdrop-filter:blur(3px);color:#fff;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;display:flex;align-items:center;gap:5px;">
                <i class="fa-solid fa-location-dot" style="font-size:10px;"></i> {{ $location }}
            </div>
        @endif
    </div>

    <div class="card-body-pad">
        <div class="package-meta">
            <span><i class="fa-solid fa-calendar-days"></i> {{ $duration }}</span>
            <span><i class="fa-solid fa-user-group"></i> {{ $type }}</span>
        </div>

        <h3 class="h5 fw-bold mb-2">{{ $title }}</h3>

        @if(!empty($rating) && $rating > 0)
            <div class="mb-2" style="color:#f59e0b;font-size:13px;">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= $rating ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
            </div>
        @endif

        <p class="text-muted mb-3">{{ $description }}</p>

        <div class="d-flex align-items-center justify-content-between gap-3">
            <div>
                <div style="font-size:11px;color:#6c757d;line-height:1;">Starting from</div>
                <span class="package-price fw-bold" style="color:#064f68;font-size:18px;">{{ $price }}</span>
            </div>
            <a class="btn-brand" href="{{ $url ?? route('frontend.contact') }}">Details</a>
        </div>
    </div>
</article>

@push('styles')
<style>
    .package-card:hover img { transform: scale(1.06); }
</style>
@endpush
