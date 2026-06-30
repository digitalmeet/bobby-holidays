<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('title', setting('seo_title', 'UniWorld Holidays - Premium Travel Agency')); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', setting('seo_description', 'Plan memorable domestic and international holidays with UniWorld Holidays.')); ?>">
    <?php echo $__env->yieldContent('meta_keywords_tag'); ?>
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', setting('seo_title', 'UniWorld Holidays')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', setting('seo_description', '')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(setting('company_name', 'UniWorld Holidays')); ?>">
    <?php echo $__env->yieldContent('og_image_meta'); ?>

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', setting('seo_title', 'UniWorld Holidays')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description', ''); ?>">

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/frontend/images/uniworld-logo-cropped.png')); ?>">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/frontend/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>" rel="stylesheet">

    
    <style>
        .breadcrumb-strip{background:#f8f9fa;border-bottom:1px solid #e9ecef;padding:10px 0;}
        .breadcrumb-strip .breadcrumb{font-size:13px;}
        .breadcrumb-strip .breadcrumb-item a{color:#064f68;text-decoration:none;}
        .breadcrumb-strip .breadcrumb-item.active{color:#6c757d;}
    </style>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" media="print" onload="this.media='all'">

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('google_analytics_id')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(setting('google_analytics_id')); ?>"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo e(setting('google_analytics_id')); ?>');</script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <script type="application/ld+json">
    {
        "<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>": "https://schema.org",
        "@type": "TravelAgency",
        "name": "<?php echo e(setting('company_name', 'UniWorld Holidays')); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "telephone": "<?php echo e(setting('company_phone', '')); ?>",
        "email": "<?php echo e(setting('company_email', '')); ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?php echo e(setting('company_city', 'Ahmedabad')); ?>",
            "addressCountry": "IN"
        }
    }
    </script>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>
    <div class="site-wrapper">
        <?php echo $__env->make('frontend.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('frontend.partials.mobile-menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('frontend.partials.sticky-enquiry', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <button class="go-top-btn" type="button" aria-label="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <a class="floating-quote-btn" href="<?php echo e(route('frontend.contact')); ?>" aria-label="Get a travel quote">
        <i class="fa-solid fa-headset"></i>
        <span>Get Quote</span>
    </a>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>

    
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/instantclick@3.1.0/instantclick.min.js" data-no-instant></script>
    <script data-no-instant>InstantClick.init();</script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
