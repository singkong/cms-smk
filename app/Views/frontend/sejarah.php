<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;">
    <div class="hero-content container text-center">
        <h1 class="hero-title">Sejarah</h1>
        <p class="hero-desc"><?= esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></p>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Sejarah Sekolah</h2>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($sejarah)): ?>
                    <div class="card">
                        <div class="card-body p-5">
                            <div style="font-size:1.05rem;line-height:1.9;white-space:pre-line;">
                                <?= $sejarah ?? '' ?>
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
