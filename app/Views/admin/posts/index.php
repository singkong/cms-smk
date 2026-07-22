<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <a href="/admin/posts/create" class="btn btn-primary"><i class="ti ti-plus icon me-1"></i> Tambah Postingan</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead><tr><th>#</th><th>Judul</th><th>Tipe</th><th>Kategori</th><th>Status</th><th>Penulis</th><th>Tanggal</th><th width="100">Aksi</th></tr></thead>
            <tbody>
                <?php foreach ($posts as $i => $post): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="text-truncate" style="max-width:250px;"><?= esc($post->title) ?></td>
                    <td><span class="badge bg-blue"><?= esc($post->type) ?></span></td>
                    <td><?= esc($post->category_name ?? '-') ?></td>
                    <td><?= $post->status === 'published' ? '<span class="badge bg-success">Published</span>' : ($post->status === 'trash' ? '<span class="badge bg-danger">Trash</span>' : '<span class="badge bg-secondary">Draft</span>') ?></td>
                    <td><?= esc($post->author) ?></td>
                    <td class="text-muted small"><?= date('d M Y', strtotime($post->created_at)) ?></td>
                    <td>
                        <a href="/admin/posts/edit/<?= $post->id ?>" class="btn btn-sm btn-icon btn-ghost-warning"><i class="ti ti-pencil icon"></i></a>
                        <a href="/admin/posts/delete/<?= $post->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus?')"><i class="ti ti-trash icon"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
