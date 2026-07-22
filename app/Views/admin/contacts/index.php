<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card"><div class="card-header"><h3 class="card-title">Pesan Masuk</h3></div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php foreach ($messages as $i => $msg): ?>
                <tr class="<?= !$msg->is_read ? 'table-active' : '' ?>">
                    <td><?= $i + 1 ?></td><td><?= esc($msg->name) ?></td><td><?= esc($msg->email) ?></td>
                    <td><?= esc($msg->subject) ?></td><td class="text-muted small"><?= date('d M H:i', strtotime($msg->created_at)) ?></td>
                    <td><?= $msg->is_read ? '<span class="badge bg-secondary">Terbaca</span>' : '<span class="badge bg-danger">Baru</span>' ?></td>
                    <td>
                        <a href="/admin/contacts/show/<?= $msg->id ?>" class="btn btn-sm btn-icon btn-ghost-info"><i class="ti ti-eye icon"></i></a>
                        <a href="/admin/contacts/delete/<?= $msg->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" onclick="return confirm('Hapus?')"><i class="ti ti-trash icon"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
