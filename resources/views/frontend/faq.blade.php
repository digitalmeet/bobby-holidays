@extends('frontend.layouts.app')

@section('title', 'FAQ - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'FAQ'])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    @include('frontend.components.section-heading', [
                        'kicker' => 'Questions',
                        'title' => 'Before you book with UniWorld',
                        'text' => 'Answers are static placeholders for now and can later become CMS-managed FAQ entries.',
                    ])
                    <div class="accordion" id="faqAccordion">
                        @foreach ([
                            ['How do I request a custom package?', 'Use the enquiry form or WhatsApp button with your destination, dates, traveller count, and budget. Our team will prepare options.'],
                            ['Can packages be changed?', 'Yes. Hotels, nights, sightseeing, transfers, meal plans, and activities can be adjusted based on availability and budget.'],
                            ['Do you help with visas?', 'Yes. We provide document checklists, application guidance, appointment support, and status follow-up for eligible destinations.'],
                            ['Are prices final?', 'Displayed prices are static placeholders. Final quotes depend on season, flight fare, hotel availability, traveller count, and inclusions.'],
                            ['Do you support groups and corporate travel?', 'Yes. Group tours, incentive travel, meetings, and business trips can be planned with dedicated coordination.'],
                        ] as $index => $faq)
                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $index }}">
                                        {{ $faq[0] }}
                                    </button>
                                </h2>
                                <div id="faqCollapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="faqHeading{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-muted">{{ $faq[1] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
