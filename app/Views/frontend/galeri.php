<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:30vh;"><div class="hero-content container"><h1 class="hero-title" style="font-size:2rem;">Galeri Foto</h1></div><div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#f8fafc" d="M0,48L48,53C96,59,192,69,288,64C384,59,480,37,576,37C672,37,768,59,864,64C960,69,1056,59,1152,53C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path></svg></div></section>

<section data-aos="fade-up"><div class="container">
    <?php if(!empty($albums)): ?><div class="d-flex flex-wrap gap-2 mb-4"><a href="/galeri" class="btn btn-sm <?= !$current_album ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill">Semua</a><?php foreach($albums as $a): ?><a href="/galeri?album=<?= $a->id ?>" class="btn btn-sm <?= $current_album == $a->id ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill"><?= esc($a->name) ?></a><?php endforeach; ?></div><?php endif; ?>
    <div class="row g-3">
        <?php if(!empty($photos)): foreach($photos as $i => $g): ?>
        <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?= $i*50 ?>">
            <div class="gallery-grid-item" data-bs-toggle="modal" data-bs-target="#lightbox<?= $g->id ?>">
                <img src="<?= base_url('uploads/gallery/'.$g->image) ?>" alt="<?= esc($g->title) ?>">
                <div class="gallery-overlay"><h6 class="text-white mb-0"><?= esc($g->title) ?></h6></div>
            </div>
            <div class="modal fade" id="lightbox<?= $g->id ?>" tabindex="-1"><div class="modal-dialog modal-fullscreen modal-dialog-centered"><div class="modal-content bg-transparent border-0"><div class="modal-body text-center p-0"><img src="<?= base_url('uploads/gallery/'.$g->image) ?>" class="img-fluid" style="max-height:90vh;" alt="<?= esc($g->title) ?>"><button class="btn btn-light position-fixed top-0 end-0 m-3 rounded-circle" data-bs-dismiss="modal"><i class="ti ti-x icon"></i></button></div></div></div></div>
        </div>
        <?php endforeach; else: ?>
        <div class="col-12 text-center py-5"><p class="text-muted">Belum ada foto.</p></div>
        <?php endif; ?>
    </div>
    <?= $pager ?? '' ?>
</div></section>
<?= $this->endSection() ?>
