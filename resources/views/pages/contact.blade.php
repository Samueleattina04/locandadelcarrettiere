@extends('layouts.app')

@section('title', 'Contatti')
@section('meta-description', 'Contatta La Locanda del Carrettiere a Bronte (CT): telefono, WhatsApp, email e indicazioni stradali. Prenota il tuo tavolo in Contrada Cantera snc, 95034 Bronte.')
@section('og-title', 'Contatti & Prenotazioni | La Locanda del Carrettiere – Bronte')
@section('og-description', 'Prenota il tuo tavolo: chiama al 095 7721961 o scrivici su WhatsApp. Siamo a Bronte, Contrada Cantera snc, ai piedi dell\'Etna. Aperto ogni giorno tranne martedì.')

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1485962398705-ef6a13c41e8f?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container-xl page-hero-content">
        <div data-aos="fade-up">
            <p class="section-eyebrow">Vieni a trovarci</p>
            <h1>Come <em>Contattarci</em></h1>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span class="sep">—</span>
                <span>Contatti</span>
            </div>
        </div>
    </div>
</section>

<!-- Recapiti + Mappa -->
<section class="section-pad bg-dark-2">
    <div class="container-xl">
        <div class="row g-5 align-items-start">

            <!-- Recapiti -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="contact-info-card">
                    <p class="section-eyebrow mb-4">Recapiti</p>

                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="contact-detail-label">Indirizzo</div>
                            <div class="contact-detail-value">
                                Contrada Cantera snc<br>
                                95034 Bronte (CT), Sicilia
                            </div>
                        </div>
                    </div>

                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <div class="contact-detail-label">Telefono</div>
                            <div class="contact-detail-value">
                                <a href="tel:0957721961">095 7721961</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <div class="contact-detail-label">WhatsApp</div>
                            <div class="contact-detail-value">
                                <a href="https://wa.me/390957721961" target="_blank">Scrivici su WhatsApp</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="contact-detail-label">Email</div>
                            <div class="contact-detail-value">
                                <a href="mailto:trattoriagullotti@gmail.com">trattoriagullotti@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mappa -->
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3158.0!2d14.8385!3d37.7763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13159e2cfb3c97c5%3A0x8be2a9e7a37dde1!2sLa%20Locanda%20Del%20Carrettiere!5e0!3m2!1sit!2sit!4v1700000000000!5m2!1sit!2sit"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="La Locanda del Carrettiere - Mappa"
                    ></iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Orari di Apertura -->
