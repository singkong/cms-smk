<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kompetensi Keahlian</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-2">Kompetensi Keahlian</h2>
        <p class="text-center text-muted mb-5">Program keahlian yang tersedia di <?= esc($setting->nama_sekolah ?? 'SMK') ?></p>

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
                                <?= esc(character_limiter(strip_tags($j->deskripsi ?? ''), 120)) ?>
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
