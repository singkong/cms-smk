<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>PPDB<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan PPDB</h3>
                <div class="card-actions">
                    <a href="/admin/ppdb/registrations" class="btn btn-ghost-primary">
                        <i class="ti ti-list icon"></i> Data Pendaftar
                    </a>
                    <?php if ($ppdb_setting): ?>
                    <a href="/admin/ppdb/export" class="btn btn-ghost-success">
                        <i class="ti ti-download icon"></i> Export CSV
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <form action="/admin/ppdb/settings" method="post">
                    <?= csrf_field() ?>
                    <?php if ($ppdb_setting): ?>
                    <input type="hidden" name="id" value="<?= $ppdb_setting->id ?>">
                    <?php endif; ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" class="form-control" placeholder="contoh: 2024/2025" value="<?= esc($ppdb_setting->tahun_ajaran ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status PPDB</label>
                                <div class="mt-2">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_open" value="1" <?= ($ppdb_setting->is_open ?? 0) ? 'checked' : '' ?>>
                                        <span class="form-check-label">
                                            <?= ($ppdb_setting->is_open ?? 0) ? 'Pendaftaran Dibuka' : 'Pendaftaran Ditutup' ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Buka</label>
                                <input type="date" name="tanggal_buka" class="form-control" value="<?= esc($ppdb_setting->tanggal_buka ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Tutup</label>
                                <input type="date" name="tanggal_tutup" class="form-control" value="<?= esc($ppdb_setting->tanggal_tutup ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Biaya Pendaftaran (Rp)</label>
                                <input type="number" name="biaya_pendaftaran" class="form-control" placeholder="0" value="<?= esc($ppdb_setting->biaya_pendaftaran ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Info Kontak</label>
                                <textarea name="kontak_info" class="form-control" rows="3" placeholder="Informasi kontak panitia PPDB"><?= esc($ppdb_setting->kontak_info ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy icon"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($ppdb_setting): ?>
<div class="row g-3 mb-3">
    <div class="col-sm-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-yellow text-white avatar">
                            <i class="ti ti-clock icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Pending</div>
                        <div class="h2 m-0"><?= $status_counts['pending'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-green text-white avatar">
                            <i class="ti ti-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Diterima</div>
                        <div class="h2 m-0"><?= $status_counts['diterima'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-red text-white avatar">
                            <i class="ti ti-x icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Ditolak</div>
                        <div class="h2 m-0"><?= $status_counts['ditolak'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-purple text-white avatar">
                            <i class="ti ti-clock-pause icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Cadangan</div>
                        <div class="h2 m-0"><?= $status_counts['cadangan'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pendaftar Terbaru</h3>
                <div class="card-actions">
                    <a href="/admin/ppdb/registrations" class="btn btn-ghost-primary">
                        Lihat Semua <i class="ti ti-arrow-right icon"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No Registrasi</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($registrations)): ?>
                            <?php foreach ($registrations as $reg): ?>
                            <tr>
                                <td><code><?= esc($reg->no_registrasi) ?></code></td>
                                <td>
                                    <span class="fw-medium"><?= esc($reg->nama) ?></span>
                                </td>
                                <td><?= esc($reg->asal_sekolah ?: '-') ?></td>
                                <td><?= esc($reg->jurusan_name ?: '-') ?></td>
                                <td>
                                    <?php
                                    $statusColors = [
                                        'pending'  => 'bg-yellow',
                                        'diterima' => 'bg-green',
                                        'ditolak'  => 'bg-red',
                                        'cadangan' => 'bg-purple',
                                    ];
                                    $statusLabels = [
                                        'pending'  => 'Pending',
                                        'diterima' => 'Diterima',
                                        'ditolak'  => 'Ditolak',
                                        'cadangan' => 'Cadangan',
                                    ];
                                    $color = $statusColors[$reg->status] ?? 'bg-secondary';
                                    $label = $statusLabels[$reg->status] ?? $reg->status;
                                    ?>
                                    <span class="badge <?= $color ?>"><?= $label ?></span>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M Y', strtotime($reg->created_at)) ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical icon"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <form action="/admin/ppdb/registrations/<?= $reg->id ?>/update" method="post" class="px-2">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $reg->id ?>">
                                                <label class="dropdown-item-text fw-bold">Ubah Status</label>
                                                <div class="dropdown-divider"></div>
                                                <?php foreach (['pending' => 'Pending', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'cadangan' => 'Cadangan'] as $val => $lbl): ?>
                                                <button type="submit" name="status" value="<?= $val ?>" class="dropdown-item <?= $reg->status === $val ? 'active' : '' ?>">
                                                    <?= $lbl ?>
                                                </button>
                                                <?php endforeach; ?>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">Belum ada pendaftar</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($pager) && $pager): ?>
            <div class="card-footer d-flex align-items-center">
                <?= $pager ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php else: ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-school icon" style="font-size:3rem;"></i></div>
                <p class="empty-title">PPDB Belum Dikonfigurasi</p>
                <p class="empty-subtitle text-muted">Simpan pengaturan PPDB di atas untuk mulai mengelola pendaftaran.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.querySelectorAll('input[name="is_open"]').forEach(function(el) {
    el.addEventListener('change', function() {
        var label = this.closest('.form-check').querySelector('.form-check-label');
        if (this.checked) {
            label.textContent = 'Pendaftaran Dibuka';
        } else {
            label.textContent = 'Pendaftaran Ditutup';
        }
    });
});
</script>
<?= $this->endSection() ?>
