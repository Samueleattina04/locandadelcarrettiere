<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-description', 'La Locanda del Carrettiere – Trattoria siciliana a Bronte, tra l\'Etna e i Nebrodi. Cucina tradizionale, antipasti rustici, pistacchio di Bronte DOP e carni grigliate.')">
    <meta name="keywords" content="@yield('meta-keywords', 'trattoria siciliana, Bronte, pistacchio, Etna, cucina tradizionale, ristorante, locanda, carrettiere')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="La Locanda del Carrettiere">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og-title', 'La Locanda del Carrettiere | Trattoria Siciliana – Bronte')">
    <meta property="og:description" content="@yield('og-description', 'Sapori autentici tra l\'Etna e i Nebrodi. Cucina tradizionale siciliana con il pistacchio di Bronte DOP.')">
    <meta property="og:type" content="restaurant">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="La Locanda del Carrettiere – Trattoria siciliana a Bronte">
    <meta property="og:locale" content="it_IT">
    <meta property="og:site_name" content="La Locanda del Carrettiere">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og-title', 'La Locanda del Carrettiere | Trattoria Siciliana – Bronte')">
    <meta name="twitter:description" content="@yield('og-description', 'Sapori autentici tra l\'Etna e i Nebrodi. Cucina tradizionale siciliana con il pistacchio di Bronte DOP.')">
    <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <title>@hasSection('page-title')@yield('page-title')@else@yield('title', 'La Locanda del Carrettiere') | Trattoria Siciliana – Bronte@endif</title>

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Restaurant",
        "name": "La Locanda del Carrettiere",
        "description": "Trattoria siciliana autentica a Bronte, ai piedi dell'Etna. Specialità con pistacchio di Bronte DOP, carni dei Nebrodi e pizza a lunga lievitazione.",
        "url": "https://lalocandadelcarrettierebronte.it",
        "telephone": "+390957721961",
        "email": "trattoriagullotti@gmail.com",
        "vatID": "05400350871",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Contrada Cantera snc",
            "addressLocality": "Bronte",
            "addressRegion": "Catania",
            "postalCode": "95034",
            "addressCountry": "IT"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "37.7903",
            "longitude": "14.8328"
        },
        "servesCuisine": ["Sicilian", "Italian"],
        "priceRange": "€€",
        "hasMap": "https://maps.google.com/?q=Contrada+Cantera+snc+95034+Bronte+CT",
        "openingHoursSpecification": [
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday"], "opens": "11:30", "closes": "14:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday"], "opens": "19:30", "closes": "22:00"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Wednesday", "Thursday"], "opens": "11:30", "closes": "14:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Wednesday", "Thursday"], "opens": "19:30", "closes": "22:00"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Friday"], "opens": "11:30", "closes": "14:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Friday"], "opens": "19:30", "closes": "23:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Saturday"], "opens": "11:30", "closes": "14:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Saturday"], "opens": "19:30", "closes": "23:45"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Sunday"], "opens": "11:30", "closes": "14:30"},
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Sunday"], "opens": "19:30", "closes": "23:30"}
        ],
        "image": "https://lalocandadelcarrettierebronte.it/images/og-image.jpg",
        "award": "TripAdvisor Travelers' Choice 2018, 2019, 2020, 2021",
        "sameAs": [
            "https://www.facebook.com/locandadelcarrettiere",
            "https://www.instagram.com/locandadelcarrettiere",
            "https://www.tripadvisor.it/Restaurant_Review-g1059862-d3580920-Reviews-La_Locanda_del_Carrettiere-Bronte_Province_of_Catania_Sicily.html"
        ]
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('images/favicon-192.png') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('head')
</head>
<body class="@yield('body-class')">

    <!-- Loader -->
    <div id="page-loader">
        <div class="loader-content">
            <div class="loader-logo">
                <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="35" fill="none" stroke="#D4AF37" stroke-width="1" opacity="0.3"/>
                    <circle cx="40" cy="40" r="35" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-dasharray="220" stroke-dashoffset="220" class="loader-circle"/>
                    <text x="50%" y="52%" text-anchor="middle" dominant-baseline="middle" fill="#D4AF37" font-size="10" font-family="Playfair Display" font-style="italic">LC</text>
                </svg>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="main-nav" class="navbar navbar-expand-lg fixed-top">
        <div class="container-xl">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="brand-container">
                    <div class="brand-container">
                        <img src="{{ asset('images/logo-navbar.png') }}" alt="La Locanda del Carrettiere" class="brand-logo-img">
                        <div class="brand-text">
                            <span class="brand-main">La Locanda</span>
                            <span class="brand-sub">del Carrettiere</span>
                        </div>
                    </div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <div class="hamburger">
                    <span></span><span></span><span></span>
                </div>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galleria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Chi Siamo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contatti</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn-nav-cta" href="tel:0957721961">
                            <i class="fas fa-phone-alt me-2"></i>Prenota ora
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Marquee Strip -->
    <div class="marquee-strip" id="marquee-strip">
        <div class="marquee-track">
            <span>Cucina Siciliana Autentica</span>
            <span class="marquee-dot">✦</span>
            <span>Pistacchio di Bronte DOP</span>
            <span class="marquee-dot">✦</span>
            <span>TripAdvisor Travelers' Choice 2018–2021</span>
            <span class="marquee-dot">✦</span>
            <span>Carni dei Nebrodi</span>
            <span class="marquee-dot">✦</span>
            <span>Vini Siciliani Selezionati</span>
            <span class="marquee-dot">✦</span>
            <span>Pizza a Lunga Lievitazione</span>
            <span class="marquee-dot">✦</span>
            <span>Cucina Siciliana Autentica</span>
            <span class="marquee-dot">✦</span>
            <span>Pistacchio di Bronte DOP</span>
            <span class="marquee-dot">✦</span>
            <span>TripAdvisor Travelers' Choice 2018–2021</span>
            <span class="marquee-dot">✦</span>
            <span>Carni dei Nebrodi</span>
            <span class="marquee-dot">✦</span>
            <span>Vini Siciliani Selezionati</span>
            <span class="marquee-dot">✦</span>
            <span>Pizza a Lunga Lievitazione</span>
            <span class="marquee-dot">✦</span>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container-xl">
                <div class="row g-5">
                    <div class="col-lg-4" data-aos="fade-up">
                        <div class="footer-brand">
                            <div class="footer-logo-wrap">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="23" stroke="#D4AF37" stroke-width="0.8"/>
                                    <path d="M24 8 C24 8, 35 16, 35 27 C35 33, 30.2 37, 24 37 C17.8 37, 13 33, 13 27 C13 16, 24 8, 24 8Z" fill="#D4AF37" opacity="0.12"/>
                                    <circle cx="24" cy="26" r="4" fill="#D4AF37" opacity="0.8"/>
                                </svg>
                            </div>
                            <h3 class="footer-brand-name">La Locanda del Carrettiere</h3>
                            <p class="footer-tagline">Tradizione siciliana dal cuore dell'Etna</p>
                        </div>
                        <p class="footer-desc">Una cucina autentica tra i profumi dei Nebrodi e la maestosità dell'Etna, dove ogni piatto racconta una storia di terra e passione.</p>
                        <div class="footer-awards">
                            <span class="award-badge">
                                <i class="fas fa-award"></i>
                                TripAdvisor Travelers' Choice 2018–2021
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <h5 class="footer-heading">Naviga</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('menu') }}">Il Nostro Menu</a></li>
                            <li><a href="{{ route('gallery') }}">Galleria</a></li>
                            <li><a href="{{ route('about') }}">Chi Siamo</a></li>
                            <li><a href="{{ route('contact') }}">Contatti</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <h5 class="footer-heading">Orari</h5>
                        <ul class="footer-hours">
                            <li><span>Lunedì</span><span>11:30–14:30 / 19:30–22:00</span></li>
                            <li class="closed"><span>Martedì</span><span>Chiuso</span></li>
                            <li><span>Mer – Gio</span><span>11:30–14:30 / 19:30–22:00</span></li>
                            <li><span>Venerdì</span><span>11:30–14:30 / 19:30–23:30</span></li>
                            <li><span>Sabato</span><span>11:30–14:30 / 19:30–23:45</span></li>
                            <li><span>Domenica</span><span>11:30–14:30 / 19:30–23:30</span></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <h5 class="footer-heading">Dove Siamo</h5>
                        <ul class="footer-contact-list">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Contrada Cantera snc<br>95034 Bronte (CT)</span>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <a href="tel:0957721961">095 7721961</a>
                            </li>
                            <li>
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/390957721961" target="_blank">WhatsApp</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:trattoriagullotti@gmail.com">trattoriagullotti@gmail.com</a>
                            </li>
                        </ul>
                        <div class="footer-social">
                            <a href="#" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-btn" aria-label="TripAdvisor"><i class="fab fa-tripadvisor"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container-xl">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p>&copy; {{ date('Y') }} La Locanda del Carrettiere — P.IVA 05400350871</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>Powered by <a href="https://samueleattina.it" target="_blank" style="color:var(--color-gold);text-decoration:none;">Safix</a> – Samuele Attinà</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/390957721961" class="whatsapp-float" target="_blank" aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span>Prenota su WhatsApp</span>
    </a>
</body>
</html>
