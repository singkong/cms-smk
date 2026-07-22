<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO SLIDER -->
<?php if (!empty($sliders)): ?>
<section class="hero-slider" id="heroParticles">
    <?php for($i=0;$i<35;$i++): ?><span class="hero-dot" style="left:<?= rand(0,100) ?>%;top:<?= rand(0,100) ?>%;animation-delay:<?= rand(0,70)/10 ?>s;animation-duration:<?= 5+rand(0,40)/10 ?>s;"></span><?php endfor; ?>
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php foreach ($sliders as $s): ?>
            <div class="swiper-slide">
                <div class="hero-content container">
                    <?php if ($s->image): ?>
                    <img src="<?= base_url('uploads/sliders/' . $s->image) ?>" alt="<?= esc($s->title) ?>" style="max-width:400px;max-height:200px;margin-bottom:24px;border-radius:12px;">
                    <?php endif; ?>
                    <div class="hero-badge"><i class="ti ti-star-filled icon me-1 text-warning"></i> Akreditasi <?= esc($setting->akreditasi ?? 'A') ?></div>
                    <h1 class="hero-title"><?= esc($s->title) ?></h1>
                    <?php if ($s->description): ?><p class="hero-desc text-balance"><?= esc($s->description) ?></p><?php endif; ?>
                    <div class="hero-btns">
                        <a href="/profil" class="btn-hero btn-hero-primary"><i class="ti ti-info-circle icon"></i> Selengkapnya</a>
                        <?php if ($s->url): ?><a href="<?= esc($s->url) ?>" class="btn-hero btn-hero-outline"><i class="ti ti-arrow-right icon"></i> Lihat</a><?php endif; ?>
                        <a href="/ppdb#daftar" class="btn-hero btn-hero-outline"><i class="ti ti-school icon"></i> Daftar PPDB</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>