<section class="section-pad bg-dark">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="contact-info-card">
                    <p class="section-eyebrow mb-4" style="justify-content:center;">Orari di Apertura</p>

                    @php
                    $days_it = ['Monday' => 'Lunedì', 'Tuesday' => 'Martedì', 'Wednesday' => 'Mercoledì', 'Thursday' => 'Giovedì', 'Friday' => 'Venerdì', 'Saturday' => 'Sabato', 'Sunday' => 'Domenica'];
                    $today_en = date('l');
                    $today_it = $days_it[$today_en] ?? '';
                    @endphp

                    <table class="hours-table">
                        @foreach($hours as $h)
                        <tr class="{{ $h['closed'] ? 'closed' : '' }} {{ $h['day'] === $today_it ? 'today' : '' }}">
                            <td class="day">
                                {{ $h['day'] }}
                                @if($h['day'] === $today_it)
                                <span style="font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;color:var(--color-gold);margin-left:6px;">oggi</span>
                                @endif
                            </td>
                            <td class="time">
                                @if($h['closed'])
                                    Chiuso
                                @else
                                    <span>{{ $h['lunch'] }}</span>
                                    <span style="color:rgba(212,175,55,.3);margin:0 6px;">·</span>
                                    <span>{{ $h['dinner'] }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <div style="margin-top:24px;padding:16px;background:rgba(212,175,55,0.05);border-left:2px solid var(--color-gold);">
                        <p style="font-size:.82rem;color:var(--color-text-muted);margin:0;font-style:italic;">
                            <i class="fas fa-info-circle me-2" style="color:var(--color-gold);"></i>
                            Pizza disponibile solo Venerdì, Sabato e Domenica sera.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Come Arrivare -->
<section class="section-pad-sm bg-dark-2">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div style="background:rgba(255,255,255,.02);border:1px solid rgba(212,175,55,.12);padding:40px;">
                    <p class="section-eyebrow mb-4" style="justify-content:center;">Come arrivare</p>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div style="display:flex;gap:16px;align-items:flex-start;">
                                <div class="contact-icon" style="flex-shrink:0;"><i class="fas fa-car"></i></div>
                                <div>
                                    <div class="contact-detail-label">In Auto</div>
                                    <p style="font-size:.85rem;color:var(--color-text-muted);line-height:1.7;margin:0;">
                                        Autostrada A18 Catania–Messina, uscita Bronte. Seguire indicazioni per Contrada Cantera.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="display:flex;gap:16px;align-items:flex-start;">
                                <div class="contact-icon" style="flex-shrink:0;"><i class="fas fa-train"></i></div>
                                <div>
                                    <div class="contact-detail-label">In Treno</div>
                                    <p style="font-size:.85rem;color:var(--color-text-muted);line-height:1.7;margin:0;">
                                        Stazione di Bronte (Ferrovia Circumetnea). Disponibile taxi locale per raggiungere il locale.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="https://maps.google.com/?q=La+Locanda+Del+Carrettiere+Bronte" target="_blank" class="btn-gold-solid" style="font-size:.76rem;">
                            <i class="fas fa-directions"></i>
                            <span>Ottieni Indicazioni</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick CTA Blocks -->
<section class="section-pad-sm bg-dark">
    <div class="container-xl">
        <div class="row g-1">
            <div class="col-md-4" data-aos="fade-up">
                <a href="tel:0957721961" class="d-block text-decoration-none" style="background:rgba(212,175,55,.06);border:1px solid rgba(212,175,55,.15);padding:40px 32px;text-align:center;transition:var(--transition);" onmouseover="this.style.background='rgba(212,175,55,.1)'" onmouseout="this.style.background='rgba(212,175,55,.06)'">
                    <i class="fas fa-phone-alt mb-3 d-block" style="font-size:1.8rem;color:var(--color-gold);"></i>
                    <h4 style="font-size:1rem;margin-bottom:6px;">Chiama Ora</h4>
                    <p style="font-size:.88rem;color:var(--color-text-muted);margin:0;">095 7721961</p>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="80">
                <a href="https://wa.me/390957721961" target="_blank" class="d-block text-decoration-none" style="background:rgba(74,124,89,.06);border:1px solid rgba(74,124,89,.2);padding:40px 32px;text-align:center;transition:var(--transition);" onmouseover="this.style.background='rgba(74,124,89,.12)'" onmouseout="this.style.background='rgba(74,124,89,.06)'">
                    <i class="fab fa-whatsapp mb-3 d-block" style="font-size:1.8rem;color:var(--color-pistachio-light);"></i>
                    <h4 style="font-size:1rem;margin-bottom:6px;">WhatsApp</h4>
                    <p style="font-size:.88rem;color:var(--color-text-muted);margin:0;">Scrivici subito</p>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="160">
                <a href="mailto:trattoriagullotti@gmail.com" class="d-block text-decoration-none" style="background:rgba(255,255,255,.02);border:1px solid rgba(245,230,211,.1);padding:40px 32px;text-align:center;transition:var(--transition);" onmouseover="this.style.background='rgba(255,255,255,.05)'" onmouseout="this.style.background='rgba(255,255,255,.02)'">
                    <i class="fas fa-envelope mb-3 d-block" style="font-size:1.8rem;color:var(--color-cream);"></i>
                    <h4 style="font-size:1rem;margin-bottom:6px;">Email</h4>
                    <p style="font-size:.88rem;color:var(--color-text-muted);margin:0;">trattoriagullotti@gmail.com</p>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
