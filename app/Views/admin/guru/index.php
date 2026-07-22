<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <i class="ti ti-plus icon me-1"></i> Tambah Guru
    </button>
</div>

<?php if (session()->getFlashdata('errors')): ?>
<div class="alert alert-danger">
    <?php foreach (session()->getFlashdata('errors') as $e): ?><div><?= $e ?></div><?php endforeach; ?>
</div>
<?php endif; ?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr><th>#</th><th>Foto</th><th>Nama</th><th>NIP</th><th>Jabatan</th><th>Bidang</th><th>Status</th><th width="100">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php if ($item->foto): ?>
                        <span class="avatar avatar-sm" style="background-image:url(<?= base_url('uploads/guru/' . $item->foto) ?>)"></span>
                        <?php else: ?>
                        <span class="avatar avatar-sm"><?= strtoupper(substr($item->nama, 0, 1)) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= esc($item->nama) ?></td>
                    <td><?= esc($item->nip ?? '-') ?></td>
                    <td><?= esc($item->jabatan ?? '-') ?></td>
                    <td><?= esc($item->bidang ?? '-') ?></td>
                    <td><?= $item->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Nonaktif</span>' ?></td>
                    <td>
                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item->id ?>">
                            <i class="ti ti-pencil icon"></i>
                        </button>
                        <a href="/admin/guru/delete/<?= $item->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus data ini?')">
                            <i class="ti ti-trash icon"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="8" class="text-center py-5 text-muted">Belum ada data guru.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($pager)): ?><div class="card-footer"><?= $pager ?? '' ?></div><?php endif; ?>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/guru/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label required">Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">NIP</label><input type="text" name="nip" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" name="jabatan" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Bidang Studi</label><input type="text" name="bidang" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Pendidikan</label><input type="text" name="pendidikan" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Telepon</label><input type="text" name="telepon" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Foto</label><input type="file" name="foto" class="form-control" accept="image/*"></div>
                        <div class="col-12"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="2"></textarea></div>
                        <div class="col-md-6"><label class="form-label">Facebook</label><input type="url" name="facebook" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Instagram</label><input type="url" name="instagram" class="form-control"></div>
                        <div class="col-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
                        <div class="col-3 d-flex align-items-end pb-2">
                            <label class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><span class="form-check-label">Aktif</span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
<?php if (!empty($items)): ?>
<?php foreach ($items as $item): ?>
<div class="modal fade" id="modalEdit<?= $item->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/guru/update/<?= $item->id ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit: <?= esc($item->nama) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Nama Lengkap</label><input type="text" name="nama" class="form-control" value="<?= esc($item->nama) ?>" required></div>
                        <div class="col-md-6"><label class="form-label">NIP</label><input type="text" name="nip" class="form-control" value="<?= esc($item->nip) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" name="jabatan" class="form-control" value="<?= esc($item->jabatan) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Bidang Studi</label><input type="text" name="bidang" class="form-control" value="<?= esc($item->bidang) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Pendidikan</label><input type="text" name="pendidikan" class="form-control" value="<?= esc($item->pendidikan) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Telepon</label><input type="text" name="telepon" class="form-control" value="<?= esc($item->telepon) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= esc($item->email) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Foto</label><input type="file" name="foto" class="form-control" accept="image/*"><?php if ($item->foto): ?><small class="text-muted d-block">Current: <?= $item->foto ?></small><?php endif; ?></div>
                        <div class="col-12"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="2"><?= esc($item->alamat) ?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Facebook</label><input type="url" name="facebook" class="form-control" value="<?= esc($item->facebook) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Instagram</label><input type="url" name="instagram" class="form-control" value="<?= esc($item->instagram) ?>"></div>
                        <div class="col-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= $item->sort_order ?>"></div>
                        <div class="col-3 d-flex align-items-end pb-2">
                            <label class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" <?= $item->is_active ? 'checked' : '' ?>><span class="form-check-label">Aktif</span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
