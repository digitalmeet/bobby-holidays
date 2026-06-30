@extends('frontend.layouts.app')

@section('title', ($destination->meta_title ?? $destination->name) . ' — UniWorld Holidays')
@section('meta_description', $destination->meta_description ?? $destination->short_description ?? '')
@section('og_image_meta')
@if($destination->og_image)<meta property="og:image" content="{{ asset('storage/' . $destination->og_image) }}">@endif
@endsection

@section('content')
    @include('frontend.components.page-banner', ['title' => $destination->name, 'subtitle' => $destination->country ?? $destination->continent])

    <section class="section-padding">
        <div class="container">
            @if($destination->short_description)
                <p class="lead text-muted text-center mb-5" data-aos="fade-up">{{ $destination->short_description }}</p>
            @endif

            @if($destination->description)
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-10">
                        <div class="content-body">{!! $destination->description !!}</div>
                    </div>
                </div>
            @endif

            @if($destination->highlights && count($destination->highlights))
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-10">
                        <h3 class="mb-3"><i class="fa-solid fa-star text-warning me-2"></i>Highlights</h3>
                        <div class="row g-3">
                            @foreach($destination->highlights as $item)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-success mt-1"></i>
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
@endsection
