<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/pengumuman">Pengumuman</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($post->title) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8 mx-auto">
                <article>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="rounded-3 bg-primary text-white p-2 text-center" style="min-width:80px;">
                                    <div class="small"><?= date('d', strtotime($post->published_at ?? $post->created_at)) ?></div>
                                    <div class="fw-bold"><?= date('M', strtotime($post->published_at ?? $post->created_at)) ?></div>
                                    <div class="small"><?= date('Y', strtotime($post->published_at ?? $post->created_at)) ?></div>
                                </div>
                                <div>
                                    <h1 class="mb-1"><?= esc($post->title) ?></h1>
                                    <div class="text-muted small">
                                        <i class="ti ti-user icon me-1"></i> <?= esc($post->author ?? 'Admin') ?>
                                        <span class="mx-2">|</span>
                                        <i class="ti ti-eye icon me-1"></i> <?= number_format($post->views ?? 0, 0, ',', '.') ?> views
                                        <span class="mx-2">|</span>
                                        <i class="ti ti-clock icon me-1"></i> <?= date('H:i', strtotime($post->published_at ?? $post->created_at)) ?>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div style="line-height:1.9;font-size:1.05rem;">
                                <?= $post->content ?>
                            </div>

                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    <span class="text-muted">Bagikan:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">
                                        <i class="ti ti-brand-facebook icon"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($post->title) ?>" class="btn btn-sm btn-outline-info" target="_blank" rel="noopener">
                                        <i class="ti ti-brand-x icon"></i>
                                    </a>
                                    <a href="https://wa.me/?text=<?= urlencode($post->title . ' ' . current_url()) ?>" class="btn btn-sm btn-outline-success" target="_blank" rel="noopener">
                                        <i class="ti ti-brand-whatsapp icon"></i>
                                    </a>
                                </div>
                                <a href="/pengumuman" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left icon me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($recent)): ?>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Pengumuman Lainnya</h4>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach ($recent as $r): ?>
                            <a href="/pengumuman/<?= esc($r->slug) ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><?= esc($r->title) ?></span>
                                    <small class="text-muted"><?= date('d M Y', strtotime($r->created_at)) ?></small>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </article>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
