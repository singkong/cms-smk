<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO -->
<section class="hero">
    <div class="hero-particles" id="heroParticles"></div>
    <div class="hero-content container">
        <div class="hero-badge"><i class="ti ti-star-filled icon me-1 text-warning"></i> Akreditasi <?= esc($setting->akreditasi ?? 'A') ?></div>
        <h1 class="hero-title">Selamat Datang di<br><span><?= esc($setting->nama_sekolah) ?></span></h1>
        <p class="hero-desc"><?= esc($setting->deskripsi ?? 'Mencetak generasi unggul, kompeten, dan berdaya saing global di era industri 4.0.') ?></p>
        <div class="hero-btns">
            <a href="/profil" class="btn-hero btn-hero-primary"><i class="ti ti-info-circle icon"></i> Selengkapnya</a>
            <a href="/ppdb" class="btn-hero btn-hero-outline"><i class="ti ti-school icon"></i> Info PPDB</a>
            <a href="/kontak" class="btn-hero btn-hero-outline"><i class="ti ti-message icon"></i> Hubungi Kami</a>
        </div>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#f8fafc" d="M0,48L48,53.3C96,59,192,69,288,64C384,59,480,37,576,37.3C672,37,768,59,864,64C960,69,1056,59,1152,53.3C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path></svg></div>
</section>

<!-- STATS -->
<section style="padding-top:0;">
    <div class="container">
        <div class="row g-3" data-aos="fade-up">
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-primary"><i class="ti ti-users icon"></i></div><div class="stat-number counter" data-target="500">0</div><div class="stat-label">Siswa Aktif</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-success"><i class="ti ti-user-star icon"></i></div><div class="stat-number counter" data-target="50">0</div><div class="stat-label">Guru</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-warning"><i class="ti ti-building icon"></i></div><div class="stat-number"><?= count($jurusans ?? []) ?></div><div class="stat-label">Jurusan</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-card"><div class="stat-icon text-danger"><i class="ti ti-trophy icon"></i></div><div class="stat-number counter" data-target="120">0</div><div class="stat-label">Prestasi</div></div></div>
        </div>
    </div>
</section>

<!-- SAMBUTAN KEPALA SEKOLAH -->
<section style="padding-top:20px;" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Sambutan</span><h2 class="section-title">Kepala Sekolah</h2></div>
        <div class="kepsek-card mx-auto" style="max-width:900px;">
            <img src="<?= base_url('uploads/' . ($setting->foto_kepsek ?? 'default-kepsek.jpg')) ?>" class="kepsek-photo" alt="Kepala Sekolah" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22160%22 height=%22160%22><rect fill=%22%23e2e8f0%22 width=%22160%22 height=%22160%22/><text x=%2280%22 y=%2280%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%2394a3b8%22 font-size=%2240%22>?</text></svg>'">
            <div>
                <span class="quote-mark">&ldquo;</span>
                <p class="lead fst-italic"><?= nl2br(esc($setting->sambutan ?? '')) ?></p>
                <div class="mt-3"><strong class="text-dark"><?= esc($setting->kepsek ?? 'Kepala Sekolah') ?></strong><br><small class="text-muted">Kepala <?= esc($setting->nama_sekolah ?? 'Sekolah') ?></small></div>
            </div>
        </div>
    </div>
</section>

