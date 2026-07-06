@extends('layouts.app')

@section('title', 'Chi Siamo')

@section('meta-description')
La storia de La Locanda del Carrettiere: una famiglia siciliana che dal cuore di Bronte porta in tavola la tradizione culinaria dell'Etna e dei Nebrodi, con ingredienti locali e passione autentica.
@endsection

@section('og-title', 'Chi Siamo | La Locanda del Carrettiere – Trattoria Siciliana Bronte')

@section('og-description')
Scopri la storia e i valori de La Locanda del Carrettiere a Bronte: tradizione siciliana, ingredienti locali di qualità e l'ospitalità genuina del territorio etneo.
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container-xl page-hero-content">
        <div data-aos="fade-up">
            <p class="section-eyebrow">La nostra storia</p>
            <h1>Chi <em>Siamo</em></h1>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span class="sep">—</span>
                <span>Chi Siamo</span>
            </div>
        </div>
    </div>
</section>

<!-- Storia -->
<section class="section-pad bg-dark-2">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <p class="section-eyebrow">Le nostre radici</p>
                <h2 class="section-title">Una storia di <em>passione</em> e territorio</h2>
                <div class="deco-rule"></div>
                <p class="section-lead mb-4">
                    La Locanda del Carrettiere nasce dall'amore profondo per la Sicilia, per i suoi sapori antichi, per le sue tradizioni culinarie tramandate di generazione in generazione.
                </p>
                <p style="color:var(--color-text-muted);line-height:1.85;margin-bottom:1.5rem;">
                    Situata in Contrada Cantera, nel cuore di Bronte, tra le pendici dell'Etna e i boschi dei Nebrodi, a due passi dal fiume Simeto, la nostra trattoria è un rifugio di autenticità. Qui non troverai effetti speciali, ma piatti onesti, preparati con cura e rispetto per gli ingredienti del territorio.
                </p>
                <p style="color:var(--color-text-muted);line-height:1.85;">
                    Il nome richiama la figura del carrettiere siciliano, simbolo di umiltà, fatica e orgoglio per la propria terra. Ogni piatto che portiamo in tavola racconta questa storia: di chi lavora la terra, di chi alleva con rispetto, di chi sa aspettare i tempi giusti della natura.
                </p>
            </div>
            <div class="col-lg-5 offset-lg-1" data-aos="fade-left" data-aos-delay="100">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-year">Le origini</div>
                        <h4>La famiglia Gullotti</h4>
                        <p>Tutto inizia con la passione di una famiglia brontese per la buona cucina e i prodotti del territorio. Ricette di nonne e bisnonne diventano il fondamento di una cucina sincera.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">Il locale</div>
                        <h4>Apre La Locanda</h4>
                        <p>La Locanda del Carrettiere apre le sue porte in Contrada Cantera, un luogo immerso nella natura tra l'Etna e i Nebrodi, scelto per la sua bellezza e la sua tranquillità.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2018–2021</div>
                        <h4>TripAdvisor Travelers' Choice</h4>
                        <p>Il riconoscimento internazionale arriva quattro anni di fila, confermando la qualità eccezionale dell'esperienza offerta ai propri ospiti da tutto il mondo.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">Oggi</div>
                        <h4>Tradizione che evolve</h4>
                        <p>Continuiamo a crescere senza mai tradire le nostre radici. La pizza a lunga lievitazione di Fabio, i piatti stagionali, i vini siciliani: una proposta sempre viva e attuale.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Valori -->
