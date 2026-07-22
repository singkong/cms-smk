<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel') ?> | <?= esc($setting->nama_singkat ?? 'CMS') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
    <style>
        :root { --tblr-primary: #2563eb; --tblr-primary-rgb: 37,99,235; }
        .page { min-height: 100vh; }
        .navbar-vertical { width: 15rem; }
        .stat-card { transition: transform .2s ease, box-shadow .2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,.1); }
        .navbar-vertical .nav-link { border-radius: 6px; margin: 1px 8px; }
        .navbar-vertical .nav-link:hover { background: rgba(255,255,255,.06); }
        .navbar-vertical .nav-link.active { background: var(--tblr-primary); color: #fff !important; }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="/dashboard" class="text-decoration-none text-white d-flex align-items-center gap-2">
                        <span class="avatar avatar-sm bg-primary rounded-2">S</span>
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
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/posts') || str_starts_with($current_uri, 'admin/categories') || str_starts_with($current_uri, 'admin/tags') || str_starts_with($current_uri, 'admin/comments') ? 'show' : '' ?>" href="#navbar-content" data-bs-toggle="dropdown" role="button">
                                <span class="nav-link-icon"><i class="ti ti-article icon"></i></span> Konten
                            </a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/posts') || str_starts_with($current_uri, 'admin/categories') || str_starts_with($current_uri, 'admin/tags') || str_starts_with($current_uri, 'admin/comments') ? 'show' : '' ?>">
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/posts') ? 'active' : '' ?>" href="/admin/posts">Semua Postingan</a>
                                <a class="dropdown-item <?= $current_uri === 'admin/posts/create' ? 'active' : '' ?>" href="/admin/posts/create">Tambah Baru</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item <?= $current_uri === 'admin/categories' ? 'active' : '' ?>" href="/admin/categories">Kategori</a>
                                <a class="dropdown-item <?= $current_uri === 'admin/tags' ? 'active' : '' ?>" href="/admin/tags">Tag</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/comments') ? 'active' : '' ?>" href="/admin/comments">Komentar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/gallery') || str_starts_with($current_uri, 'admin/videos') ? 'show' : '' ?>" href="#navbar-media" data-bs-toggle="dropdown" role="button">
                                <span class="nav-link-icon"><i class="ti ti-photo icon"></i></span> Media
                            </a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/gallery') || str_starts_with($current_uri, 'admin/videos') ? 'show' : '' ?>">
                                <a class="dropdown-item" href="/admin/gallery">Galeri Foto</a>
                                <a class="dropdown-item" href="/admin/videos">Galeri Video</a>
                                <a class="dropdown-item" href="/admin/albums">Album</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/guru') || str_starts_with($current_uri, 'admin/staff') || str_starts_with($current_uri, 'admin/jurusan') || str_starts_with($current_uri, 'admin/fasilitas') || str_starts_with($current_uri, 'admin/alumni') || str_starts_with($current_uri, 'admin/sliders') || str_starts_with($current_uri, 'admin/partners') || str_starts_with($current_uri, 'admin/testimoni') || str_starts_with($current_uri, 'admin/faq') ? 'show' : '' ?>" href="#navbar-master" data-bs-toggle="dropdown" role="button">
                                <span class="nav-link-icon"><i class="ti ti-database icon"></i></span> Master Data
                            </a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/guru') || str_starts_with($current_uri, 'admin/staff') || str_starts_with($current_uri, 'admin/jurusan') || str_starts_with($current_uri, 'admin/fasilitas') || str_starts_with($current_uri, 'admin/alumni') || str_starts_with($current_uri, 'admin/sliders') || str_starts_with($current_uri, 'admin/partners') || str_starts_with($current_uri, 'admin/testimoni') || str_starts_with($current_uri, 'admin/faq') ? 'show' : '' ?>">
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/guru') ? 'active' : '' ?>" href="/admin/guru"><i class="ti ti-user-star icon me-1"></i> Guru</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/staff') ? 'active' : '' ?>" href="/admin/staff"><i class="ti ti-user-cog icon me-1"></i> Staff</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/jurusan') ? 'active' : '' ?>" href="/admin/jurusan"><i class="ti ti-building icon me-1"></i> Jurusan</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/fasilitas') ? 'active' : '' ?>" href="/admin/fasilitas"><i class="ti ti-tools icon me-1"></i> Fasilitas</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/alumni') ? 'active' : '' ?>" href="/admin/alumni"><i class="ti ti-school icon me-1"></i> Alumni</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/sliders') ? 'active' : '' ?>" href="/admin/sliders"><i class="ti ti-slideshow icon me-1"></i> Slider</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/partners') ? 'active' : '' ?>" href="/admin/partners"><i class="ti ti-affiliate icon me-1"></i> Partner</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/testimoni') ? 'active' : '' ?>" href="/admin/testimoni"><i class="ti ti-message-heart icon me-1"></i> Testimoni</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/faq') ? 'active' : '' ?>" href="/admin/faq"><i class="ti ti-help-circle icon me-1"></i> FAQ</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/downloads">
                                <span class="nav-link-icon"><i class="ti ti-download icon"></i></span> Download
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_starts_with($current_uri, 'admin/ppdb') ? 'active' : '' ?>" href="/admin/ppdb">
                                <span class="nav-link-icon"><i class="ti ti-school icon"></i></span> PPDB
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri, 'admin/users') || str_starts_with($current_uri, 'admin/roles') || str_starts_with($current_uri, 'admin/contacts') || str_starts_with($current_uri, 'admin/comments') || str_starts_with($current_uri, 'admin/visitors') || str_starts_with($current_uri, 'admin/logs') || str_starts_with($current_uri, 'admin/tags') ? 'show' : '' ?>" href="#navbar-management" data-bs-toggle="dropdown" role="button">
                                <span class="nav-link-icon"><i class="ti ti-settings icon"></i></span> Manajemen
                            </a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri, 'admin/users') || str_starts_with($current_uri, 'admin/roles') || str_starts_with($current_uri, 'admin/contacts') || str_starts_with($current_uri, 'admin/comments') || str_starts_with($current_uri, 'admin/visitors') || str_starts_with($current_uri, 'admin/logs') || str_starts_with($current_uri, 'admin/tags') ? 'show' : '' ?>">
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/users') ? 'active' : '' ?>" href="/admin/users"><i class="ti ti-users icon me-1"></i> Pengguna</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/roles') ? 'active' : '' ?>" href="/admin/roles"><i class="ti ti-shield-lock icon me-1"></i> Role & Permission</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item <?= $current_uri === 'admin/contacts' ? 'active' : '' ?>" href="/admin/contacts"><i class="ti ti-mail icon me-1"></i> Pesan Masuk</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/comments') ? 'active' : '' ?>" href="/admin/comments"><i class="ti ti-messages icon me-1"></i> Komentar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/tags') ? 'active' : '' ?>" href="/admin/tags"><i class="ti ti-tag icon me-1"></i> Tag</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/visitors') ? 'active' : '' ?>" href="/admin/visitors"><i class="ti ti-chart-bar icon me-1"></i> Pengunjung</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri, 'admin/logs') ? 'active' : '' ?>" href="/admin/logs"><i class="ti ti-history icon me-1"></i> Log Aktivitas</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_uri === 'admin/settings' ? 'active' : '' ?>" href="/admin/settings">
                                <span class="nav-link-icon"><i class="ti ti-adjustments icon"></i></span> Pengaturan
                            </a>
                        </li>
                        <li class="nav-item mt-2">
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

        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle"><?= $this->renderSection('pretitle') ?? 'Overview' ?></div>
                            <h2 class="page-title"><?= esc($title ?? 'Dashboard') ?></h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-none d-md-block">
                                    <div class="fw-semibold"><?= esc(session()->get('full_name')) ?></div>
                                    <div class="text-muted small">
                                        <?php
                                        $roleNames = ['superadmin' => 'Super Admin', 'admin' => 'Admin', 'operator' => 'Operator', 'editor' => 'Editor', 'guru' => 'Guru', 'guest' => 'Guest'];
                                        $roles = session()->get('roles') ?? [];
                                        echo esc(implode(', ', array_map(fn($r) => $roleNames[$r] ?? $r, $roles)));
                                        ?>
                                    </div>
                                </div>
                                <span class="avatar avatar-sm bg-primary rounded-circle">
                                    <?= strtoupper(substr(session()->get('full_name') ?? 'U', 0, 1)) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex"><i class="ti ti-check me-2"></i><div><?= session()->getFlashdata('success') ?></div></div>
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex"><i class="ti ti-alert-circle me-2"></i><div><?= session()->getFlashdata('error') ?></div></div>
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                    <?php endif; ?>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            &copy; <?= date('Y') ?> <?= esc($setting->nama_sekolah ?? 'SMK CMS') ?>. v1.0
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
    <script>
    // Global confirm delete with SweetAlert2
    function confirmDelete(url, title) {
        Swal.fire({ title: title || 'Hapus data?', text: 'Tindakan ini tidak dapat dibatalkan.', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal' }).then((result) => { if (result.isConfirmed) window.location.href = url; });
    }
    // DataTables auto-init
    $(document).ready(function() {
        $('.datatable').each(function() { $(this).DataTable({ pageLength: 25, language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data', info: 'Menampilkan _START_-_END_ dari _TOTAL_', paginate: { first:'Awal',last:'Akhir',next:'→',previous:'←' } } }); });
    });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
