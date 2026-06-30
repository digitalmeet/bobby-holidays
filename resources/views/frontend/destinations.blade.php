@extends('frontend.layouts.app')

@section('title', 'Destinations — UniWorld Holidays')
@section('meta_description', 'Explore our curated destinations across India and the world.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Destinations', 'subtitle' => 'Explore where we take you'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-4">
                @forelse($destinations as $destination)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.destination-card', [
                            'image' => $destination->hero_image ? asset('storage/' . $destination->hero_image) : asset('assets/frontend/images/destination-goa.svg'),
                            'title' => $destination->name,
                            'location' => $destination->country ?? $destination->continent,
                            'duration' => ($destination->tours_count ?? 0) . ' Packages',
                            'description' => $destination->short_description ?? 'Discover ' . $destination->name,
                            'url' => route('frontend.destination.show', $destination->slug),
                        ])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No destinations available yet. Check back soon!</p>
                    </div>
                @endforelse
            </div>
            @if($destinations->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $destinations->links() }}</div>
            @endif
        </div>
    </section>
@endsection
