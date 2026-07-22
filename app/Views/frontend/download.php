<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Download</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Download</h2>

        <?php if (empty($downloads)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-download icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada file download</p>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Kategori</th>
                                <th>Ukuran</th>
                                <th class="text-center">Download</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 + (($pager ? $pager->getCurrentPage() : 1) - 1) * 15; ?>
                            <?php foreach ($downloads as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-file text-primary icon"></i>
                                        <div>
                                            <div><?= esc($d->title) ?></div>
                                            <?php if (!empty($d->description)): ?>
                                                <small class="text-muted"><?= esc($d->description) ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($d->category_name)): ?>
                                        <span class="badge bg-blue-lt"><?= esc($d->category_name) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($d->file_size)): ?>
                                        <span class="text-muted small"><?= esc($d->file_size) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-green-lt"><?= number_format($d->downloads ?? 0, 0, ',', '.') ?> x</span>
                                </td>
                                <td class="text-end">
                                    <a href="/download/file/<?= esc($d->id) ?>" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="ti ti-download icon me-1"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <?= $pager ? $pager : '' ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
