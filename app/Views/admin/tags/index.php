<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Konten<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Tag</h3>
                <div class="card-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">
                        <i class="ti ti-plus icon"></i> Tambah Tag
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Jumlah Post</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $i => $tag): ?>
                            <tr>
                                <td class="text-muted small"><?= $i + 1 ?></td>
                                <td>
                                    <span class="fw-medium"><?= esc($tag->name) ?></span>
                                </td>
                                <td>
                                    <code><?= esc($tag->slug) ?></code>
                                </td>
                                <td>
                                    <span class="badge bg-blue"><?= $tag->post_count ?> post</span>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#editTag<?= $tag->id ?>" title="Edit">
                                            <i class="ti ti-pencil icon"></i>
                                        </button>
                                        <a href="/admin/tags/delete/<?= $tag->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" title="Hapus" onclick="return confirm('Hapus tag ini?')">
                                            <i class="ti ti-trash icon"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">Belum ada tag</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Tag Modal -->
<div class="modal fade" id="addTagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/tags/store" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-tag icon me-2"></i>Tambah Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tag</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama tag" required>
                        <small class="form-hint">Slug akan dibuat otomatis dari nama tag.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check icon"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tag Modals -->
<?php if (!empty($tags)): ?>
<?php foreach ($tags as $tag): ?>
<div class="modal fade" id="editTag<?= $tag->id ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/tags/update/<?= $tag->id ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-pencil icon me-2"></i>Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tag</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($tag->name) ?>" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Slug</label>
                        <code class="d-block"><?= esc($tag->slug) ?></code>
                        <small class="text-muted">Slug akan diperbarui otomatis sesuai nama.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check icon"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
