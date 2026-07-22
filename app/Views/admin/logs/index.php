<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Monitoring<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Log Aktivitas</h3>
                <div class="card-actions">
                    <a href="/admin/logs/login" class="btn btn-ghost-primary">
                        <i class="ti ti-login icon"></i> Log Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="get" action="/admin/logs" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">User</label>
                        <input type="text" name="user" class="form-control" placeholder="Username..." value="<?= esc($filters['user'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Module</label>
                        <select name="module" class="form-select">
                            <option value="">Semua Module</option>
                            <?php foreach ($modules as $mod): ?>
                            <option value="<?= esc($mod->module) ?>" <?= ($filters['module'] ?? '') === $mod->module ? 'selected' : '' ?>>
                                <?= esc($mod->module) ?>
                            </option>
                            <?php endforeach; ?>
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
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search icon"></i> Filter
                            </button>
                            <a href="/admin/logs" class="btn btn-ghost-secondary" title="Reset">
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
                            <th>User</th>
                            <th>Module</th>
                            <th>Action</th>
                            <th>Deskripsi</th>
                            <th>IP Address</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach ($logs as $i => $log): ?>
                            <tr>
                                <td class="text-muted small"><?= $i + 1 ?></td>
                                <td>
                                    <span class="fw-medium"><?= esc($log->username ?: 'System') ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-blue"><?= esc($log->module) ?></span>
                                </td>
                                <td>
                                    <?php
                                    $actionColors = [
                                        'create' => 'bg-green',
                                        'update' => 'bg-yellow',
                                        'delete' => 'bg-red',
                                        'approve' => 'bg-cyan',
                                        'spam' => 'bg-orange',
                                        'export' => 'bg-purple',
                                        'update_permissions' => 'bg-indigo',
                                        'update_settings' => 'bg-teal',
                                        'update_status' => 'bg-pink',
                                    ];
                                    $actionColor = $actionColors[$log->action] ?? 'bg-blue';
                                    ?>
                                    <span class="badge <?= $actionColor ?>"><?= esc($log->action) ?></span>
                                </td>
                                <td class="text-truncate" style="max-width:300px;">
                                    <?= esc($log->description) ?>
                                </td>
                                <td><code class="small"><?= esc($log->ip_address) ?></code></td>
                                <td class="text-muted small">
                                    <?= date('d M Y H:i:s', strtotime($log->created_at)) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">Tidak ada data log aktivitas</div>
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
