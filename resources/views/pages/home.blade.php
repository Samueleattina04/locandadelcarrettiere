@extends('layouts.app')

@section('title', 'La Locanda del Carrettiere')

@section('meta-description')
La Locanda del Carrettiere a Bronte (CT): trattoria siciliana autentica con specialità al pistacchio di Bronte DOP, carni dei Nebrodi e pizza a lunga lievitazione. TripAdvisor Travelers' Choice 2018–2021.
@endsection

@section('og-title', 'La Locanda del Carrettiere | Trattoria Siciliana a Bronte')

@section('og-description')
Sapori autentici tra l'Etna e i Nebrodi. Cucina tradizionale siciliana, pistacchio di Bronte DOP, carni grigliate e pizza artigianale.
@endsection

@section('content')

<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero-section">
    <canvas id="hero-canvas"></canvas>
    <div class="hero-bg"></div>
    <div class="hero-particles"></div>
    <div class="texture-overlay"></div>

    <div class="container-xl hero-content">
        <p class="hero-eyebrow">Bronte · Etna · Nebrodi</p>
        <h1 class="hero-title">
            La Locanda
            <span class="italic-gold">del Carrettiere</span>
        </h1>
        <p class="hero-subtitle">
            Dove la tradizione siciliana diventa emozione
        </p>
        <div class="hero-actions">
            <a href="{{ route('menu') }}" class="btn-gold">
                <span>Scopri il Menu</span>
                <i class="fas fa-arrow-right fa-sm"></i>
            </a>
            <a href="tel:0957721961" class="btn-ghost">
                <i class="fas fa-phone-alt fa-sm"></i>
                <span>Prenota un Tavolo</span>
            </a>
        </div>
    </div>

    <div class="hero-scroll-hint">
        <span>Scorri</span>
        <div class="scroll-line"></div>
    </div>

    <!-- Stats Bar -->
    <div class="hero-stats">
        <div class="container-xl">
            <div class="hero-stats-inner">
                <div class="stat-item">
                    <div class="stat-number">4×</div>
                    <div class="stat-label">TripAdvisor Award</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Anni di Tradizione</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Km Zero</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">★ 4.8</div>
                    <div class="stat-label">Rating Medio</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ INTRO ═══════════════ -->
<section class="section-pad bg-dark-2" id="intro">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="about-mini-image reveal-image">
                    <img
                        src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=85"
                        alt="Interno della Locanda del Carrettiere"
                        loading="lazy"
                    >
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-delay="100">
                <p class="section-eyebrow">La nostra storia</p>
                <h2 class="section-title">
                    Un angolo di <em>Sicilia autentica</em><br>tra l'Etna e i Nebrodi
                </h2>
                <div class="deco-rule"></div>
                <p class="section-lead mb-4">
                    Immersa tra le pendici dell'Etna e i boschi dei Nebrodi, a due passi dal fiume Simeto, La Locanda del Carrettiere è un luogo dove il tempo rallenta e i sapori raccontano storie antiche.
                </p>
                <p class="section-lead mb-5" style="font-size:1rem;">
                    La famiglia Gullotti porta avanti con passione una cucina genuina, fatta di ingredienti km zero, ricette tramandate di generazione in generazione e il re assoluto della tavola: il <strong class="gold-text">pistacchio di Bronte DOP</strong>.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('about') }}" class="btn-gold">
                        <span>Chi Siamo</span>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-ghost">
                        <span>Come Arrivare</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ SPECIALTIES ═══════════════ -->
<section class="section-pad bg-dark" id="specialties">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-eyebrow justify-content-center">Il cuore della cucina</p>
            <h2 class="section-title">Le nostre <em>specialità</em></h2>
            <p class="section-lead mx-auto" style="max-width:560px;">
                Quattro pilastri di un'esperienza culinaria che celebra la Sicilia in ogni sua sfumatura.
            </p>
        </div>
    </div>
    <div class="specialty-grid stagger-cards" data-aos="fade-up" data-aos-delay="150">
        @foreach($specialties as $i => $spec)
        <div class="specialty-card" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
            <div class="specialty-icon">
                @if($spec['icon'] === 'antipasto') 🫒
                @elseif($spec['icon'] === 'pistacchio') 🌿
                @elseif($spec['icon'] === 'grigliata') 🔥
                @else 🍝
                @endif
            </div>
            <h3>{{ $spec['title'] }}</h3>
            <p>{{ $spec['description'] }}</p>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('menu') }}" class="btn-gold">
            <span>Esplora il Menu Completo</span>
            <i class="fas fa-arrow-right fa-sm"></i>
        </a>
    </div>
</section>

<!-- ═══════════════ QUOTE PARALLAX ═══════════════ -->
<div class="parallax-quote">
    <div class="texture-overlay"></div>
    <div class="container" data-aos="fade-up">
        <div class="deco-rule mb-4"></div>
        <blockquote>
            "A tavola non si invecchia.<br>
            Qui ogni piatto è un <em>viaggio nella memoria</em>,<br>
            ogni sorso un abbraccio alla nostra terra."
        </blockquote>
        <cite>— La Famiglia Gullotti</cite>
        <div class="deco-rule mt-4"></div>
    </div>
</div>

