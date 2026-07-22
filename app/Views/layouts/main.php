<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SMK Negeri 1 Indonesia') ?> | <?= esc($setting->nama_singkat ?? 'SMKN 1') ?></title>
    <meta name="description" content="<?= esc($setting->meta_description ?? '') ?>">
    <meta name="keywords" content="<?= esc($setting->meta_keywords ?? '') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --c-primary: #2563eb; --c-primary-dark: #1d4ed8; --c-accent: #7c3aed;
            --c-dark: #0f172a; --c-darker: #020617;
            --c-body: #334155; --c-muted: #64748b; --c-border: #e2e8f0;
            --c-bg: #f8fafc; --c-white: #ffffff;
            --radius: 16px; --radius-sm: 10px; --radius-xs: 8px;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: var(--c-bg); color: var(--c-body);
            -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;
            line-height: 1.7; overflow-x: hidden;
        }
        a { color: var(--c-primary); text-decoration: none; }
        a:hover { color: var(--c-primary-dark); text-decoration: none !important; }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(15,23,42,0.85); backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 8px 0; transition: all 0.3s; z-index: 1030;
        }
        .navbar.scrolled { background: rgba(2,6,23,0.97); box-shadow: 0 1px 20px rgba(0,0,0,0.25); }
        .navbar-brand { font-weight: 800; font-size: 1.1rem; letter-spacing: -0.3px; display: flex; align-items: center; gap: 10px; }
        .navbar .nav-link {
            color: rgba(255,255,255,0.75) !important; font-weight: 500; font-size: .875rem;
            padding: 8px 14px !important; border-radius: 8px; transition: all .2s; letter-spacing: -0.2px; margin: 0 1px;
            text-decoration: none !important;
        }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: #fff !important; background: rgba(255,255,255,0.08); text-decoration: none !important; }
        .btn-nav {
            background: linear-gradient(135deg, var(--c-primary), var(--c-accent)); border: none;
            color: #fff !important; font-weight: 600; padding: 9px 20px; border-radius: 50px;
            font-size: .85rem; box-shadow: 0 4px 15px rgba(37,99,235,0.35); transition: all .25s;
        }
        .btn-nav:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(37,99,235,0.5); color: #fff !important; background: linear-gradient(135deg, var(--c-primary-dark), var(--c-accent)); }

        .hero, .home-hero {
            position: relative; display: flex; align-items: center;
            background: linear-gradient(135deg, #020617 0%, #0f172a 30%, #1e3a5f 60%, #1d4ed8 100%);
            overflow: hidden;
        }
        .hero { min-height: 85vh; }
        .home-hero { min-height: 100vh; }
        .hero::before, .home-hero::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 20% 80%, rgba(37,99,235,0.22) 0%, transparent 55%),
                        radial-gradient(ellipse at 80% 20%, rgba(124,58,237,0.18) 0%, transparent 55%);
        }
        .hero-content { position: relative; z-index: 2; text-align: center; color: #fff; padding: 40px 0; }
        .hero-badge {
            display: inline-block; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.12); padding: 5px 18px; border-radius: 50px;
            font-size: .78rem; font-weight: 500; letter-spacing: 1px; margin-bottom: 20px;
            animation: fup .7s ease both;
        }
        .hero-title { font-size: clamp(2rem, 5.5vw, 3.4rem); font-weight: 800; line-height: 1.12; letter-spacing: -1.5px; margin-bottom: 14px; animation: fup .7s ease .1s both; }
        .hero-title span { background: linear-gradient(135deg, #60a5fa, #c4b5fd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-desc { font-size: 1rem; opacity: .82; max-width: 520px; margin: 0 auto 28px; line-height: 1.6; animation: fup .7s ease .15s both; }
        .hero-btns { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; animation: fup .7s ease .2s both; }
        @keyframes fup { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .btn-hero { padding: 11px 26px; border-radius: 50px; font-weight: 700; font-size: .88rem; transition: all .25s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-hero-primary { background: #fff; color: var(--c-primary-dark); box-shadow: 0 8px 30px rgba(0,0,0,0.18); }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(0,0,0,0.3); }
        .btn-hero-outline { border: 1.5px solid rgba(255,255,255,0.35); color: #fff; }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.07); border-color: #fff; transform: translateY(-2px); }
        .hero-wave { position: absolute; bottom: -1px; left: 0; width: 100%; line-height: 0; z-index: 3; }
        .hero-wave svg { width: 100%; height: 50px; }
        .hero + *, .home-hero + * { padding-top: 40px !important; }

        /* ── PARTICLES ── */
        .hero-dot { position: absolute; width: 6px; height: 6px; background: rgba(255,255,255,0.3); border-radius: 50%; animation: floatP 7s ease-in-out infinite; pointer-events: none; z-index: 4; box-shadow: 0 0 8px rgba(255,255,255,0.4); }
        @keyframes floatP { 0%,100% { transform: translateY(0) scale(1); opacity: .2; } 50% { transform: translateY(-20px) scale(2.5); opacity: .8; } }

        /* ── SECTIONS ── */
        section { padding: 0 0 40px 0; }
        .section-label {
            display: inline-block; padding: 4px 14px; background: rgba(37,99,235,0.06);
            color: var(--c-primary); border-radius: 50px; font-size: .7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;
        }
        .section-title { font-size: clamp(1.6rem, 3.2vw, 2.1rem); font-weight: 800; color: var(--c-dark); letter-spacing: -0.5px; margin-bottom: 4px; }
        .section-desc { color: var(--c-muted); font-size: .95rem; max-width: 480px; }
        .section-header { text-align: center; margin-bottom: 40px; }

        /* ── CARD ── */
        .card-elevate {
            background: var(--c-white); border: 1px solid var(--c-border); border-radius: var(--radius);
            transition: all .3s cubic-bezier(.4,0,.2,1); overflow: hidden;
        }
        .card-elevate:hover { transform: translateY(-5px); box-shadow: 0 14px 40px rgba(0,0,0,0.08); border-color: #cbd5e1; }
        .card-elevate .card-img-wrap { overflow: hidden; }
        .card-elevate .card-img-wrap img { transition: transform .5s cubic-bezier(.4,0,.2,1); width: 100%; height: 190px; object-fit: cover; }
        .card-elevate:hover .card-img-wrap img { transform: scale(1.05); }

        /* ── STATS ── */
        .stat-card {
            background: var(--c-white); border-radius: var(--radius); padding: 24px 16px; text-align: center;
            border: 1px solid var(--c-border); transition: all .3s; position: relative; overflow: hidden;
        }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--c-primary), var(--c-accent)); transform: scaleX(0); transition: transform .4s ease; }
        .stat-card:hover::before { transform: scaleX(1); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 35px rgba(0,0,0,0.07); }
        .stat-icon { font-size: 1.7rem; margin-bottom: 6px; }
        .stat-number { font-size: 1.7rem; font-weight: 800; color: var(--c-dark); letter-spacing: -1px; }
        .stat-label { color: var(--c-muted); font-weight: 500; font-size: .78rem; }

        /* ── KEPSEK ── */
        .kepsek-card {
            display: flex; gap: 28px; align-items: center; background: var(--c-white);
            border-radius: var(--radius); padding: 32px; border: 1px solid var(--c-border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }
        .kepsek-photo { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #e0e7ff; flex-shrink: 0; }
        .quote-mark { font-size: 4rem; color: #e2e8f0; line-height: 1; font-family: Georgia, serif; }

        /* ── TIMELINE ── */
        .tl-item {
            display: flex; gap: 16px; padding: 16px 20px; background: var(--c-white);
            border-radius: var(--radius-sm); border: 1px solid var(--c-border);
            margin-bottom: 10px; transition: all .25s;
        }
        .tl-item:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-left: 3px solid #f59e0b; }
        .tl-date { min-width: 50px; height: 50px; background: #fef3c7; color: #92400e; border-radius: 10px; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 700; line-height: 1.1; }
        .tl-date .d { font-size: 1.2rem; } .tl-date .m { font-size: .62rem; text-transform: uppercase; }

        /* ── JURUSAN ── */
        .jurusan-card { position: relative; border-radius: var(--radius); overflow: hidden; background: var(--c-white); border: 1px solid var(--c-border); transition: all .3s; }
        .jurusan-card:hover { transform: translateY(-5px); box-shadow: 0 14px 40px rgba(0,0,0,0.08); }
        .jurusan-card img { width: 100%; height: 200px; object-fit: cover; transition: transform .5s; }
        .jurusan-card:hover img { transform: scale(1.06); }
        .jurusan-badge-ak { position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); color: #fff; padding: 4px 12px; border-radius: 50px; font-size: .7rem; font-weight: 600; letter-spacing: .3px; }

        /* ── GALLERY ── */
        .gallery-item { position: relative; border-radius: var(--radius); overflow: hidden; cursor: pointer; }
        .gallery-item img { width: 100%; height: 200px; object-fit: cover; transition: transform .5s; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.65), transparent 60%); display: flex; align-items: flex-end; padding: 16px; opacity: 0; transition: all .3s; }
        .gallery-item:hover .gallery-overlay { opacity: 1; }

        /* ── CTA ── */
        .cta { background: linear-gradient(135deg, #0f172a, #1e293b); padding: 64px 0; text-align: center; color: #fff; }

        /* ── FOOTER ── */
        .footer { background: var(--c-darker); color: #94a3b8; padding: 50px 0 0; position: relative; font-size: .88rem; }
        .footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--c-primary), var(--c-accent), #06b6d4); }
        .footer h5 { color: #fff; font-weight: 700; margin-bottom: 16px; font-size: .92rem; letter-spacing: -0.2px; }
        .footer a { color: #94a3b8; transition: color .2s; text-decoration: none; } .footer a:hover { color: #fff; text-decoration: none; }
        .footer-social a { display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.05); color: #fff; margin-right: 7px; transition: all .25s; font-size: .95rem; }
        .footer-social a:hover { transform: translateY(-3px); } .footer-social a.fb:hover { background: #1877f2; } .footer-social a.ig:hover { background: #e4405f; } .footer-social a.yt:hover { background: #ff0000; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.06); padding: 16px 0; margin-top: 40px; text-align: center; font-size: .82rem; color: #64748b; }

        /* ── SCROLL TOP ── */
        .scroll-top { position: fixed; bottom: 28px; right: 28px; z-index: 999; width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, var(--c-primary), var(--c-accent)); color: #fff; border: none; cursor: pointer; display: none; align-items: center; justify-content: center; font-size: 1rem; box-shadow: 0 4px 15px rgba(37,99,235,0.35); transition: all .25s; }
        .scroll-top:hover { transform: translateY(-3px); }

        /* ── MISC ── */
        .bg-soft { background: var(--c-bg); }
        .text-balance { text-wrap: balance; }
        [data-aos] { transition-timing-function: cubic-bezier(.4,0,.2,1); }

        @media (max-width: 768px) {
            .hero { min-height: 60vh; } .kepsek-card { flex-direction: column; text-align: center; padding: 20px; }
            section { padding: 0 0 20px 0; } .section-header { margin-bottom: 28px; }
            .hero-content { padding: 30px 0; }
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="topnav">
        <div class="container">
            <a class="navbar-brand" href="/">
                <?php if ($setting->logo ?? false): ?><img src="<?= base_url('uploads/'.$setting->logo) ?>" alt="Logo" height="36" class="rounded-2"><?php endif; ?>
                <?= esc($setting->nama_singkat ?? 'SMKN 1') ?>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nb">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nb">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?= uri_string()==''?'active':'' ?>" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="/prestasi">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ppdb">PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="nav-link btn-nav" href="/login"><i class="ti ti-login icon me-1"></i>Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main><?= $this->renderSection('content') ?></main>

    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4"><h5><?= esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></h5><p class="mb-3"><?= esc($setting->deskripsi ?? '') ?></p><div class="footer-social"><?php if($setting->facebook??false): ?><a href="<?= esc($setting->facebook) ?>" target="_blank" class="fb"><i class="ti ti-brand-facebook icon"></i></a><?php endif; ?><?php if($setting->instagram??false): ?><a href="<?= esc($setting->instagram) ?>" target="_blank" class="ig"><i class="ti ti-brand-instagram icon"></i></a><?php endif; ?><?php if($setting->youtube??false): ?><a href="<?= esc($setting->youtube) ?>" target="_blank" class="yt"><i class="ti ti-brand-youtube icon"></i></a><?php endif; ?></div></div>
                <div class="col-6 col-lg-2"><h5>Menu</h5><ul class="list-unstyled"><li class="mb-1"><a href="/profil">Profil</a></li><li class="mb-1"><a href="/visi-misi">Visi Misi</a></li><li class="mb-1"><a href="/sejarah">Sejarah</a></li><li class="mb-1"><a href="/guru-staff">Guru & Staff</a></li></ul></div>
                <div class="col-6 col-lg-2"><h5>Lainnya</h5><ul class="list-unstyled"><li class="mb-1"><a href="/berita">Berita</a></li><li class="mb-1"><a href="/pengumuman">Pengumuman</a></li><li class="mb-1"><a href="/galeri">Galeri</a></li><li class="mb-1"><a href="/download">Download</a></li><li class="mb-1"><a href="/ppdb">PPDB</a></li></ul></div>
                <div class="col-lg-4"><h5>Kontak</h5><ul class="list-unstyled"><li class="mb-2 d-flex"><i class="ti ti-map-pin icon me-2 text-primary mt-1 flex-shrink-0"></i><span><?= esc($setting->alamat??'') ?></span></li><li class="mb-2 d-flex"><i class="ti ti-phone icon me-2 text-primary mt-1 flex-shrink-0"></i><span><?= esc($setting->telepon??'') ?></span></li><li class="mb-2 d-flex"><i class="ti ti-mail icon me-2 text-primary mt-1 flex-shrink-0"></i><span><?= esc($setting->email??'') ?></span></li></ul></div>
            </div>
        </div>
        <div class="footer-bottom"><div class="container"><?= $setting->footer_text ?? '&copy; '.date('Y').' '.esc($setting->nama_sekolah??'SMK Negeri 1 Indonesia') ?></div></div>
    </footer>

    <button class="scroll-top" id="scrollTop"><i class="ti ti-arrow-up icon"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        AOS.init({duration:600,once:true,offset:60});
        const st=document.getElementById('scrollTop');addEventListener('scroll',()=>{document.getElementById('topnav').classList.toggle('scrolled',scrollY>50);st.style.display=scrollY>400?'flex':'none'});
        st.addEventListener('click',()=>scrollTo({top:0,behavior:'smooth'}));
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