<!-- JURUSAN -->
<?php if (!empty($jurusans)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Program Keahlian</span><h2 class="section-title">Kompetensi Keahlian</h2><p class="section-desc mx-auto">Pilihan program keahlian unggulan sesuai kebutuhan dunia usaha dan industri</p></div>
        <div class="row g-4">
            <?php foreach ($jurusans as $i => $j): ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                <div class="jurusan-card">
                    <img src="<?= base_url('uploads/jurusan/' . ($j->gambar ?? 'default.jpg')) ?>" alt="<?= esc($j->nama) ?>" onerror="this.style.background='linear-gradient(135deg,#e0e7ff,#c7d2fe)';this.style.height='200px'">
                    <?php if ($j->akreditasi): ?><span class="jurusan-badge-ak">Akreditasi <?= esc($j->akreditasi) ?></span><?php endif; ?>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-1"><?= esc($j->nama) ?></h5>
                        <span class="badge bg-primary rounded-pill px-3 py-1 mb-2"><?= esc($j->singkatan) ?></span>
                        <p class="text-muted small mb-3"><?= character_limiter(esc($j->deskripsi ?? ''), 80) ?></p>
                        <a href="/jurusan/<?= $j->id ?>" class="btn btn-outline-primary rounded-pill btn-sm">Detail <i class="ti ti-arrow-right icon ms-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5"><a href="/jurusan" class="btn btn-primary rounded-pill px-5 py-2">Lihat Semua Jurusan <i class="ti ti-arrow-right icon ms-2"></i></a></div>
    </div>
</section>
<?php endif; ?>

<!-- BERITA & PENGUMUMAN -->
<section>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div><span class="section-label">Informasi</span><h2 class="section-title mb-0">Berita Terbaru</h2></div>
                    <a href="/berita" class="text-primary fw-semibold small">Lihat Semua <i class="ti ti-arrow-right icon ms-1"></i></a>
                </div>
                <div class="row g-4">
                    <?php foreach ($berita as $i => $post): ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
                        <div class="card-elevate h-100">
                            <?php if ($post->image): ?><div class="card-img-wrap"><img src="<?= base_url('uploads/posts/' . $post->image) ?>" alt="<?= esc($post->title) ?>"></div><?php endif; ?>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-2 small text-muted"><i class="ti ti-calendar icon me-1"></i> <?= date('d M Y', strtotime($post->created_at)) ?> &bull; <i class="ti ti-user icon me-1"></i> <?= esc($post->author) ?></div>
                                <h5 class="fw-bold mb-2"><?= esc($post->title) ?></h5>
                                <p class="text-muted small flex-grow-1"><?= character_limiter(strip_tags($post->content ?? ''), 90) ?></p>
                                <a href="/berita/<?= esc($post->slug) ?>" class="btn btn-outline-primary rounded-pill btn-sm mt-2 align-self-start">Baca <i class="ti ti-arrow-right icon ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div><span class="section-label">Pengumuman</span><h2 class="section-title mb-0" style="font-size:1.5rem;">Terbaru</h2></div>
                    <a href="/pengumuman" class="text-warning fw-semibold small">Semua <i class="ti ti-arrow-right icon ms-1"></i></a>
                </div>
                <?php foreach ($pengumuman ?? [] as $p): ?>
                <a href="/pengumuman/<?= esc($p->slug) ?>" class="text-decoration-none">
                    <div class="timeline-item">
                        <div class="tl-date"><span class="d"><?= date('d', strtotime($p->created_at)) ?></span><span class="m"><?= date('M', strtotime($p->created_at)) ?></span></div>
                        <div><h6 class="fw-semibold mb-1 text-dark"><?= esc($p->title) ?></h6><p class="text-muted small mb-0"><?= character_limiter(strip_tags($p->content ?? ''), 60) ?></p></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- GALERI -->
<?php if (!empty($galeri_home)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Dokumentasi</span><h2 class="section-title">Galeri Kegiatan</h2></div>
        <div class="row g-3">
            <?php foreach ($galeri_home as $i => $g): ?>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?= $i * 60 ?>">
                <div class="gallery-grid-item">
                    <img src="<?= base_url('uploads/gallery/' . $g->image) ?>" alt="<?= esc($g->title) ?>">
                    <div class="gallery-overlay"><h6 class="text-white mb-0"><?= esc($g->title) ?></h6></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5"><a href="/galeri" class="btn btn-outline-primary rounded-pill px-5 py-2">Lihat Semua Galeri <i class="ti ti-arrow-right icon ms-2"></i></a></div>
    </div>
</section>
<?php endif; ?>

<!-- PARTNER -->
<?php if (!empty($partners)): ?>
<section>
    <div class="container" data-aos="fade-up">
        <div class="section-header"><span class="section-label">Kerjasama</span><h2 class="section-title">Partner DU/DI</h2></div>
        <div class="swiper partnerSwiper"><div class="swiper-wrapper">
            <?php foreach ($partners as $p): ?>
            <div class="swiper-slide text-center"><a href="<?= esc($p->website ?? '#') ?>" target="_blank"><img src="<?= base_url('uploads/partners/' . $p->logo) ?>" alt="<?= esc($p->nama) ?>" style="height:60px;opacity:0.7;transition:opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'"></a></div>
            <?php endforeach; ?>
        </div></div>
    </div>
</section>
<?php endif; ?>

<!-- TESTIMONI -->
<?php if (!empty($testimoni)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Testimoni</span><h2 class="section-title">Apa Kata Alumni</h2></div>
        <div class="swiper testiSwiper pb-4"><div class="swiper-wrapper">
            <?php foreach ($testimoni as $t): ?>
            <div class="swiper-slide"><div class="card-elevate text-center p-4 mx-2">
                <span class="avatar avatar-lg rounded-circle mb-3 bg-primary text-white"><?= strtoupper(substr($t->nama,0,1)) ?></span>
                <p class="fst-italic text-muted">&ldquo;<?= esc($t->pesan) ?>&rdquo;</p>
                <strong class="text-dark"><?= esc($t->nama) ?></strong><br><small class="text-muted"><?= esc($t->jurusan ?? '') ?> - Alumni <?= esc($t->angkatan ?? '') ?></small>
            </div></div>
            <?php endforeach; ?>
        </div><div class="swiper-pagination"></div></div>
    </div>
</section>
<?php endif; ?>

<!-- CTA PPDB -->
<section class="cta-section" data-aos="fade-up">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Bergabung Menjadi Generasi Unggul?</h2>
        <p class="mb-4 text-white-50">Daftarkan diri Anda sekarang di <?= esc($setting->nama_sekolah ?? 'sekolah kami') ?></p>
        <a href="/ppdb" class="btn-hero btn-hero-primary" style="display:inline-flex;"><i class="ti ti-school icon me-2"></i> Informasi PPDB</a>
    </div>
</section>

<script>
// Hero particles
(function(){const c=document.getElementById('heroParticles');for(let i=0;i<40;i++){const d=document.createElement('div');d.className='hero-dot';d.style.left=Math.random()*100+'%';d.style.top=Math.random()*100+'%';d.style.animationDelay=Math.random()*7+'s';d.style.animationDuration=(5+Math.random()*5)+'s';c.appendChild(d);}})();

// Counter animation
const countObserver=new IntersectionObserver(e=>{e.forEach(e=>{if(e.isIntersecting){const t=e.target.querySelectorAll('.counter');t.forEach(e=>{const t=parseInt(e.dataset.target),n=t/50;let o=0;const r=setInterval(()=>{o+=n;if(o>=t){o=t;clearInterval(r)}e.textContent=Math.floor(o)+'+'},30)});countObserver.unobserve(e.target)}})},{threshold:0.4});
document.querySelectorAll('.row.g-3').forEach(e=>e.closest('.container')&&e.parentElement.tagName==='SECTION'&&countObserver.observe(e));

// Swipers
new Swiper('.partnerSwiper',{slidesPerView:3,spaceBetween:20,autoplay:{delay:2000},loop:true,breakpoints:{320:{slidesPerView:2},768:{slidesPerView:4},1024:{slidesPerView:5}}});
new Swiper('.testiSwiper',{slidesPerView:1,spaceBetween:20,autoplay:{delay:4000},loop:true,pagination:{el:'.swiper-pagination',clickable:true},breakpoints:{768:{slidesPerView:2},1024:{slidesPerView:3}}});
</script>

<?= $this->endSection() ?>
