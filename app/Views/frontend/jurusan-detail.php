<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:30vh;">
    <div class="hero-content container text-center">
        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
            <?php if (!empty($jurusan->singkatan)): ?><span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold"><?= esc($jurusan->singkatan) ?></span><?php endif; ?>
            <?php if (!empty($jurusan->akreditasi)): ?><span class="badge bg-success px-3 py-2 rounded-pill">Akreditasi <?= esc($jurusan->akreditasi) ?></span><?php endif; ?>
        </div>
        <h1 class="hero-title" style="font-size:2rem;"><?= esc($jurusan->nama) ?></h1>
        <?php if (!empty($jurusan->kepala_jurusan)): ?><p class="hero-desc">Kepala Jurusan: <?= esc($jurusan->kepala_jurusan) ?></p><?php endif; ?>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (!empty($jurusan->gambar)): ?>
                    <div class="card mb-4">
                        <img src="<?= base_url('uploads/jurusan/' . $jurusan->gambar) ?>" alt="<?= esc($jurusan->nama) ?>" class="card-img-top rounded" style="max-height:400px;object-fit:cover;">
                    </div>
                <?php endif; ?>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Deskripsi</h3>
                    </div>
                    <div class="card-body">
                        <div style="line-height:1.9;font-size:1.05rem;">
                            <?= nl2br(esc($jurusan->deskripsi ?? '-')) ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($jurusan->visi)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="ti ti-bulb icon me-1 text-warning"></i> Visi</h3>
                    </div>
                    <div class="card-body">
                        <p style="line-height:1.8;white-space:pre-line;"><?= esc($jurusan->visi) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($jurusan->misi)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="ti ti-target-arrow icon me-1 text-primary"></i> Misi</h3>
                    </div>
                    <div class="card-body">
                        <p style="line-height:1.8;white-space:pre-line;"><?= esc($jurusan->misi) ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php if (!empty($jurusan->kurikulum)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0"><i class="ti ti-books icon me-1"></i> Kurikulum</h4>
                    </div>
                    <div class="card-body">
                        <p style="line-height:1.8;white-space:pre-line;"><?= esc($jurusan->kurikulum) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($jurusan->prospek_kerja)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0"><i class="ti ti-briefcase icon me-1"></i> Prospek Kerja</h4>
                    </div>
                    <div class="card-body">
                        <p style="line-height:1.8;white-space:pre-line;"><?= esc($jurusan->prospek_kerja) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <a href="/jurusan" class="btn btn-outline-primary w-100">
                            <i class="ti ti-arrow-left icon me-1"></i> Kembali ke Daftar Jurusan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
