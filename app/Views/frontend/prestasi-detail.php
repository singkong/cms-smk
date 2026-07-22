<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/prestasi">Prestasi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc(character_limiter($post->title, 50)) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8 mx-auto">
                <article>
                    <div class="card">
                        <?php if (!empty($post->image)): ?>
                            <img src="<?= esc($post->image) ?>" alt="<?= esc($post->title) ?>" class="card-img-top" style="max-height:400px;object-fit:cover;width:100%;">
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="avatar avatar-sm rounded-circle bg-warning-lt">
                                    <i class="ti ti-trophy icon text-warning"></i>
                                </span>
                                <span class="badge bg-yellow-lt text-yellow fs-11">Prestasi</span>
                            </div>

                            <h1 class="fw-bold mb-3"><?= esc($post->title) ?></h1>

                            <div class="d-flex flex-wrap align-items-center gap-3 text-muted mb-4">
                                <?php if (!empty($post->author)): ?>
                                    <span><i class="ti ti-user icon me-1"></i> <?= esc($post->author) ?></span>
                                <?php endif; ?>
                                <span><i class="ti ti-calendar icon me-1"></i> <?= date('d M Y, H:i', strtotime($post->published_at ?? $post->created_at)) ?></span>
                                <span><i class="ti ti-eye icon me-1"></i> <?= number_format($post->views ?? 0, 0, ',', '.') ?> views</span>
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
                                <a href="/prestasi" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left icon me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($recent)): ?>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Prestasi Lainnya</h4>
                        </div>
                        <div class="row g-3 p-3">
                            <?php foreach ($recent as $r): ?>
                            <div class="col-sm-6">
                                <a href="/prestasi/<?= esc($r->slug) ?>" class="card card-sm text-reset text-decoration-none h-100">
                                    <div class="card-body">
                                        <?php if (!empty($r->image)): ?>
                                            <img src="<?= esc($r->image) ?>" alt="" class="rounded mb-2" style="width:100%;height:120px;object-fit:cover;">
                                        <?php endif; ?>
                                        <div class="fw-medium"><?= esc($r->title) ?></div>
                                        <small class="text-muted"><?= date('d M Y', strtotime($r->created_at)) ?></small>
                                    </div>
                                </a>
                            </div>
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
