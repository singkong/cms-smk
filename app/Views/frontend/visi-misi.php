<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;">
    <div class="hero-content container text-center">
        <h1 class="hero-title">Visi & Misi</h1>
        <p class="hero-desc"><?= esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></p>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
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
