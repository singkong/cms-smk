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
            $is = fn(...$p) => array_reduce($p, fn($c, $x) => $c || str_starts_with($uri, $x), false);
        ?>

        <div class="collapse navbar-collapse" id="sb-menu">
            <ul class="navbar-nav pt-2">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link <?= $uri === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ti ti-dashboard icon me-2 fs-5"></i> Dashboard
                    </a>
                </li>

                <!-- Konten -->
                <li class="nav-item">
                    <a class="nav-link sb-toggle <?= $is('admin/posts','admin/categories','admin/tags','admin/comments') ? 'active' : '' ?>"
                       href="javascript:void(0)" data-target="sb-konten">
                        <i class="ti ti-article icon me-2 fs-5"></i> Konten
                        <i class="ti ti-chevron-down icon ms-auto sb-chevron <?= $is('admin/posts','admin/categories','admin/tags','admin/comments') ? 'rotate' : '' ?>"></i>
                    </a>
                    <div class="sb-sub <?= $is('admin/posts','admin/categories','admin/tags','admin/comments') ? 'open' : '' ?>" id="sb-konten">
                        <a class="nav-link sb-sub-link <?= $is('admin/posts') ? 'active' : '' ?>" href="/admin/posts">Postingan</a>
                        <a class="nav-link sb-sub-link <?= $uri === 'admin/categories' ? 'active' : '' ?>" href="/admin/categories">Kategori</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/tags') ? 'active' : '' ?>" href="/admin/tags">Tag</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/comments') ? 'active' : '' ?>" href="/admin/comments">Komentar</a>
                    </div>
                </li>

                <!-- Media -->
                <li class="nav-item">
                    <a class="nav-link sb-toggle <?= $is('admin/gallery','admin/videos','admin/albums') ? 'active' : '' ?>"
                       href="javascript:void(0)" data-target="sb-media">
                        <i class="ti ti-photo icon me-2 fs-5"></i> Media
                        <i class="ti ti-chevron-down icon ms-auto sb-chevron <?= $is('admin/gallery','admin/videos','admin/albums') ? 'rotate' : '' ?>"></i>
                    </a>
                    <div class="sb-sub <?= $is('admin/gallery','admin/videos','admin/albums') ? 'open' : '' ?>" id="sb-media">
                        <a class="nav-link sb-sub-link <?= $is('admin/gallery') ? 'active' : '' ?>" href="/admin/gallery">Galeri Foto</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/albums') ? 'active' : '' ?>" href="/admin/albums">Album</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/videos') ? 'active' : '' ?>" href="/admin/videos">Video</a>
                    </div>
                </li>

                <!-- Master Data -->
                <li class="nav-item">
                    <a class="nav-link sb-toggle <?= $is('admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq') ? 'active' : '' ?>"
                       href="javascript:void(0)" data-target="sb-master">
                        <i class="ti ti-database icon me-2 fs-5"></i> Master Data
                        <i class="ti ti-chevron-down icon ms-auto sb-chevron <?= $is('admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq') ? 'rotate' : '' ?>"></i>
                    </a>
                    <div class="sb-sub <?= $is('admin/guru','admin/staff','admin/jurusan','admin/fasilitas','admin/alumni','admin/sliders','admin/partners','admin/testimoni','admin/faq') ? 'open' : '' ?>" id="sb-master">
                        <a class="nav-link sb-sub-link <?= $is('admin/guru') ? 'active' : '' ?>" href="/admin/guru">Guru</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/staff') ? 'active' : '' ?>" href="/admin/staff">Staff</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/jurusan') ? 'active' : '' ?>" href="/admin/jurusan">Jurusan</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/fasilitas') ? 'active' : '' ?>" href="/admin/fasilitas">Fasilitas</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/alumni') ? 'active' : '' ?>" href="/admin/alumni">Alumni</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/sliders') ? 'active' : '' ?>" href="/admin/sliders">Slider</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/partners') ? 'active' : '' ?>" href="/admin/partners">Partner</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/testimoni') ? 'active' : '' ?>" href="/admin/testimoni">Testimoni</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/faq') ? 'active' : '' ?>" href="/admin/faq">FAQ</a>
                    </div>
                </li>

                <!-- Single items -->
                <li class="nav-item">
                    <a class="nav-link <?= $is('admin/downloads') ? 'active' : '' ?>" href="/admin/downloads">
                        <i class="ti ti-download icon me-2 fs-5"></i> Download
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $is('admin/menus') ? 'active' : '' ?>" href="/admin/menus">
                        <i class="ti ti-menu-2 icon me-2 fs-5"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $is('admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb">
                        <i class="ti ti-school icon me-2 fs-5"></i> PPDB
                    </a>
                </li>

                <!-- Manajemen -->
                <li class="nav-item">
                    <a class="nav-link sb-toggle <?= $is('admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs') ? 'active' : '' ?>"
                       href="javascript:void(0)" data-target="sb-mgmt">
                        <i class="ti ti-settings icon me-2 fs-5"></i> Manajemen
                        <i class="ti ti-chevron-down icon ms-auto sb-chevron <?= $is('admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs') ? 'rotate' : '' ?>"></i>
                    </a>
                    <div class="sb-sub <?= $is('admin/users','admin/roles','admin/contacts','admin/visitors','admin/logs') ? 'open' : '' ?>" id="sb-mgmt">
                        <a class="nav-link sb-sub-link <?= $is('admin/users') ? 'active' : '' ?>" href="/admin/users">Pengguna</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/roles') ? 'active' : '' ?>" href="/admin/roles">Role & Permission</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/contacts') ? 'active' : '' ?>" href="/admin/contacts">Pesan Masuk</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/visitors') ? 'active' : '' ?>" href="/admin/visitors">Pengunjung</a>
                        <a class="nav-link sb-sub-link <?= $is('admin/logs') ? 'active' : '' ?>" href="/admin/logs">Log Aktivitas</a>
                    </div>
                </li>

                <!-- Pengaturan -->
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
    document.querySelectorAll('.sb-toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.getElementById(this.dataset.target);
            if (!target) return;
            var chevron = this.querySelector('.sb-chevron');
            if (target.classList.contains('open')) {
                target.classList.remove('open');
                if (chevron) chevron.classList.remove('rotate');
            } else {
                target.classList.add('open');
                if (chevron) chevron.classList.add('rotate');
            }
        });
    });
</script>
