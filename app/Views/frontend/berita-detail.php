<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/berita">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc(character_limiter($post->title, 50)) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <article>
                    <?php if (!empty($post->image)): ?>
                        <div class="card mb-4">
                            <img src="<?= esc($post->image) ?>" alt="<?= esc($post->title) ?>" class="card-img-top rounded" style="max-height:450px;object-fit:cover;width:100%;">
                        </div>
                    <?php endif; ?>

                    <h1 class="fw-bold mb-3"><?= esc($post->title) ?></h1>

                    <div class="d-flex flex-wrap align-items-center gap-3 text-muted mb-4">
                        <?php if (!empty($post->author)): ?>
                            <span><i class="ti ti-user icon me-1"></i> <?= esc($post->author) ?></span>
                        <?php endif; ?>
                        <span><i class="ti ti-calendar icon me-1"></i> <?= date('d M Y, H:i', strtotime($post->published_at ?? $post->created_at)) ?></span>
                        <span><i class="ti ti-eye icon me-1"></i> <?= number_format($post->views ?? 0, 0, ',', '.') ?> views</span>
                        <?php if (!empty($post->category_name)): ?>
                            <span class="badge bg-blue"><?= esc($post->category_name) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div style="line-height:1.9;font-size:1.05rem;">
                                <?= $post->content ?>
                            </div>
                        </div>
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
                            <a href="https://t.me/share/url?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($post->title) ?>" class="btn btn-sm btn-outline-cyan" target="_blank" rel="noopener">
                                <i class="ti ti-brand-telegram icon"></i>
                            </a>
                        </div>
                        <a href="/berita" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left icon me-1"></i> Kembali
                        </a>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <?php if (!empty($categories)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Kategori</h4>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="/berita" class="list-group-item list-group-item-action">Semua Kategori</a>
                        <?php foreach ($categories as $cat): ?>
                        <a href="/berita?kategori=<?= esc($cat->slug) ?>" class="list-group-item list-group-item-action">
                            <?= esc($cat->name) ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($recent)): ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Berita Terbaru</h4>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recent as $r): ?>
                        <a href="/berita/<?= esc($r->slug) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center gap-3">
                                <?php if (!empty($r->image)): ?>
                                    <img src="<?= esc($r->image) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                <?php endif; ?>
                                <div>
                                    <div class="text-truncate" style="max-width:220px;"><?= esc($r->title) ?></div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($r->created_at)) ?></small>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
