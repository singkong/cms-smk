<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sejarah</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Sejarah Sekolah</h2>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($sejarah)): ?>
                    <div class="card">
                        <div class="card-body p-5">
                            <div style="font-size:1.05rem;line-height:1.9;white-space:pre-line;">
                                <?= esc($sejarah) ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty">
                        <div class="empty-icon">
                            <i class="ti ti-book icon" style="font-size:4rem;"></i>
                        </div>
                        <p class="empty-title">Belum ada sejarah</p>
                        <p class="empty-subtitle text-muted">Informasi sejarah sekolah belum tersedia.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
