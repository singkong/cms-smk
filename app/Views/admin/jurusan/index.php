<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <i class="ti ti-plus icon me-1"></i> Tambah Jurusan
    </button>
</div>

<?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><?php foreach (session()->getFlashdata('errors') as $e): ?><div><?= $e ?></div><?php endforeach; ?></div><?php endif; ?>
<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead><tr><th>#</th><th>Gambar</th><th>Nama</th><th>Singkatan</th><th>Kepala Jurusan</th><th>Akreditasi</th><th width="100">Aksi</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): ?>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php if ($item->gambar): ?><img src="<?= base_url('uploads/jurusan/'.$item->gambar) ?>" style="width:50px;height:35px;object-fit:cover;border-radius:6px;" alt=""><?php else: ?>-<?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= esc($item->nama) ?></td>
                    <td><span class="badge bg-blue"><?= esc($item->singkatan) ?></span></td>
                    <td><?= esc($item->kepala_jurusan ?? '-') ?></td>
                    <td><?= $item->akreditasi ? '<span class="badge bg-success">'.$item->akreditasi.'</span>' : '-' ?></td>
                    <td>
                        <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item->id ?>"><i class="ti ti-pencil icon"></i></button>
                        <a href="/admin/jurusan/delete/<?= $item->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus?')"><i class="ti ti-trash icon"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada jurusan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/jurusan/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Jurusan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label required">Nama Jurusan</label><input type="text" name="nama" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label required">Singkatan</label><input type="text" name="singkatan" class="form-control" required maxlength="10"></div>
                        <div class="col-md-6"><label class="form-label">Kepala Jurusan</label><input type="text" name="kepala_jurusan" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Akreditasi</label><input type="text" name="akreditasi" class="form-control" maxlength="5" placeholder="A / B"></div>
                        <div class="col-md-6"><label class="form-label">Gambar</label><input type="file" name="gambar" class="form-control" accept="image/*"></div>
                        <div class="col-12"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
                        <div class="col-md-6"><label class="form-label">Visi</label><textarea name="visi" class="form-control" rows="2"></textarea></div>
                        <div class="col-md-6"><label class="form-label">Misi</label><textarea name="misi" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Prospek Kerja</label><textarea name="prospek_kerja" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Kurikulum</label><textarea name="kurikulum" class="form-control" rows="2"></textarea></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php if (!empty($items)): foreach ($items as $item): ?>
<div class="modal fade" id="modalEdit<?= $item->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/jurusan/update/<?= $item->id ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Edit: <?= esc($item->nama) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Nama Jurusan</label><input type="text" name="nama" class="form-control" value="<?= esc($item->nama) ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Singkatan</label><input type="text" name="singkatan" class="form-control" value="<?= esc($item->singkatan) ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Kepala Jurusan</label><input type="text" name="kepala_jurusan" class="form-control" value="<?= esc($item->kepala_jurusan) ?>"></div>
                        <div class="col-md-6"><label class="form-label">Akreditasi</label><input type="text" name="akreditasi" class="form-control" value="<?= esc($item->akreditasi) ?>" maxlength="5"></div>
                        <div class="col-md-6"><label class="form-label">Gambar</label><input type="file" name="gambar" class="form-control" accept="image/*"><?php if ($item->gambar): ?><small class="text-muted d-block">Current: <?= $item->gambar ?></small><?php endif; ?></div>
                        <div class="col-12"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"><?= esc($item->deskripsi) ?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Visi</label><textarea name="visi" class="form-control" rows="2"><?= esc($item->visi) ?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Misi</label><textarea name="misi" class="form-control" rows="2"><?= esc($item->misi) ?></textarea></div>
                        <div class="col-12"><label class="form-label">Prospek Kerja</label><textarea name="prospek_kerja" class="form-control" rows="2"><?= esc($item->prospek_kerja) ?></textarea></div>
                        <div class="col-12"><label class="form-label">Kurikulum</label><textarea name="kurikulum" class="form-control" rows="2"><?= esc($item->kurikulum) ?></textarea></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>
