/* ================================================
   LA LOCANDA DEL CARRETTIERE — Advanced JS
   GSAP 3 + ScrollTrigger + Lenis Smooth Scroll
   ================================================ */

/* ── 1. Lenis Smooth Scroll ── */
const lenis = new Lenis({
    duration: 1.4,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    direction: 'vertical',
    smooth: true,
});
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// Connect Lenis with GSAP ScrollTrigger
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => { lenis.raf(time * 1000); });
gsap.ticker.lagSmoothing(0);

/* ── 2. Page Loader ── */
const loader = document.getElementById('page-loader');
const loaderCircle = document.querySelector('.loader-circle');
if (loader && loaderCircle) {
    gsap.to(loaderCircle, {
        strokeDashoffset: 0,
        duration: 1.8,
        ease: 'power2.inOut',
        onComplete: () => {
            gsap.to(loader, {
                opacity: 0,
                duration: 0.6,
                delay: 0.2,
                onComplete: () => {
                    loader.classList.add('hidden');
                    initHeroAnimations();
                }
            });
        }
    });
}

/* ── 3. GSAP Register Plugins ── */
gsap.registerPlugin(ScrollTrigger);

/* ── 4. Navbar Scroll ── */
const nav = document.getElementById('main-nav');
ScrollTrigger.create({
    start: 'top -80',
    onEnter: () => nav && nav.classList.add('scrolled'),
    onLeaveBack: () => nav && nav.classList.remove('scrolled'),
});

/* ── 5. Hero Animations ── */
function initHeroAnimations() {
    const heroEyebrow = document.querySelector('.hero-eyebrow');
    const heroTitle = document.querySelector('.hero-title');
    const heroSubtitle = document.querySelector('.hero-subtitle');
    const heroActions = document.querySelector('.hero-actions');
    const heroStats = document.querySelector('.hero-stats');
    const heroScrollHint = document.querySelector('.hero-scroll-hint');

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    if (heroEyebrow) tl.to(heroEyebrow, { opacity: 1, y: 0, duration: 0.8 }, 0);
    if (heroTitle) tl.to(heroTitle, { opacity: 1, y: 0, duration: 1 }, 0.25);
    if (heroSubtitle) tl.to(heroSubtitle, { opacity: 1, y: 0, duration: 0.8 }, 0.55);
    if (heroActions) tl.to(heroActions, { opacity: 1, y: 0, duration: 0.8 }, 0.8);
    if (heroStats) tl.to(heroStats, { opacity: 1, y: 0, duration: 0.6 }, 1.0);
    if (heroScrollHint) tl.to(heroScrollHint, { opacity: 1, duration: 0.6 }, 1.3);
}

/* ── 6. Hero Parallax ── */
const heroBg = document.querySelector('.hero-bg');
if (heroBg) {
    gsap.to(heroBg, {
        yPercent: 30,
        ease: 'none',
        scrollTrigger: {
            trigger: '.hero-section',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        }
    });
}

/* ── 7. Section Text Reveal Animations ── */
// Animate all section eyebrows
gsap.utils.toArray('.section-eyebrow').forEach(el => {
    gsap.fromTo(el,
        { opacity: 0, y: 20 },
        {
            opacity: 1, y: 0, duration: 0.7,
            scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' }
        }
    );
});

// Animate section titles with clip-path reveal
gsap.utils.toArray('.section-title').forEach(el => {
    gsap.fromTo(el,
        { clipPath: 'inset(0 100% 0 0)', opacity: 0 },
        {
            clipPath: 'inset(0 0% 0 0)', opacity: 1, duration: 1, ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' }
        }
    );
});

// Animate section leads
gsap.utils.toArray('.section-lead').forEach(el => {
    gsap.fromTo(el,
        { opacity: 0, y: 30 },
        {
            opacity: 1, y: 0, duration: 0.9, ease: 'power2.out',
            scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' }
        }
    );
});

/* ── 8. Image Reveal with Clip-Path ── */
gsap.utils.toArray('.reveal-image').forEach(wrap => {
    const img = wrap.querySelector('img');
    gsap.fromTo(wrap,
        { clipPath: 'inset(0 0 100% 0)' },
        {
            clipPath: 'inset(0 0 0% 0)', duration: 1.2, ease: 'power3.out',
            scrollTrigger: { trigger: wrap, start: 'top 80%', toggleActions: 'play none none none' }
        }
    );
    if (img) {
        gsap.fromTo(img,
            { scale: 1.15 },
            {
                scale: 1, duration: 1.4, ease: 'power3.out',
                scrollTrigger: { trigger: wrap, start: 'top 80%', toggleActions: 'play none none none' }
            }
        );
    }
});

