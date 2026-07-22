<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="/admin/menus" class="btn btn-ghost-secondary"><i class="ti ti-arrow-left icon me-1"></i> Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="ti ti-plus icon me-1"></i> Tambah Item</button>
</div>

<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>

<h4 class="mb-3">Menu: <?= esc($menu->name) ?> <span class="badge bg-blue"><?= esc($menu->location) ?></span></h4>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead><tr><th>#</th><th>Judul</th><th>URL</th><th>Icon</th><th>Target</th><th>Parent</th><th>Sort</th><th width="100">Aksi</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): ?>
                <?php
                    $itemMap = [];
                    foreach ($items as $it) { $itemMap[$it->id] = $it->title; }
                ?>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="fw-semibold">
                        <?php if ($item->icon): ?><i class="ti ti-<?= esc($item->icon) ?> icon me-1 text-muted"></i><?php endif; ?>
                        <?= esc($item->title) ?>
                    </td>
                    <td><code class="text-muted small"><?= esc($item->url) ?></code></td>
                    <td><?= esc($item->icon ?? '-') ?></td>
                    <td><span class="badge bg-secondary"><?= esc($item->target) ?></span></td>
                    <td class="text-muted small"><?= $item->parent_id ? esc($itemMap[$item->parent_id] ?? 'ID:'.$item->parent_id) : '-' ?></td>
                    <td><?= $item->sort_order ?></td>
                    <td>
                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item->id ?>"><i class="ti ti-pencil icon"></i></button>
                        <a href="/admin/menus/items/delete/<?= $item->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus item ini?')"><i class="ti ti-trash icon"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="8" class="text-center py-4 text-muted">Belum ada item. Tambahkan item pertama.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/menus/items/store/<?= $menu->id ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Menu Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label required">Judul</label><input type="text" name="title" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label required">URL</label><input type="text" name="url" class="form-control" placeholder="/halaman, https://..." required></div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6"><label class="form-label">Target</label><select name="target" class="form-select"><option value="_self">Same Tab (_self)</option><option value="_blank">New Tab (_blank)</option></select></div>
                        <div class="col-md-6"><label class="form-label">Icon (Tabler)</label><input type="text" name="icon" class="form-control" placeholder="ti-home"></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Parent</label>
                        <select name="parent_id" class="form-select"><option value="">-- Tidak ada (Root) --</option>
                            <?php foreach ($items as $p): ?><option value="<?= $p->id ?>"><?= esc($p->title) ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
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
            <form action="/admin/menus/items/update/<?= $item->id ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Edit: <?= esc($item->title) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Judul</label><input type="text" name="title" class="form-control" value="<?= esc($item->title) ?>" required></div>
                    <div class="mb-3"><label class="form-label">URL</label><input type="text" name="url" class="form-control" value="<?= esc($item->url) ?>" required></div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6"><label class="form-label">Target</label><select name="target" class="form-select"><option value="_self" <?= $item->target === '_self' ? 'selected' : '' ?>>_self</option><option value="_blank" <?= $item->target === '_blank' ? 'selected' : '' ?>>_blank</option></select></div>
                        <div class="col-md-6"><label class="form-label">Icon</label><input type="text" name="icon" class="form-control" value="<?= esc($item->icon) ?>"></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Parent</label>
                        <select name="parent_id" class="form-select"><option value="">-- Tidak ada (Root) --</option>
                            <?php foreach ($items as $p): ?><?php if ($p->id != $item->id): ?><option value="<?= $p->id ?>" <?= $item->parent_id == $p->id ? 'selected' : '' ?>><?= esc($p->title) ?></option><?php endif; ?><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= $item->sort_order ?>"></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>
