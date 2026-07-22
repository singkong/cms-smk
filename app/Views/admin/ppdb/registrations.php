<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>PPDB<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pendaftar PPDB</h3>
                <div class="card-actions">
                    <a href="/admin/ppdb" class="btn btn-ghost-secondary">
                        <i class="ti ti-settings icon"></i> Pengaturan
                    </a>
                    <a href="/admin/ppdb/export" class="btn btn-ghost-success">
                        <i class="ti ti-download icon"></i> Export CSV
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
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

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="get" action="/admin/ppdb/registrations" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Nama, No Registrasi, Sekolah..." value="<?= esc($filters['search'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="diterima" <?= ($filters['status'] ?? '') === 'diterima' ? 'selected' : '' ?>>Diterima</option>
                            <option value="ditolak" <?= ($filters['status'] ?? '') === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            <option value="cadangan" <?= ($filters['status'] ?? '') === 'cadangan' ? 'selected' : '' ?>>Cadangan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jurusan</label>
                        <select name="jurusan_id" class="form-select">
                            <option value="">Semua Jurusan</option>
                            <?php foreach ($jurusan_list as $jur): ?>
                            <option value="<?= $jur->id ?>" <?= ($filters['jurusan_id'] ?? '') == $jur->id ? 'selected' : '' ?>>
                                <?= esc($jur->nama) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search icon"></i> Filter
                            </button>
                            <a href="/admin/ppdb/registrations" class="btn btn-ghost-secondary" title="Reset">
                                <i class="ti ti-x icon"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No Registrasi</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>TTL</th>
                            <th>JK</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Tahun</th>
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
                                    <?php if ($reg->telepon): ?>
                                    <div class="text-muted small"><?= esc($reg->telepon) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><code class="small"><?= esc($reg->nik ?: '-') ?></code></td>
                                <td class="small">
                                    <?= esc($reg->tempat_lahir ?: '-') ?>,
                                    <?= $reg->tanggal_lahir ? date('d M Y', strtotime($reg->tanggal_lahir)) : '-' ?>
                                </td>
                                <td><?= $reg->jk === 'L' ? '<span class="badge bg-blue">L</span>' : '<span class="badge bg-pink">P</span>' ?></td>
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
                                <td><small class="text-muted"><?= esc($reg->tahun_ajaran ?? '-') ?></small></td>
                                <td>
                                    <button class="btn btn-sm btn-icon btn-ghost-info" data-bs-toggle="modal" data-bs-target="#detailModal<?= $reg->id ?>" title="Detail">
                                        <i class="ti ti-eye icon"></i>
                                    </button>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical icon"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <form action="/admin/ppdb/registrations/<?= $reg->id ?>/update" method="post" class="px-2">
                                                <?= csrf_field() ?>
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
                                <td colspan="10" class="text-center py-4">
                                    <div class="text-muted">Tidak ada data pendaftar</div>
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

<!-- Detail Modals -->
<?php if (!empty($registrations)): ?>
<?php foreach ($registrations as $reg): ?>
<div class="modal fade" id="detailModal<?= $reg->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pendaftar: <?= esc($reg->no_registrasi) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <small class="text-muted">Nama Lengkap</small>
                            <div class="fw-medium"><?= esc($reg->nama) ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">NIK</small>
                            <div><?= esc($reg->nik ?: '-') ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Tempat, Tanggal Lahir</small>
                            <div>
                                <?= esc($reg->tempat_lahir ?: '-') ?>,
                                <?= $reg->tanggal_lahir ? date('d M Y', strtotime($reg->tanggal_lahir)) : '-' ?>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Jenis Kelamin</small>
                            <div><?= $reg->jk === 'L' ? 'Laki-laki' : 'Perempuan' ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Alamat</small>
                            <div><?= esc($reg->alamat ?: '-') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <small class="text-muted">Telepon</small>
                            <div><?= esc($reg->telepon ?: '-') ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Email</small>
                            <div><?= esc($reg->email ?: '-') ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Asal Sekolah</small>
                            <div><?= esc($reg->asal_sekolah ?: '-') ?></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Jurusan Pilihan</small>
                            <div><span class="badge bg-blue"><?= esc($reg->jurusan_name ?: '-') ?></span></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Status</small>
                            <div>
                                <?php
                                $statusColors = ['pending' => 'bg-yellow', 'diterima' => 'bg-green', 'ditolak' => 'bg-red', 'cadangan' => 'bg-purple'];
                                $statusLabels = ['pending' => 'Pending', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'cadangan' => 'Cadangan'];
                                $color = $statusColors[$reg->status] ?? 'bg-secondary';
                                $label = $statusLabels[$reg->status] ?? $reg->status;
                                ?>
                                <span class="badge <?= $color ?>"><?= $label ?></span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Tanggal Daftar</small>
                            <div><?= date('d M Y H:i', strtotime($reg->created_at)) ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