/* ── 9. Cards Stagger ── */
gsap.utils.toArray('.stagger-cards').forEach(container => {
    const cards = container.querySelectorAll('.specialty-card, .testimonial-card, .value-card, .menu-item');
    gsap.fromTo(cards,
        { opacity: 0, y: 50 },
        {
            opacity: 1, y: 0, duration: 0.7, stagger: 0.1, ease: 'power2.out',
            scrollTrigger: { trigger: container, start: 'top 80%', toggleActions: 'play none none none' }
        }
    );
});

/* ── 10. Counter Animations ── */
gsap.utils.toArray('.stat-number').forEach(el => {
    const text = el.textContent;
    const num = parseFloat(text.replace(/[^0-9.]/g, ''));
    const prefix = text.match(/^[^0-9]*/)?.[0] || '';
    const suffix = text.match(/[^0-9.]*$/)?.[0] || '';
    if (!isNaN(num) && num > 0) {
        gsap.fromTo({ val: 0 }, { val: num,
            duration: 2, ease: 'power2.out',
            onUpdate: function() {
                el.textContent = prefix + (Number.isInteger(num) ? Math.round(this.targets()[0].val) : this.targets()[0].val.toFixed(1)) + suffix;
            },
            scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' }
        });
    }
});

/* ── 11. Marquee Animation ── */
const marqueeTrack = document.querySelector('.marquee-track');
if (marqueeTrack) {
    gsap.to(marqueeTrack, {
        xPercent: -50,
        duration: 25,
        ease: 'none',
        repeat: -1,
    });
    // Pause on hover
    const strip = document.querySelector('.marquee-strip');
    if (strip) {
        strip.addEventListener('mouseenter', () => gsap.globalTimeline.pause());
        strip.addEventListener('mouseleave', () => gsap.globalTimeline.resume());
    }
}

/* ── 12. Magnetic Buttons ── */
document.querySelectorAll('.btn-gold, .btn-gold-solid, .btn-ghost, .btn-nav-cta').forEach(btn => {
    btn.addEventListener('mousemove', function(e) {
        const rect = this.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        gsap.to(this, {
            x: x * 0.25,
            y: y * 0.25,
            duration: 0.4,
            ease: 'power2.out'
        });
    });
    btn.addEventListener('mouseleave', function() {
        gsap.to(this, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.5)' });
    });
});

/* ── 13. Highlight Cards Scroll Parallax ── */
gsap.utils.toArray('.highlight-card').forEach((card, i) => {
    gsap.fromTo(card,
        { opacity: 0, y: 60 + i * 20 },
        {
            opacity: 1, y: 0, duration: 0.9, ease: 'power3.out',
            scrollTrigger: { trigger: card, start: 'top 85%', toggleActions: 'play none none none' }
        }
    );
});

/* ── 14. Parallax Quote ── */
const paralaxQuote = document.querySelector('.parallax-quote blockquote');
if (paralaxQuote) {
    gsap.fromTo(paralaxQuote,
        { opacity: 0, scale: 0.95 },
        {
            opacity: 1, scale: 1, duration: 1.2, ease: 'power2.out',
            scrollTrigger: { trigger: '.parallax-quote', start: 'top 70%' }
        }
    );
}

/* ── 15. Custom Cursor ── */
if (window.innerWidth > 1024 && window.matchMedia('(hover: hover)').matches) {
    const cursor = document.createElement('div');
    cursor.id = 'custom-cursor';
    cursor.innerHTML = '<div class="cursor-dot"></div><div class="cursor-ring"></div>';
    document.body.appendChild(cursor);
    const dot = cursor.querySelector('.cursor-dot');
    const ring = cursor.querySelector('.cursor-ring');
    let mouseX = 0, mouseY = 0;
    document.addEventListener('mousemove', e => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        gsap.to(dot, { left: mouseX, top: mouseY, duration: 0.05 });
        gsap.to(ring, { left: mouseX, top: mouseY, duration: 0.2, ease: 'power2.out' });
    });
    document.querySelectorAll('a, button, .gallery-item, .menu-tab-btn, .specialty-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(ring, { scale: 1.8, opacity: 0.6, duration: 0.3 });
            gsap.to(dot, { scale: 0, duration: 0.2 });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(ring, { scale: 1, opacity: 1, duration: 0.3 });
            gsap.to(dot, { scale: 1, duration: 0.2 });
        });
    });
}

/* ── 16. Back to Top ── */
const btt = document.createElement('button');
btt.id = 'back-to-top';
btt.innerHTML = '<i class="fas fa-chevron-up"></i>';
btt.setAttribute('aria-label', 'Torna in cima');
document.body.appendChild(btt);
ScrollTrigger.create({
    start: 'top -400',
    onEnter: () => btt.classList.add('visible'),
    onLeaveBack: () => btt.classList.remove('visible'),
});
btt.addEventListener('click', () => lenis.scrollTo(0, { duration: 1.5 }));