<section class="section-pad bg-dark">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-eyebrow justify-content-center">La nostra filosofia</p>
            <h2 class="section-title">I valori che <em>ci guidano</em></h2>
        </div>
        <div class="row g-3">
            @php
            $values = [
                ['icon' => '🌿', 'title' => 'Km Zero', 'desc' => 'Acquistiamo direttamente da produttori locali: carni dei Nebrodi, verdure dell\'Etna, pistacchio DOP di Bronte. Il territorio nel piatto.'],
                ['icon' => '👨‍🍳', 'title' => 'Artigianalità', 'desc' => 'Nessun ingrediente industriale. Pasta fatta in casa, salumi artigianali, conserve stagionali preparate secondo metodi tradizionali.'],
                ['icon' => '🏺', 'title' => 'Tradizione', 'desc' => 'Ricette di famiglia tramandate per generazioni, custodite con rispetto e proposte con orgoglio. La memoria gastronomica della Sicilia.'],
                ['icon' => '❤️', 'title' => 'Ospitalità', 'desc' => 'Ogni ospite è un amico. L\'accoglienza calorosa e genuina è parte integrante dell\'esperienza alla Locanda del Carrettiere.'],
                ['icon' => '🌋', 'title' => 'Territorio', 'desc' => 'L\'Etna, i Nebrodi, il Simeto: la nostra posizione unica ci permette di attingere a una biodiversità straordinaria di ingredienti.'],
                ['icon' => '♻️', 'title' => 'Sostenibilità', 'desc' => 'Rispettiamo i ritmi della natura, privilegiamo ingredienti stagionali, riduciamo gli sprechi. La cucina responsabile inizia dalla scelta delle materie prime.'],
            ];
            @endphp
            @foreach($values as $i => $val)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                <div class="value-card">
                    <span class="value-icon">{{ $val['icon'] }}</span>
                    <h4>{{ $val['title'] }}</h4>
                    <p>{{ $val['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team -->
<section class="section-pad bg-dark-2">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-eyebrow justify-content-center">Le persone</p>
            <h2 class="section-title">La <em>famiglia</em> Gullotti</h2>
            <p class="section-lead mx-auto" style="max-width:520px;">
                Dietro ogni piatto ci sono persone appassionate che ogni giorno mettono il cuore in quello che fanno.
            </p>
        </div>
        <div class="row g-5 justify-content-center">
            @php
            $team = [
                ['initials' => 'G', 'name' => 'La Famiglia Gullotti', 'role' => 'La Cucina della Tradizione', 'bio' => 'Custodi delle ricette di famiglia, portano in tavola ogni giorno la memoria gastronomica della Sicilia più autentica, con ingredienti freschi e tecniche tramandate.', 'photo' => null],
                ['initials' => 'F', 'name' => 'Fabio Gullotto', 'role' => 'Pizzaiolo', 'bio' => 'Artista dell\'impasto, Fabio cura ogni venerdì, sabato e domenica sera la preparazione delle pizze con lievitazione naturale e farine selezionate.', 'photo' => null],
            ];
            @endphp
            @foreach($team as $i => $member)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="team-card">
                    <div class="team-photo">
                        @if(!empty($member['photo']))
                            <img
                                src="{{ $member['photo'] }}"
                                alt="{{ $member['name'] }}"
                                class="team-photo-img"
                                loading="lazy"
                            >
                        @else
                            <div class="team-photo-placeholder">{{ $member['initials'] }}</div>
                        @endif
                    </div>
                    <h3 class="team-name">{{ $member['name'] }}</h3>
                    <p class="team-role">{{ $member['role'] }}</p>
                    <p class="team-bio">{{ $member['bio'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Awards -->
<section class="parallax-quote">
    <div class="texture-overlay"></div>
    <div class="container" data-aos="fade-up">
        <div class="deco-rule mb-4"></div>
        <p style="font-size:.75rem;letter-spacing:.25em;text-transform:uppercase;color:var(--color-gold);margin-bottom:1.5rem;">Riconoscimenti</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:20px;margin-bottom:2rem;">
            @foreach([2018, 2019, 2020, 2021] as $year)
            <div style="text-align:center;padding:24px 36px;border:1px solid rgba(212,175,55,0.25);">
                <div style="font-size:1.5rem;margin-bottom:8px;">🏆</div>
                <div style="font-family:var(--font-serif);color:var(--color-gold);font-size:1.2rem;font-weight:600;">{{ $year }}</div>
                <div style="font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--color-text-muted);margin-top:4px;">TripAdvisor<br>Travelers' Choice</div>
            </div>
            @endforeach
        </div>
        <div class="deco-rule"></div>
    </div>
</section>

<!-- CTA -->
<section class="cta-strip">
    <div class="texture-overlay"></div>
    <div class="container-xl" data-aos="fade-up">
        <h2 class="section-title">Vieni a conoscerci di persona</h2>
        <p>La migliore presentazione è un tavolo apparecchiato, un calice di Nero d'Avola e un piatto fumante.</p>
        <div class="cta-actions">
            <a href="tel:0957721961" class="btn-gold-solid">
                <i class="fas fa-phone-alt"></i><span>Prenota un Tavolo</span>
            </a>
            <a href="{{ route('contact') }}" class="btn-gold">
                <span>Come Arrivare</span>
            </a>
        </div>
    </div>
</section>

@endsection
