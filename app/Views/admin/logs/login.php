<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Monitoring<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Log Login</h3>
                <div class="card-actions">
                    <a href="/admin/logs" class="btn btn-ghost-secondary">
                        <i class="ti ti-notes icon"></i> Log Aktivitas
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
                        <span class="bg-green text-white avatar">
                            <i class="ti ti-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Login Berhasil</div>
                        <div class="h2 m-0"><?= $success_count ?></div>
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
                        <div class="font-weight-medium">Login Gagal</div>
                        <div class="h2 m-0"><?= $failed_count ?></div>
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
                <form method="get" action="/admin/logs/login" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="user" class="form-control" placeholder="Username..." value="<?= esc($filters['user'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="success" <?= ($filters['status'] ?? '') === 'success' ? 'selected' : '' ?>>Success</option>
                            <option value="failed" <?= ($filters['status'] ?? '') === 'failed' ? 'selected' : '' ?>>Failed</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="date_from" class="form-control" value="<?= esc($filters['date_from'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="date_to" class="form-control" value="<?= esc($filters['date_to'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search icon"></i> Filter
                            </button>
                            <a href="/admin/logs/login" class="btn btn-ghost-secondary" title="Reset">
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
                            <th>#</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach ($logs as $i => $log): ?>
                            <tr>
                                <td class="text-muted small"><?= $i + 1 ?></td>
                                <td>
                                    <span class="fw-medium"><?= esc($log->username) ?></span>
                                </td>
                                <td>
                                    <?php if ($log->status === 'success'): ?>
                                    <span class="badge bg-success"><i class="ti ti-check icon"></i> Success</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger"><i class="ti ti-x icon"></i> Failed</span>
                                    <?php endif; ?>
                                </td>
                                <td><code><?= esc($log->ip_address) ?></code></td>
                                <td class="text-truncate" style="max-width:250px;">
                                    <small class="text-muted"><?= esc($log->user_agent ?: '-') ?></small>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M Y H:i:s', strtotime($log->created_at)) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">Tidak ada data log login</div>
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

<?= $this->endSection() ?>
