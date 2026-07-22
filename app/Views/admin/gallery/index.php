<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3"><div></div><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="ti ti-plus icon me-1"></i> Tambah</button></div>
<?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><?php foreach (session()->getFlashdata('errors') as $e): ?><div><?= $e ?></div><?php endforeach; ?></div><?php endif; ?>

<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>

<div class="row g-3">
<?php foreach ($items as $item): ?>
<div class="col-md-3 col-sm-4 col-6">
<div class="card">
<a href="<?= base_url('uploads/gallery/'.$item->image) ?>" target="_blank">
<img src="<?= base_url('uploads/gallery/'.$item->image) ?>" class="card-img-top" alt="<?= esc($item->title ?? 'Photo') ?>" style="height:150px;object-fit:cover">
</a>
<div class="card-body p-2">
<p class="mb-1 text-truncate fw-semibold small"><?= esc($item->title ?? '-') ?></p>
<?php if ($item->category): ?><span class="badge bg-primary mb-1"><?= esc($item->category) ?></span><?php endif; ?>
<div class="d-flex gap-1">
<button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item->id ?>"><i class="ti ti-pencil icon"></i></button>
<a href="/admin/gallery/delete/<?= $item->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus?')"><i class="ti ti-trash icon"></i></a>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>

<?php if (!empty($pager)): ?><div class="mt-3"><?= $pager ?></div><?php endif; ?>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd"><div class="modal-dialog"><div class="modal-content"><form action="/admin/gallery/store" method="post" enctype="multipart/form-data"><?= csrf_field() ?><div class="modal-header"><h5 class="modal-title">Upload Foto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="mb-3"><label class="form-label">Judul</label><input type="text" name="title" class="form-control"></div><div class="mb-3"><label class="form-label">Kategori</label><input type="text" name="category" class="form-control" placeholder="Contoh: Kegiatan, Lomba, dll"></div><div class="mb-3"><label class="form-label">Album</label><select name="album_id" class="form-select"><option value="">-- Pilih Album --</option><?php foreach ($albums as $album): ?><option value="<?= $album->id ?>"><?= esc($album->name) ?></option><?php endforeach; ?></select></div><div class="mb-3"><label class="form-label">Gambar</label><input type="file" name="image" class="form-control" accept="image/*" required></div><div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="2"></textarea></div></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Upload</button></div></form></div></div></div>

<!-- Modal Edit templates -->
<?php foreach ($items as $item): ?>
<div class="modal fade" id="modalEdit<?= $item->id ?>"><div class="modal-dialog"><div class="modal-content"><form action="/admin/gallery/update/<?= $item->id ?>" method="post" enctype="multipart/form-data"><?= csrf_field() ?><div class="modal-header"><h5 class="modal-title">Edit Foto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="mb-3"><label class="form-label">Judul</label><input type="text" name="title" class="form-control" value="<?= esc($item->title) ?>"></div><div class="mb-3"><label class="form-label">Kategori</label><input type="text" name="category" class="form-control" value="<?= esc($item->category) ?>" placeholder="Contoh: Kegiatan, Lomba, dll"></div><div class="mb-3"><label class="form-label">Album</label><select name="album_id" class="form-select"><option value="">-- Pilih Album --</option><?php foreach ($albums as $album): ?><option value="<?= $album->id ?>" <?= $item->album_id == $album->id ? 'selected' : '' ?>><?= esc($album->name) ?></option><?php endforeach; ?></select></div><div class="mb-3"><label class="form-label">Ganti Gambar</label><input type="file" name="image" class="form-control" accept="image/*"><?php if ($item->image): ?><small class="text-muted d-block mt-1">Current: <?= $item->image ?></small><?php endif; ?></div><div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="2"><?= esc($item->description) ?></textarea></div></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div></form></div></div></div>
<?php endforeach; ?>
<?= $this->endSection() ?>
