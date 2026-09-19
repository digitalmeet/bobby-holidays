(function () {
    "use strict";

    document.addEventListener("DOMContentLoaded", function () {
        var body = document.body;
        var mediaPlaceholder = body.dataset.mediaPlaceholder;
        var mobileMenu = document.querySelector(".mobile-menu");
        var mobileBackdrop = document.querySelector(".mobile-menu-backdrop");
        var mobileToggles = document.querySelectorAll(".mobile-menu-toggle");
        var lastFocusedElement = null;

        // Keep broken or missing media from leaving empty cards in customer-facing flows.
        function useMediaPlaceholder(image) {
            if (!mediaPlaceholder || image.dataset.placeholderApplied === "true") return;
            image.dataset.placeholderApplied = "true";
            image.src = mediaPlaceholder;
        }

        document.querySelectorAll("img").forEach(function (image) {
            image.addEventListener("error", function () { useMediaPlaceholder(image); });
            if (image.complete && image.naturalWidth === 0) useMediaPlaceholder(image);
        });

        function mobileFocusableElements() {
            return mobileMenu ? Array.from(mobileMenu.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])')) : [];
        }

        function openMobileMenu(event) {
            lastFocusedElement = event.currentTarget || document.activeElement;
            mobileMenu && mobileMenu.classList.add("is-active");
            if (mobileMenu) {
                mobileMenu.removeAttribute("inert");
                mobileMenu.setAttribute("aria-hidden", "false");
            }
            mobileBackdrop && mobileBackdrop.classList.add("is-active");
            mobileToggles.forEach(function (toggle) { toggle.setAttribute("aria-expanded", "true"); });
            body.style.overflow = "hidden";
            mobileFocusableElements()[0]?.focus();
        }

        function closeMobileMenu() {
            mobileMenu && mobileMenu.classList.remove("is-active");
            if (mobileMenu) {
                mobileMenu.setAttribute("inert", "");
                mobileMenu.setAttribute("aria-hidden", "true");
            }
            mobileBackdrop && mobileBackdrop.classList.remove("is-active");
            mobileToggles.forEach(function (toggle) { toggle.setAttribute("aria-expanded", "false"); });
            body.style.overflow = "";
            lastFocusedElement?.focus();
        }

        mobileToggles.forEach(function (el) {
            el.addEventListener("click", openMobileMenu);
        });
        document.querySelectorAll(".mobile-menu-close, .mobile-menu-backdrop, .mobile-nav a").forEach(function (el) {
            el.addEventListener("click", closeMobileMenu);
        });
        document.addEventListener("keydown", function (event) {
            if (!mobileMenu?.classList.contains("is-active")) return;
            if (event.key === "Escape") {
                event.preventDefault();
                closeMobileMenu();
                return;
            }
            if (event.key !== "Tab") return;
            var focusable = mobileFocusableElements();
            if (!focusable.length) return;
            var first = focusable[0];
            var last = focusable[focusable.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        });

        // Go to top button
        var goTopBtn = document.querySelector(".go-top-btn");
        if (goTopBtn) {
            window.addEventListener("scroll", function () {
                goTopBtn.classList.toggle("is-visible", window.scrollY > 360);
            }, { passive: true });
            goTopBtn.addEventListener("click", function () {
                window.scrollTo({ top: 0, behavior: window.matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth" });
            });
        }

        // Flatpickr init
        if (window.flatpickr) {
            document.querySelectorAll(".date-picker").forEach(function (el) {
                flatpickr(el, { minDate: "today", dateFormat: "d M Y" });
            });
        }

        // GLightbox init
        if (window.GLightbox) {
            GLightbox({ selector: ".glightbox" });
        }

        // Swiper carousels
        if (window.Swiper) {
            var prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            var heroEl = document.querySelector(".hero-carousel");
            if (heroEl) {
                var heroSlideCount = heroEl.querySelectorAll(".swiper-slide").length;
                new Swiper(heroEl, {
                    loop: heroSlideCount > 1,
                    effect: "fade",
                    speed: 700,
                    allowTouchMove: false,
                    autoplay: prefersReducedMotion || heroSlideCount < 2 ? false : { delay: 6000, disableOnInteraction: false },
                });
            }
            var destEl = document.querySelector(".destination-carousel");
            if (destEl) {
                var destinationSlideCount = destEl.querySelectorAll(".swiper-slide").length;
                new Swiper(destEl, {
                    loop: destinationSlideCount > 4,
                    slidesPerView: 1,
                    spaceBetween: 24,
                    autoplay: prefersReducedMotion ? false : { delay: 4200, disableOnInteraction: false, pauseOnMouseEnter: true },
                    navigation: { nextEl: ".dest-swiper-next", prevEl: ".dest-swiper-prev" },
                    breakpoints: {
                        576: { slidesPerView: 2 },
                        992: { slidesPerView: 3 },
                        1200: { slidesPerView: 4 }
                    }
                });
            }

            var testEl = document.querySelector(".testimonial-carousel");
            if (testEl) {
                var testimonialSlideCount = testEl.querySelectorAll(".swiper-slide").length;
                new Swiper(testEl, {
                    loop: testimonialSlideCount > 3,
                    slidesPerView: 1,
                    spaceBetween: 24,
                    autoplay: prefersReducedMotion ? false : { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
                    pagination: { el: ".testimonial-pagination", clickable: true },
                    breakpoints: {
                        768: { slidesPerView: 2 },
                        1200: { slidesPerView: 3 }
                    }
                });
            }
        }

        // IntersectionObserver for scroll animations (replaces AOS)
        var animEls = document.querySelectorAll("[data-animate]");
        if (animEls.length && "IntersectionObserver" in window) {
            var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            if (!reduceMotion) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) {
                            var delay = e.target.getAttribute("data-animate-delay");
                            if (delay) {
                                setTimeout(function () { e.target.classList.add("is-visible"); }, parseInt(delay));
                            } else {
                                e.target.classList.add("is-visible");
                            }
                            observer.unobserve(e.target);
                        }
                    });
                }, { threshold: 0.1 });
                animEls.forEach(function (el) { observer.observe(el); });
            } else {
                animEls.forEach(function (el) { el.classList.add("is-visible"); });
            }
        }

        // Parallax hero
        var parallaxHero = document.querySelector(".parallax-hero");
        var reduceMotion = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        if (parallaxHero && !reduceMotion) {
            var ticking = false;
            function updateHeroParallax() {
                var scrollTop = window.scrollY;
                var offset = Math.min(90, scrollTop * 0.14);
                var floatOffset = Math.min(48, scrollTop * 0.08);
                parallaxHero.style.setProperty("--parallax-y", offset + "px");
                parallaxHero.style.setProperty("--parallax-float", floatOffset + "px");
                ticking = false;
            }
            window.addEventListener("scroll", function () {
                if (!ticking) {
                    window.requestAnimationFrame(updateHeroParallax);
                    ticking = true;
                }
            }, { passive: true });
            updateHeroParallax();
        }
    });
})();
