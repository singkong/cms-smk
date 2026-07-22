<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Guru & Staff</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Guru & Staff</h2>

        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#guru-tab" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                            <i class="ti ti-school icon me-1"></i> Guru (<?= count($guru) ?>)
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#staff-tab" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                            <i class="ti ti-users icon me-1"></i> Staff (<?= count($staff) ?>)
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="guru-tab" role="tabpanel">
                        <?php if (empty($guru)): ?>
                            <div class="empty">
                                <div class="empty-icon"><i class="ti ti-school icon" style="font-size:3rem;"></i></div>
                                <p class="empty-title">Belum ada data guru</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-4">
                                <?php foreach ($guru as $g): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-sm h-100">
                                        <div class="card-body text-center">
                                            <?php if (!empty($g->foto)): ?>
                                                <img src="<?= esc($g->foto) ?>" alt="<?= esc($g->nama) ?>" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;">
                                            <?php else: ?>
                                                <span class="avatar avatar-lg bg-blue-lt rounded-circle mb-3 mx-auto">
                                                    <i class="ti ti-user icon" style="font-size:2rem;"></i>
                                                </span>
                                            <?php endif; ?>
                                            <h5 class="mb-0"><?= esc($g->nama) ?></h5>
                                            <?php if (!empty($g->nip)): ?>
                                                <small class="text-muted">NIP. <?= esc($g->nip) ?></small>
                                            <?php endif; ?>
                                            <?php if (!empty($g->jabatan)): ?>
                                                <div class="mt-2"><span class="badge bg-blue"><?= esc($g->jabatan) ?></span></div>
                                            <?php endif; ?>
                                            <?php if (!empty($g->bidang)): ?>
                                                <div class="mt-1"><span class="badge bg-purple-lt"><?= esc($g->bidang) ?></span></div>
                                            <?php endif; ?>
                                            <?php if (!empty($g->pendidikan)): ?>
                                                <div class="mt-1"><small class="text-muted"><?= esc($g->pendidikan) ?></small></div>
                                            <?php endif; ?>
                                            <div class="mt-3">
                                                <?php if (!empty($g->email)): ?>
                                                    <a href="mailto:<?= esc($g->email) ?>" class="btn btn-sm btn-ghost-secondary" title="Email">
                                                        <i class="ti ti-mail icon"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($g->facebook)): ?>
                                                    <a href="<?= esc($g->facebook) ?>" class="btn btn-sm btn-ghost-secondary" target="_blank" title="Facebook">
                                                        <i class="ti ti-brand-facebook icon"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($g->instagram)): ?>
                                                    <a href="<?= esc($g->instagram) ?>" class="btn btn-sm btn-ghost-secondary" target="_blank" title="Instagram">
                                                        <i class="ti ti-brand-instagram icon"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="tab-pane fade" id="staff-tab" role="tabpanel">
                        <?php if (empty($staff)): ?>
                            <div class="empty">
                                <div class="empty-icon"><i class="ti ti-users icon" style="font-size:3rem;"></i></div>
                                <p class="empty-title">Belum ada data staff</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-4">
                                <?php foreach ($staff as $s): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-sm h-100">
                                        <div class="card-body text-center">
                                            <?php if (!empty($s->foto)): ?>
                                                <img src="<?= esc($s->foto) ?>" alt="<?= esc($s->nama) ?>" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;">
                                            <?php else: ?>
                                                <span class="avatar avatar-lg bg-azure-lt rounded-circle mb-3 mx-auto">
                                                    <i class="ti ti-user icon" style="font-size:2rem;"></i>
                                                </span>
                                            <?php endif; ?>
                                            <h5 class="mb-0"><?= esc($s->nama) ?></h5>
                                            <?php if (!empty($s->jabatan)): ?>
                                                <div class="mt-2"><span class="badge bg-teal"><?= esc($s->jabatan) ?></span></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