<style>
    .hero-slider { position: relative; min-height: 90vh; background: linear-gradient(135deg, #020617 0%, #0f172a 30%, #1e3a5f 60%, #1d4ed8 100%); overflow: hidden; }
    .hero-slider::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 20% 80%, rgba(37,99,235,0.22) 0%, transparent 55%), radial-gradient(ellipse at 80% 20%, rgba(124,58,237,0.18) 0%, transparent 55%); }
    .hero-slider .hero-content { padding: 80px 0 60px; }
    .hero-slider .swiper { width: 100%; height: 100%; }
    .hero-slider .swiper-pagination-bullet { background: rgba(255,255,255,0.5); }
    .hero-slider .swiper-pagination-bullet-active { background: #fff; }
    .hero-slider .swiper-button-prev, .hero-slider .swiper-button-next { color: rgba(255,255,255,0.7); }
    .hero-slider .swiper-button-prev:hover, .hero-slider .swiper-button-next:hover { color: #fff; }
</style>
<?php else: ?>
<!-- Static Hero (fallback) -->
<section class="hero" id="heroParticles">
    <?php for($i=0;$i<35;$i++): ?><span class="hero-dot" style="left:<?= rand(0,100) ?>%;top:<?= rand(0,100) ?>%;animation-delay:<?= rand(0,70)/10 ?>s;animation-duration:<?= 5+rand(0,40)/10 ?>s;"></span><?php endfor; ?>
    <div class="hero-content container">
        <div class="hero-badge"><i class="ti ti-star-filled icon me-1 text-warning"></i> Akreditasi <?= esc($setting->akreditasi ?? 'A') ?></div>
        <h1 class="hero-title">Selamat Datang di<br><span><?= esc($setting->nama_sekolah) ?></span></h1>
        <p class="hero-desc text-balance"><?= esc($setting->deskripsi ?? 'Mencetak generasi unggul, kompeten, dan berdaya saing global di era industri 4.0.') ?></p>
        <div class="hero-btns">
            <a href="/profil" class="btn-hero btn-hero-primary"><i class="ti ti-info-circle icon"></i> Selengkapnya</a>
            <a href="/ppdb#daftar" class="btn-hero btn-hero-outline"><i class="ti ti-school icon"></i> Daftar PPDB</a>
            <a href="/kontak" class="btn-hero btn-hero-outline"><i class="ti ti-message icon"></i> Hubungi Kami</a>
        </div>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>
<?php endif; ?>

<!-- STATS -->
<section style="padding-top:20px;" data-aos="fade-up">
    <div class="container">
        <div class="row g-4" id="statRow">
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-primary"><i class="ti ti-users icon"></i></div><div class="stat-number"><span class="counter" data-target="500">0</span>+</div><div class="stat-label">Siswa Aktif</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-success"><i class="ti ti-user-star icon"></i></div><div class="stat-number"><span class="counter" data-target="50">0</span>+</div><div class="stat-label">Guru</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-warning"><i class="ti ti-building icon"></i></div><div class="stat-number"><?= count($jurusans ?? []) ?></div><div class="stat-label">Jurusan</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-red"><i class="ti ti-trophy icon"></i></div><div class="stat-number"><span class="counter" data-target="120">0</span>+</div><div class="stat-label">Prestasi</div></div></div>
        </div>
    </div>
</section>

<!-- JURUSAN -->
<?php if(!empty($jurusans)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Program Keahlian</span><h2 class="section-title">Kompetensi Keahlian</h2><p class="section-desc mx-auto">Pilihan program keahlian unggulan sesuai kebutuhan dunia usaha dan industri</p></div>
        <div class="row g-4">
            <?php foreach($jurusans as $i=>$j): ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?=$i*80?>">
                <div class="jurusan-card h-100">
                    <img src="<?= base_url('uploads/jurusan/'.($j->gambar??'default.jpg')) ?>" alt="<?= esc($j->nama) ?>" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22><rect fill=%22%23e2e8f0%22 width=%22400%22 height=%22200%22/></svg>'">
                    <?php if($j->akreditasi): ?><span class="jurusan-badge-ak">Akreditasi <?= esc($j->akreditasi) ?></span><?php endif; ?>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-1"><?= esc($j->nama) ?></h5>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 mb-2 fw-medium"><?= esc($j->singkatan) ?></span>
                        <p class="text-muted small mb-3"><?= character_limiter(esc($j->deskripsi??''), 80) ?></p>
                        <a href="/jurusan/<?= $j->id ?>" class="btn btn-outline-primary rounded-pill btn-sm px-3">Detail <i class="ti ti-arrow-right icon ms-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5"><a href="/jurusan" class="btn btn-primary rounded-pill px-5 py-2">Lihat Semua Jurusan <i class="ti ti-arrow-right icon ms-2"></i></a></div>
    </div>
</section>
<?php endif; ?>

<!-- BERITA + PENGUMUMAN -->
<section class="bg-soft">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="d-flex justify-content-between align-items-end mb-4"><div><span class="section-label">Informasi</span><h2 class="section-title mb-0">Berita Terbaru</h2></div><a href="/berita" class="fw-semibold small">Lihat Semua <i class="ti ti-arrow-right icon ms-1"></i></a></div>
                <div class="row g-4">
                    <?php foreach($berita as $i=>$post): ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?=$i*80?>">
                        <div class="card-elevate h-100">
                            <?php if($post->image): ?><div class="card-img-wrap"><img src="<?= base_url('uploads/posts/'.$post->image) ?>" alt="<?= esc($post->title) ?>"></div><?php endif; ?>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="small text-muted mb-2"><i class="ti ti-calendar icon me-1"></i><?= date('d M Y',strtotime($post->created_at)) ?> &bull; <?= esc($post->author) ?></div>
                                <h5 class="fw-bold mb-2 lh-sm"><?= esc($post->title) ?></h5>
                                <p class="text-muted small flex-grow-1"><?= character_limiter(strip_tags($post->content??''), 90) ?></p>
                                <a href="/berita/<?= esc($post->slug) ?>" class="btn btn-outline-primary rounded-pill btn-sm mt-2 align-self-start">Baca <i class="ti ti-arrow-right icon ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div class="d-flex justify-content-between align-items-end mb-4"><div><span class="section-label">Pengumuman</span><h2 class="section-title mb-0" style="font-size:1.4rem;">Terbaru</h2></div><a href="/pengumuman" class="fw-semibold small text-warning">Semua <i class="ti ti-arrow-right icon ms-1"></i></a></div>
                <?php foreach($pengumuman ?? [] as $p): ?>
                <a href="/pengumuman/<?= esc($p->slug) ?>" class="text-decoration-none">
                    <div class="tl-item">
                        <div class="tl-date"><span class="d"><?= date('d',strtotime($p->created_at)) ?></span><span class="m"><?= date('M',strtotime($p->created_at)) ?></span></div>
                        <div><h6 class="fw-semibold mb-1 text-dark lh-sm"><?= esc($p->title) ?></h6><p class="text-muted small mb-0"><?= character_limiter(strip_tags($p->content??''), 60) ?></p></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- GALERI -->
<?php if(!empty($galeri_home)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Dokumentasi</span><h2 class="section-title">Galeri Kegiatan</h2></div>
        <div class="row g-3">
            <?php foreach($galeri_home as $i=>$g): ?>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?=$i*50?>">
                <div class="gallery-item">
                    <img src="<?= base_url('uploads/gallery/'.$g->image) ?>" alt="<?= esc($g->title) ?>" loading="lazy">
                    <div class="gallery-overlay"><h6 class="text-white mb-0 small"><?= esc($g->title) ?></h6></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5"><a href="/galeri" class="btn btn-outline-primary rounded-pill px-5 py-2">Lihat Semua Galeri <i class="ti ti-arrow-right icon ms-2"></i></a></div>
    </div>
</section>
<?php endif; ?>

<!-- PARTNER -->
<?php if(!empty($partners)): ?>
<section class="bg-soft" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Kerjasama</span><h2 class="section-title">Partner DU/DI</h2></div>
        <div class="swiper partnerSwiper"><div class="swiper-wrapper align-items-center">
            <?php foreach($partners as $p): ?><div class="swiper-slide text-center px-3"><img src="<?= base_url('uploads/partners/'.$p->logo) ?>" alt="<?= esc($p->nama) ?>" style="height:50px;opacity:.65;transition:opacity .3s;filter:grayscale(100%);" onmouseover="this.style.opacity='1';this.style.filter='none'" onmouseout="this.style.opacity='.65';this.style.filter='grayscale(100%)'"></div><?php endforeach; ?>
        </div></div>
    </div>
</section>
<?php endif; ?>

<!-- TESTIMONI -->
<?php if(!empty($testimoni)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Testimoni</span><h2 class="section-title">Apa Kata Alumni</h2></div>
        <div class="swiper testiSwiper pb-5"><div class="swiper-wrapper">
            <?php foreach($testimoni as $t): ?>
            <div class="swiper-slide"><div class="card-elevate text-center p-4 mx-2">
                <span class="avatar avatar-lg rounded-circle mb-3 bg-primary text-white fw-bold"><?= strtoupper(substr($t->nama,0,1)) ?></span>
                <p class="fst-italic text-muted mb-3">&ldquo;<?= esc($t->pesan) ?>&rdquo;</p>
                <strong class="text-dark"><?= esc($t->nama) ?></strong><br><small class="text-muted"><?= esc($t->jurusan??'') ?> &bull; Alumni <?= esc($t->angkatan??'') ?></small>
            </div></div>
            <?php endforeach; ?>
        </div><div class="swiper-pagination"></div></div>
    </div>
</section>
<?php endif; ?>

<!-- CTA PPDB -->
<section class="cta" data-aos="fade-up">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Bergabung Menjadi Generasi Unggul?</h2>
        <p class="mb-4 text-white-50">Daftarkan diri Anda sekarang di <?= esc($setting->nama_sekolah ?? 'sekolah kami') ?></p>
        <a href="/ppdb#daftar" class="btn-hero btn-hero-primary" style="display:inline-flex;"><i class="ti ti-school icon me-2"></i> Daftar PPDB Sekarang</a>
    </div>
</section>

<script>
const co=new IntersectionObserver(e=>{e.forEach(e=>{if(e.isIntersecting){e.target.querySelectorAll('.counter').forEach(e=>{const t=parseInt(e.dataset.target),n=t/50;let o=0;const r=setInterval(()=>{o+=n;if(o>=t){o=t;clearInterval(r)}e.textContent=Math.floor(o)},25)});co.unobserve(e.target)}})},{threshold:.4});
document.getElementById('statRow')&&co.observe(document.getElementById('statRow'));
new Swiper('.heroSwiper',{slidesPerView:1,spaceBetween:0,autoplay:{delay:5000,pauseOnMouseEnter:true},loop:true,pagination:{el:'.swiper-pagination',clickable:true},navigation:{nextEl:'.swiper-button-next',prevEl:'.swiper-button-prev'}});
new Swiper('.partnerSwiper',{slidesPerView:2,spaceBetween:20,autoplay:{delay:2000,pauseOnMouseEnter:true},loop:true,breakpoints:{640:{slidesPerView:3},1024:{slidesPerView:5}}});
new Swiper('.testiSwiper',{slidesPerView:1,spaceBetween:20,autoplay:{delay:4000},loop:true,pagination:{el:'.swiper-pagination',clickable:true},breakpoints:{768:{slidesPerView:2},1024:{slidesPerView:3}}});
</script>
<?= $this->endSection() ?>
