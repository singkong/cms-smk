<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;background:linear-gradient(135deg,#020617,#0f172a,#14532d,#16a34a);">
    <div class="hero-content container text-center">
        <h1 class="hero-title">Prestasi</h1>
        <p class="hero-desc">Raihan prestasi membanggakan siswa dan guru <?= esc($setting->nama_sekolah ?? 'SMK') ?></p>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
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