<!-- ═══════════════ HIGHLIGHTS ═══════════════ -->
<section class="section-pad bg-dark-3">
    <div class="container-xl">
        <div class="row g-0 align-items-stretch">

            <div class="col-lg-4 highlight-card" data-aos="fade-up">
                <div style="
                    background: url('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=700&q=80') center/cover;
                    min-height: 400px;
                    position: relative;
                ">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,6,0,0.7),rgba(92,45,0,0.4));"></div>
                    <div style="position:relative;z-index:1;padding:40px;height:100%;display:flex;flex-direction:column;justify-content:flex-end;">
                        <span style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:var(--color-gold);margin-bottom:8px;">Ogni settimana</span>
                        <h3 style="margin-bottom:12px;">Pizza a lunga lievitazione</h3>
                        <p style="font-size:.88rem;color:var(--color-text-muted);">Ogni venerdì, sabato e domenica sera, il pizzaiolo Fabio Gullotto serve pizze con impasto artigianale a lunga lievitazione.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 highlight-card" data-aos="fade-up" data-aos-delay="100">
                <div style="
                    background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=700&q=80') center/cover;
                    min-height: 400px;
                    position: relative;
                ">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,6,0,0.7),rgba(74,124,89,0.3));"></div>
                    <div style="position:relative;z-index:1;padding:40px;height:100%;display:flex;flex-direction:column;justify-content:flex-end;">
                        <span style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:var(--color-pistachio-light);margin-bottom:8px;">Il re di Bronte</span>
                        <h3 style="margin-bottom:12px;">Pistacchio DOP</h3>
                        <p style="font-size:.88rem;color:var(--color-text-muted);">Il pistacchio di Bronte DOP è protagonista di antipasti, primi, secondi e dolci. Un ingrediente unico al mondo.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 highlight-card" data-aos="fade-up" data-aos-delay="200">
                <div style="
                    background: url('https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=700&q=80') center/cover;
                    min-height: 400px;
                    position: relative;
                ">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,6,0,0.7),rgba(122,64,16,0.3));"></div>
                    <div style="position:relative;z-index:1;padding:40px;height:100%;display:flex;flex-direction:column;justify-content:flex-end;">
                        <span style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:var(--color-gold);margin-bottom:8px;">La cantina</span>
                        <h3 style="margin-bottom:12px;">Vini Siciliani</h3>
                        <p style="font-size:.88rem;color:var(--color-text-muted);">Una selezione curata dei migliori vini siciliani: dall'Etna Rosso DOC al Nero d'Avola, fino ai grandi amari locali.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════ TESTIMONIALS ═══════════════ -->
<section class="section-pad testimonials-section">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-eyebrow justify-content-center">Cosa dicono di noi</p>
            <h2 class="section-title">Le <em>voci</em> dei nostri ospiti</h2>
        </div>

        <div class="swiper swiper-testimonials" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper stagger-cards">
                @foreach($testimonials as $t)
                <div class="swiper-slide">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-stars">
                            @for($i = 0; $i < $t['rating']; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="testimonial-text">"{{ $t['text'] }}"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">{{ substr($t['name'], 0, 1) }}</div>
                            <div class="testimonial-meta">
                                <strong>{{ $t['name'] }}</strong>
                                <span>{{ $t['city'] }}</span>
                            </div>
                            <span class="platform-badge">{{ $t['platform'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<!-- ═══════════════ CTA ═══════════════ -->
<section class="cta-strip">
    <div class="texture-overlay"></div>
    <div class="container-xl" data-aos="fade-up">
        <p class="section-eyebrow justify-content-center">Vieni a trovarci</p>
        <h2 class="section-title">Prenota il tuo tavolo</h2>
        <p>Il gusto della Sicilia autentica ti aspetta a Bronte, tra l'Etna e i Nebrodi.</p>
        <div class="cta-actions">
            <a href="tel:0957721961" class="btn-gold-solid">
                <i class="fas fa-phone-alt"></i>
                <span>Chiama Ora · 095 7721961</span>
            </a>
            <a href="https://wa.me/390957721961" class="btn-gold" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>Scrivi su WhatsApp</span>
            </a>
        </div>
        <p style="margin-top:2rem;font-size:.78rem;letter-spacing:.1em;color:rgba(232,221,208,.3);font-style:normal;">
            Contrada Cantera snc – 95034 Bronte (CT) &nbsp;·&nbsp; Chiuso il martedì
        </p>
    </div>
</section>

<!-- ═══════════════ GALLERY PREVIEW ═══════════════ -->
<section class="section-pad bg-dark">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-eyebrow justify-content-center">In immagini</p>
            <h2 class="section-title">Un assaggio <em>visivo</em></h2>
        </div>
        <div class="row g-2" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-6 col-lg-4">
                <div class="gallery-item" style="height:280px;">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80" alt="Piatti siciliani" style="height:100%;object-fit:cover;width:100%;">
                    <div class="gallery-item-overlay"><span class="gallery-item-caption">La sala</span></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="gallery-item" style="height:280px;">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80" alt="Piatti siciliani" style="height:100%;object-fit:cover;width:100%;">
                    <div class="gallery-item-overlay"><span class="gallery-item-caption">Antipasti della casa</span></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="gallery-item" style="height:280px;">
                    <img src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?w=600&q=80" alt="Pasta siciliana" style="height:100%;object-fit:cover;width:100%;">
                    <div class="gallery-item-overlay"><span class="gallery-item-caption">Pasta della tradizione</span></div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('gallery') }}" class="btn-ghost">
                <span>Vedi Tutta la Galleria</span>
                <i class="fas fa-arrow-right fa-sm"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.swiper-testimonials', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: {
            768: { slidesPerView: 2 },
            1200: { slidesPerView: 3 }
        }
    });
});
</script>
@endsection
