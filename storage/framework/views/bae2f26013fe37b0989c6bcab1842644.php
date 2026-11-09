<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($setting->title); ?></title>
    <link rel="shortcut icon"
        href="<?php echo e($admin_setting && file_exists($admin_setting->favicon) ? asset($admin_setting->favicon) : asset('backend/images/logo/favicon.png')); ?>"
        type="image/x-icon">
    <meta name="description"
        content="SM Group Bangladesh supplies, installs and services electrical power equipment for industry, utilities and commercial projects.">
    <script>
    document.documentElement.classList.add('js')
    </script>
    <link href="<?php echo e(asset('frontend/css/style.css')); ?>" rel="stylesheet" />
    <style>

    </style>
</head>

<body>

    <a class="skip" href="#main">Skip to content</a>
    <div id="progress" aria-hidden="true"></div>
    <?php echo $__env->make('layouts.frontend.partial.top_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.frontend.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main id="main">
    <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->make('layouts.frontend.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <button class="totop" id="totop" aria-label="Back to top"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 19V5M5 12l7-7 7 7"></path>
        </svg></button>
    <script>
    (function() {
        var root = document.documentElement;
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var TITLES = {
            home: 'Home',
            about: 'About us',
            products: 'Products',
            services: 'Services',
            projects: 'Projects',
            news: 'News',
            contact: 'Contact'
        };
        var pages = [].slice.call(document.querySelectorAll('.page'));
        var navLinks = [].slice.call(document.querySelectorAll('a[data-route]'));
        var bar = document.getElementById('mainbar');
        var burger = document.getElementById('burger');

        /* ---------- menu ---------- */
        function setMenu(open) {
            document.body.classList.toggle('menu-open', open);
            burger.setAttribute('aria-expanded', open);
            burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        }
        burger.addEventListener('click', function() {
            setMenu(!document.body.classList.contains('menu-open'))
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') setMenu(false)
        });
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1020) setMenu(false)
        });

        /* ---------- router ---------- */
        function current() {
            var h = location.hash.replace(/^#\/?/, '').split('?')[0] || 'home';
            return TITLES[h] ? h : 'home';
        }

        function route(first) {
            var r = current();
            pages.forEach(function(p) {
                p.hidden = p.dataset.page !== r
            });
            navLinks.forEach(function(a) {
                if (a.dataset.route === r && a.classList.contains('nl')) a.setAttribute('aria-current',
                    'page');
                else a.removeAttribute('aria-current');
            });
            document.title = 'SM Group Bangladesh: ' + TITLES[r];
            setMenu(false);
            if (!first) window.scrollTo({
                top: 0,
                behavior: 'instant'
            });
            if (r === 'home') slider.start();
            else slider.stop();
            scan();
        }
        window.addEventListener('hashchange', function() {
            route(false)
        });

        /* ---------- scroll reveal ---------- */
        var io = null;

        function reveal(el) {
            el.classList.add('in');
            if (el.classList.contains('rv') && !el.classList.contains('ms') && !el.classList.contains('step')) {
                // release the stagger transition so hover effects stay snappy
                setTimeout(function() {
                    el.classList.remove('rv', 'in');
                }, 1400 + (parseFloat(el.style.getPropertyValue('--i')) || 0) * 80);
            }
            countUp(el);
        }
        if ('IntersectionObserver' in window && !reduced) {
            io = new IntersectionObserver(function(es) {
                es.forEach(function(e) {
                    if (e.isIntersecting) {
                        io.unobserve(e.target);
                        reveal(e.target)
                    }
                });
            }, {
                threshold: .12,
                rootMargin: '0px 0px -6% 0px'
            });
        }

        function scan() {
            var els = document.querySelectorAll(
                '.page:not([hidden]) .rv:not(.in),.page:not([hidden]) .rv-img:not(.in),.footer .rv:not(.in)');
            [].forEach.call(els, function(el) {
                if (io) {
                    if (!el.__o) {
                        el.__o = 1;
                        io.observe(el)
                    }
                } else {
                    el.classList.add('in');
                    countUp(el)
                }
            });
        }

        /* ---------- count up (activates automatically once real numbers replace the [00] placeholders) ---------- */
        function countUp(scope) {
            [].forEach.call(scope.querySelectorAll ? scope.querySelectorAll('[data-count]') : [], function(el) {
                run(el)
            });
            if (scope.hasAttribute && scope.hasAttribute('data-count')) run(scope);
        }

        function run(el) {
            if (el.__done) return;
            el.__done = 1;
            var m = el.textContent.match(/\d[\d,]*/);
            if (!m) return;
            var end = parseFloat(m[0].replace(/,/g, ''));
            if (!end || reduced) return;
            var pre = el.textContent.slice(0, m.index),
                post = el.textContent.slice(m.index + m[0].length);
            var t0 = performance.now(),
                dur = 1600;
            (function tick(t) {
                var k = Math.min(1, (t - t0) / dur),
                    v = Math.round(end * (1 - Math.pow(1 - k, 3)));
                el.textContent = pre + v.toLocaleString('en-US') + post;
                if (k < 1) requestAnimationFrame(tick);
            })(t0);
        }

        /* ---------- hero slider ---------- */
        var slider = (function() {
            var slides = [].slice.call(document.querySelectorAll('.slide')),
                dots = [].slice.call(document.querySelectorAll('.dot'));
            var i = 0,
                timer = null,
                DUR = 6000,
                box = document.querySelector('.hero-media');

            function go(n) {
                i = (n + slides.length) % slides.length;
                slides.forEach(function(s, k) {
                    s.classList.toggle('is-on', k === i);
                    s.setAttribute('aria-hidden', k !== i)
                });
                dots.forEach(function(d, k) {
                    d.classList.remove('is-on');
                    d.removeAttribute('aria-current');
                    if (k === i) {
                        void d.offsetWidth;
                        d.classList.add('is-on');
                        d.setAttribute('aria-current', 'true')
                    }
                });
            }

            function start() {
                stop();
                if (reduced || !slides.length) return;
                timer = setInterval(function() {
                    go(i + 1)
                }, DUR);
            }

            function stop() {
                if (timer) {
                    clearInterval(timer);
                    timer = null
                }
            }
            dots.forEach(function(d, k) {
                d.addEventListener('click', function() {
                    go(k);
                    start()
                })
            });
            if (box) {
                box.addEventListener('mouseenter', stop);
                box.addEventListener('mouseleave', function() {
                    if (current() === 'home') start()
                });
            }
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) stop();
                else if (current() === 'home') start()
            });
            document.documentElement.style.setProperty('--dur', DUR + 'ms');
            go(0);
            return {
                start: start,
                stop: stop
            };
        })();

        /* ---------- product filter ---------- */
        (function() {
            var chips = [].slice.call(document.querySelectorAll('.chip')),
                cards = [].slice.call(document.querySelectorAll('.prod')),
                count = document.getElementById('count');
            chips.forEach(function(c) {
                c.addEventListener('click', function() {
                    var cat = c.dataset.cat,
                        n = 0;
                    chips.forEach(function(x) {
                        x.setAttribute('aria-pressed', x === c)
                    });
                    cards.forEach(function(card) {
                        var show = cat === 'all' || card.dataset.cat === cat;
                        card.hidden = !show;
                        card.classList.remove('pop');
                        if (show) {
                            card.style.setProperty('--i', n++);
                            void card.offsetWidth;
                            card.classList.add('pop')
                        }
                    });
                    count.textContent = 'Showing ' + n + (n === 1 ? ' product' : ' products');
                });
            });
        })();

        /* ---------- forms ---------- */
        var cf = document.getElementById('contact-form'),
            thanks = document.getElementById('thanks'),
            cwrap = document.getElementById('form-wrap');
        if (cf) {
            cf.addEventListener('submit', function(e) {
                e.preventDefault();
                cwrap.hidden = true;
                thanks.hidden = false;
                thanks.focus();
            });
            document.getElementById('again').addEventListener('click', function() {
                cf.reset();
                thanks.hidden = true;
                cwrap.hidden = false;
            });
        }
        [].forEach.call(document.querySelectorAll('form.nlf'), function(f) {
            f.addEventListener('submit', function(e) {
                e.preventDefault();
                var m = document.createElement('p');
                m.className = 'ok-msg';
                m.setAttribute('role', 'status');
                m.innerHTML =
                    '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg><span>Thanks. You are on the list.</span>';
                f.replaceChildren(m);
            });
        });

        /* ---------- scroll: progress, sticky shadow, back to top ---------- */
        var prog = document.getElementById('progress'),
            top = document.getElementById('totop'),
            tick = false;

        function onScroll() {
            if (tick) return;
            tick = true;
            requestAnimationFrame(function() {
                var y = window.scrollY,
                    h = document.documentElement.scrollHeight - window.innerHeight;
                prog.style.transform = 'scaleX(' + (h > 0 ? Math.min(1, y / h) : 0) + ')';
                bar.classList.toggle('scrolled', y > 40);
                top.classList.toggle('show', y > 700);
                tick = false;
            });
        }
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        onScroll();
        top.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: reduced ? 'auto' : 'smooth'
            })
        });

        root.classList.add('js');
        route(true);
    })();
    </script>
</body>

</html><?php /**PATH E:\laragon\www\smgroupbd\resources\views/layouts/frontend/app.blade.php ENDPATH**/ ?>