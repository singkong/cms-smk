<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- ===== HERO ===== -->
<section class="home-hero" id="heroParticles" style="min-height:92vh;">
    <?php for($i=0;$i<35;$i++): ?><span class="hero-dot" style="left:<?= rand(0,100) ?>%;top:<?= rand(0,100) ?>%;animation-delay:<?= rand(0,70)/10 ?>s;animation-duration:<?= 5+rand(0,40)/10 ?>s;"></span><?php endfor; ?>
    <?php if (!empty($sliders)): ?>
    <div class="swiper heroSwiper"><div class="swiper-wrapper">
        <?php foreach ($sliders as $s): ?>
        <div class="swiper-slide" <?= $s->image ? 'style="background:linear-gradient(135deg,rgba(2,6,23,0.75),rgba(15,23,42,0.8)),url(\''.base_url('uploads/sliders/'.$s->image).'\') center/cover no-repeat"' : '' ?>>
            <div class="hero-content container text-center">
                <div class="hero-badge"><i class="ti ti-star-filled icon me-1 text-warning"></i> Akreditasi <?= esc($setting->akreditasi ?? 'A') ?></div>
                <h1 class="hero-title"><?= esc($s->title) ?></h1>
                <?php if ($s->description): ?><p class="hero-desc"><?= esc($s->description) ?></p><?php endif; ?>
                <div class="hero-btns">
                    <a href="/profil" class="btn-hero btn-hero-primary"><i class="ti ti-info-circle icon"></i> Profil Sekolah</a>
                    <?php if ($s->url): ?><a href="<?= esc($s->url) ?>" class="btn-hero btn-hero-outline"><i class="ti ti-arrow-right icon"></i> Selengkapnya</a><?php endif; ?>
                    <a href="/ppdb#daftar" class="btn-hero btn-hero-outline"><i class="ti ti-school icon"></i> Daftar PPDB</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>
    <?php else: ?>
    <div class="hero-content container text-center">
        <div class="hero-badge"><i class="ti ti-star-filled icon me-1 text-warning"></i> Akreditasi <?= esc($setting->akreditasi ?? 'A') ?></div>
        <h1 class="hero-title">Selamat Datang di<br><span><?= esc($setting->nama_sekolah) ?></span></h1>
        <p class="hero-desc"><?= esc($setting->deskripsi ?? 'Mencetak generasi unggul, kompeten, dan berdaya saing global.') ?></p>
        <div class="hero-btns">
            <a href="/profil" class="btn-hero btn-hero-primary"><i class="ti ti-info-circle icon"></i> Profil Sekolah</a>
            <a href="/ppdb#daftar" class="btn-hero btn-hero-outline"><i class="ti ti-school icon"></i> Daftar PPDB</a>
            <a href="/kontak" class="btn-hero btn-hero-outline"><i class="ti ti-message icon"></i> Hubungi Kami</a>
        </div>
    </div>
    <?php endif; ?>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<!-- ===== STATS ===== -->
<section data-aos="fade-up">
    <div class="container">
        <div class="row g-4" id="statRow">
            <?php foreach ([
                ['icon'=>'users','color'=>'primary','number'=>'500','label'=>'Siswa Aktif'],
                ['icon'=>'user-star','color'=>'success','number'=>'50','label'=>'Guru Profesional'],
                ['icon'=>'building','color'=>'warning','number'=>count($jurusans??[]),'label'=>'Kompetensi Keahlian','counter'=>false],
                ['icon'=>'trophy','color'=>'red','number'=>'100','label'=>'Prestasi'],
            ] as $st): ?>
            <div class="col-6 col-md-3"><div class="stat-card">
                <div class="stat-icon text-<?= $st['color'] ?>"><i class="ti ti-<?= $st['icon'] ?> icon"></i></div>
                <div class="stat-number"><?= ($st['counter'] ?? true) ? '<span class="counter" data-target="'.$st['number'].'">0</span>+' : $st['number'] ?></div>
                <div class="stat-label"><?= $st['label'] ?></div>
            </div></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== JURUSAN ===== -->
