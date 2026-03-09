@extends('layouts.app')

@section('title', 'Galleria')

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1920&q=80');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container-xl page-hero-content">
        <div data-aos="fade-up">
            <p class="section-eyebrow">In immagini</p>
            <h1>La nostra <em>Galleria</em></h1>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span class="sep">—</span>
                <span>Galleria</span>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Categories -->
<section class="section-pad bg-dark">
    <div class="container-xl">

        <!-- Filter Buttons -->
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5" data-aos="fade-up">
            <button class="btn-gold gallery-filter active" data-filter="all">Tutto</button>
            <button class="btn-ghost gallery-filter" data-filter="piatti">Piatti</button>
            <button class="btn-ghost gallery-filter" data-filter="locale">Il Locale</button>
            <button class="btn-ghost gallery-filter" data-filter="territorio">Territorio</button>
        </div>

        <!-- Masonry Grid -->
        <div class="gallery-grid" id="gallery-grid" data-aos="fade-up" data-aos-delay="100">

            @php
            $images = [
                ['url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=700&q=80', 'caption' => 'La sala principale', 'cat' => 'locale'],
                ['url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=700&q=80', 'caption' => 'Antipasto rustico della casa', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?w=700&q=80', 'caption' => 'Pasta della tradizione', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=700&q=80', 'caption' => 'Atmosfera serale', 'cat' => 'locale'],
                ['url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=700&q=80', 'caption' => 'Piatti siciliani', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=700&q=80', 'caption' => 'Selezione di vini', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=700&q=80', 'caption' => 'Pizza artigianale', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=700&q=80', 'caption' => 'Vista sull\'Etna', 'cat' => 'territorio'],
                ['url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=700&h=900&q=80', 'caption' => 'Cena in terrazza', 'cat' => 'locale'],
                ['url' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?w=700&q=80', 'caption' => 'Dolci della tradizione', 'cat' => 'piatti'],
                ['url' => 'https://images.unsplash.com/photo-1485962398705-ef6a13c41e8f?w=700&q=80', 'caption' => 'I Nebrodi', 'cat' => 'territorio'],
                ['url' => 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=700&q=80', 'caption' => 'Pistacchio di Bronte', 'cat' => 'territorio'],
            ];
            @endphp

            @foreach($images as $img)
            <div class="gallery-item" data-cat="{{ $img['cat'] }}">
                <img
                    src="{{ $img['url'] }}"
                    alt="{{ $img['caption'] }}"
                    loading="lazy"
                    data-lightbox="{{ $img['url'] }}"
                >
                <div class="gallery-item-overlay">
                    <div>
                        <span class="gallery-item-caption">{{ $img['caption'] }}</span>
                        <br>
                        <span style="font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--color-gold);margin-top:4px;display:block;">
                            @if($img['cat'] === 'piatti') Piatti
                            @elseif($img['cat'] === 'locale') Il Locale
                            @else Territorio
                            @endif
                        </span>
                    </div>
                    <i class="fas fa-expand ms-auto" style="color:var(--color-gold);font-size:.8rem;align-self:flex-end;"></i>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" id="lightbox-close"><i class="fas fa-times"></i></button>
    <img src="" alt="" id="lightbox-img">
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Filter
    const filterBtns = document.querySelectorAll('.gallery-filter');
    const items = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const filter = this.dataset.filter;
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.classList.add('btn-ghost');
                b.classList.remove('btn-gold');
            });
            this.classList.add('active', 'btn-gold');
            this.classList.remove('btn-ghost');
            items.forEach(item => {
                if (filter === 'all' || item.dataset.cat === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');

    items.forEach(item => {
        const img = item.querySelector('img');
        item.addEventListener('click', function () {
            lightboxImg.src = img.dataset.lightbox || img.src;
            lightboxImg.alt = img.alt;
            lightbox.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeLightbox() {
        lightbox.classList.remove('open');
        document.body.style.overflow = '';
        setTimeout(() => { lightboxImg.src = ''; }, 400);
    }

    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });
});
</script>
@endsection
