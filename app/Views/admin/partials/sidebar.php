<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sb-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/dashboard" class="text-decoration-none text-white d-flex align-items-center gap-2">
                <span class="avatar avatar-sm bg-primary rounded-3 fw-bold"><?= strtoupper(substr($setting->nama_singkat ?? 'S', 0, 1)) ?></span>
                <span class="fw-bold"><?= esc($setting->nama_singkat ?? 'CMS') ?></span>
            </a>
        </h1>

        <?php
            $uri = $current_uri;
            $on = fn(...$p) => array_reduce($p, fn($c, $x) => $c || $uri === $x || str_starts_with($uri, $x), false);
        ?>

        <div class="collapse navbar-collapse" id="sb-menu">
            <ul class="navbar-nav pt-2">

                <?php
                // Helper to render a sidebar menu group
                $menuGroup = function($icon, $label, $items, $checkPaths) use ($on, $uri) {
                    $isActive = $on(...$checkPaths);
                ?>
                <li class="nav-item">
                    <a class="nav-link sb-parent <?= $isActive ? 'active' : '' ?>"
                       href="javascript:void(0)" onclick="toggleSB(this)" data-target="sb-<?= $label ?>">
                        <i class="ti ti-<?= $icon ?> icon me-2 fs-5"></i> <?= $label ?>
                        <i class="ti ti-chevron-down icon ms-auto sb-chevron <?= $isActive ? 'rotate' : '' ?>"></i>
                    </a>
                    <div class="sb-sub <?= $isActive ? 'open' : '' ?>" id="sb-<?= $label ?>">
                        <?php foreach ($items as $item): ?>
                        <a class="nav-link sb-sub-link <?= $uri === $item['path'] || str_starts_with($uri, $item['path'].'/') ? 'active' : '' ?>"
                           href="<?= $item['path'] ?>"><?= $item['label'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <?php }; ?>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link <?= $uri === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ti ti-dashboard icon me-2 fs-5"></i> Dashboard
                    </a>
                </li>

                <!-- Konten -->
                <?php $menuGroup('article', 'Konten', [
                    ['label'=>'Postingan','path'=>'/admin/posts'],
                    ['label'=>'Kategori','path'=>'/admin/categories'],
                    ['label'=>'Tag','path'=>'/admin/tags'],
                    ['label'=>'Komentar','path'=>'/admin/comments'],
                ], ['admin/posts','admin/categories','admin/tags','admin/comments']); ?>

                <!-- Media -->
                <?php $menuGroup('photo', 'Media', [
                    ['label'=>'Galeri Foto','path'=>'/admin/gallery'],
                    ['label'=>'Album','path'=>'/admin/albums'],
                    ['label'=>'Video','path'=>'/admin/videos'],
                ], ['admin/gallery','admin/albums','admin/videos']); ?>

                <!-- Master Data -->
                <?php $menuGroup('database', 'Master Data', [
                    ['label'=>'Guru','path'=>'/admin/guru'],
                    ['label'=>'Staff','path'=>'/admin/staff'],
                    ['label'=>'Jurusan','path'=>'/admin/jurusan'],
                    ['label'=>'Fasilitas','path'=>'/admin/fasilitas'],
                    ['label'=>'Alumni','path'=>'/admin/alumni'],
                    ['label'=>'Slider','path'=>'/admin/sliders'],
                    ['label'=>'Partner','path'=>'/admin/partners'],
                    ['label'=>'Testimoni','path'=>'/admin/testimoni'],
                    ['label'=>'FAQ','path'=>'/admin/faq'],
                ], ['admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq']); ?>

                <!-- Single items -->
                <li class="nav-item"><a class="nav-link <?= $on('admin/downloads') ? 'active' : '' ?>" href="/admin/downloads"><i class="ti ti-download icon me-2 fs-5"></i> Download</a></li>
                <li class="nav-item"><a class="nav-link <?= $on('admin/menus') ? 'active' : '' ?>" href="/admin/menus"><i class="ti ti-menu-2 icon me-2 fs-5"></i> Menu</a></li>
                <li class="nav-item"><a class="nav-link <?= $on('admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb"><i class="ti ti-school icon me-2 fs-5"></i> PPDB</a></li>

                <!-- Manajemen -->
                <?php $menuGroup('settings', 'Manajemen', [
                    ['label'=>'Pengguna','path'=>'/admin/users'],
                    ['label'=>'Role & Permission','path'=>'/admin/roles'],
                    ['label'=>'Pesan Masuk','path'=>'/admin/contacts'],
                    ['label'=>'Pengunjung','path'=>'/admin/visitors'],
                    ['label'=>'Log Aktivitas','path'=>'/admin/logs'],
                ], ['admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs']); ?>

                <!-- Settings -->
                <li class="nav-item"><a class="nav-link <?= $uri === 'admin/settings' ? 'active' : '' ?>" href="/admin/settings"><i class="ti ti-adjustments icon me-2 fs-5"></i> Pengaturan</a></li>

                <li class="nav-item mt-3"><a class="nav-link" href="/" target="_blank"><i class="ti ti-eye icon me-2 fs-5"></i> Lihat Website</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout"><i class="ti ti-logout icon me-2 fs-5"></i> Logout</a></li>

            </ul>
        </div>
    </div>
</aside>

<style>
    .navbar-vertical .nav-link { display: flex; align-items: center; border-radius: 8px; margin: 2px 8px; font-size: .88rem; font-weight: 500; padding: 10px 14px; color: #94a3b8 !important; text-decoration: none; transition: background .2s, color .2s; cursor: pointer; }
    .navbar-vertical .nav-link:hover { background: rgba(255,255,255,0.05); color: #fff !important; }
    .navbar-vertical .nav-link.active { background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(124,58,237,0.15)); color: #fff !important; font-weight: 600; }
    .sb-sub { overflow: hidden; max-height: 0; transition: max-height .35s ease; padding-left: 12px; }
    .sb-sub.open { max-height: 600px; }
    .sb-sub-link { font-size: .82rem !important; padding: 7px 12px 7px 12px !important; margin: 1px 4px !important; }
    .sb-chevron { font-size: .7rem; opacity: .5; transition: transform .3s ease; }
    .sb-chevron.rotate { transform: rotate(180deg); opacity: 1; }
</style>

<script>
function toggleSB(el) {
    var target = document.getElementById(el.dataset.target);
    if (!target) return;
    var chevron = el.querySelector('.sb-chevron');
    if (target.classList.contains('open')) {
        target.classList.remove('open');
        if (chevron) chevron.classList.remove('rotate');
    } else {
        target.classList.add('open');
        if (chevron) chevron.classList.add('rotate');
    }
}
</script>
