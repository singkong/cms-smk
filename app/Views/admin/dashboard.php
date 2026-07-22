<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-primary text-white avatar"><i class="ti ti-article icon"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_posts ?> Postingan</div><div class="text-muted small"><?= $total_published ?> Published</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-success text-white avatar"><i class="ti ti-users icon"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_users ?> Pengguna</div><div class="text-muted small">Aktif</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-warning text-white avatar"><i class="ti ti-eye icon"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_visitors ?> Visitor</div><div class="text-muted small"><?= $today_visitors ?> Hari Ini</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-danger text-white avatar"><i class="ti ti-mail icon"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $unread_messages ?> Pesan</div><div class="text-muted small">Belum Dibaca</div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Postingan Terbaru</h3></div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead><tr><th>Judul</th><th>Tipe</th><th>Status</th><th>Tanggal</th></tr></thead>
                    <tbody>
                        <?php foreach ($recent_posts as $post): ?>
                        <tr>
                            <td class="text-truncate" style="max-width:300px;"><?= esc($post->title) ?></td>
                            <td><span class="badge bg-blue"><?= esc($post->type) ?></span></td>
                            <td><?= $post->status === 'published' ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-secondary">Draft</span>' ?></td>
                            <td class="text-muted"><?= date('d M Y', strtotime($post->created_at)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title">Statistik Postingan</h3></div>
            <div class="card-body"><canvas id="chartPostTypes" height="80"></canvas></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Aktivitas Login</h3></div>
            <div class="list-group list-group-flush overflow-auto" style="max-height:320px;">
                <?php foreach ($recent_logins as $log): ?>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto"><span class="badge <?= $log->status === 'success' ? 'bg-success' : 'bg-danger' ?>"></span></div>
                        <div class="col text-truncate"><span class="text-body d-block"><?= esc($log->username) ?></span></div>
                        <div class="col-auto text-muted small"><?= date('d M H:i', strtotime($log->created_at)) ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
new Chart(document.getElementById('chartPostTypes'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($post_types_chart)) ?>,
        datasets: [{
            label: 'Jumlah',
            data: <?= json_encode(array_values($post_types_chart)) ?>,
            backgroundColor: ['#2563eb','#f59e0b','#06b6d4','#22c55e','#8b5cf6'],
            borderRadius: 6,
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});
</script>
<?= $this->endSection() ?>
