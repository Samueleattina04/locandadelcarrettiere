/* ================================================
   LA LOCANDA DEL CARRETTIERE — Advanced JS
   GSAP 3 + ScrollTrigger + Lenis (fix v2)
   ================================================ */

/* ── Failsafe globale: se GSAP/Lenis non partono entro 3s, tutto visibile ── */
const FAILSAFE_MS = 3000;
const failsafe = setTimeout(function () {
    document.querySelectorAll('[data-gsap-hidden]').forEach(function (el) {
        el.style.opacity = '1';
        el.style.transform = 'none';
        el.style.clipPath = 'none';
        el.style.visibility = 'visible';
    });
    const loader = document.getElementById('page-loader');
    if (loader) loader.classList.add('hidden');
}, FAILSAFE_MS);

/* ── Attendi che GSAP e Lenis siano disponibili ── */
document.addEventListener('DOMContentLoaded', function () {

    /* Controlla che le librerie siano caricate */
    if (typeof gsap === 'undefined') {
        console.warn('GSAP non disponibile — contenuto reso visibile');
        clearTimeout(failsafe);
        document.querySelectorAll('[data-gsap-hidden]').forEach(function (el) {
            el.style.opacity = '1'; el.style.transform = 'none';
        });
        return;
    }

    /* ── 1. Registra plugin ScrollTrigger ── */
    gsap.registerPlugin(ScrollTrigger);

    /* ── 2. Lenis smooth scroll (un solo metodo RAF: GSAP ticker) ── */
    var lenis;
    if (typeof Lenis !== 'undefined') {
        lenis = new Lenis({
            duration: 1.2,
            easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
            smoothWheel: true,
            wheelMultiplier: 0.9,
            touchMultiplier: 1.5,
        });
        /* Collega Lenis a GSAP ticker — UN SOLO metodo, nessun requestAnimationFrame manuale */
        gsap.ticker.add(function (time) {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);
        lenis.on('scroll', ScrollTrigger.update);
    }

    /* ── 3. Loader ── */
    var loader = document.getElementById('page-loader');
    if (loader) {
        gsap.to(loader, {
            opacity: 0,
            duration: 0.5,
            delay: 0.6,
            ease: 'power2.out',
            onComplete: function () {
                loader.classList.add('hidden');
                clearTimeout(failsafe);
                initAnimations();
            }
        });
    } else {
        clearTimeout(failsafe);
        initAnimations();
    }

    /* ── 4. Navbar scroll ── */
    var nav = document.getElementById('main-nav');
    if (nav) {
        ScrollTrigger.create({
            start: 'top -80',
            onEnter: function () { nav.classList.add('scrolled'); },
            onLeaveBack: function () { nav.classList.remove('scrolled'); },
        });
    }

    /* ── 5. Marquee ── */
    var marqueeTrack = document.querySelector('.marquee-track');
    if (marqueeTrack) {
        gsap.to(marqueeTrack, {
            xPercent: -50,
            duration: 30,
            ease: 'none',
            repeat: -1,
        });
    }

    /* ── 6. WhatsApp float appare allo scroll ── */
    var waf = document.querySelector('.whatsapp-float');
    if (waf) {
        ScrollTrigger.create({
            start: 'top -300',
            onEnter: function () { waf.classList.add('visible'); },
            onLeaveBack: function () { waf.classList.remove('visible'); },
        });
    }

    /* ── 7. Back to top ── */
    var btt = document.getElementById('back-to-top');
    if (!btt) {
        btt = document.createElement('button');
        btt.id = 'back-to-top';
        btt.innerHTML = '<i class="fas fa-chevron-up"></i>';
        btt.setAttribute('aria-label', 'Torna in cima');
        document.body.appendChild(btt);
    }
    ScrollTrigger.create({
        start: 'top -400',
        onEnter: function () { btt.classList.add('visible'); },
        onLeaveBack: function () { btt.classList.remove('visible'); },
    });
    btt.addEventListener('click', function () {
        if (lenis) lenis.scrollTo(0, { duration: 1.4 });
        else window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ── 8. Custom cursor (solo desktop con hover) ── */
    if (window.innerWidth > 1024 && window.matchMedia('(hover: hover)').matches) {
        var cursorEl = document.createElement('div');
        cursorEl.id = 'custom-cursor';
        cursorEl.innerHTML = '<div class="cursor-dot"></div><div class="cursor-ring"></div>';
        document.body.appendChild(cursorEl);
        var dot = cursorEl.querySelector('.cursor-dot');
        var ring = cursorEl.querySelector('.cursor-ring');
        document.addEventListener('mousemove', function (e) {
            gsap.to(dot,  { left: e.clientX, top: e.clientY, duration: 0.06, overwrite: true });
            gsap.to(ring, { left: e.clientX, top: e.clientY, duration: 0.22, ease: 'power2.out', overwrite: true });
        });
        document.querySelectorAll('a, button, .gallery-item, .specialty-card').forEach(function (el) {
            el.addEventListener('mouseenter', function () { gsap.to(ring, { scale: 1.8, duration: 0.25 }); });
            el.addEventListener('mouseleave', function () { gsap.to(ring, { scale: 1,   duration: 0.25 }); });
        });
    }

    /* ── 9. Galley filter + lightbox ── */
    var filterBtns = document.querySelectorAll('.gallery-filter');
    var galleryItems = document.querySelectorAll('.gallery-item');
    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var filter = this.dataset.filter;
            filterBtns.forEach(function (b) {
                b.classList.remove('active', 'btn-gold');
                b.classList.add('btn-ghost');
            });
            this.classList.add('active', 'btn-gold');
            this.classList.remove('btn-ghost');
            galleryItems.forEach(function (item) {
                var show = filter === 'all' || item.dataset.cat === filter;
                if (show) {
                    item.style.display = 'block';
                    gsap.fromTo(item, { opacity: 0, scale: 0.95 }, { opacity: 1, scale: 1, duration: 0.35 });
                } else {
                    gsap.to(item, { opacity: 0, scale: 0.95, duration: 0.25, onComplete: function () { item.style.display = 'none'; } });
                }
            });
        });
    });

    var lightbox   = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightbox-img');
    var lightboxClose = document.getElementById('lightbox-close');
    if (lightbox && lightboxImg) {
        galleryItems.forEach(function (item) {
            item.addEventListener('click', function () {
                var img = this.querySelector('img');
                lightboxImg.src = (img && img.dataset.lightbox) ? img.dataset.lightbox : (img ? img.src : '');
                lightbox.classList.add('open');
                document.body.style.overflow = 'hidden';
                gsap.fromTo(lightboxImg, { scale: 0.9, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.35, ease: 'power2.out' });
            });
        });
        function closeLightbox() {
            gsap.to(lightboxImg, {
                scale: 0.9, opacity: 0, duration: 0.25, ease: 'power2.in',
                onComplete: function () {
                    lightbox.classList.remove('open');
                    document.body.style.overflow = '';
                    lightboxImg.src = '';
                }
            });
        }
        if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function (e) { if (e.target === lightbox) closeLightbox(); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && lightbox.classList.contains('open')) closeLightbox(); });
    }

    /* ── 10. Menu tab switch ── */
    document.querySelectorAll('.menu-tab-btn').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.dataset.tab;
            document.querySelectorAll('.menu-tab-btn').forEach(function (t) { t.classList.remove('active'); });
            document.querySelectorAll('.menu-category').forEach(function (c) { c.classList.remove('active'); });
            this.classList.add('active');
            var cat = document.getElementById('tab-' + target);
            if (cat) {
                cat.classList.add('active');
                gsap.fromTo(cat.querySelectorAll('.menu-item'),
                    { opacity: 0, x: -16 },
                    { opacity: 1, x: 0, duration: 0.4, stagger: 0.04, ease: 'power2.out' }
                );
            }
        });
    });

    /* ── 11. Canvas particelle hero ── */
    var canvas = document.getElementById('hero-canvas');
    if (canvas) {
        var ctx = canvas.getContext('2d');
        var W = canvas.width  = window.innerWidth;
        var H = canvas.height = window.innerHeight;
        var particles = [];
        for (var i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * W, y: Math.random() * H,
                r: Math.random() * 1.4 + 0.3,
                vx: (Math.random() - 0.5) * 0.28,
                vy: (Math.random() - 0.5) * 0.28,
                a: Math.random() * 0.45 + 0.1,
            });
        }
        function drawParticles() {
            ctx.clearRect(0, 0, W, H);
            particles.forEach(function (p) {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(212,175,55,' + p.a + ')';
                ctx.fill();
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0 || p.x > W) p.vx *= -1;
                if (p.y < 0 || p.y > H) p.vy *= -1;
            });
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
        window.addEventListener('resize', function () {
            W = canvas.width  = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }, { passive: true });
    }

    /* ── ANIMAZIONI: si avviano dopo il loader ── */
    function initAnimations() {

        /* Hero parallax */
        var heroBg = document.querySelector('.hero-bg');
        if (heroBg) {
            gsap.to(heroBg, {
                yPercent: 28,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.hero-section',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 1.5,
                }
            });
        }

        /* Hero entrata — gsap.set per initial state (non CSS) */
        var heroEls = [
            { sel: '.hero-eyebrow',    delay: 0    },
            { sel: '.hero-title',      delay: 0.22 },
            { sel: '.hero-subtitle',   delay: 0.45 },
            { sel: '.hero-actions',    delay: 0.65 },
            { sel: '.hero-stats',      delay: 0.85 },
            { sel: '.hero-scroll-hint', delay: 1.1 },
        ];
        heroEls.forEach(function (item) {
            var el = document.querySelector(item.sel);
            if (!el) return;
            el.setAttribute('data-gsap-hidden', '1');
            gsap.set(el, { opacity: 0, y: 28 });
            gsap.to(el, { opacity: 1, y: 0, duration: 0.9, delay: item.delay, ease: 'power3.out',
                onComplete: function () { el.removeAttribute('data-gsap-hidden'); }
            });
        });

        /* Section titles — clip-path reveal */
        gsap.utils.toArray('.section-title').forEach(function (el) {
            el.setAttribute('data-gsap-hidden', '1');
            gsap.set(el, { clipPath: 'inset(0 100% 0 0)', opacity: 0 });
            ScrollTrigger.create({
                trigger: el,
                start: 'top 88%',
                once: true,
                onEnter: function () {
                    gsap.to(el, {
                        clipPath: 'inset(0 0% 0 0)', opacity: 1,
                        duration: 0.9, ease: 'power3.out',
                        onComplete: function () { el.removeAttribute('data-gsap-hidden'); }
                    });
                }
            });
        });

        /* Section eyebrows */
        gsap.utils.toArray('.section-eyebrow').forEach(function (el) {
            gsap.set(el, { opacity: 0, y: 18 });
            ScrollTrigger.create({
                trigger: el, start: 'top 90%', once: true,
                onEnter: function () { gsap.to(el, { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }); }
            });
        });

        /* Section leads */
        gsap.utils.toArray('.section-lead').forEach(function (el) {
            gsap.set(el, { opacity: 0, y: 24 });
            ScrollTrigger.create({
                trigger: el, start: 'top 90%', once: true,
                onEnter: function () { gsap.to(el, { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' }); }
            });
        });

        /* Stagger cards */
        gsap.utils.toArray('.stagger-cards').forEach(function (container) {
            var cards = container.querySelectorAll('.specialty-card, .testimonial-card, .value-card');
            if (!cards.length) return;
            gsap.set(cards, { opacity: 0, y: 40 });
            ScrollTrigger.create({
                trigger: container, start: 'top 82%', once: true,
                onEnter: function () {
                    gsap.to(cards, { opacity: 1, y: 0, duration: 0.65, stagger: 0.1, ease: 'power2.out' });
                }
            });
        });

        /* Highlight cards */
        gsap.utils.toArray('.highlight-card').forEach(function (card, i) {
            gsap.set(card, { opacity: 0, y: 50 });
            ScrollTrigger.create({
                trigger: card, start: 'top 85%', once: true,
                onEnter: function () {
                    gsap.to(card, { opacity: 1, y: 0, duration: 0.8, delay: i * 0.1, ease: 'power3.out' });
                }
            });
        });

        /* Image reveal */
        gsap.utils.toArray('.reveal-image').forEach(function (wrap) {
            var img = wrap.querySelector('img');
            gsap.set(wrap, { clipPath: 'inset(0 0 100% 0)' });
            if (img) gsap.set(img, { scale: 1.12 });
            ScrollTrigger.create({
                trigger: wrap, start: 'top 82%', once: true,
                onEnter: function () {
                    gsap.to(wrap, { clipPath: 'inset(0 0 0% 0)', duration: 1.1, ease: 'power3.out' });
                    if (img) gsap.to(img, { scale: 1, duration: 1.3, ease: 'power3.out' });
                }
            });
        });

        /* Counter stats */
        gsap.utils.toArray('.stat-number').forEach(function (el) {
            var text   = el.textContent.trim();
            var num    = parseFloat(text.replace(/[^0-9.]/g, ''));
            var prefix = text.match(/^[^0-9]*/)?.[0] || '';
            var suffix = text.match(/[^0-9.]*$/)?.[0] || '';
            if (isNaN(num) || num <= 0) return;
            var obj = { val: 0 };
            ScrollTrigger.create({
                trigger: el, start: 'top 88%', once: true,
                onEnter: function () {
                    gsap.to(obj, {
                        val: num, duration: 1.8, ease: 'power2.out',
                        onUpdate: function () {
                            el.textContent = prefix + (Number.isInteger(num) ? Math.round(obj.val) : obj.val.toFixed(1)) + suffix;
                        }
                    });
                }
            });
        });

        /* Magnetic buttons */
        document.querySelectorAll('.btn-gold, .btn-gold-solid, .btn-ghost').forEach(function (btn) {
            btn.addEventListener('mousemove', function (e) {
                var r = this.getBoundingClientRect();
                var x = (e.clientX - r.left - r.width  / 2) * 0.22;
                var y = (e.clientY - r.top  - r.height / 2) * 0.22;
                gsap.to(this, { x: x, y: y, duration: 0.35, ease: 'power2.out', overwrite: true });
            });
            btn.addEventListener('mouseleave', function () {
                gsap.to(this, { x: 0, y: 0, duration: 0.55, ease: 'elastic.out(1, 0.5)', overwrite: true });
            });
        });

        /* Tilt 3D sulle card */
        document.querySelectorAll('.specialty-card, .value-card').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var r = this.getBoundingClientRect();
                var x = (e.clientX - r.left) / r.width  - 0.5;
                var y = (e.clientY - r.top)  / r.height - 0.5;
                gsap.to(this, { rotateX: -y * 7, rotateY: x * 7, transformPerspective: 900, duration: 0.4, ease: 'power2.out' });
            });
            card.addEventListener('mouseleave', function () {
                gsap.to(this, { rotateX: 0, rotateY: 0, duration: 0.6, ease: 'elastic.out(1, 0.4)' });
            });
        });

        /* Menu item hover */
        document.querySelectorAll('.menu-item').forEach(function (item) {
            var name = item.querySelector('.menu-item-name');
            item.addEventListener('mouseenter', function () {
                gsap.to(this, { paddingLeft: '10px', duration: 0.25, ease: 'power2.out' });
                if (name) gsap.to(name, { color: 'var(--color-gold)', duration: 0.2 });
            });
            item.addEventListener('mouseleave', function () {
                gsap.to(this, { paddingLeft: '0px', duration: 0.3, ease: 'power2.out' });
                if (name) gsap.to(name, { color: '', duration: 0.2 });
            });
        });

        /* Quote parallax */
        var quote = document.querySelector('.parallax-quote blockquote');
        if (quote) {
            gsap.set(quote, { opacity: 0, scale: 0.94 });
            ScrollTrigger.create({
                trigger: '.parallax-quote', start: 'top 72%', once: true,
                onEnter: function () {
                    gsap.to(quote, { opacity: 1, scale: 1, duration: 1.1, ease: 'power2.out' });
                }
            });
        }

        /* Page hero bg leggero parallax */
        var pageHeroBg = document.querySelector('.page-hero-bg');
        if (pageHeroBg) {
            gsap.to(pageHeroBg, {
                yPercent: 20, ease: 'none',
                scrollTrigger: { trigger: '.page-hero', start: 'top top', end: 'bottom top', scrub: 1.5 }
            });
        }

        /* Swiper testimonials */
        var swiperEl = document.querySelector('.swiper-testimonials');
        if (swiperEl && typeof Swiper !== 'undefined') {
            new Swiper(swiperEl, {
                slidesPerView: 1, spaceBetween: 24, loop: true,
                autoplay: { delay: 5500, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                breakpoints: { 768: { slidesPerView: 2 }, 1200: { slidesPerView: 3 } }
            });
        }
    }

}); /* fine DOMContentLoaded */
