<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Role & Permission<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Permission untuk Role: <?= esc($role->name) ?></h3>
                    <div class="card-subtitle text-muted mt-1">
                        <code><?= esc($role->slug) ?></code>
                        <?php if ($role->description): ?>
                        &mdash; <?= esc($role->description) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-actions">
                    <a href="/admin/roles" class="btn btn-ghost-secondary">
                        <i class="ti ti-arrow-left icon"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="/admin/roles/permissions/<?= $role->id ?>/update" method="post">
<?= csrf_field() ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <span class="form-check-label fw-bold">Pilih Semua</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy icon"></i> Simpan Permission
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($permission_groups as $group => $permissions): ?>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <?php
                    $icons = [
                        'Posts'       => 'ti-article',
                        'Categories'  => 'ti-folder',
                        'Tags'        => 'ti-tag',
                        'Users'       => 'ti-users',
                        'Roles'       => 'ti-shield',
                        'Settings'    => 'ti-settings',
                        'Media'       => 'ti-photo',
                        'Gallery'     => 'ti-photo',
                        'Videos'      => 'ti-video',
                        'Downloads'   => 'ti-download',
                        'Comments'    => 'ti-messages',
                        'Contacts'    => 'ti-mail',
                        'Menu'        => 'ti-menu-2',
                        'Pages'       => 'ti-file',
                        'Guru'        => 'ti-user-star',
                        'Staff'       => 'ti-user-cog',
                        'Jurusan'     => 'ti-building',
                        'Fasilitas'   => 'ti-tools',
                        'Alumni'      => 'ti-school',
                        'Slider'      => 'ti-slideshow',
                        'Partner'     => 'ti-affiliate',
                        'Testimoni'   => 'ti-message-heart',
                        'FAQ'         => 'ti-help-circle',
                        'PPDB'        => 'ti-school',
                        'Visitors'    => 'ti-eye',
                        'Dashboard'   => 'ti-dashboard',
                        'Logs'        => 'ti-notes',
                    ];
                    $icon = $icons[$group] ?? 'ti-lock';
                    ?>
                    <i class="ti <?= $icon ?> icon me-1"></i> <?= esc($group) ?>
                </h3>
                <div class="card-actions">
                    <label class="form-check">
                        <input class="form-check-input group-check-all" type="checkbox">
                        <span class="form-check-label small">Semua</span>
                    </label>
                </div>
            </div>
            <div class="card-body">
                <?php foreach ($permissions as $perm): ?>
                <div class="mb-2">
                    <label class="form-check">
                        <input class="form-check-input perm-checkbox" type="checkbox" name="permissions[]" value="<?= $perm->id ?>" <?= in_array($perm->id, $assigned_ids) ? 'checked' : '' ?>>
                        <span class="form-check-label">
                            <?= esc($perm->name) ?>
                            <?php if ($perm->description): ?>
                            <small class="text-muted d-block"><?= esc($perm->description) ?></small>
                            <?php endif; ?>
                        </span>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('checkAll').addEventListener('change', function() {
    const checked = this.checked;
    document.querySelectorAll('.perm-checkbox').forEach(cb => {
        cb.checked = checked;
    });
    document.querySelectorAll('.group-check-all').forEach(cb => {
        cb.checked = checked;
    });
});

document.querySelectorAll('.group-check-all').forEach(function(groupCheck) {
    groupCheck.addEventListener('change', function() {
        const card = this.closest('.card');
        const checked = this.checked;
        card.querySelectorAll('.perm-checkbox').forEach(cb => {
            cb.checked = checked;
        });
        updateCheckAll();
    });
});

function updateCheckAll() {
    const total = document.querySelectorAll('.perm-checkbox').length;
    const checked = document.querySelectorAll('.perm-checkbox:checked').length;
    document.getElementById('checkAll').checked = (total > 0 && checked === total);
    document.getElementById('checkAll').indeterminate = (checked > 0 && checked < total);
}

document.querySelectorAll('.perm-checkbox').forEach(function(cb) {
    cb.addEventListener('change', function() {
        updateCheckAll();
        const card = this.closest('.card');
        const cardTotal = card.querySelectorAll('.perm-checkbox').length;
        const cardChecked = card.querySelectorAll('.perm-checkbox:checked').length;
        const groupCheck = card.querySelector('.group-check-all');
        if (groupCheck) {
            groupCheck.checked = (cardTotal > 0 && cardChecked === cardTotal);
            groupCheck.indeterminate = (cardChecked > 0 && cardChecked < cardTotal);
        }
    });
});

updateCheckAll();
</script>
<?= $this->endSection() ?>
