<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fasilitas</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-2">Fasilitas</h2>
        <p class="text-center text-muted mb-5">Fasilitas pendukung kegiatan belajar mengajar</p>

        <?php if (empty($fasilitas)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-building icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada data fasilitas</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($fasilitas as $f): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-sm h-100 shadow-sm border-0">
                        <?php if (!empty($f->gambar)): ?>
                            <div style="height:200px;overflow:hidden;">
                                <img src="<?= esc($f->gambar) ?>" alt="<?= esc($f->nama) ?>" class="card-img-top" style="height:100%;width:100%;object-fit:cover;">
                            </div>
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                <?php if (!empty($f->ikon)): ?>
                                    <i class="ti ti-<?= esc($f->ikon) ?> icon text-primary" style="font-size:4rem;"></i>
                                <?php else: ?>
                                    <i class="ti ti-building icon text-muted" style="font-size:4rem;"></i>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <?php if (!empty($f->ikon)): ?>
                                    <i class="ti ti-<?= esc($f->ikon) ?> icon text-primary me-2" style="font-size:1.5rem;"></i>
                                <?php endif; ?>
                                <h4 class="card-title mb-0"><?= esc($f->nama) ?></h4>
                            </div>
                            <p class="text-muted mb-0"><?= esc($f->deskripsi ?? '') ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
