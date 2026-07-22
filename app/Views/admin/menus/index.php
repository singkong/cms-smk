<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <i class="ti ti-plus icon me-1"></i> Tambah Menu
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead><tr><th>#</th><th>Nama Menu</th><th>Lokasi</th><th>Items</th><th width="120">Aksi</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): ?>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="fw-semibold"><?= esc($item->name) ?></td>
                    <td><span class="badge bg-blue"><?= esc($item->location) ?></span></td>
                    <td><?= $item->item_count ?? 0 ?> items</td>
                    <td>
                        <a href="/admin/menus/items/<?= $item->id ?>" class="btn btn-sm btn-outline-primary">Kelola Items</a>
                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item->id ?>"><i class="ti ti-pencil icon"></i></button>
                        <a href="/admin/menus/delete/<?= $item->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus menu ini?')"><i class="ti ti-trash icon"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada menu. Tambahkan menu baru.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/menus/store" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Menu</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Menu</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Lokasi</label>
                        <select name="location" class="form-select">
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                            <option value="sidebar">Sidebar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Modals Edit -->
<?php if (!empty($items)): foreach ($items as $item): ?>
<div class="modal fade" id="modalEdit<?= $item->id ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/menus/update/<?= $item->id ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Edit: <?= esc($item->name) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Menu</label><input type="text" name="name" class="form-control" value="<?= esc($item->name) ?>" required></div>
                    <div class="mb-3"><label class="form-label">Lokasi</label>
                        <select name="location" class="form-select">
                            <option value="header" <?= $item->location === 'header' ? 'selected' : '' ?>>Header</option>
                            <option value="footer" <?= $item->location === 'footer' ? 'selected' : '' ?>>Footer</option>
                            <option value="sidebar" <?= $item->location === 'sidebar' ? 'selected' : '' ?>>Sidebar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>
