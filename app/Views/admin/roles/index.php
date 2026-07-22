<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Manajemen<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Role</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <?php if (!empty($roles)): ?>
        <?php foreach ($roles as $role): ?>
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="avatar bg-blue-lt me-3">
                            <i class="ti ti-shield icon"></i>
                        </span>
                        <div>
                            <h3 class="card-title m-0"><?= esc($role->name) ?></h3>
                            <div class="text-muted small"><code><?= esc($role->slug) ?></code></div>
                        </div>
                    </div>
                    <?php if ($role->description): ?>
                    <p class="text-muted small mb-3"><?= esc($role->description) ?></p>
                    <?php endif; ?>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="card card-sm">
                                <div class="card-body p-2 text-center">
                                    <div class="text-muted small">Permission</div>
                                    <div class="h2 m-0"><?= $role->permission_count ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-sm">
                                <div class="card-body p-2 text-center">
                                    <div class="text-muted small">Pengguna</div>
                                    <div class="h2 m-0"><?= $role->user_count ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/roles/permissions/<?= $role->id ?>" class="btn btn-primary w-100">
                        <i class="ti ti-settings icon"></i> Atur Permission
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="empty">
                <p class="empty-title">Belum ada role</p>
                <p class="empty-subtitle text-muted">Role akan otomatis dibuat melalui database seeder.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
