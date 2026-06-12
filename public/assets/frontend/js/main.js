(function ($) {
    "use strict";

    $(function () {
        var $body = $("body");
        var $mobileMenu = $(".mobile-menu");
        var $mobileBackdrop = $(".mobile-menu-backdrop");

        function openMobileMenu() {
            $mobileMenu.addClass("is-active");
            $mobileBackdrop.addClass("is-active");
            $body.css("overflow", "hidden");
        }

        function closeMobileMenu() {
            $mobileMenu.removeClass("is-active");
            $mobileBackdrop.removeClass("is-active");
            $body.css("overflow", "");
        }

        $(".mobile-menu-toggle").on("click", openMobileMenu);
        $(".mobile-menu-close, .mobile-menu-backdrop, .mobile-nav a").on("click", closeMobileMenu);

        var $goTopButton = $(".go-top-btn");

        function toggleGoTopButton() {
            $goTopButton.toggleClass("is-visible", $(window).scrollTop() > 360);
        }

        $goTopButton.on("click", function () {
            $("html, body").animate({ scrollTop: 0 }, 550);
        });

        $(window).on("scroll", toggleGoTopButton);
        toggleGoTopButton();

        if ($.fn.select2) {
            $(".destination-select").select2({
                width: "100%",
                minimumResultsForSearch: Infinity
            });
        }

        if (window.flatpickr) {
            flatpickr(".date-picker", {
                minDate: "today",
                dateFormat: "d M Y"
            });
        }

        if (window.GLightbox) {
            GLightbox({
                selector: ".glightbox"
            });
        }

        if (window.AOS) {
            AOS.init({
                duration: 700,
                once: true,
                offset: 80
            });
        }

        if ($.fn.owlCarousel) {
            $(".destination-carousel").owlCarousel({
                loop: true,
                margin: 24,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4200,
                navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 }
                }
            });

            $(".testimonial-carousel").owlCarousel({
                loop: true,
                margin: 24,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    1200: { items: 3 }
                }
            });
        }

        var $parallaxHero = $(".parallax-hero");
        var reduceMotion = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        if ($parallaxHero.length && !reduceMotion) {
            var ticking = false;

            function updateHeroParallax() {
                var scrollTop = $(window).scrollTop();
                var offset = Math.min(90, scrollTop * 0.14);
                var floatOffset = Math.min(48, scrollTop * 0.08);

                $parallaxHero.css({
                    "--parallax-y": offset + "px",
                    "--parallax-float": floatOffset + "px"
                });
                ticking = false;
            }

            $(window).on("scroll", function () {
                if (!ticking) {
                    window.requestAnimationFrame(updateHeroParallax);
                    ticking = true;
                }
            });

            updateHeroParallax();
        }
    });
})(jQuery);
