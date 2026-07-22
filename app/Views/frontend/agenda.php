<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agenda</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Agenda</h2>

        <?php if (empty($agenda)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-calendar-event icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada agenda</p>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php foreach ($agenda as $index => $a): ?>
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-center flex-shrink-0" style="min-width:80px;">
                                    <div class="rounded-3 bg-teal text-white p-2">
                                        <div class="small"><?= date('d', strtotime($a->published_at ?? $a->created_at)) ?></div>
                                        <div class="fw-bold"><?= date('M', strtotime($a->published_at ?? $a->created_at)) ?></div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-2"><?= esc($a->title) ?></h5>
                                    <div class="d-flex flex-wrap gap-3 text-muted small mb-2">
                                        <?php
                                        $excerpt = $a->excerpt ?: $a->content ?? '';
                                        preg_match('/Waktu\s*:\s*([^\n]+)/i', strip_tags($excerpt), $timeMatch);
                                        preg_match('/Lokasi\s*:\s*([^\n]+)/i', strip_tags($excerpt), $locMatch);
                                        ?>
                                        <?php if (!empty($timeMatch[1])): ?>
                                            <span><i class="ti ti-clock icon me-1"></i> <?= esc(trim($timeMatch[1])) ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($locMatch[1])): ?>
                                            <span><i class="ti ti-map-pin icon me-1"></i> <?= esc(trim($locMatch[1])) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-muted mb-2">
                                        <?= esc(character_limiter(strip_tags($excerpt), 150)) ?>
                                    </p>
                                    <?php if (!empty($a->author)): ?>
                                        <small class="text-muted"><i class="ti ti-user icon me-1"></i> <?= esc($a->author) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-4">
                <?= $pager ? $pager : '' ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
