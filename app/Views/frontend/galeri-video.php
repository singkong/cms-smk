<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Galeri Video</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-center mb-5">Galeri Video</h2>

        <?php if (empty($videos)): ?>
            <div class="empty">
                <div class="empty-icon"><i class="ti ti-video icon" style="font-size:4rem;"></i></div>
                <p class="empty-title">Belum ada video</p>
            </div>
        <?php else: ?>
            <div class="row g-4" id="video-grid">
                <?php foreach ($videos as $video): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 video-card">
                        <div class="position-relative" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#videoModal" data-embed="<?= esc($video->embed_code ?? '') ?>" data-url="<?= esc($video->url ?? '') ?>">
                            <?php
                            $ytId = '';
                            if (!empty($video->url)) {
                                parse_str(parse_url($video->url, PHP_URL_QUERY), $ytParams);
                                $ytId = $ytParams['v'] ?? '';
                            }
                            ?>
                            <div style="height:200px;overflow:hidden;">
                                <?php if (!empty($video->thumbnail)): ?>
                                    <img src="<?= esc($video->thumbnail) ?>" alt="<?= esc($video->title) ?>" class="w-100" style="height:200px;object-fit:cover;">
                                <?php elseif ($ytId): ?>
                                    <img src="https://img.youtube.com/vi/<?= esc($ytId) ?>/hqdefault.jpg" alt="<?= esc($video->title) ?>" class="w-100" style="height:200px;object-fit:cover;">
                                <?php else: ?>
                                    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:200px;">
                                        <i class="ti ti-video icon text-white" style="font-size:3rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <span class="avatar bg-red rounded-circle" style="width:60px;height:60px;">
                                    <i class="ti ti-player-play-filled icon text-white" style="font-size:1.5rem;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($video->title) ?></h5>
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

<div class="modal modal-blur fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-2">
                <div class="ratio ratio-16x9" id="videoModalContainer">
                    <iframe src="" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.querySelectorAll('.video-card .position-relative').forEach(function(card) {
    card.addEventListener('click', function() {
        var embed = this.getAttribute('data-embed');
        var url = this.getAttribute('data-url');
        var iframe = document.querySelector('#videoModalContainer iframe');

        if (embed) {
            var temp = document.createElement('div');
            temp.innerHTML = embed;
            var iframeSrc = temp.querySelector('iframe');
            if (iframeSrc) {
                iframe.setAttribute('src', iframeSrc.getAttribute('src') + '?autoplay=1');
            } else {
                iframe.setAttribute('src', embed + (embed.indexOf('?') > -1 ? '&' : '?') + 'autoplay=1');
            }
        } else if (url) {
            var ytMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
            if (ytMatch) {
                iframe.setAttribute('src', 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1');
            } else {
                iframe.setAttribute('src', url);
            }
        }
    });
});

document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
    document.querySelector('#videoModalContainer iframe').setAttribute('src', '');
});
</script>
<?= $this->endSection() ?>
