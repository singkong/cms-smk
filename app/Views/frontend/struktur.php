<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Struktur Organisasi</h2>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($struktur_image)): ?>
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <img src="<?= esc($struktur_image) ?>" alt="Struktur Organisasi" class="img-fluid rounded" style="max-width:100%;">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($struktur_organisasi)): ?>
                    <div class="card mt-4">
                        <div class="card-body p-5">
                            <div style="font-size:1.05rem;line-height:1.9;white-space:pre-line;">
                                <?= esc($struktur_organisasi) ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (empty($struktur_image) && empty($struktur_organisasi)): ?>
                    <div class="empty">
                        <div class="empty-icon">
                            <i class="ti ti-hierarchy-2 icon" style="font-size:4rem;"></i>
                        </div>
                        <p class="empty-title">Belum ada data</p>
                        <p class="empty-subtitle text-muted">Informasi struktur organisasi belum tersedia.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
