/* ================================================
   LA LOCANDA DEL CARRETTIERE — Main JS
   GSAP 3 + ScrollTrigger + scroll nativo browser
   ================================================ */

/* ── Failsafe: se GSAP non parte in 2s, tutto visibile ── */
var failsafe = setTimeout(function () {
    document.querySelectorAll('[data-gsap-hidden]').forEach(function (el) {
        el.style.cssText += 'opacity:1!important;transform:none!important;clip-path:none!important;visibility:visible!important;';
        el.removeAttribute('data-gsap-hidden');
    });
    var loader = document.getElementById('page-loader');
    if (loader) loader.classList.add('hidden');
}, 2000);

document.addEventListener('DOMContentLoaded', function () {

    if (typeof gsap === 'undefined') {
        clearTimeout(failsafe);
        var loader = document.getElementById('page-loader');
        if (loader) loader.classList.add('hidden');
        return;
    }

    /* ── Plugin ── */
    gsap.registerPlugin(ScrollTrigger);

    /* ── Loader ── */
    var loader = document.getElementById('page-loader');
    if (loader) {
        gsap.to(loader, {
            opacity: 0, duration: 0.45, delay: 0.5,
            onComplete: function () {
                loader.classList.add('hidden');
                clearTimeout(failsafe);
                startAnimations();
            }
        });
    } else {
        clearTimeout(failsafe);
        startAnimations();
    }

    /* ── Navbar ── */
    var nav = document.getElementById('main-nav');
    if (nav) {
        ScrollTrigger.create({
            start: 'top -60',
            onEnter:     function () { nav.classList.add('scrolled'); },
            onLeaveBack: function () { nav.classList.remove('scrolled'); }
        });
    }

    /* ── Marquee ── */
    var track = document.querySelector('.marquee-track');
    if (track) {
        gsap.to(track, { xPercent: -50, duration: 28, ease: 'none', repeat: -1 });
    }

    /* ── WhatsApp float ── */
    var waf = document.querySelector('.whatsapp-float');
    if (waf) {
        ScrollTrigger.create({
            start: 'top -300',
            onEnter:     function () { waf.classList.add('visible'); },
            onLeaveBack: function () { waf.classList.remove('visible'); }
        });
    }

    /* ── Back to top ── */
    var btt = document.createElement('button');
    btt.id = 'back-to-top';
    btt.innerHTML = '<i class="fas fa-chevron-up"></i>';
    btt.setAttribute('aria-label', 'Torna in cima');
    document.body.appendChild(btt);
    ScrollTrigger.create({
        start: 'top -400',
        onEnter:     function () { btt.classList.add('visible'); },
        onLeaveBack: function () { btt.classList.remove('visible'); }
    });
    btt.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ── Custom cursor (solo desktop) ── */
    if (window.innerWidth > 1024 && window.matchMedia('(hover: hover)').matches) {
        var cur = document.createElement('div');
        cur.id = 'custom-cursor';
        cur.innerHTML = '<div class="cursor-dot"></div><div class="cursor-ring"></div>';
        document.body.appendChild(cur);
        var dot  = cur.querySelector('.cursor-dot');
        var ring = cur.querySelector('.cursor-ring');
        document.addEventListener('mousemove', function (e) {
            gsap.to(dot,  { left: e.clientX, top: e.clientY, duration: 0.06, overwrite: true });
            gsap.to(ring, { left: e.clientX, top: e.clientY, duration: 0.2,  ease: 'power2.out', overwrite: true });
        });
        document.querySelectorAll('a, button, .gallery-item, .specialty-card').forEach(function (el) {
            el.addEventListener('mouseenter', function () { gsap.to(ring, { scale: 1.8, duration: 0.25 }); });
            el.addEventListener('mouseleave', function () { gsap.to(ring, { scale: 1,   duration: 0.25 }); });
        });
    }

    /* ── Canvas particelle hero ── */
    var canvas = document.getElementById('hero-canvas');
    if (canvas) {
        var ctx = canvas.getContext('2d');
        var W = canvas.width  = window.innerWidth;
        var H = canvas.height = window.innerHeight;
        var pts = [];
        for (var i = 0; i < 50; i++) {
            pts.push({ x: Math.random()*W, y: Math.random()*H,
                       r: Math.random()*1.3+0.3,
                       vx:(Math.random()-0.5)*0.25, vy:(Math.random()-0.5)*0.25,
                       a: Math.random()*0.4+0.1 });
        }
        (function loop() {
            ctx.clearRect(0,0,W,H);
            pts.forEach(function(p){
                ctx.beginPath();
                ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
                ctx.fillStyle='rgba(212,175,55,'+p.a+')';
                ctx.fill();
                p.x+=p.vx; p.y+=p.vy;
                if(p.x<0||p.x>W) p.vx*=-1;
                if(p.y<0||p.y>H) p.vy*=-1;
            });
            requestAnimationFrame(loop);
        })();
        window.addEventListener('resize', function(){
            W=canvas.width=window.innerWidth;
            H=canvas.height=window.innerHeight;
        }, { passive: true });
    }

    /* ── Gallery filter + lightbox ── */
    var filterBtns  = document.querySelectorAll('.gallery-filter');
    var galleryItems = document.querySelectorAll('.gallery-item');
    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var f = this.dataset.filter;
            filterBtns.forEach(function(b){ b.classList.remove('active','btn-gold'); b.classList.add('btn-ghost'); });
            this.classList.add('active','btn-gold'); this.classList.remove('btn-ghost');
            galleryItems.forEach(function(item){
                var show = f==='all' || item.dataset.cat===f;
                if (show) {
                    item.style.display='block';
                    gsap.fromTo(item,{opacity:0,scale:0.95},{opacity:1,scale:1,duration:0.32});
                } else {
                    gsap.to(item,{opacity:0,scale:0.95,duration:0.22,onComplete:function(){item.style.display='none';}});
                }
            });
        });
    });

    var lb    = document.getElementById('lightbox');
    var lbImg = document.getElementById('lightbox-img');
    var lbX   = document.getElementById('lightbox-close');
    if (lb && lbImg) {
        galleryItems.forEach(function(item){
            item.addEventListener('click', function(){
                var img = this.querySelector('img');
                lbImg.src = (img&&img.dataset.lightbox) ? img.dataset.lightbox : (img?img.src:'');
                lb.classList.add('open');
                document.body.style.overflow='hidden';
                gsap.fromTo(lbImg,{scale:0.88,opacity:0},{scale:1,opacity:1,duration:0.32,ease:'power2.out'});
            });
        });
        function closeLb(){
            gsap.to(lbImg,{scale:0.88,opacity:0,duration:0.22,onComplete:function(){
                lb.classList.remove('open');
                document.body.style.overflow='';
                lbImg.src='';
            }});
        }
        if (lbX) lbX.addEventListener('click', closeLb);
        lb.addEventListener('click', function(e){ if(e.target===lb) closeLb(); });
        document.addEventListener('keydown', function(e){ if(e.key==='Escape'&&lb.classList.contains('open')) closeLb(); });
    }

    /* ── Menu tabs ── */
    document.querySelectorAll('.menu-tab-btn').forEach(function(tab){
        tab.addEventListener('click', function(){
            var t = this.dataset.tab;
            document.querySelectorAll('.menu-tab-btn').forEach(function(b){b.classList.remove('active');});
            document.querySelectorAll('.menu-category').forEach(function(c){c.classList.remove('active');});
            this.classList.add('active');
            var cat = document.getElementById('tab-'+t);
            if (cat) {
                cat.classList.add('active');
                gsap.fromTo(cat.querySelectorAll('.menu-item'),
                    {opacity:0,x:-14},{opacity:1,x:0,duration:0.38,stagger:0.04,ease:'power2.out'});
            }
        });
    });

    /* ── Menu item hover ── */
    document.querySelectorAll('.menu-item').forEach(function(item){
        var nm = item.querySelector('.menu-item-name');
        item.addEventListener('mouseenter',function(){
            gsap.to(this,{paddingLeft:'10px',duration:0.22,ease:'power2.out'});
            if(nm) gsap.to(nm,{color:'var(--color-gold)',duration:0.18});
        });
        item.addEventListener('mouseleave',function(){
            gsap.to(this,{paddingLeft:'0px',duration:0.28,ease:'power2.out'});
            if(nm) gsap.to(nm,{color:'',duration:0.18});
        });
    });

    /* ── Swiper ── */
    var swiperEl = document.querySelector('.swiper-testimonials');
    if (swiperEl && typeof Swiper !== 'undefined') {
        new Swiper(swiperEl, {
            slidesPerView:1, spaceBetween:24, loop:true,
            autoplay:{delay:5500,disableOnInteraction:false},
            pagination:{el:'.swiper-pagination',clickable:true},
            breakpoints:{768:{slidesPerView:2},1200:{slidesPerView:3}}
        });
    }

    /* ════════════════════════════════════════
       ANIMAZIONI GSAP (avviano dopo il loader)
       ════════════════════════════════════════ */
    function startAnimations() {

        /* Hero parallax leggero */
        var heroBg = document.querySelector('.hero-bg');
        if (heroBg) {
            gsap.to(heroBg, {
                yPercent: 22, ease:'none',
                scrollTrigger:{ trigger:'.hero-section', start:'top top', end:'bottom top', scrub:2 }
            });
        }

        /* Hero entrata */
        var heroItems = [
            {sel:'.hero-eyebrow',   delay:0   },
            {sel:'.hero-title',     delay:0.2 },
            {sel:'.hero-subtitle',  delay:0.42},
            {sel:'.hero-actions',   delay:0.6 },
            {sel:'.hero-stats',     delay:0.8 },
            {sel:'.hero-scroll-hint',delay:1.05},
        ];
        heroItems.forEach(function(it){
            var el = document.querySelector(it.sel);
            if (!el) return;
            el.setAttribute('data-gsap-hidden','1');
            gsap.set(el, {opacity:0, y:24});
            gsap.to(el,  {opacity:1, y:0, duration:0.85, delay:it.delay, ease:'power3.out',
                onComplete:function(){ el.removeAttribute('data-gsap-hidden'); }});
        });

        /* Section titles clip-path */
        gsap.utils.toArray('.section-title').forEach(function(el){
            el.setAttribute('data-gsap-hidden','1');
            gsap.set(el, {clipPath:'inset(0 100% 0 0)', opacity:0});
            ScrollTrigger.create({ trigger:el, start:'top 90%', once:true,
                onEnter:function(){
                    gsap.to(el,{clipPath:'inset(0 0% 0 0)',opacity:1,duration:0.85,ease:'power3.out',
                        onComplete:function(){ el.removeAttribute('data-gsap-hidden'); }});
                }
            });
        });

        /* Section eyebrows */
        gsap.utils.toArray('.section-eyebrow').forEach(function(el){
            gsap.set(el,{opacity:0,y:16});
            ScrollTrigger.create({ trigger:el, start:'top 92%', once:true,
                onEnter:function(){ gsap.to(el,{opacity:1,y:0,duration:0.55,ease:'power2.out'}); }
            });
        });

        /* Section leads */
        gsap.utils.toArray('.section-lead').forEach(function(el){
            gsap.set(el,{opacity:0,y:22});
            ScrollTrigger.create({ trigger:el, start:'top 92%', once:true,
                onEnter:function(){ gsap.to(el,{opacity:1,y:0,duration:0.7,ease:'power2.out'}); }
            });
        });

        /* Stagger cards */
        gsap.utils.toArray('.stagger-cards').forEach(function(wrap){
            var cards = wrap.querySelectorAll('.specialty-card,.testimonial-card,.value-card');
            if (!cards.length) return;
            gsap.set(cards,{opacity:0,y:36});
            ScrollTrigger.create({ trigger:wrap, start:'top 84%', once:true,
                onEnter:function(){ gsap.to(cards,{opacity:1,y:0,duration:0.6,stagger:0.09,ease:'power2.out'}); }
            });
        });

        /* Highlight cards */
        gsap.utils.toArray('.highlight-card').forEach(function(card,i){
            gsap.set(card,{opacity:0,y:44});
            ScrollTrigger.create({ trigger:card, start:'top 87%', once:true,
                onEnter:function(){ gsap.to(card,{opacity:1,y:0,duration:0.75,delay:i*0.09,ease:'power3.out'}); }
            });
        });

        /* Reveal image */
        gsap.utils.toArray('.reveal-image').forEach(function(wrap){
            var img = wrap.querySelector('img');
            gsap.set(wrap,{clipPath:'inset(0 0 100% 0)'});
            if (img) gsap.set(img,{scale:1.1});
            ScrollTrigger.create({ trigger:wrap, start:'top 84%', once:true,
                onEnter:function(){
                    gsap.to(wrap,{clipPath:'inset(0 0 0% 0)',duration:1.0,ease:'power3.out'});
                    if(img) gsap.to(img,{scale:1,duration:1.2,ease:'power3.out'});
                }
            });
        });

        /* Quote */
        var quote = document.querySelector('.parallax-quote blockquote');
        if (quote) {
            gsap.set(quote,{opacity:0,scale:0.95});
            ScrollTrigger.create({ trigger:'.parallax-quote', start:'top 74%', once:true,
                onEnter:function(){ gsap.to(quote,{opacity:1,scale:1,duration:1.0,ease:'power2.out'}); }
            });
        }

        /* Page hero leggero parallax */
        var phBg = document.querySelector('.page-hero-bg');
        if (phBg) {
            gsap.to(phBg,{ yPercent:18, ease:'none',
                scrollTrigger:{ trigger:'.page-hero', start:'top top', end:'bottom top', scrub:2 }
            });
        }

        /* Counter */
        gsap.utils.toArray('.stat-number').forEach(function(el){
            var t  = el.textContent.trim();
            var n  = parseFloat(t.replace(/[^0-9.]/g,''));
            var pre= t.match(/^[^0-9]*/)?.[0]||'';
            var suf= t.match(/[^0-9.]*$/)?.[0]||'';
            if (isNaN(n)||n<=0) return;
            var o={v:0};
            ScrollTrigger.create({ trigger:el, start:'top 90%', once:true,
                onEnter:function(){
                    gsap.to(o,{v:n,duration:1.6,ease:'power2.out',
                        onUpdate:function(){ el.textContent=pre+(Number.isInteger(n)?Math.round(o.v):o.v.toFixed(1))+suf; }
                    });
                }
            });
        });

        /* Magnetic buttons */
        document.querySelectorAll('.btn-gold,.btn-gold-solid,.btn-ghost').forEach(function(btn){
            btn.addEventListener('mousemove',function(e){
                var r=this.getBoundingClientRect();
                gsap.to(this,{x:(e.clientX-r.left-r.width/2)*0.2,y:(e.clientY-r.top-r.height/2)*0.2,
                    duration:0.3,ease:'power2.out',overwrite:true});
            });
            btn.addEventListener('mouseleave',function(){
                gsap.to(this,{x:0,y:0,duration:0.5,ease:'elastic.out(1,0.5)',overwrite:true});
            });
        });

        /* Tilt 3D cards */
        document.querySelectorAll('.specialty-card,.value-card').forEach(function(card){
            card.addEventListener('mousemove',function(e){
                var r=this.getBoundingClientRect();
                gsap.to(this,{rotateX:-((e.clientY-r.top)/r.height-0.5)*6,
                              rotateY: ((e.clientX-r.left)/r.width-0.5)*6,
                    transformPerspective:900,duration:0.35,ease:'power2.out'});
            });
            card.addEventListener('mouseleave',function(){
                gsap.to(this,{rotateX:0,rotateY:0,duration:0.55,ease:'elastic.out(1,0.4)'});
            });
        });
    }

}); /* fine DOMContentLoaded */