/* ── 17. WhatsApp Float Appear ── */
const waf = document.querySelector('.whatsapp-float');
if (waf) {
    ScrollTrigger.create({
        start: 'top -300',
        onEnter: () => waf.classList.add('visible'),
        onLeaveBack: () => waf.classList.remove('visible'),
    });
}

/* ── 18. Gallery Filter + Lightbox ── */
const filterBtns = document.querySelectorAll('.gallery-filter');
const galleryItems = document.querySelectorAll('.gallery-item');
filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const filter = this.dataset.filter;
        filterBtns.forEach(b => { b.classList.remove('active', 'btn-gold'); b.classList.add('btn-ghost'); });
        this.classList.add('active', 'btn-gold');
        this.classList.remove('btn-ghost');
        galleryItems.forEach(item => {
            const show = filter === 'all' || item.dataset.cat === filter;
            gsap.to(item, { opacity: show ? 1 : 0, scale: show ? 1 : 0.95, duration: 0.35, display: show ? 'block' : 'none' });
        });
    });
});

const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const lightboxClose = document.getElementById('lightbox-close');
if (lightbox) {
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            lightboxImg.src = img.dataset.lightbox || img.src;
            lightboxImg.alt = img.alt;
            lightbox.classList.add('open');
            document.body.style.overflow = 'hidden';
            gsap.fromTo(lightboxImg, { scale: 0.88, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.4, ease: 'power3.out' });
        });
    });
    function closeLightbox() {
        gsap.to(lightboxImg, { scale: 0.88, opacity: 0, duration: 0.3, ease: 'power2.in', onComplete: () => {
            lightbox.classList.remove('open');
            document.body.style.overflow = '';
            lightboxImg.src = '';
        }});
    }
    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
}

/* ── 19. Menu Tab Switch ── */
document.querySelectorAll('.menu-tab-btn').forEach(tab => {
    tab.addEventListener('click', function() {
        const target = this.dataset.tab;
        document.querySelectorAll('.menu-tab-btn').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.menu-category').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        const cat = document.getElementById('tab-' + target);
        if (cat) {
            cat.classList.add('active');
            gsap.fromTo(cat.querySelectorAll('.menu-item'),
                { opacity: 0, x: -20 },
                { opacity: 1, x: 0, duration: 0.5, stagger: 0.05, ease: 'power2.out' }
            );
        }
    });
});

/* ── 20. Menu Item Hover ── */
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
        gsap.to(this.querySelector('.menu-item-name'), { color: 'var(--color-gold)', duration: 0.2 });
        gsap.to(this, { paddingLeft: '12px', duration: 0.3, ease: 'power2.out' });
    });
    item.addEventListener('mouseleave', function() {
        gsap.to(this.querySelector('.menu-item-name'), { color: '', duration: 0.2 });
        gsap.to(this, { paddingLeft: '0', duration: 0.3, ease: 'power2.out' });
    });
});

/* ── 21. Tilt Cards ── */
document.querySelectorAll('.specialty-card, .value-card, .testimonial-card').forEach(card => {
    card.addEventListener('mousemove', function(e) {
        const rect = this.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        gsap.to(this, { rotateX: -y * 6, rotateY: x * 6, transformPerspective: 800, duration: 0.4, ease: 'power2.out' });
    });
    card.addEventListener('mouseleave', function() {
        gsap.to(this, { rotateX: 0, rotateY: 0, duration: 0.5, ease: 'elastic.out(1, 0.5)' });
    });
});

/* ── 22. Canvas Particles (Hero) ── */
(function initParticles() {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W = canvas.width = window.innerWidth;
    let H = canvas.height = window.innerHeight;
    const particles = [];
    const PARTICLE_COUNT = 55;
    for (let i = 0; i < PARTICLE_COUNT; i++) {
        particles.push({
            x: Math.random() * W,
            y: Math.random() * H,
            r: Math.random() * 1.5 + 0.3,
            vx: (Math.random() - 0.5) * 0.3,
            vy: (Math.random() - 0.5) * 0.3,
            a: Math.random() * 0.5 + 0.1,
        });
    }
    function drawParticles() {
        ctx.clearRect(0, 0, W, H);
        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(212,175,55,${p.a})`;
            ctx.fill();
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > W) p.vx *= -1;
            if (p.y < 0 || p.y > H) p.vy *= -1;
        });
        requestAnimationFrame(drawParticles);
    }
    drawParticles();
    window.addEventListener('resize', () => {
        W = canvas.width = window.innerWidth;
        H = canvas.height = window.innerHeight;
    });
})();
