@extends('frontend.layouts.app')

@section('title', 'FAQ - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Frequently Asked Questions', 'subtitle' => 'Find answers to common travel queries'])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    @forelse($faqs as $category => $items)
                        <div class="mb-5">
                            <h3 class="h5 fw-bold text-primary mb-3 text-capitalize">{{ str_replace('_', ' ', $category) }}</h3>
                            <div class="accordion" id="faq-{{ Str::slug($category) }}">
                                @foreach($items as $index => $faq)
                                    <div class="accordion-item border mb-2 rounded overflow-hidden">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faq-{{ Str::slug($category) }}">
                                            <div class="accordion-body content-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <p class="text-muted">No FAQs available yet. Have a question? <a href="{{ route('frontend.contact') }}">Contact us</a>.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
