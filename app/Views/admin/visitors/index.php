<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Statistik<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-eye icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Hari Ini</div>
                        <div class="h2 m-0"><?= $today_visitors ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-green text-white avatar">
                            <i class="ti ti-calendar-week icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">7 Hari</div>
                        <div class="h2 m-0"><?= $week_visitors ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-yellow text-white avatar">
                            <i class="ti ti-calendar-month icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Bulan Ini</div>
                        <div class="h2 m-0"><?= $month_visitors ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-purple text-white avatar">
                            <i class="ti ti-users icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Total</div>
                        <div class="h2 m-0"><?= $total_visitors ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengunjung 7 Hari Terakhir</h3>
            </div>
            <div class="card-body">
                <canvas id="visitorChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Perangkat</h3>
            </div>
            <div class="card-body">
                <canvas id="deviceChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($page_stats)): ?>
<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Halaman Populer</h3></div>
            <div class="list-group list-group-flush">
                <?php foreach ($page_stats as $page): ?>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col text-truncate">
                            <code class="text-muted small"><?= esc($page->page) ?></code>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-blue"><?= $page->count ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Browser</h3></div>
            <div class="list-group list-group-flush">
                <?php foreach ($browser_stats as $browser): ?>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col text-truncate">
                            <?= esc($browser->browser ?: 'Unknown') ?>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-cyan"><?= $browser->count ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengunjung Terbaru</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Negara</th>
                            <th>Browser</th>
                            <th>Device</th>
                            <th>OS</th>
                            <th>Halaman</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_visitors)): ?>
                            <?php foreach ($recent_visitors as $v): ?>
                            <tr>
                                <td><code><?= esc($v->ip_address) ?></code></td>
                                <td><?= esc($v->country ?: '-') ?></td>
                                <td><?= esc($v->browser ?: '-') ?></td>
                                <td>
                                    <?php
                                    $deviceIcon = 'ti-device-desktop';
                                    $device = strtolower($v->device ?? '');
                                    if (strpos($device, 'mobile') !== false) $deviceIcon = 'ti-device-mobile';
                                    elseif (strpos($device, 'tablet') !== false) $deviceIcon = 'ti-device-tablet';
                                    ?>
                                    <i class="ti <?= $deviceIcon ?> icon me-1 text-muted"></i>
                                    <?= esc($v->device ?: '-') ?>
                                </td>
                                <td><?= esc($v->os ?: '-') ?></td>
                                <td class="text-truncate" style="max-width:200px;">
                                    <small><?= esc($v->page ?: '/') ?></small>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M H:i', strtotime($v->created_at)) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">Belum ada data pengunjung</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
new Chart(document.getElementById('visitorChart'), {
    type: 'line',
    data: {
        labels: <?= json_encode(array_keys($visitors_per_day)) ?>,
        datasets: [{
            label: 'Pengunjung',
            data: <?= json_encode(array_values($visitors_per_day)) ?>,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37, 99, 235, 0.1)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#2563eb',
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

<?php if (!empty($device_stats)): ?>
var deviceLabels = [];
var deviceData = [];
var deviceColors = ['#2563eb', '#22c55e', '#f59e0b', '#8b5cf6', '#ef4444', '#06b6d4'];
<?php $di = 0; foreach ($device_stats as $d): ?>
deviceLabels.push('<?= esc($d->device ?: 'Unknown') ?>');
deviceData.push(<?= $d->count ?>);
<?php $di++; endforeach; ?>

new Chart(document.getElementById('deviceChart'), {
    type: 'doughnut',
    data: {
        labels: deviceLabels,
        datasets: [{
            data: deviceData,
            backgroundColor: deviceColors.slice(0, deviceLabels.length),
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { padding: 16, usePointStyle: true }
            }
        }
    }
});
<?php endif; ?>
</script>
<?= $this->endSection() ?>
