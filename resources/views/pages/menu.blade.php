@extends('layouts.app')

@section('title', 'Menu')
@section('meta-description', 'Scopri il menu de La Locanda del Carrettiere a Bronte: antipasti siciliani, primi con pistacchio di Bronte DOP, carni dei Nebrodi, pizza a lunga lievitazione e dessert tradizionali.')
@section('og-title', 'Il Menu | La Locanda del Carrettiere – Trattoria Siciliana Bronte')
@section('og-description', 'Antipasti siciliani, primi piatti con pistacchio DOP, secondi di carne dei Nebrodi, pizza artigianale e dolci tradizionali. Prenota il tuo tavolo a Bronte.')

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container-xl page-hero-content">
        <div data-aos="fade-up">
            <p class="section-eyebrow">Cucina siciliana</p>
            <h1>Il Nostro <em>Menu</em></h1>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span class="sep">—</span>
                <span>Menu</span>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<section class="section-pad bg-dark">
    <div class="container-xl">

        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-lead" style="max-width:620px;margin:0 auto;">
                Una selezione di piatti che celebra la tradizione siciliana con ingredienti freschi, km zero e il prezioso pistacchio di Bronte DOP.
            </p>
        </div>

        <!-- Tabs -->
        <div class="menu-tabs" data-aos="fade-up">
            @foreach($menu as $key => $category)
            <button class="menu-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $key }}">
                <span class="tab-emoji">{{ $category['icon'] }}</span>
                {{ $category['label'] }}
            </button>
            @endforeach
        </div>

        <!-- Categories -->
        @foreach($menu as $key => $category)
        <div class="menu-category {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}">
            <div class="menu-category-header" data-aos="fade-up">
                <span style="font-size:2.5rem;display:block;margin-bottom:16px;">{{ $category['icon'] }}</span>
                <h2 class="section-title">{{ $category['label'] }}</h2>
                <p>{{ $category['description'] }}</p>
            </div>

            @if(isset($category['note']))
            <div class="menu-note" data-aos="fade-up">
                <i class="fas fa-info-circle me-2"></i>
                {{ $category['note'] }}
            </div>
            @endif

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    @foreach($category['items'] as $i => $item)
                    <div class="menu-item" data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 60 }}">
                        <div class="menu-item-content">
                            <div class="menu-item-name">
                                {{ $item['name'] }}
                                @if($item['tag'])
                                <span class="menu-tag tag-{{ $item['tag'] }}">
                                    @if($item['tag'] === 'signature') Chef's
                                    @elseif($item['tag'] === 'pistachio') Pistacchio
                                    @else Classico
                                    @endif
                                </span>
                                @endif
                            </div>
                            <p class="menu-item-desc">{{ $item['desc'] }}</p>
                        </div>
                        <div class="menu-item-price">{{ number_format((float)$item['price'], 2, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <!-- Note legali -->
        <div class="text-center mt-5" data-aos="fade-up" style="border-top:1px solid rgba(212,175,55,.1);padding-top:40px;">
            <p style="font-size:.78rem;color:var(--color-text-muted);line-height:1.8;">
                I prezzi indicati sono IVA inclusa. Il coperto non è previsto.<br>
                Disponibile menù senza glutine per piatti selezionati · Informare il personale di allergie o intolleranze.<br>
                Il menu potrebbe variare in base alla stagionalità degli ingredienti.
            </p>
        </div>

    </div>
</section>

<!-- CTA Strip -->
<section class="cta-strip">
    <div class="texture-overlay"></div>
    <div class="container-xl" data-aos="fade-up">
        <h2 class="section-title">Ti è venuta l'acquolina?</h2>
        <p>Prenota il tuo tavolo e vivi un'esperienza culinaria indimenticabile.</p>
        <div class="cta-actions">
            <a href="tel:0957721961" class="btn-gold-solid">
                <i class="fas fa-phone-alt"></i>
                <span>Prenota Ora</span>
            </a>
            <a href="https://wa.me/390957721961" class="btn-gold" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.menu-tab-btn');
    const categories = document.querySelectorAll('.menu-category');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.dataset.tab;
            tabs.forEach(t => t.classList.remove('active'));
            categories.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('tab-' + target).classList.add('active');
        });
    });
});
</script>
@endsection
