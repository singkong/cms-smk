<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prestasi</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Prestasi</h2>

        <?php if (empty($prestasi)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-trophy icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada data prestasi</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($prestasi as $p): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (!empty($p->image)): ?>
                            <div style="height:200px;overflow:hidden;">
                                <a href="/prestasi/<?= esc($p->slug) ?>">
                                    <img src="<?= base_url('uploads/posts/' . $p->image) ?>" alt="<?= esc($p->title) ?>" class="card-img-top" style="height:100%;width:100%;object-fit:cover;">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <span class="avatar avatar-sm rounded-circle bg-warning-lt me-2 flex-shrink-0">
                                    <i class="ti ti-trophy icon text-warning"></i>
                                </span>
                                <span class="badge bg-yellow-lt text-yellow">Prestasi</span>
                                <small class="text-muted ms-auto"><?= date('d M Y', strtotime($p->published_at ?? $p->created_at)) ?></small>
                            </div>
                            <h5 class="card-title">
                                <a href="/prestasi/<?= esc($p->slug) ?>" class="text-reset text-decoration-none">
                                    <?= esc($p->title) ?>
                                </a>
                            </h5>
                            <p class="text-muted flex-grow-1">
                                <?= esc(character_limiter(strip_tags($p->excerpt ?: $p->content ?? ''), 100)) ?>
                            </p>
                            <div class="d-flex align-items-center mt-auto">
                                <?php if (!empty($p->author)): ?>
                                    <small class="text-muted"><i class="ti ti-user icon me-1"></i> <?= esc($p->author) ?></small>
                                <?php endif; ?>
                                <a href="/prestasi/<?= esc($p->slug) ?>" class="btn btn-sm btn-outline-warning ms-auto">
                                    Detail <i class="ti ti-arrow-right icon ms-1"></i>
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
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
