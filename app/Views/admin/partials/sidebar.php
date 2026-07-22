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
            $active = fn(...$paths) => array_reduce($paths, fn($c, $p) => $c || str_starts_with($uri, $p), false);
        ?>

        <div class="collapse navbar-collapse" id="sb-menu">
            <ul class="navbar-nav pt-2">

                <li class="nav-item">
                    <a class="nav-link <?= $uri === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ti ti-dashboard icon me-2 fs-5"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/posts','admin/categories','admin/tags','admin/comments') ? 'active' : '' ?>" 
                       href="#sb-konten" data-bs-toggle="collapse" role="button" aria-expanded="<?= $active('admin/posts','admin/categories','admin/tags','admin/comments') ? 'true' : 'false' ?>">
                        <i class="ti ti-article icon me-2 fs-5"></i> Konten
                        <i class="ti ti-chevron-down icon ms-auto transition"></i>
                    </a>
                    <div class="collapse <?= $active('admin/posts','admin/categories','admin/tags','admin/comments') ? 'show' : '' ?>" id="sb-konten">
                        <div class="ps-3 py-1">
                            <a class="nav-link small <?= $active('admin/posts') ? 'active' : '' ?>" href="/admin/posts">Postingan</a>
                            <a class="nav-link small <?= $uri === 'admin/categories' ? 'active' : '' ?>" href="/admin/categories">Kategori</a>
                            <a class="nav-link small <?= $active('admin/tags') ? 'active' : '' ?>" href="/admin/tags">Tag</a>
                            <a class="nav-link small <?= $active('admin/comments') ? 'active' : '' ?>" href="/admin/comments">Komentar</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/gallery','admin/videos','admin/albums') ? 'active' : '' ?>"
                       href="#sb-media" data-bs-toggle="collapse" role="button" aria-expanded="<?= $active('admin/gallery','admin/videos','admin/albums') ? 'true' : 'false' ?>">
                        <i class="ti ti-photo icon me-2 fs-5"></i> Media
                        <i class="ti ti-chevron-down icon ms-auto transition"></i>
                    </a>
                    <div class="collapse <?= $active('admin/gallery','admin/videos','admin/albums') ? 'show' : '' ?>" id="sb-media">
                        <div class="ps-3 py-1">
                            <a class="nav-link small <?= $active('admin/gallery') ? 'active' : '' ?>" href="/admin/gallery">Galeri Foto</a>
                            <a class="nav-link small <?= $active('admin/albums') ? 'active' : '' ?>" href="/admin/albums">Album</a>
                            <a class="nav-link small <?= $active('admin/videos') ? 'active' : '' ?>" href="/admin/videos">Video</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq') ? 'active' : '' ?>"
                       href="#sb-master" data-bs-toggle="collapse" role="button">
                        <i class="ti ti-database icon me-2 fs-5"></i> Master Data
                        <i class="ti ti-chevron-down icon ms-auto transition"></i>
                    </a>
                    <div class="collapse <?= $active('admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq') ? 'show' : '' ?>" id="sb-master">
                        <div class="ps-3 py-1">
                            <a class="nav-link small <?= $active('admin/guru') ? 'active' : '' ?>" href="/admin/guru">Guru</a>
                            <a class="nav-link small <?= $active('admin/staff') ? 'active' : '' ?>" href="/admin/staff">Staff</a>
                            <a class="nav-link small <?= $active('admin/jurusan') ? 'active' : '' ?>" href="/admin/jurusan">Jurusan</a>
                            <a class="nav-link small <?= $active('admin/fasilitas') ? 'active' : '' ?>" href="/admin/fasilitas">Fasilitas</a>
                            <a class="nav-link small <?= $active('admin/alumni') ? 'active' : '' ?>" href="/admin/alumni">Alumni</a>
                            <a class="nav-link small <?= $active('admin/sliders') ? 'active' : '' ?>" href="/admin/sliders">Slider</a>
                            <a class="nav-link small <?= $active('admin/partners') ? 'active' : '' ?>" href="/admin/partners">Partner</a>
                            <a class="nav-link small <?= $active('admin/testimoni') ? 'active' : '' ?>" href="/admin/testimoni">Testimoni</a>
                            <a class="nav-link small <?= $active('admin/faq') ? 'active' : '' ?>" href="/admin/faq">FAQ</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/downloads') ? 'active' : '' ?>" href="/admin/downloads">
                        <i class="ti ti-download icon me-2 fs-5"></i> Download
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/menus') ? 'active' : '' ?>" href="/admin/menus">
                        <i class="ti ti-menu-2 icon me-2 fs-5"></i> Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb">
                        <i class="ti ti-school icon me-2 fs-5"></i> PPDB
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $active('admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs') ? 'active' : '' ?>"
                       href="#sb-mgmt" data-bs-toggle="collapse" role="button">
                        <i class="ti ti-settings icon me-2 fs-5"></i> Manajemen
                        <i class="ti ti-chevron-down icon ms-auto transition"></i>
                    </a>
                    <div class="collapse <?= $active('admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs') ? 'show' : '' ?>" id="sb-mgmt">
                        <div class="ps-3 py-1">
                            <a class="nav-link small <?= $active('admin/users') ? 'active' : '' ?>" href="/admin/users">Pengguna</a>
                            <a class="nav-link small <?= $active('admin/roles') ? 'active' : '' ?>" href="/admin/roles">Role & Permission</a>
                            <a class="nav-link small <?= $active('admin/contacts') ? 'active' : '' ?>" href="/admin/contacts">Pesan Masuk</a>
                            <a class="nav-link small <?= $active('admin/visitors') ? 'active' : '' ?>" href="/admin/visitors">Pengunjung</a>
                            <a class="nav-link small <?= $active('admin/logs') ? 'active' : '' ?>" href="/admin/logs">Log Aktivitas</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $uri === 'admin/settings' ? 'active' : '' ?>" href="/admin/settings">
                        <i class="ti ti-adjustments icon me-2 fs-5"></i> Pengaturan
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a class="nav-link" href="/" target="_blank">
                        <i class="ti ti-eye icon me-2 fs-5"></i> Lihat Website
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">
                        <i class="ti ti-logout icon me-2 fs-5"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>

<style>
    .navbar-vertical .nav-link { display: flex; align-items: center; border-radius: 8px; margin: 2px 8px; font-size: .88rem; font-weight: 500; padding: 10px 14px; color: #94a3b8 !important; text-decoration: none; transition: background .2s, color .2s; }
    .navbar-vertical .nav-link:hover { background: rgba(255,255,255,0.05); color: #fff !important; }
    .navbar-vertical .nav-link.active { background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(124,58,237,0.15)); color: #fff !important; font-weight: 600; }
    .navbar-vertical .nav-link.small { font-size: .82rem; padding: 7px 12px 7px 28px; margin: 1px 0; }
    .navbar-vertical .nav-link .ti-chevron-down.transition { transition: transform .25s ease; font-size: .75rem; opacity: .6; }
    .navbar-vertical .nav-link[aria-expanded="true"] .ti-chevron-down { transform: rotate(180deg); opacity: 1; }
    .navbar-vertical .collapse { transition: height .3s ease; }
</style>
