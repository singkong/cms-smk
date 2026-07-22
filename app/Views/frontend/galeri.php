<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:30vh;"><div class="hero-content container"><h1 class="hero-title" style="font-size:2rem;">Galeri Foto</h1></div><div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div></section>

<section data-aos="fade-up"><div class="container">
    <?php if(!empty($albums)): ?><div class="d-flex flex-wrap gap-2 mb-4"><a href="/galeri" class="btn btn-sm <?= !$current_album ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill">Semua</a><?php foreach($albums as $a): ?><a href="/galeri?album=<?= $a->id ?>" class="btn btn-sm <?= $current_album == $a->id ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill"><?= esc($a->name) ?></a><?php endforeach; ?></div><?php endif; ?>
    <div class="row g-3">
        <?php if(!empty($photos)): foreach($photos as $i => $g): ?>
        <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?= $i*50 ?>">
            <div class="gallery-grid-item" onclick="openLightbox(<?= $i ?>)">
                <img src="<?= base_url('uploads/gallery/'.$g->image) ?>" alt="<?= esc($g->title) ?>" loading="lazy">
                <div class="gallery-overlay"><h6 class="text-white mb-0"><?= esc($g->title) ?></h6></div>
            </div>
        </div>
        <?php endforeach; else: ?>
        <div class="col-12 text-center py-5"><p class="text-muted">Belum ada foto.</p></div>
        <?php endif; ?>
    </div>
    <?= $pager ?? '' ?>
</div></section>

<!-- Lightbox -->
<div id="lightbox" class="lightbox-overlay" onclick="closeLightbox(event)">
    <button class="lightbox-close" onclick="closeLightbox()"><i class="ti ti-x icon"></i></button>
    <button class="lightbox-prev" onclick="event.stopPropagation();navigateLightbox(-1)"><i class="ti ti-chevron-left icon"></i></button>
    <button class="lightbox-next" onclick="event.stopPropagation();navigateLightbox(1)"><i class="ti ti-chevron-right icon"></i></button>
    <img id="lightbox-img" src="" alt="" onclick="event.stopPropagation()">
    <div id="lightbox-caption" class="lightbox-caption"></div>
    <div id="lightbox-counter" class="lightbox-counter"></div>
</div>

<style>
    .lightbox-overlay { display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.92); cursor: zoom-out; align-items: center; justify-content: center; }
    .lightbox-overlay.active { display: flex; }
    .lightbox-overlay img { max-width: 90vw; max-height: 85vh; object-fit: contain; border-radius: 4px; transition: transform .3s; cursor: default; }
    .lightbox-close { position: fixed; top: 16px; right: 16px; z-index: 10001; width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.12); border: none; color: #fff; font-size: 1.3rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
    .lightbox-close:hover { background: rgba(255,255,255,0.22); }
    .lightbox-prev, .lightbox-next { position: fixed; top: 50%; transform: translateY(-50%); z-index: 10001; width: 48px; height: 48px; border-radius: 50%; background: rgba(255,255,255,0.1); border: none; color: #fff; font-size: 1.4rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
    .lightbox-prev:hover, .lightbox-next:hover { background: rgba(255,255,255,0.25); }
    .lightbox-prev { left: 16px; } .lightbox-next { right: 16px; }
    .lightbox-caption { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); color: #fff; font-size: .9rem; background: rgba(0,0,0,0.5); padding: 6px 18px; border-radius: 50px; }
    .lightbox-counter { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); color: rgba(255,255,255,0.6); font-size: .8rem; }
    @media (max-width:768px) { .lightbox-prev, .lightbox-next { width: 38px; height: 38px; font-size: 1rem; } }
</style>

<script>
const galleryImages = <?= json_encode(array_map(function($g) { return ['src'=>base_url('uploads/gallery/'.$g->image),'title'=>$g->title]; }, $photos ?? [])) ?>;
let currentIndex = 0;

function openLightbox(index) {
    currentIndex = index;
    updateLightbox();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target !== document.getElementById('lightbox')) return;
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

function navigateLightbox(dir) {
    currentIndex = (currentIndex + dir + galleryImages.length) % galleryImages.length;
    updateLightbox();
}

function updateLightbox() {
    const item = galleryImages[currentIndex];
    document.getElementById('lightbox-img').src = item.src;
    document.getElementById('lightbox-img').alt = item.title;
    document.getElementById('lightbox-caption').textContent = item.title;
    document.getElementById('lightbox-counter').textContent = (currentIndex + 1) + ' / ' + galleryImages.length;
}

document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('active')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') navigateLightbox(-1);
    if (e.key === 'ArrowRight') navigateLightbox(1);
});
</script>
<?= $this->endSection() ?>
