<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumni</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Alumni</h2>

        <?php if (empty($alumni)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-users icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada data alumni</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($alumni as $a): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-sm h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <?php if (!empty($a->foto)): ?>
                                <img src="<?= base_url('uploads/alumni/'.$a->foto) ?>" alt="<?= esc($a->nama) ?>" class="rounded-circle mb-3" style="width:80px;height:80px;object-fit:cover;">
                            <?php else: ?>
                                <span class="avatar avatar-lg bg-purple-lt rounded-circle mb-3 mx-auto">
                                    <i class="ti ti-user icon" style="font-size:2rem;"></i>
                                </span>
                            <?php endif; ?>
                            <h5 class="mb-1"><?= esc($a->nama) ?></h5>
                            <?php if (!empty($a->angkatan)): ?>
                                <span class="badge bg-blue mb-2">Angkatan <?= esc($a->angkatan) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($a->jurusan)): ?>
                                <p class="text-muted mb-1 small"><?= esc($a->jurusan) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($a->pekerjaan)): ?>
                                <p class="small mb-1">
                                    <i class="ti ti-briefcase icon me-1"></i> <?= esc($a->pekerjaan) ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($a->perusahaan)): ?>
                                <p class="small text-muted mb-0">
                                    <i class="ti ti-building icon me-1"></i> <?= esc($a->perusahaan) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4">
                <?= $pager ? $pager : '' ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
