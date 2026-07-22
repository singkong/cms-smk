<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero" style="min-height:35vh;background:linear-gradient(135deg,#020617,#0f172a,#1e3a5f,#b45309);">
    <div class="hero-content container text-center">
        <h1 class="hero-title">Pengumuman</h1>
        <p class="hero-desc">Informasi resmi dan pengumuman penting dari <?= esc($setting->nama_sekolah ?? 'sekolah') ?></p>
    </div>
    <div class="hero-wave"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="#f8fafc" d="M0,40L48,44C96,48,192,56,288,52C384,48,480,32,576,32C672,32,768,48,864,52C960,56,1056,48,1152,44C1248,40,1344,40,1392,40L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z"></path></svg></div>
</section>

<section>
    <div class="container">
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
