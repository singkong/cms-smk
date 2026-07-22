<?= $this->extend('layouts/admin') ?>
<?= $this->section('pretitle') ?>Konten<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-3">
    <div class="col-sm-6 col-md-3">
        <div class="card card-sm stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                            <i class="ti ti-messages icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Semua</div>
                        <div class="h2 m-0"><?= $pending_count + $approved_count + $spam_count ?></div>
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
                        <span class="bg-yellow text-white avatar">
                            <i class="ti ti-clock icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Pending</div>
                        <div class="h2 m-0"><?= $pending_count ?></div>
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
                        <div class="font-weight-medium">Approved</div>
                        <div class="h2 m-0"><?= $approved_count ?></div>
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
                            <i class="ti ti-alert-triangle icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Spam</div>
                        <div class="h2 m-0"><?= $spam_count ?></div>
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
                <h3 class="card-title">Daftar Komentar</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Post</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $i => $comment): ?>
                            <tr>
                                <td class="text-muted small"><?= $i + 1 ?></td>
                                <td>
                                    <a href="/berita/<?= esc($comment->post_slug ?? '#') ?>" target="_blank" class="text-reset text-truncate d-block" style="max-width:150px;" title="<?= esc($comment->post_title) ?>">
                                        <?= esc($comment->post_title ?: '(Post dihapus)') ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="fw-medium"><?= esc($comment->name) ?></span>
                                </td>
                                <td>
                                    <small class="text-muted"><?= esc($comment->email) ?></small>
                                </td>
                                <td class="text-truncate" style="max-width:250px;">
                                    <?= esc($comment->content) ?>
                                </td>
                                <td>
                                    <?php if ($comment->status === 'approved'): ?>
                                    <span class="badge bg-success">Approved</span>
                                    <?php elseif ($comment->status === 'spam'): ?>
                                    <span class="badge bg-danger">Spam</span>
                                    <?php else: ?>
                                    <span class="badge bg-warning">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M H:i', strtotime($comment->created_at)) ?>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <?php if ($comment->status !== 'approved'): ?>
                                        <a href="/admin/comments/approve/<?= $comment->id ?>" class="btn btn-sm btn-icon btn-ghost-success" title="Approve" onclick="return confirm('Setujui komentar ini?')">
                                            <i class="ti ti-check icon"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($comment->status !== 'spam'): ?>
                                        <a href="/admin/comments/spam/<?= $comment->id ?>" class="btn btn-sm btn-icon btn-ghost-warning" title="Spam" onclick="return confirm('Tandai sebagai spam?')">
                                            <i class="ti ti-alert-triangle icon"></i>
                                        </a>
                                        <?php endif; ?>
                                        <a href="/admin/comments/delete/<?= $comment->id ?>" class="btn btn-sm btn-icon btn-ghost-danger" title="Hapus" onclick="return confirm('Hapus komentar ini?')">
                                            <i class="ti ti-trash icon"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">Belum ada komentar</div>
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
