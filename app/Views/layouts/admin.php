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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --tblr-primary: #2563eb; --tblr-primary-rgb: 37,99,235; --tblr-font-sans-serif: 'Plus Jakarta Sans',system-ui,sans-serif; }
        body { font-family: var(--tblr-font-sans-serif); -webkit-font-smoothing: antialiased; letter-spacing: -0.15px; }
        .page { min-height: 100vh; }
        .navbar-vertical { width: 15.5rem; background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%) !important; }
        .navbar-vertical .nav-link { border-radius: 8px; margin: 2px 8px; font-size: .88rem; font-weight: 500; letter-spacing: -0.2px; padding: 10px 14px; transition: all .2s; }
        .navbar-vertical .nav-link:hover { background: rgba(255,255,255,0.05); }
        .navbar-vertical .nav-link.active { background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(124,58,237,0.15)); color: #fff !important; font-weight: 600; }
        .navbar-vertical .dropdown-menu { background: #1e293b; border: 1px solid rgba(255,255,255,0.06); border-radius: 10px; padding: 6px; margin-left: 8px; }
        .navbar-vertical .dropdown-item { color: #94a3b8; border-radius: 6px; font-size: .84rem; padding: 8px 12px; }
        .navbar-vertical .dropdown-item:hover, .navbar-vertical .dropdown-item.active { background: rgba(255,255,255,0.06); color: #fff; }
        .card { border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); }
        .card-header { background: transparent; border-bottom: 1px solid #f1f5f9; font-weight: 700; font-size: .92rem; padding: 16px 20px; }
        .card-header:first-child { border-radius: 12px 12px 0 0; }
        .table th { font-weight: 600; font-size: .78rem; color: #64748b; text-transform: uppercase; letter-spacing: .5px; border-bottom-width: 1px; }
        .table td { padding: 12px 16px; vertical-align: middle; font-size: .88rem; }
        .form-control, .form-select { border-radius: 8px; border-color: #e2e8f0; font-size: .88rem; padding: 9px 14px; transition: all .2s; }
        .form-control:focus, .form-select:focus { border-color: var(--tblr-primary); box-shadow: 0 0 0 3px rgba(37,99,235,0.08); }
        .btn { border-radius: 8px; font-weight: 600; font-size: .85rem; letter-spacing: -0.2px; transition: all .2s; }
        .btn-primary { box-shadow: 0 2px 8px rgba(37,99,235,0.2); }
        .btn-primary:hover { box-shadow: 0 4px 16px rgba(37,99,235,0.3); transform: translateY(-1px); }
        .badge { font-weight: 600; letter-spacing: -0.1px; }
        .page-header { padding: 20px 0 16px; }
        .page-title { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }
        .page-pretitle { font-size: .78rem; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; font-weight: 600; margin-bottom: 2px; }
        .navbar-brand-autodark .avatar { border-radius: 10px; }
        .alert { border-radius: 10px; border: none; font-weight: 500; }
        .modal-content { border-radius: 14px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header { border-bottom: 1px solid #f1f5f9; padding: 18px 24px; }
        .modal-footer { border-top: 1px solid #f1f5f9; padding: 14px 24px; }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"><span class="navbar-toggler-icon"></span></button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="/dashboard" class="text-decoration-none text-white d-flex align-items-center gap-2">
                        <span class="avatar avatar-sm bg-primary rounded-3 fw-bold"><?= strtoupper(substr($setting->nama_singkat??'S',0,1)) ?></span>
                        <span class="fw-bold"><?= esc($setting->nama_singkat ?? 'CMS') ?></span>
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-2">
                        <li class="nav-item"><a class="nav-link <?= $current_uri==='dashboard'?'active':'' ?>" href="/dashboard"><span class="nav-link-icon"><i class="ti ti-dashboard icon"></i></span>Dashboard</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri,'admin/posts')||str_starts_with($current_uri,'admin/categories')||str_starts_with($current_uri,'admin/tags')||str_starts_with($current_uri,'admin/comments')?'show':'' ?>" href="#nav-content" data-bs-toggle="dropdown"><span class="nav-link-icon"><i class="ti ti-article icon"></i></span>Konten</a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri,'admin/posts')||str_starts_with($current_uri,'admin/categories')||str_starts_with($current_uri,'admin/tags')||str_starts_with($current_uri,'admin/comments')?'show':'' ?>">
                                <a class="dropdown-item <?= str_starts_with($current_uri,'admin/posts')?'active':'' ?>" href="/admin/posts">Postingan</a>
                                <a class="dropdown-item <?= $current_uri==='admin/categories'?'active':'' ?>" href="/admin/categories">Kategori</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri,'admin/tags')?'active':'' ?>" href="/admin/tags">Tag</a>
                                <a class="dropdown-item <?= str_starts_with($current_uri,'admin/comments')?'active':'' ?>" href="/admin/comments">Komentar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri,'admin/gallery')||str_starts_with($current_uri,'admin/videos')?'show':'' ?>" href="#nav-media" data-bs-toggle="dropdown"><span class="nav-link-icon"><i class="ti ti-photo icon"></i></span>Media</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="/admin/gallery">Galeri Foto</a><a class="dropdown-item" href="/admin/albums">Album</a><a class="dropdown-item" href="/admin/videos">Video</a></div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri,'admin/guru')||str_starts_with($current_uri,'admin/staff')||str_starts_with($current_uri,'admin/jurusan')||str_starts_with($current_uri,'admin/fasilitas')||str_starts_with($current_uri,'admin/alumni')||str_starts_with($current_uri,'admin/sliders')||str_starts_with($current_uri,'admin/partners')||str_starts_with($current_uri,'admin/testimoni')||str_starts_with($current_uri,'admin/faq')?'show':'' ?>" href="#nav-master" data-bs-toggle="dropdown"><span class="nav-link-icon"><i class="ti ti-database icon"></i></span>Master Data</a>
                            <div class="dropdown-menu <?= str_starts_with($current_uri,'admin/guru')||str_starts_with($current_uri,'admin/staff')||str_starts_with($current_uri,'admin/jurusan')||str_starts_with($current_uri,'admin/fasilitas')||str_starts_with($current_uri,'admin/alumni')||str_starts_with($current_uri,'admin/sliders')||str_starts_with($current_uri,'admin/partners')||str_starts_with($current_uri,'admin/testimoni')||str_starts_with($current_uri,'admin/faq')?'show':'' ?>">
                                <a class="dropdown-item" href="/admin/guru">Guru</a><a class="dropdown-item" href="/admin/staff">Staff</a>
                                <a class="dropdown-item" href="/admin/jurusan">Jurusan</a><a class="dropdown-item" href="/admin/fasilitas">Fasilitas</a>
                                <a class="dropdown-item" href="/admin/alumni">Alumni</a><a class="dropdown-item" href="/admin/sliders">Slider</a>
                                <a class="dropdown-item" href="/admin/partners">Partner</a><a class="dropdown-item" href="/admin/testimoni">Testimoni</a>
                                <a class="dropdown-item" href="/admin/faq">FAQ</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/admin/downloads"><span class="nav-link-icon"><i class="ti ti-download icon"></i></span>Download</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/menus"><span class="nav-link-icon"><i class="ti ti-menu-2 icon"></i></span>Menu</a></li>
                        <li class="nav-item"><a class="nav-link <?= str_starts_with($current_uri,'admin/ppdb')?'active':'' ?>" href="/admin/ppdb"><span class="nav-link-icon"><i class="ti ti-school icon"></i></span>PPDB</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= str_starts_with($current_uri,'admin/users')||str_starts_with($current_uri,'admin/roles')||str_starts_with($current_uri,'admin/contacts')||str_starts_with($current_uri,'admin/visitors')||str_starts_with($current_uri,'admin/logs')?'show':'' ?>" href="#nav-mgmt" data-bs-toggle="dropdown"><span class="nav-link-icon"><i class="ti ti-settings icon"></i></span>Manajemen</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/users">Pengguna</a><a class="dropdown-item" href="/admin/roles">Role & Permission</a>
                                <a class="dropdown-item" href="/admin/contacts">Pesan Masuk</a>
                                <a class="dropdown-item" href="/admin/visitors">Pengunjung</a><a class="dropdown-item" href="/admin/logs">Log Aktivitas</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link <?= $current_uri==='admin/settings'?'active':'' ?>" href="/admin/settings"><span class="nav-link-icon"><i class="ti ti-adjustments icon"></i></span>Pengaturan</a></li>
                        <li class="nav-item mt-3"><a class="nav-link" href="/" target="_blank"><span class="nav-link-icon"><i class="ti ti-eye icon"></i></span>Lihat Website</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="/logout"><span class="nav-link-icon"><i class="ti ti-logout icon"></i></span>Logout</a></li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col"><div class="page-pretitle"><?= $this->renderSection('pretitle') ?? 'Overview' ?></div><h2 class="page-title"><?= esc($title ?? 'Dashboard') ?></h2></div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-none d-md-block text-end"><div class="fw-semibold small"><?= esc(session()->get('full_name')) ?></div><div class="text-muted" style="font-size:.75rem;"><?php $rn=['superadmin'=>'Super Admin','admin'=>'Admin','operator'=>'Operator','editor'=>'Editor','guru'=>'Guru'];$r=session()->get('roles')??[];echo esc(implode(', ',array_map(fn($x)=>$rn[$x]??$x,$r))); ?></div></div>
                                <span class="avatar avatar-sm bg-primary rounded-3 fw-bold"><?= strtoupper(substr(session()->get('full_name')??'U',0,1)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <?php if(session()->getFlashdata('success')): ?><div class="alert alert-success alert-dismissible"><div class="d-flex"><i class="ti ti-check icon me-2"></i><div><?= session()->getFlashdata('success') ?></div></div><a class="btn-close" data-bs-dismiss="alert"></a></div><?php endif; ?>
                    <?php if(session()->getFlashdata('error')): ?><div class="alert alert-danger alert-dismissible"><div class="d-flex"><i class="ti ti-alert-circle icon me-2"></i><div><?= session()->getFlashdata('error') ?></div></div><a class="btn-close" data-bs-dismiss="alert"></a></div><?php endif; ?>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none"><div class="container-xl"><div class="text-center"><small class="text-muted">&copy; <?= date('Y') ?> <?= esc($setting->nama_sekolah??'') ?>. v1.0</small></div></div></footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
    <script>
        function confirmDelete(u,t){Swal.fire({title:t||'Hapus data?',text:'Tindakan ini tidak dapat dibatalkan.',icon:'warning',showCancelButton:true,confirmButtonColor:'#d33',confirmButtonText:'Ya, Hapus',cancelButtonText:'Batal'}).then(r=>{if(r.isConfirmed)location.href=u})}
        $(function(){$('.datatable').each(function(){$(this).DataTable({pageLength:25,language:{search:'Cari:',lengthMenu:'Tampilkan _MENU_',info:'_START_-_END_ dari _TOTAL_',paginate:{first:'«',last:'»',next:'›',previous:'‹'}}})})});
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
