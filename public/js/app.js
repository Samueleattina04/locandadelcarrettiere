/* ================================================
   LA LOCANDA DEL CARRETTIERE — Main JS
   ================================================ */

document.addEventListener('DOMContentLoaded', function () {

    /* ── Page Loader ── */
    const loader = document.getElementById('page-loader');
    if (loader) {
        window.addEventListener('load', function () {
            setTimeout(() => loader.classList.add('hidden'), 400);
        });
        // Fallback
        setTimeout(() => loader.classList.add('hidden'), 2800);
    }

    /* ── AOS Init ── */
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 60,
    });

    /* ── Navbar Scroll ── */
    const nav = document.getElementById('main-nav');
    if (nav) {
        function updateNav() {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        }
        window.addEventListener('scroll', updateNav, { passive: true });
        updateNav();
    }

    /* ── Hero Parallax BG ── */
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        window.addEventListener('scroll', function () {
            const y = window.scrollY;
            heroBg.style.transform = `scale(1.05) translateY(${y * 0.25}px)`;
        }, { passive: true });
    }

    /* ── Smooth Anchor Links ── */
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ── Animated Counters ── */
    const counters = document.querySelectorAll('.stat-number[data-count]');
    if (counters.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.dataset.count);
                    const prefix = el.dataset.prefix || '';
                    const suffix = el.dataset.suffix || '';
                    let current = 0;
                    const step = target / 60;
                    const timer = setInterval(() => {
                        current = Math.min(current + step, target);
                        el.textContent = prefix + Math.floor(current) + suffix;
                        if (current >= target) clearInterval(timer);
                    }, 16);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => observer.observe(c));
    }

    /* ── Tilt Effect on Cards ── */
    document.querySelectorAll('.specialty-card, .value-card').forEach(card => {
        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            this.style.transform = `translateY(-4px) rotateX(${-y * 4}deg) rotateY(${x * 4}deg)`;
        });
        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
        });
    });

    /* ── Custom Cursor (desktop only) ── */
    if (window.innerWidth > 1024) {
        const cursor = document.createElement('div');
        cursor.id = 'custom-cursor';
        cursor.innerHTML = '<div class="cursor-dot"></div><div class="cursor-ring"></div>';
        document.body.appendChild(cursor);

        const dot = cursor.querySelector('.cursor-dot');
        const ring = cursor.querySelector('.cursor-ring');

        let mouseX = 0, mouseY = 0;
        let ringX = 0, ringY = 0;

        document.addEventListener('mousemove', function (e) {
            mouseX = e.clientX;
            mouseY = e.clientY;
            dot.style.left = mouseX + 'px';
            dot.style.top = mouseY + 'px';
        });

        function animateRing() {
            ringX += (mouseX - ringX) * 0.12;
            ringY += (mouseY - ringY) * 0.12;
            ring.style.left = ringX + 'px';
            ring.style.top = ringY + 'px';
            requestAnimationFrame(animateRing);
        }
        animateRing();

        document.querySelectorAll('a, button, .gallery-item, .menu-tab-btn').forEach(el => {
            el.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
            el.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
        });
    }

    /* ── Back to Top ── */
    const btt = document.createElement('button');
    btt.id = 'back-to-top';
    btt.innerHTML = '<i class="fas fa-chevron-up"></i>';
    btt.setAttribute('aria-label', 'Torna in cima');
    document.body.appendChild(btt);

    window.addEventListener('scroll', function () {
        btt.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });

    btt.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ── Fade-in Images on Load ── */
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.6s ease';
        img.addEventListener('load', function () {
            this.style.opacity = '1';
        });
        if (img.complete) img.style.opacity = '1';
    });

    /* ── Menu Item Hover Line ── */
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('mouseenter', function () {
            this.querySelector('.menu-item-name').style.color = 'var(--color-gold)';
        });
        item.addEventListener('mouseleave', function () {
            this.querySelector('.menu-item-name').style.color = '';
        });
    });

});
