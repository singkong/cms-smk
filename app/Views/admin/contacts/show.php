<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between mb-3">
    <div></div>
    <a href="/admin/contacts" class="btn btn-ghost-secondary"><i class="ti ti-arrow-left icon me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table mb-0">
            <tr><td width="150"><strong>Nama</strong></td><td><?= esc($message->name) ?></td></tr>
            <tr><td><strong>Email</strong></td><td><?= esc($message->email) ?></td></tr>
            <tr><td><strong>Telepon</strong></td><td><?= esc($message->phone ?? '-') ?></td></tr>
            <tr><td><strong>Subjek</strong></td><td><?= esc($message->subject) ?></td></tr>
            <tr><td><strong>Tanggal</strong></td><td><?= date('d M Y, H:i', strtotime($message->created_at)) ?></td></tr>
        </table>
        <hr>
        <h5>Pesan</h5>
        <p><?= nl2br(esc($message->message)) ?></p>
    </div>
</div>
<?= $this->endSection() ?>
