<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card"><div class="card-header"><h3 class="card-title">Tambah Kategori</h3></div>
            <div class="card-body">
                <form action="/admin/categories/store" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Tipe</label>
                        <select name="type" class="form-select"><option value="berita">Berita</option><option value="pengumuman">Pengumuman</option><option value="download">Download</option><option value="gallery">Gallery</option></select>
                    </div>
                    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="2"></textarea></div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card"><div class="card-header"><h3 class="card-title">Daftar Kategori</h3></div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead><tr><th>#</th><th>Nama</th><th>Slug</th><th>Tipe</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php foreach ($categories as $i => $cat): ?>
                        <tr>
                            <td><?= $i + 1 ?></td><td><?= esc($cat->name) ?></td><td><code><?= esc($cat->slug) ?></code></td>
                            <td><span class="badge bg-blue"><?= esc($cat->type) ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-icon btn-ghost-warning" data-bs-toggle="modal" data-bs-target="#editCat<?= $cat->id ?>"><i class="ti ti-pencil icon"></i></button>
                                <a href="/admin/categories/delete/<?= $cat->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus?')"><i class="ti ti-trash icon"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editCat<?= $cat->id ?>"><div class="modal-dialog"><div class="modal-content">
                            <form action="/admin/categories/update/<?= $cat->id ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-header"><h5 class="modal-title">Edit Kategori</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" value="<?= esc($cat->name) ?>" required></div>
                                    <div class="mb-3"><label class="form-label">Tipe</label><select name="type" class="form-select"><option value="berita" <?= $cat->type === 'berita' ? 'selected' : '' ?>>Berita</option><option value="pengumuman" <?= $cat->type === 'pengumuman' ? 'selected' : '' ?>>Pengumuman</option><option value="download" <?= $cat->type === 'download' ? 'selected' : '' ?>>Download</option><option value="gallery" <?= $cat->type === 'gallery' ? 'selected' : '' ?>>Gallery</option></select></div>
                                    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="2"><?= esc($cat->description) ?></textarea></div>
                                </div>
                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div>
                            </form>
                        </div></div></div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
