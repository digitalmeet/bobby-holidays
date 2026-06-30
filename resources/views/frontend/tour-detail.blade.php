@extends('frontend.layouts.app')

@section('title', ($tour->meta_title ?? $tour->title) . ' — UniWorld Holidays')
@section('meta_description', $tour->meta_description ?? $tour->subtitle ?? '')
@section('og_image_meta')
@if($tour->og_image)<meta property="og:image" content="{{ asset('storage/' . $tour->og_image) }}">@endif
@endsection

@section('content')
    {{-- Breadcrumb --}}
    @include('frontend.components.page-banner', ['title' => $tour->title, 'subtitle' => $tour->destination?->name ?? 'Packages'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                {{-- Main Content --}}
                <div class="col-lg-8">
                {{-- Page Title --}}
                    <div class="mb-4">
                        <h1 class="h2 fw-bold mb-1" style="color:#064f68;">{{ $tour->title }}</h1>
                        @if($tour->subtitle)
                            <p class="text-muted mb-0">{{ $tour->subtitle }}</p>
                        @endif
                    </div>

                    {{-- Quick Info Badges --}}
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3 text-center">
                                <div class="col-6 col-md-3">
                                    <div class="p-2">
                                        <i class="fa-solid fa-calendar-days fa-lg mb-2" style="color:#064f68;"></i>
                                        <p class="mb-0 fw-bold">{{ $tour->duration_nights }}N / {{ $tour->duration_days }}D</p>
                                        <small class="text-muted">Duration</small>
                                    </div>
                                </div>
                                @if($tour->destination)
                                <div class="col-6 col-md-3">
                                    <div class="p-2">
                                        <i class="fa-solid fa-map-location-dot fa-lg mb-2" style="color:#064f68;"></i>
                                        <p class="mb-0 fw-bold">{{ $tour->destination->name }}</p>
                                        <small class="text-muted">Destination</small>
                                    </div>
                                </div>
                                @endif
                                @if($tour->category)
                                <div class="col-6 col-md-3">
                                    <div class="p-2">
                                        <i class="fa-solid fa-tag fa-lg mb-2" style="color:#064f68;"></i>
                                        <p class="mb-0 fw-bold">{{ ucfirst($tour->category) }}</p>
                                        <small class="text-muted">Category</small>
                                    </div>
                                </div>
                                @endif
                                <div class="col-6 col-md-3">
                                    <div class="p-2">
                                        <i class="fa-solid fa-users fa-lg mb-2" style="color:#064f68;"></i>
                                        <p class="mb-0 fw-bold">{{ $tour->min_group_size }}{{ $tour->max_group_size ? '–' . $tour->max_group_size : '+' }}</p>
                                        <small class="text-muted">Group Size</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Overview --}}
                    @if($tour->overview)
                        <div class="card border-0 shadow-sm rounded-3 mb-4">
                            <div class="card-body p-4 p-lg-5">
                                <h3 class="fw-bold mb-3" style="color:#064f68;">Package Overview</h3>
                                <div class="content-body">{!! $tour->overview !!}</div>
                            </div>
                        </div>
                    @endif

                    {{-- Highlights --}}
                    @if($tour->highlights && count($tour->highlights))
                        <div class="card border-0 shadow-sm rounded-3 mb-4">
                            <div class="card-body p-4 p-lg-5">
                                <h3 class="fw-bold mb-4" style="color:#064f68;">
                                    <i class="fa-solid fa-star me-2" style="color:#f59e0b;"></i>Tour Highlights
                                </h3>
                                <div class="row g-3">
                                    @foreach($tour->highlights as $item)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-start gap-2">
                                                <i class="fa-solid fa-check-circle mt-1" style="color:#064f68;"></i>
                                                <span>{{ $item['text'] ?? $item }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Itinerary --}}
                    @if($tour->itinerary && count($tour->itinerary))
                        <div class="card border-0 shadow-sm rounded-3 mb-4">
                            <div class="card-body p-4 p-lg-5">
                                <h3 class="fw-bold mb-4" style="color:#064f68;">
                                    <i class="fa-solid fa-route me-2"></i>Day-wise Itinerary
                                </h3>
                                <div class="itinerary-timeline">
                                    @foreach($tour->itinerary as $day)
                                        <div class="d-flex gap-3 mb-0 {{ !$loop->last ? 'pb-4' : '' }}" style="{{ !$loop->last ? 'border-left:2px solid #064f68;margin-left:14px;padding-left:24px;' : 'margin-left:14px;padding-left:24px;border-left:2px solid transparent;' }}">
                                            <div class="flex-shrink-0" style="margin-left:-38px;">
                                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold" style="width:30px;height:30px;background:#064f68;font-size:12px;">
                                                    {{ $day['day'] ?? $loop->iteration }}
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1" style="color:#064f68;">{{ $day['title'] ?? 'Day ' . ($day['day'] ?? $loop->iteration) }}</h6>
                                                @if(!empty($day['description']))
                                                    <p class="text-muted mb-2 small">{{ $day['description'] }}</p>
                                                @endif
                                                @if(!empty($day['meals']) || !empty($day['accommodation']))
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @if(!empty($day['meals']))
                                                            <span class="badge rounded-pill" style="background:rgba(6,79,104,0.08);color:#064f68;"><i class="fa-solid fa-utensils me-1"></i>{{ $day['meals'] }}</span>
                                                        @endif
                                                        @if(!empty($day['accommodation']))
                                                            <span class="badge rounded-pill" style="background:rgba(6,79,104,0.08);color:#064f68;"><i class="fa-solid fa-bed me-1"></i>{{ $day['accommodation'] }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Inclusions & Exclusions side by side --}}
                    @if(($tour->inclusions && count($tour->inclusions)) || ($tour->exclusions && count($tour->exclusions)))
                        <div class="row g-4 mb-4">
                            @if($tour->inclusions && count($tour->inclusions))
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-3 h-100">
                                        <div class="card-body p-4">
                                            <h5 class="fw-bold mb-3 text-success"><i class="fa-solid fa-circle-check me-2"></i>Inclusions</h5>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($tour->inclusions as $item)
                                                    <li class="d-flex align-items-start gap-2 mb-2">
                                                        <i class="fa-solid fa-check text-success mt-1 small"></i>
                                                        <span class="small">{{ $item['text'] ?? $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($tour->exclusions && count($tour->exclusions))
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-3 h-100">
                                        <div class="card-body p-4">
                                            <h5 class="fw-bold mb-3 text-danger"><i class="fa-solid fa-circle-xmark me-2"></i>Exclusions</h5>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($tour->exclusions as $item)
                                                    <li class="d-flex align-items-start gap-2 mb-2">
                                                        <i class="fa-solid fa-xmark text-danger mt-1 small"></i>
                                                        <span class="small">{{ $item['text'] ?? $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        {{-- Price Card --}}
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                            <div class="card-header border-0 text-center py-3" style="background:linear-gradient(135deg, #064f68, #0a7a9e);">
                                @if($tour->starting_price)
                                    <p class="text-white-50 mb-0 small">Starting from</p>
                                    <h2 class="text-white mb-0">₹{{ number_format($tour->starting_price) }}</h2>
                                    <p class="text-white-50 mb-0 small">{{ $tour->price_type === 'per_person' ? 'per person' : str_replace('_', ' ', $tour->price_type) }}</p>
                                @else
                                    <h4 class="text-white mb-0">Price on Request</h4>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <a href="{{ route('frontend.contact') }}?tour={{ $tour->slug }}&destination={{ $tour->destination?->name }}" class="btn d-block mb-2 fw-semibold text-white" style="background:#064f68;">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Get a Quote
                                </a>
                                <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}?text={{ urlencode('Hi, I am interested in "' . $tour->title . '" package. Please share details.') }}" target="_blank" class="btn btn-outline-success d-block fw-semibold">
                                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp Us
                                </a>
                                <div class="text-center mt-3">
                                    <a href="tel:{{ setting('company_phone', '+91 98765 43210') }}" class="text-muted small">
                                        <i class="fa-solid fa-phone me-1"></i> Or call {{ setting('company_phone', '+91 98765 43210') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Pricing Tiers --}}
                        @if($tour->pricing && $tour->pricing->count())
                            <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
                                <div class="card-header border-0 py-3 px-4" style="background:#064f68;">
                                    <h6 class="mb-0 text-white fw-semibold"><i class="fa-solid fa-tags me-2"></i>Pricing Options</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-sm mb-0">
                                        <tbody>
                                            @foreach($tour->pricing as $price)
                                                <tr>
                                                    <td class="px-4 py-3">
                                                        <span class="fw-medium">{{ $price->label }}</span>
                                                        @if($price->child_price)
                                                            <br><small class="text-muted">Child: ₹{{ number_format($price->child_price) }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 text-end">
                                                        <span class="fw-bold" style="color:#064f68;">₹{{ number_format($price->price_per_person) }}</span>
                                                        <br><small class="text-muted">per person</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        {{-- Quick Facts --}}
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3" style="color:#064f68;">Quick Facts</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded" style="width:32px;height:32px;background:rgba(6,79,104,0.08);"><i class="fa-solid fa-clock small" style="color:#064f68;"></i></span>
                                        <div><small class="text-muted d-block">Duration</small><span class="fw-medium small">{{ $tour->duration_nights }} Nights / {{ $tour->duration_days }} Days</span></div>
                                    </li>
                                    @if($tour->destination)
                                    <li class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded" style="width:32px;height:32px;background:rgba(6,79,104,0.08);"><i class="fa-solid fa-location-dot small" style="color:#064f68;"></i></span>
                                        <div><small class="text-muted d-block">Location</small><span class="fw-medium small">{{ $tour->destination->name }}, {{ $tour->destination->country }}</span></div>
                                    </li>
                                    @endif
                                    @if($tour->min_group_size)
                                    <li class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded" style="width:32px;height:32px;background:rgba(6,79,104,0.08);"><i class="fa-solid fa-users small" style="color:#064f68;"></i></span>
                                        <div><small class="text-muted d-block">Group Size</small><span class="fw-medium small">{{ $tour->min_group_size }}{{ $tour->max_group_size ? ' – ' . $tour->max_group_size : '+' }} persons</span></div>
                                    </li>
                                    @endif
                                    @if($tour->difficulty_level)
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded" style="width:32px;height:32px;background:rgba(6,79,104,0.08);"><i class="fa-solid fa-mountain small" style="color:#064f68;"></i></span>
                                        <div><small class="text-muted d-block">Difficulty</small><span class="fw-medium small">{{ ucfirst($tour->difficulty_level) }}</span></div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Tours --}}
    @if($relatedTours->count())
        <section class="section-padding bg-soft">
            <div class="container">
                @include('frontend.components.section-heading', ['kicker' => 'Similar Packages', 'title' => 'You may also like', 'text' => ''])
                <div class="row g-4">
                    @foreach($relatedTours as $related)
                        <div class="col-lg-3 col-md-6">
                            @include('frontend.components.package-card', [
                                'image' => $related->hero_image ? asset('storage/' . $related->hero_image) : asset('assets/frontend/images/destination-kashmir.svg'),
                                'title' => $related->title,
                                'duration' => $related->duration_nights . 'N / ' . $related->duration_days . 'D',
                                'type' => ucfirst($related->category ?? 'Tour'),
                                'description' => $related->subtitle ?? '',
                                'price' => $related->starting_price ? '₹' . number_format($related->starting_price) : 'On Request',
                                'url' => route('frontend.tour.show', $related->slug),
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
