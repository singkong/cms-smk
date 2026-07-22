<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/dashboard" class="text-decoration-none text-white d-flex align-items-center gap-2">
                <span class="avatar avatar-sm bg-primary rounded-3 fw-bold"><?= strtoupper(substr($setting->nama_singkat ?? 'S', 0, 1)) ?></span>
                <span class="fw-bold"><?= esc($setting->nama_singkat ?? 'CMS') ?></span>
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-2">

                <li class="nav-item">
                    <a class="nav-link <?= $current_uri === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <span class="nav-link-icon"><i class="ti ti-dashboard icon"></i></span> Dashboard
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/posts') || str_starts_with($current_uri, 'admin/categories') || str_starts_with($current_uri, 'admin/tags') || str_starts_with($current_uri, 'admin/comments') ? 'show' : '' ?>"
                       href="#nav-content" data-bs-toggle="dropdown">
                        <span class="nav-link-icon"><i class="ti ti-article icon"></i></span> Konten
                    </a>
                    <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/posts') || str_starts_with($current_uri, 'admin/categories') || str_starts_with($current_uri, 'admin/tags') || str_starts_with($current_uri, 'admin/comments') ? 'show' : '' ?>">
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/posts') ? 'active' : '' ?>" href="/admin/posts">Postingan</a>
                        <a class="dropdown-item <?= $current_uri === 'admin/categories' ? 'active' : '' ?>" href="/admin/categories">Kategori</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/tags') ? 'active' : '' ?>" href="/admin/tags">Tag</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/comments') ? 'active' : '' ?>" href="/admin/comments">Komentar</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/gallery') || str_starts_with($current_uri, 'admin/videos') || str_starts_with($current_uri, 'admin/albums') ? 'show' : '' ?>"
                       href="#nav-media" data-bs-toggle="dropdown">
                        <span class="nav-link-icon"><i class="ti ti-photo icon"></i></span> Media
                    </a>
                    <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/gallery') || str_starts_with($current_uri, 'admin/videos') || str_starts_with($current_uri, 'admin/albums') ? 'show' : '' ?>">
                        <a class="dropdown-item" href="/admin/gallery">Galeri Foto</a>
                        <a class="dropdown-item" href="/admin/albums">Album</a>
                        <a class="dropdown-item" href="/admin/videos">Video</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/guru') || str_starts_with($current_uri, 'admin/staff') || str_starts_with($current_uri, 'admin/jurusan') || str_starts_with($current_uri, 'admin/fasilitas') || str_starts_with($current_uri, 'admin/alumni') || str_starts_with($current_uri, 'admin/sliders') || str_starts_with($current_uri, 'admin/partners') || str_starts_with($current_uri, 'admin/testimoni') || str_starts_with($current_uri, 'admin/faq') ? 'show' : '' ?>"
                       href="#nav-master" data-bs-toggle="dropdown">
                        <span class="nav-link-icon"><i class="ti ti-database icon"></i></span> Master Data
                    </a>
                    <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/guru') || str_starts_with($current_uri, 'admin/staff') || str_starts_with($current_uri, 'admin/jurusan') || str_starts_with($current_uri, 'admin/fasilitas') || str_starts_with($current_uri, 'admin/alumni') || str_starts_with($current_uri, 'admin/sliders') || str_starts_with($current_uri, 'admin/partners') || str_starts_with($current_uri, 'admin/testimoni') || str_starts_with($current_uri, 'admin/faq') ? 'show' : '' ?>">
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/guru') ? 'active' : '' ?>" href="/admin/guru">Guru</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/staff') ? 'active' : '' ?>" href="/admin/staff">Staff</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/jurusan') ? 'active' : '' ?>" href="/admin/jurusan">Jurusan</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/fasilitas') ? 'active' : '' ?>" href="/admin/fasilitas">Fasilitas</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/alumni') ? 'active' : '' ?>" href="/admin/alumni">Alumni</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/sliders') ? 'active' : '' ?>" href="/admin/sliders">Slider</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/partners') ? 'active' : '' ?>" href="/admin/partners">Partner</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/testimoni') ? 'active' : '' ?>" href="/admin/testimoni">Testimoni</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/faq') ? 'active' : '' ?>" href="/admin/faq">FAQ</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= str_starts_with($current_uri, 'admin/downloads') ? 'active' : '' ?>" href="/admin/downloads">
                        <span class="nav-link-icon"><i class="ti ti-download icon"></i></span> Download
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= str_starts_with($current_uri, 'admin/menus') ? 'active' : '' ?>" href="/admin/menus">
                        <span class="nav-link-icon"><i class="ti ti-menu-2 icon"></i></span> Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= str_starts_with($current_uri, 'admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb">
                        <span class="nav-link-icon"><i class="ti ti-school icon"></i></span> PPDB
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/users') || str_starts_with($current_uri, 'admin/roles') || str_starts_with($current_uri, 'admin/contacts') || str_starts_with($current_uri, 'admin/visitors') || str_starts_with($current_uri, 'admin/logs') ? 'show' : '' ?>"
                       href="#nav-mgmt" data-bs-toggle="dropdown">
                        <span class="nav-link-icon"><i class="ti ti-settings icon"></i></span> Manajemen
                    </a>
                    <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/users') || str_starts_with($current_uri, 'admin/roles') || str_starts_with($current_uri, 'admin/contacts') || str_starts_with($current_uri, 'admin/visitors') || str_starts_with($current_uri, 'admin/logs') ? 'show' : '' ?>">
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/users') ? 'active' : '' ?>" href="/admin/users">Pengguna</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/roles') ? 'active' : '' ?>" href="/admin/roles">Role & Permission</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/contacts') ? 'active' : '' ?>" href="/admin/contacts">Pesan Masuk</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/visitors') ? 'active' : '' ?>" href="/admin/visitors">Pengunjung</a>
                        <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/logs') ? 'active' : '' ?>" href="/admin/logs">Log Aktivitas</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $current_uri === 'admin/settings' ? 'active' : '' ?>" href="/admin/settings">
                        <span class="nav-link-icon"><i class="ti ti-adjustments icon"></i></span> Pengaturan
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a class="nav-link" href="/" target="_blank">
                        <span class="nav-link-icon"><i class="ti ti-eye icon"></i></span> Lihat Website
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">
                        <span class="nav-link-icon"><i class="ti ti-logout icon"></i></span> Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
