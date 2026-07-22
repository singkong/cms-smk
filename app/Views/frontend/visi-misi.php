<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Visi & Misi</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-1">Visi & Misi</h2>
        <p class="text-center text-muted mb-5"><?= esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></p>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-5">
                        <span class="avatar avatar-lg rounded-circle mb-3" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                            <i class="ti ti-bulb icon text-white" style="font-size:2rem;"></i>
                        </span>
                        <h3 class="fw-bold mb-3">Visi</h3>
                        <div class="bg-light rounded-3 p-4 text-start">
                            <p style="white-space:pre-line;font-size:1.05rem;line-height:1.8;"><?= $setting->visi ?? 'Belum ada visi.' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-5">
                        <span class="avatar avatar-lg rounded-circle mb-3" style="background:linear-gradient(135deg,#2563eb,#7c3aed);">
                            <i class="ti ti-target-arrow icon text-white" style="font-size:2rem;"></i>
                        </span>
                        <h3 class="fw-bold mb-3">Misi</h3>
                        <div class="bg-light rounded-3 p-4 text-start">
                            <p style="white-space:pre-line;font-size:1.05rem;line-height:1.8;"><?= $setting->misi ?? 'Belum ada misi.' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($setting->tujuan ?? false): ?>
        <div class="row g-4 justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center p-5">
                        <span class="avatar avatar-lg rounded-circle mb-3" style="background:linear-gradient(135deg,#059669,#10b981);">
                            <i class="ti ti-flag icon text-white" style="font-size:2rem;"></i>
                        </span>
                        <h3 class="fw-bold mb-3">Tujuan</h3>
                        <div class="bg-light rounded-3 p-4 text-start">
                            <p style="white-space:pre-line;font-size:1.05rem;line-height:1.8;"><?= $setting->tujuan ?? '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
