<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Pengumuman</h2>

        <?php if (empty($pengumuman)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-speakerphone icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada pengumuman</p>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline">
                        <?php foreach ($pengumuman as $index => $p): ?>
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="text-center flex-shrink-0" style="min-width:70px;">
                                        <div class="rounded-3 bg-primary text-white p-2">
                                            <div class="small"><?= date('d', strtotime($p->published_at ?? $p->created_at)) ?></div>
                                            <div class="fw-bold"><?= date('M', strtotime($p->published_at ?? $p->created_at)) ?></div>
                                            <div class="small"><?= date('Y', strtotime($p->published_at ?? $p->created_at)) ?></div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">
                                            <a href="/pengumuman/<?= esc($p->slug) ?>" class="text-reset text-decoration-none">
                                                <?= esc($p->title) ?>
                                            </a>
                                        </h5>
                                        <div class="text-muted small mb-2">
                                            <i class="ti ti-user icon me-1"></i> <?= esc($p->author ?? 'Admin') ?>
                                            <span class="mx-1">&middot;</span>
                                            <i class="ti ti-eye icon me-1"></i> <?= number_format($p->views ?? 0, 0, ',', '.') ?> views
                                        </div>
                                        <p class="text-muted mb-2">
                                            <?= esc(character_limiter(strip_tags($p->excerpt ?: $p->content ?? ''), 150)) ?>
                                        </p>
                                        <a href="/pengumuman/<?= esc($p->slug) ?>" class="btn btn-sm btn-outline-primary">
                                            Baca Selengkapnya <i class="ti ti-arrow-right icon ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-4">
                        <?= $pager ? $pager : '' ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
