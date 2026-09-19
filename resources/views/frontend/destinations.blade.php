@extends('frontend.layouts.app')

@section('title', 'India & International Holiday Destinations | UniWorld Holidays')
@section('meta_description', 'Explore handpicked holiday destinations across India, Asia, the Middle East and the Indian Ocean, with practical guides and custom itinerary options.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Destinations', 'subtitle' => 'Find the place that fits your season, interests and travel style'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($destinations as $destination)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.destination-card', [
                            'image' => media_url($destination->hero_image, 'assets/frontend/images/demo/destination-goa.webp'),
                            'title' => $destination->name,
                            'location' => $destination->country ?? $destination->continent,
                            'duration' => ($destination->tours_count ?? 0) . ' Packages',
                            'description' => $destination->short_description ?? 'Discover ' . $destination->name,
                            'url' => route('frontend.destination.show', $destination->slug),
                        ])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Our destination collection is being updated. Speak with a consultant for recommendations tailored to your dates.</p>
                    </div>
                @endforelse
            </div>
            @if($destinations->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $destinations->links() }}</div>
            @endif
        </div>
    </section>
@endsection
