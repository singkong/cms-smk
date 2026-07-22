<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:30vh;"><div class="hero-content container"><h1 class="hero-title" style="font-size:2rem;">Berita</h1></div><div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#f8fafc" d="M0,48L48,53C96,59,192,69,288,64C384,59,480,37,576,37C672,37,768,59,864,64C960,69,1056,59,1152,53C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path></svg></div></section>

<section data-aos="fade-up"><div class="container"><div class="row g-5">
    <div class="col-lg-8">
        <div class="row g-4">
            <?php if (!empty($berita)): foreach ($berita as $i => $post): ?>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= $i*80 ?>">
                <div class="card-elevate h-100">
                    <?php if($post->image): ?><div class="card-img-wrap"><img src="<?= base_url('uploads/posts/'.$post->image) ?>" alt="<?= esc($post->title) ?>"></div><?php endif; ?>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2 small text-muted"><i class="ti ti-calendar icon me-1"></i><?= date('d M Y',strtotime($post->created_at)) ?> &bull; <?= esc($post->author) ?></div>
                        <h5 class="fw-bold"><?= esc($post->title) ?></h5>
                        <p class="text-muted small flex-grow-1"><?= character_limiter(strip_tags($post->content??''),100) ?></p>
                        <a href="/berita/<?= esc($post->slug) ?>" class="btn btn-outline-primary rounded-pill btn-sm mt-2 align-self-start">Baca <i class="ti ti-arrow-right icon ms-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5"><i class="ti ti-news icon fs-1 text-muted opacity-25 d-block mb-3"></i><p class="text-muted">Belum ada berita.</p></div>
            <?php endif; ?>
        </div>
        <?= $pager ?? '' ?>
    </div>
    <div class="col-lg-4">
        <div class="card-elevate p-4 mb-4"><h5 class="fw-bold mb-3">Berita Terbaru</h5><?php if(!empty($recent)): ?><ul class="list-unstyled mb-0"><?php foreach($recent as $r): ?><li class="mb-3 pb-3 border-bottom"><a href="/berita/<?= esc($r->slug) ?>" class="text-decoration-none"><h6 class="fw-semibold text-dark mb-1"><?= esc($r->title) ?></h6><small class="text-muted"><i class="ti ti-calendar icon me-1"></i><?= date('d M Y',strtotime($r->created_at)) ?></small></a></li><?php endforeach; ?></ul><?php endif; ?></div>
        <?php if(!empty($categories)): ?><div class="card-elevate p-4"><h5 class="fw-bold mb-3">Kategori</h5><div class="d-flex flex-wrap gap-2"><?php foreach($categories as $cat): ?><a href="/berita?cat=<?= $cat->id ?>" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none"><?= esc($cat->name) ?></a><?php endforeach; ?></div></div><?php endif; ?>
    </div>
</div></div></section>
<?= $this->endSection() ?>
