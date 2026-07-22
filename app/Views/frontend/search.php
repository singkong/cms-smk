<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pencarian</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold text-center mb-2">Pencarian</h2>
                <p class="text-center text-muted mb-4">
                    <?php if (!empty($query)): ?>
                        Hasil pencarian untuk: <strong>"<?= esc($query) ?>"</strong>
                    <?php endif; ?>
                </p>

                <form action="/search" method="GET" class="mb-5">
                    <div class="input-group input-group-lg">
                        <input type="text" name="q" class="form-control" placeholder="Cari berita, pengumuman, prestasi..." value="<?= esc($query ?? '') ?>" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search icon me-1"></i> Cari
                        </button>
                    </div>
                </form>

                <?php if (empty($query)): ?>
                    <div class="empty">
                        <div class="empty-icon"><i class="ti ti-search icon" style="font-size:4rem;"></i></div>
                        <p class="empty-title">Masukkan kata kunci</p>
                        <p class="empty-subtitle text-muted">Ketik kata kunci untuk mencari konten</p>
                    </div>
                <?php elseif (empty($results)): ?>
                    <div class="empty">
                        <div class="empty-icon"><i class="ti ti-file-off icon" style="font-size:4rem;"></i></div>
                        <p class="empty-title">Tidak ditemukan</p>
                        <p class="empty-subtitle text-muted">Tidak ada hasil untuk "<strong><?= esc($query) ?></strong>". Coba kata kunci lain.</p>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-4">Ditemukan <?= $pager ? $pager->getTotal() : count($results) ?> hasil</p>

                    <?php foreach ($results as $row): ?>
                    <?php
                    $typeUrl = match($row->type) {
                        'pengumuman' => '/pengumuman/',
                        'agenda' => '/agenda#',
                        'prestasi' => '/prestasi/',
                        'halaman' => '/pages/',
                        default => '/berita/',
                    };
                    $typeLabel = match($row->type) {
                        'pengumuman' => 'Pengumuman',
                        'agenda' => 'Agenda',
                        'prestasi' => 'Prestasi',
                        'halaman' => 'Halaman',
                        default => 'Berita',
                    };
                    $typeColor = match($row->type) {
                        'pengumuman' => 'bg-orange',
                        'agenda' => 'bg-teal',
                        'prestasi' => 'bg-yellow',
                        'halaman' => 'bg-purple',
                        default => 'bg-blue',
                    };
                    ?>
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <?php if (!empty($row->image)): ?>
                                    <img src="<?= base_url('uploads/posts/' . $row->image) ?>" alt="" style="width:100px;height:75px;object-fit:cover;border-radius:8px;" class="flex-shrink-0">
                                <?php endif; ?>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge <?= $typeColor ?>"><?= $typeLabel ?></span>
                                        <?php if (!empty($row->category_name)): ?>
                                            <span class="badge bg-blue-lt"><?= esc($row->category_name) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="mb-1">
                                        <a href="<?= esc($typeUrl . $row->slug) ?>" class="text-reset text-decoration-none">
                                            <?= esc(highlightKeyword($row->title, $query ?? '')) ?>
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-2">
                                        <?= esc(character_limiter(highlightKeyword(strip_tags($row->excerpt ?: $row->content ?? ''), $query ?? ''), 200)) ?>
                                    </p>
                                    <div class="d-flex align-items-center gap-3 text-muted small">
                                        <span><i class="ti ti-calendar icon me-1"></i> <?= date('d M Y', strtotime($row->published_at ?? $row->created_at)) ?></span>
                                        <?php if (!empty($row->author)): ?>
                                            <span><i class="ti ti-user icon me-1"></i> <?= esc($row->author) ?></span>
                                        <?php endif; ?>
                                        <span><i class="ti ti-eye icon me-1"></i> <?= number_format($row->views ?? 0, 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="mt-4">
                        <?= $pager ? $pager : '' ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
