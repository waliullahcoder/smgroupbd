$(document).ready(function () {
    "use strict";

    $(".carousel").not(".owl-loaded").each(function () {
        var $this = $(this);

        var slidesPerViewXs = $this.data("xs-items");
        var slidesPerViewSm = $this.data("sm-items");
        var slidesPerViewMd = $this.data("md-items");
        var slidesPerViewLg = $this.data("lg-items");
        var slidesPerViewXl = $this.data("xl-items");
        var slidesPerView = $this.data("items");

        var nav = $this.data("arrows");
        var dots = $this.data("dots");
        var dotsEach = $this.data("dot-each");
        var pauseOnHover = $this.data("hover-pause");
        var autoplay = $this.data("autoplay");
        var loop = $this.data("loop");
        var margin = $this.data("margin");
        var marginMd = $this.data("md-margin");
        var center = $this.data("center");
        var animateOut = $this.data("animateOut");

        var autoplayTimeout = $this.data("timeout");
        autoplayTimeout = !autoplayTimeout ? 3000 : autoplayTimeout;

        var smartSpeed = $this.data("smart-speed");
        smartSpeed = !smartSpeed ? 250 : smartSpeed;

        var slidescroll = $this.data("slidescroll");
        slidescroll = !slidescroll ? 1 : slidescroll;

        slidesPerView = !slidesPerView ? 1 : slidesPerView;
        slidesPerViewXl = !slidesPerViewXl ? slidesPerView : slidesPerViewXl;
        slidesPerViewLg = !slidesPerViewLg ? slidesPerViewXl : slidesPerViewLg;
        slidesPerViewMd = !slidesPerViewMd ? slidesPerViewLg : slidesPerViewMd;
        slidesPerViewSm = !slidesPerViewSm ? slidesPerViewMd : slidesPerViewSm;
        slidesPerViewXs = !slidesPerViewXs ? slidesPerViewSm : slidesPerViewXs;

        nav = !nav ? false : nav;
        dots = !dots ? false : dots;
        dotsEach = !dotsEach ? false : dotsEach;
        pauseOnHover = !pauseOnHover ? false : pauseOnHover;
        autoplay = !autoplay ? false : autoplay;
        loop = !loop ? false : loop;
        center = !center ? false : center;
        animateOut = !animateOut ? 'fadeOut' : animateOut;

        $this.owlCarousel({
            loop: loop,
            margin: margin,
            center: center,
            autoplay: autoplay,
            dots: dots,
            dotsEach: dotsEach,
            responsiveClass: true,
            autoplayTimeout: autoplayTimeout,
            autoplayHoverPause: pauseOnHover,
            smartSpeed: smartSpeed,
            nav: nav,
            animateOut: animateOut,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: slidesPerViewXs,
                },
                576: {
                    items: slidesPerViewSm,
                    margin: marginMd,
                },
                768: {
                    items: slidesPerViewMd,
                    margin: marginMd,
                },
                992: {
                    items: slidesPerViewLg,
                    margin: marginMd,
                },
                1200: {
                    items: slidesPerViewXl,
                    margin: marginMd,
                },
                1400: {
                    items: slidesPerView,
                }
            }
        });
    });

    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $(".header-bottom").removeClass("sticky");
            $(".header-middle").removeClass("sticky");
            $(".scrollTop").removeClass("show");
        } else {
            $(".header-bottom").addClass("sticky");
            $(".header-middle").addClass("sticky");
            $(".scrollTop").addClass("show");
        }
    });

    $(".scrollTop").click(function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });

    $(document).on('click', '.cart-toggler', function (e) {
        e.preventDefault();
        if ($('#st-minicart').hasClass('shown')) {
            $('#st-minicart').removeClass('shown');
            $('.overlay2').removeClass('show');
        } else {
            $('#st-minicart').addClass('shown');
            $('.overlay2').addClass('show');
        }
    });

    $(document).on('click', '.menu-title', function (e) {
        e.preventDefault();
        $('.menu-container').toggleClass('show');
        if ($('.menu-container').hasClass('show')) {
            $('.overlay').addClass('show');
        } else {
            $('.overlay').removeClass('show');
        }
    });

    $(document).on('click', '.mobile-toggle', function (event) {
        event.preventDefault();
        $(this).closest('.tab-links-title').find('.nav-pills').toggle();
    });

    $(document).on('click', '.menu-toggler', function (event) {
        event.preventDefault();
        $('.mobile-menu').toggleClass('show');
        if ($('.mobile-menu').hasClass('show')) {
            $('.overlay3').addClass('show');
        } else {
            $('.overlay3').removeClass('show');
        }
    });

    $(document).on('click', '.dropdown-toggle', function (event) {
        event.preventDefault();
        $(this).toggleClass('dropup');
        $(this).closest('.mobile-menu__item').find('>.mobile-groupmenu__drop').slideToggle();
        $(this).closest('.st-menu__item').find('>.st-megamenu,>.st-submenu').slideToggle();
    });

    $(document).on('click', '.more-view', function (event) {
        event.preventDefault();
        $(this).toggleClass('shown');
        $(this).parent().find('~li').toggle();
    });

    $(document).on('click', '.search-toggler', function (event) {
        event.preventDefault();
        $('.search-container').toggleClass('shown');
        if ($('.search-container').hasClass('shown')) {
            $('.overlay4').addClass('show');
        } else {
            $('.overlay4').removeClass('show');
        }
    });

    function checkWidth() {
        $(document).on('click', function (event) {
            var $targetElement = $('#st-minicart');
            if (!event.target.closest('.cart-toggler') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                $targetElement.removeClass('shown');
                $('.overlay2').removeClass('show');
            }

            var $targetElement = $('.search-container');
            if (!event.target.closest('.search-toggler') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                $targetElement.removeClass('shown');
                $('.overlay4').removeClass('show');
            }

            var $targetElement = $('.menu-container');
            if (!event.target.closest('.menu-title') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                $('.menu-container').removeClass('show');
                $('.overlay').removeClass('show');

                if (!$(this).hasClass('dropup')) {
                    setTimeout(function () {
                        $('.st-megamenu,.st-submenu').slideUp();
                        $('.dropdown-toggle').removeClass('dropup');
                    }, 1000);
                }
            }

            var $targetElement = $('.mobile-menu');
            if (!event.target.closest('.menu-toggler') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                $('.mobile-menu').removeClass('show');
                $('.overlay3').removeClass('show');

                setTimeout(function () {
                    $('.mobile-groupmenu__drop').slideUp();
                }, 1000);
            }

            if ($(window).width() < 575) {
                var $targetElement = $('.tab-links-title .nav-pills');
                if (!event.target.closest('.mobile-toggle') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                    $('.tab-links-title .nav-pills').hide();
                }
            }

            var $targetElement = $('.sidebar-area');
            if (!event.target.closest('#btn-filter') && !$targetElement.is(event.target) && $targetElement.has(event.target).length === 0) {
                $targetElement.removeClass('show');
                $('.filter-overlay').removeClass('show');
            }
        });
    }

    checkWidth();

    $(window).resize(function () {
        checkWidth();
    });
});
