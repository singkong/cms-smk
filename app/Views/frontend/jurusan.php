<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;">
    <div class="hero-content container text-center">
        <h1 class="hero-title">Kompetensi Keahlian</h1>
        <p class="hero-desc">Program keahlian unggulan di <?= esc($setting->nama_sekolah ?? 'SMK') ?></p>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
        <?php if (empty($jurusans)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-certificate icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada data jurusan</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($jurusans as $j): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-sm h-100 shadow-sm border-0">
                        <?php if (!empty($j->gambar)): ?>
                            <div style="height:200px;overflow:hidden;">
                                <img src="<?= base_url('uploads/jurusan/' . $j->gambar) ?>" alt="<?= esc($j->nama) ?>" class="card-img-top" style="height:100%;width:100%;object-fit:cover;">
                            </div>
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                <i class="ti ti-certificate icon text-muted" style="font-size:4rem;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h4 class="card-title mb-0"><?= esc($j->nama) ?></h4>
                                <?php if (!empty($j->singkatan)): ?>
                                    <span class="badge bg-blue ms-auto"><?= esc($j->singkatan) ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($j->akreditasi)): ?>
                                <span class="badge bg-success mb-2">Akreditasi <?= esc($j->akreditasi) ?></span>
                            <?php endif; ?>
                            <p class="text-muted mb-3" style="line-height:1.7;">
                                <?= esc(strip_tags($j->deskripsi ?? '')) ?>
                            </p>
                            <?php if (!empty($j->kepala_jurusan)): ?>
                                <p class="text-muted small mb-3">
                                    <i class="ti ti-user icon me-1"></i> Ka. Jurusan: <?= esc($j->kepala_jurusan) ?>
                                </p>
                            <?php endif; ?>
                            <a href="<?= base_url('jurusan/' . $j->id) ?>" class="btn btn-primary w-100">
                                <i class="ti ti-info-circle icon me-1"></i> Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
