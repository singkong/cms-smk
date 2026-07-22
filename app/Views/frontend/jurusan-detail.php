<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/jurusan">Jurusan</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($jurusan->nama) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (!empty($jurusan->gambar)): ?>
                    <div class="card mb-4">
                        <img src="<?= base_url('uploads/jurusan/' . $jurusan->gambar) ?>" alt="<?= esc($jurusan->nama) ?>" class="card-img-top rounded" style="max-height:400px;object-fit:cover;">
                    </div>
                <?php endif; ?>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <h2 class="mb-0"><?= esc($jurusan->nama) ?></h2>
                    <?php if (!empty($jurusan->singkatan)): ?>
                        <span class="badge bg-blue fs-3"><?= esc($jurusan->singkatan) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($jurusan->akreditasi)): ?>
                        <span class="badge bg-success">Akreditasi <?= esc($jurusan->akreditasi) ?></span>
                    <?php endif; ?>
                </div>

                <?php if (!empty($jurusan->kepala_jurusan)): ?>
                    <div class="d-flex align-items-center gap-2 mb-4 p-3 bg-light rounded-3">
                        <i class="ti ti-user icon text-primary" style="font-size:1.5rem;"></i>
                        <div>
                            <strong>Kepala Jurusan:</strong>
                            <span><?= esc($jurusan->kepala_jurusan) ?></span>
                        </div>
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
