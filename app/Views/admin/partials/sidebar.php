<style>
.nav-accordion .accordion-button { background: transparent; color: #94a3b8 !important; border: none; border-radius: 8px !important; font-size: .88rem; font-weight: 500; padding: 10px 14px; letter-spacing: -0.2px; box-shadow: none !important; }
.nav-accordion .accordion-button::after { filter: invert(0.5); width: .7rem; height: .7rem; background-size: .7rem; }
.nav-accordion .accordion-button:not(.collapsed) { background: rgba(255,255,255,0.05); color: #fff !important; }
.nav-accordion .accordion-button:not(.collapsed)::after { filter: invert(1); }
.nav-accordion .accordion-button:hover { background: rgba(255,255,255,0.04); color: #fff !important; }
.nav-accordion .accordion-body { padding: 2px 8px 6px; }
.nav-accordion .accordion-body .nav-link { margin: 1px 0; padding: 8px 14px 8px 36px !important; font-size: .84rem; color: #94a3b8 !important; border-radius: 6px; display: flex; align-items: center; gap: 8px; }
.nav-accordion .accordion-body .nav-link:hover { background: rgba(255,255,255,0.04); color: #fff !important; }
.nav-accordion .accordion-body .nav-link.active { background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(124,58,237,0.15)); color: #fff !important; font-weight: 600; }
.nav-accordion .accordion-item { background: transparent; border: none; }
.nav-link-normal { display: flex; align-items: center; gap: 12px; padding: 10px 14px !important; border-radius: 8px; margin: 2px 8px; font-size: .88rem; font-weight: 500; color: #94a3b8 !important; text-decoration: none; transition: all .2s; }
.nav-link-normal:hover { background: rgba(255,255,255,0.04); color: #fff !important; }
.nav-link-normal.active { background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(124,58,237,0.15)); color: #fff !important; font-weight: 600; }
.nav-link-normal i { font-size: 1.1rem; width: 22px; text-align: center; }
</style>

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
            <?php
                $isKonten  = str_starts_with($current_uri, 'admin/posts') || str_starts_with($current_uri, 'admin/categories') || str_starts_with($current_uri, 'admin/tags') || str_starts_with($current_uri, 'admin/comments');
                $isMedia   = str_starts_with($current_uri, 'admin/gallery') || str_starts_with($current_uri, 'admin/videos') || str_starts_with($current_uri, 'admin/albums');
                $isMaster  = str_starts_with($current_uri, 'admin/guru') || str_starts_with($current_uri, 'admin/staff') || str_starts_with($current_uri, 'admin/jurusan') || str_starts_with($current_uri, 'admin/fasilitas') || str_starts_with($current_uri, 'admin/alumni') || str_starts_with($current_uri, 'admin/sliders') || str_starts_with($current_uri, 'admin/partners') || str_starts_with($current_uri, 'admin/testimoni') || str_starts_with($current_uri, 'admin/faq');
                $isMgmt    = str_starts_with($current_uri, 'admin/users') || str_starts_with($current_uri, 'admin/roles') || str_starts_with($current_uri, 'admin/contacts') || str_starts_with($current_uri, 'admin/visitors') || str_starts_with($current_uri, 'admin/logs');
            ?>

            <div class="accordion nav-accordion pt-2" id="sidebarAccordion">

                <!-- Dashboard -->
                <a class="nav-link-normal <?= $current_uri === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                    <i class="ti ti-dashboard icon"></i> Dashboard
                </a>

                <!-- Konten -->
                <div class="accordion-item">
                    <button class="accordion-button <?= $isKonten ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#nav-konten">
                        <i class="ti ti-article icon me-2"></i> Konten
                    </button>
                    <div id="nav-konten" class="accordion-collapse collapse <?= $isKonten ? 'show' : '' ?>" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body">
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/posts') ? 'active' : '' ?>" href="/admin/posts">Postingan</a>
                            <a class="nav-link <?= $current_uri === 'admin/categories' ? 'active' : '' ?>" href="/admin/categories">Kategori</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/tags') ? 'active' : '' ?>" href="/admin/tags">Tag</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/comments') ? 'active' : '' ?>" href="/admin/comments">Komentar</a>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="accordion-item">
                    <button class="accordion-button <?= $isMedia ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#nav-media">
                        <i class="ti ti-photo icon me-2"></i> Media
                    </button>
                    <div id="nav-media" class="accordion-collapse collapse <?= $isMedia ? 'show' : '' ?>" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body">
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/gallery') ? 'active' : '' ?>" href="/admin/gallery">Galeri Foto</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/albums') ? 'active' : '' ?>" href="/admin/albums">Album</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/videos') ? 'active' : '' ?>" href="/admin/videos">Video</a>
                        </div>
                    </div>
                </div>

                <!-- Master Data -->
                <div class="accordion-item">
                    <button class="accordion-button <?= $isMaster ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#nav-master">
                        <i class="ti ti-database icon me-2"></i> Master Data
                    </button>
                    <div id="nav-master" class="accordion-collapse collapse <?= $isMaster ? 'show' : '' ?>" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body">
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/guru') ? 'active' : '' ?>" href="/admin/guru">Guru</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/staff') ? 'active' : '' ?>" href="/admin/staff">Staff</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/jurusan') ? 'active' : '' ?>" href="/admin/jurusan">Jurusan</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/fasilitas') ? 'active' : '' ?>" href="/admin/fasilitas">Fasilitas</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/alumni') ? 'active' : '' ?>" href="/admin/alumni">Alumni</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/sliders') ? 'active' : '' ?>" href="/admin/sliders">Slider</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/partners') ? 'active' : '' ?>" href="/admin/partners">Partner</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/testimoni') ? 'active' : '' ?>" href="/admin/testimoni">Testimoni</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/faq') ? 'active' : '' ?>" href="/admin/faq">FAQ</a>
                        </div>
                    </div>
                </div>

                <!-- Single nav items -->
                <a class="nav-link-normal <?= str_starts_with($current_uri, 'admin/downloads') ? 'active' : '' ?>" href="/admin/downloads">
                    <i class="ti ti-download icon"></i> Download
                </a>
                <a class="nav-link-normal <?= str_starts_with($current_uri, 'admin/menus') ? 'active' : '' ?>" href="/admin/menus">
                    <i class="ti ti-menu-2 icon"></i> Menu
                </a>
                <a class="nav-link-normal <?= str_starts_with($current_uri, 'admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb">
                    <i class="ti ti-school icon"></i> PPDB
                </a>

                <!-- Manajemen -->
                <div class="accordion-item">
                    <button class="accordion-button <?= $isMgmt ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#nav-mgmt">
                        <i class="ti ti-settings icon me-2"></i> Manajemen
                    </button>
                    <div id="nav-mgmt" class="accordion-collapse collapse <?= $isMgmt ? 'show' : '' ?>" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body">
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/users') ? 'active' : '' ?>" href="/admin/users">Pengguna</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/roles') ? 'active' : '' ?>" href="/admin/roles">Role & Permission</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/contacts') ? 'active' : '' ?>" href="/admin/contacts">Pesan Masuk</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/visitors') ? 'active' : '' ?>" href="/admin/visitors">Pengunjung</a>
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/logs') ? 'active' : '' ?>" href="/admin/logs">Log Aktivitas</a>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <a class="nav-link-normal <?= $current_uri === 'admin/settings' ? 'active' : '' ?>" href="/admin/settings">
                    <i class="ti ti-adjustments icon"></i> Pengaturan
                </a>

                <!-- Bottom links -->
                <a class="nav-link-normal mt-3" href="/" target="_blank">
                    <i class="ti ti-eye icon"></i> Lihat Website
                </a>
                <a class="nav-link-normal text-danger" href="/logout">
                    <i class="ti ti-logout icon"></i> Logout
                </a>

            </div>
        </div>
    </div>
</aside>