<?php if(!empty($jurusans)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Program Keahlian</span><h2 class="section-title">Kompetensi Keahlian</h2><p class="section-desc mx-auto">Pilihan program keahlian unggulan sesuai kebutuhan industri</p></div>
        <div class="row g-4">
            <?php foreach($jurusans as $i=>$j): ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?=$i*80?>">
                <div class="jurusan-card h-100">
                    <img src="<?= base_url('uploads/jurusan/'.($j->gambar??'default.jpg')) ?>" alt="<?= esc($j->nama) ?>" onerror="this.style.background='linear-gradient(135deg,#e0e7ff,#c7d2fe)';this.style.minHeight='200px'">
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

<!-- ===== BERITA ===== -->
<section class="bg-soft" data-aos="fade-up">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div><span class="section-label">Informasi</span><h2 class="section-title mb-0">Berita Terbaru</h2></div>
            <a href="/berita" class="fw-semibold small">Lihat Semua <i class="ti ti-arrow-right icon ms-1"></i></a>
        </div>
        <div class="row g-4">
            <?php foreach($berita as $i=>$post): ?>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?=$i*80?>">
                <div class="card-elevate h-100">
                    <?php if($post->image): ?><div class="card-img-wrap"><img src="<?= base_url('uploads/posts/'.$post->image) ?>" alt="<?= esc($post->title) ?>" loading="lazy"></div><?php endif; ?>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="small text-muted mb-2"><i class="ti ti-calendar icon me-1"></i><?= date('d M Y',strtotime($post->created_at)) ?></div>
                        <h5 class="fw-bold mb-2 lh-sm"><?= esc($post->title) ?></h5>
                        <p class="text-muted small flex-grow-1"><?= character_limiter(strip_tags($post->content??''), 80) ?></p>
                        <a href="/berita/<?= esc($post->slug) ?>" class="btn btn-outline-primary rounded-pill btn-sm mt-2 align-self-start">Baca <i class="ti ti-arrow-right icon ms-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== PENGUMUMAN + QUICK LINKS ===== -->
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div><span class="section-label">Pengumuman</span><h2 class="section-title mb-0">Informasi Terbaru</h2></div>
                    <a href="/pengumuman" class="fw-semibold small text-warning">Semua <i class="ti ti-arrow-right icon ms-1"></i></a>
                </div>
                <?php foreach($pengumuman ?? [] as $p): ?>
                <a href="/pengumuman/<?= esc($p->slug) ?>" class="text-decoration-none">
                    <div class="tl-item">
                        <div class="tl-date"><span class="d"><?= date('d',strtotime($p->created_at)) ?></span><span class="m"><?= date('M',strtotime($p->created_at)) ?></span></div>
                        <div><h6 class="fw-semibold mb-1 text-dark lh-sm"><?= esc($p->title) ?></h6><p class="text-muted small mb-0"><?= character_limiter(strip_tags($p->content??''), 60) ?></p></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-5">
                <div class="mb-4"><span class="section-label">Akses Cepat</span></div>
                <div class="row g-2">
                    <?php foreach ([
                        ['calendar-event','Agenda','/agenda','info'],['trophy','Prestasi','/prestasi','success'],
                        ['download','Download','/download','secondary'],['users','Alumni','/alumni','warning'],
                        ['photo','Galeri','/galeri','primary'],['video','Video','/galeri-video','red'],
                        ['help-circle','FAQ','/faq','purple'],['school','PPDB','/ppdb','pink'],
                    ] as $ql): ?>
                    <div class="col-3"><a href="<?= $ql[2] ?>" class="card card-sm text-decoration-none" style="transition:all .2s;"><div class="card-body text-center py-3 px-1"><i class="ti ti-<?= $ql[0] ?> icon text-<?= $ql[3] ?> d-block mb-1" style="font-size:1.3rem;"></i><small class="text-muted"><?= $ql[1] ?></small></div></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== GALERI ===== -->
<?php if(!empty($galeri_home)): ?>
<section class="bg-soft" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Dokumentasi</span><h2 class="section-title">Galeri Kegiatan</h2></div>
        <div class="row g-3">
            <?php foreach($galeri_home as $i=>$g): ?>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?=$i*50?>">
                <div class="gallery-item"><img src="<?= base_url('uploads/gallery/'.$g->image) ?>" alt="<?= esc($g->title) ?>" loading="lazy"><div class="gallery-overlay"><h6 class="text-white mb-0 small"><?= esc($g->title) ?></h6></div></div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5"><a href="/galeri" class="btn btn-outline-primary rounded-pill px-5 py-2">Lihat Semua <i class="ti ti-arrow-right icon ms-2"></i></a></div>
    </div>
</section>
<?php endif; ?>

<!-- ===== PARTNER ===== -->
<?php if(!empty($partners)): ?>
<section class="bg-white" data-aos="fade-up">
    <div class="container">
        <div class="section-header"><span class="section-label">Kerjasama</span><h2 class="section-title">Partner DU/DI</h2></div>
        <div class="swiper partnerSwiper"><div class="swiper-wrapper align-items-center">
            <?php foreach($partners as $p): ?><div class="swiper-slide text-center px-3"><img src="<?= base_url('uploads/partners/'.$p->logo) ?>" alt="<?= esc($p->nama) ?>" style="height:50px;opacity:.65;filter:grayscale(100%);transition:all .3s;" onmouseover="this.style.opacity='1';this.style.filter='none'" onmouseout="this.style.opacity='.65';this.style.filter='grayscale(100%)'"></div><?php endforeach; ?>
        </div></div>
    </div>
</section>
<?php endif; ?>

<!-- ===== TESTIMONI ===== -->
<?php if(!empty($testimoni)): ?>
<section class="bg-soft" data-aos="fade-up">
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

<!-- ===== CTA PPDB ===== -->
<section class="cta" data-aos="fade-up">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Bergabung Menjadi Generasi Unggul?</h2>
        <p class="mb-4 text-white-50">Daftarkan diri Anda sekarang di <?= esc($setting->nama_sekolah ?? 'sekolah kami') ?></p>
        <a href="/ppdb#daftar" class="btn-hero btn-hero-primary" style="display:inline-flex;"><i class="ti ti-school icon me-2"></i> Daftar PPDB Sekarang</a>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
const co=new IntersectionObserver(e=>{e.forEach(e=>{if(e.isIntersecting){e.target.querySelectorAll('.counter').forEach(e=>{const t=parseInt(e.dataset.target),n=t/50;let o=0;const r=setInterval(()=>{o+=n;if(o>=t){o=t;clearInterval(r)}e.textContent=Math.floor(o)},25)});co.unobserve(e.target)}})},{threshold:.4});
document.getElementById('statRow')&&co.observe(document.getElementById('statRow'));
new Swiper('.heroSwiper',{slidesPerView:1,spaceBetween:0,autoplay:{delay:5000,pauseOnMouseEnter:true},loop:true,pagination:{el:'.swiper-pagination',clickable:true},navigation:{nextEl:'.swiper-button-next',prevEl:'.swiper-button-prev'}});
new Swiper('.partnerSwiper',{slidesPerView:2,spaceBetween:20,autoplay:{delay:2000},loop:true,breakpoints:{640:{slidesPerView:3},1024:{slidesPerView:5}}});
new Swiper('.testiSwiper',{slidesPerView:1,spaceBetween:20,autoplay:{delay:4000},loop:true,pagination:{el:'.swiper-pagination',clickable:true},breakpoints:{768:{slidesPerView:2},1024:{slidesPerView:3}}});
</script>
<?= $this->endSection() ?>
