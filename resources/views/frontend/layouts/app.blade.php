<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta --}}
    <title>@yield('title', setting('seo_title', 'Tailor-Made India & International Holidays | UniWorld Holidays'))</title>
    <meta name="description" content="@yield('meta_description', setting('seo_description', 'Plan personalised holidays with considered itineraries, clear proposals and dependable travel support from UniWorld Holidays.'))">
    @yield('meta_keywords_tag')
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', setting('seo_title', 'UniWorld Holidays'))">
    <meta property="og:description" content="@yield('meta_description', setting('seo_description', ''))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ setting('company_name', 'UniWorld Holidays') }}">
    @yield('og_image_meta')

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('seo_title', 'UniWorld Holidays'))">
    <meta name="twitter:description" content="@yield('meta_description', '')">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ media_url(setting('site_logo'), 'assets/frontend/images/uniworld-logo-cropped.png') }}">

    {{-- Critical CSS: Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://wa.me">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/solid.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">

    {{-- Inline critical styles --}}
    <style>
        .breadcrumb-strip{background:#f8f9fa;border-bottom:1px solid #e9ecef;padding:10px 0;}
        .breadcrumb-strip .breadcrumb{font-size:13px;}
        .breadcrumb-strip .breadcrumb-item a{color:#064f68;text-decoration:none;}
        .breadcrumb-strip .breadcrumb-item.active{color:#6c757d;}
        [data-animate]{opacity:0;transform:translateY(20px);transition:opacity .6s ease,transform .6s ease;}
        [data-animate="fade-left"]{transform:translateX(20px);}
        [data-animate="fade-right"]{transform:translateX(-20px);}
        [data-animate].is-visible{opacity:1;transform:none;}
        @media (prefers-reduced-motion:reduce){html{scroll-behavior:auto!important;}*,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important;scroll-behavior:auto!important;}[data-animate]{opacity:1;transform:none;}}
    </style>

    {{-- Deferred non-critical CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" media="print" onload="this.media='all'">

    {{-- Google Analytics (if configured) --}}
    @if(setting('google_analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics_id') }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ setting('google_analytics_id') }}');</script>
    @endif

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "TravelAgency",
        "name": "{{ setting('company_name', 'UniWorld Holidays') }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ setting('company_phone', '') }}",
        "email": "{{ setting('company_email', '') }}",
        "address": {
            "@@type": "PostalAddress",
            "addressLocality": "{{ setting('company_city', 'Ahmedabad') }}",
            "addressCountry": "IN"
        }
    }
    </script>

    @stack('styles')
    @stack('head')
</head>
<body data-media-placeholder="{{ asset('assets/frontend/images/image-placeholder.svg') }}">
    <div class="site-wrapper">
        @include('frontend.partials.header')
        @include('frontend.partials.mobile-menu')
        @include('frontend.partials.sticky-enquiry')

        <main>
            @yield('content')
        </main>

        @include('frontend.partials.footer')
    </div>

    <button class="go-top-btn" type="button" aria-label="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <a class="floating-quote-btn" href="{{ route('frontend.contact') }}" aria-label="Get a travel quote">
        <i class="fa-solid fa-headset"></i>
        <span>Request Proposal</span>
    </a>

    {{-- Core JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}" defer></script>

    {{-- Deferred JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    @stack('scripts')
</body>
</html>
