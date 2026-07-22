<!DOCTYPE html>
<html lang="id">
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
            --primary: #2563eb; --primary-dark: #1d4ed8; --accent: #7c3aed;
            --dark: #0f172a; --darker: #020617; --light: #f8fafc;
            --gray: #64748b; --radius: 16px; --radius-sm: 10px;
            --shadow: 0 4px 24px rgba(0,0,0,0.06); --shadow-lg: 0 12px 48px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: var(--light); color: #334155; overflow-x: hidden; -webkit-font-smoothing: antialiased;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(15,23,42,0.82) !important; backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 12px 0; transition: var(--transition);
        }
        .navbar.scrolled { background: rgba(2,6,23,0.96) !important; box-shadow: 0 4px 30px rgba(0,0,0,0.3); }
        .navbar-brand { font-weight: 800; font-size: 1.15rem; letter-spacing: -0.3px; display: flex; align-items: center; gap: 10px; }
        .navbar-brand img { height: 38px; border-radius: 10px; }
        .nav-link { color: rgba(255,255,255,0.78) !important; font-weight: 500; font-size: 0.88rem; padding: 8px 15px !important; border-radius: 8px; transition: var(--transition); }
        .nav-link:hover, .nav-link.active { color: #fff !important; background: rgba(255,255,255,0.08); }
        .btn-nav { background: linear-gradient(135deg, var(--primary), var(--accent)); border: none; color: #fff; font-weight: 600; padding: 9px 22px; border-radius: 50px; font-size: 0.85rem; box-shadow: 0 4px 15px rgba(37,99,235,0.35); transition: var(--transition); }
        .btn-nav:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(37,99,235,0.5); color: #fff; }

        /* ===== HERO ===== */
        .hero { position: relative; min-height: 85vh; display: flex; align-items: center; background: linear-gradient(135deg, #020617 0%, #0f172a 30%, #1e3a5f 60%, #1d4ed8 100%); overflow: hidden; }
        .hero::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 20% 80%, rgba(37,99,235,0.25) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(124,58,237,0.2) 0%, transparent 60%), radial-gradient(ellipse at 50% 50%, rgba(6,182,212,0.08) 0%, transparent 50%); }
        .hero-particles { position: absolute; inset: 0; pointer-events: none; }
        .hero-dot { position: absolute; width: 4px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 50%; animation: floatUp 7s ease-in-out infinite; }
        @keyframes floatUp { 0%,100% { transform: translateY(0) scale(1); opacity: 0.3; } 50% { transform: translateY(-25px) scale(1.8); opacity: 1; } }
        .hero-content { position: relative; z-index: 2; text-align: center; color: #fff; padding: 40px 0; }
        .hero-badge { display: inline-block; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.12); padding: 6px 20px; border-radius: 50px; font-size: 0.82rem; font-weight: 500; margin-bottom: 24px; animation: fadeUp 0.8s ease both; }
        .hero-title { font-size: clamp(2.3rem, 6vw, 4rem); font-weight: 800; line-height: 1.1; letter-spacing: -1.5px; margin-bottom: 16px; animation: fadeUp 0.8s ease 0.1s both; }
        .hero-title span { background: linear-gradient(135deg, #60a5fa, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-desc { font-size: 1.1rem; opacity: 0.8; max-width: 600px; margin: 0 auto 32px; line-height: 1.7; animation: fadeUp 0.8s ease 0.2s both; }
        .hero-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; animation: fadeUp 0.8s ease 0.3s both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .btn-hero { padding: 14px 32px; border-radius: 50px; font-weight: 700; font-size: 0.95rem; transition: var(--transition); display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
        .btn-hero-primary { background: #fff; color: var(--primary-dark); box-shadow: 0 8px 30px rgba(0,0,0,0.2); }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.35); color: var(--primary-dark); }
        .btn-hero-outline { border: 2px solid rgba(255,255,255,0.4); color: #fff; background: transparent; }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.08); border-color: #fff; transform: translateY(-3px); color: #fff; }
        .hero-wave { position: absolute; bottom: -1px; left: 0; width: 100%; line-height: 0; z-index: 1; }
        .hero-wave svg { width: 100%; height: 60px; }

        /* ===== SECTIONS ===== */
        section { padding: 80px 0; }
        .section-label { display: inline-block; padding: 6px 18px; background: rgba(37,99,235,0.07); color: var(--primary); border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; }
        .section-title { font-size: clamp(1.8rem, 3.5vw, 2.4rem); font-weight: 800; color: var(--dark); letter-spacing: -0.5px; margin-bottom: 8px; }
        .section-desc { color: var(--gray); font-size: 1.05rem; max-width: 550px; }
        .section-header { text-align: center; margin-bottom: 48px; }

        /* ===== CARDS ===== */
        .card-elevate {
            background: #fff; border: 1px solid #e2e8f0; border-radius: var(--radius);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: var(--transition); overflow: hidden;
        }
        .card-elevate:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: #cbd5e1; }
        .card-img-wrap { overflow: hidden; }
        .card-img-wrap img { transition: transform 0.5s ease; width: 100%; height: 200px; object-fit: cover; }
        .card-elevate:hover .card-img-wrap img { transform: scale(1.06); }

        /* ===== STATS ===== */
        .stat-card {
            background: #fff; border-radius: var(--radius); padding: 32px 20px; text-align: center;
            border: 1px solid #e2e8f0; transition: var(--transition); position: relative; overflow: hidden;
        }
        .stat-card::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--primary), var(--accent)); transform: scaleX(0); transition: transform 0.4s ease; }
        .stat-card:hover::after { transform: scaleX(1); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .stat-icon { font-size: 2.2rem; margin-bottom: 10px; }
        .stat-number { font-size: 2.2rem; font-weight: 800; color: var(--dark); letter-spacing: -1px; }
        .stat-label { color: var(--gray); font-weight: 500; font-size: 0.85rem; }

        /* ===== SAMBUTAN ===== */
        .kepsek-card { display: flex; gap: 32px; align-items: center; background: #fff; border-radius: var(--radius); padding: 40px; border: 1px solid #e2e8f0; box-shadow: var(--shadow); }
        .kepsek-photo { width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 5px solid #e0e7ff; flex-shrink: 0; }
        .quote-mark { font-size: 4rem; color: #e2e8f0; line-height: 1; }

        /* ===== TIMELINE ===== */
        .timeline-item {
            display: flex; gap: 18px; padding: 18px 20px; background: #fff; border-radius: var(--radius-sm);
            border: 1px solid #e2e8f0; margin-bottom: 12px; transition: var(--transition);
        }
        .timeline-item:hover { box-shadow: var(--shadow); border-left: 4px solid #f59e0b; }
        .tl-date { min-width: 55px; height: 55px; background: #fef3c7; color: #92400e; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 700; line-height: 1.2; }
        .tl-date .d { font-size: 1.3rem; } .tl-date .m { font-size: 0.65rem; text-transform: uppercase; }

        /* ===== JURUSAN ===== */
        .jurusan-card {
            position: relative; border-radius: var(--radius); overflow: hidden; background: #fff;
            border: 1px solid #e2e8f0; transition: var(--transition);
        }
        .jurusan-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .jurusan-card img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.5s ease; }
        .jurusan-card:hover img { transform: scale(1.06); }
        .jurusan-badge-ak { position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.55); backdrop-filter: blur(8px); color: #fff; padding: 4px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }

        /* ===== GALLERY GRID ===== */
        .gallery-grid-item {
            position: relative; border-radius: var(--radius); overflow: hidden; cursor: pointer;
        }
        .gallery-grid-item img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.5s ease; }
        .gallery-grid-item:hover img { transform: scale(1.1); }
        .gallery-overlay {
            position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent 60%);
            display: flex; align-items: flex-end; padding: 16px; opacity: 0; transition: var(--transition);
        }
        .gallery-grid-item:hover .gallery-overlay { opacity: 1; }

        /* ===== CTA ===== */
        .cta-section { background: linear-gradient(135deg, #0f172a, #1e293b); padding: 70px 0; text-align: center; color: #fff; }

        /* ===== FOOTER ===== */
        .footer { background: var(--darker); color: #94a3b8; padding: 60px 0 0; position: relative; }
        .footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--primary), var(--accent), #06b6d4); }
        .footer h5 { color: #fff; font-weight: 700; margin-bottom: 16px; font-size: 0.95rem; }
        .footer a { color: #94a3b8; text-decoration: none; transition: color 0.2s; }
        .footer a:hover { color: #fff; }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
            border-radius: 10px; background: rgba(255,255,255,0.05); color: #fff; margin-right: 8px;
            transition: var(--transition); font-size: 1rem;
        }
        .footer-social a:hover { transform: translateY(-3px); }
        .footer-social a.fb:hover { background: #1877f2; } .footer-social a.ig:hover { background: #e4405f; } .footer-social a.yt:hover { background: #ff0000; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.06); padding: 18px 0; margin-top: 40px; text-align: center; font-size: 0.85rem; }

        /* ===== SCROLL TOP ===== */
        .scroll-top { position: fixed; bottom: 28px; right: 28px; z-index: 999; width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, var(--primary), var(--accent)); color: #fff; border: none; cursor: pointer; display: none; align-items: center; justify-content: center; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(37,99,235,0.35); transition: var(--transition); }
        .scroll-top:hover { transform: translateY(-3px); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero { min-height: 70vh; }
            .kepsek-card { flex-direction: column; text-align: center; padding: 24px; }
            section { padding: 50px 0; }
        }

        [data-aos] { transition-timing-function: cubic-bezier(0.4,0,0.2,1); }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="topnav">
        <div class="container">
            <a class="navbar-brand" href="/">
                <?php if ($setting->logo ?? false): ?><img src="<?= base_url('uploads/' . $setting->logo) ?>" alt="Logo"><?php endif; ?>
                <?= esc($setting->nama_singkat ?? 'SMKN 1') ?>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="/prestasi">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ppdb">PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn-nav nav-link" href="/login"><i class="ti ti-login icon me-1"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main><?= $this->renderSection('content') ?></main>

    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5><?= esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></h5>
                    <p class="small mb-3"><?= esc($setting->deskripsi ?? '') ?></p>
                    <div class="footer-social">
                        <?php if ($setting->facebook ?? false): ?><a href="<?= esc($setting->facebook) ?>" target="_blank" class="fb" title="Facebook"><i class="ti ti-brand-facebook icon"></i></a><?php endif; ?>
                        <?php if ($setting->instagram ?? false): ?><a href="<?= esc($setting->instagram) ?>" target="_blank" class="ig" title="Instagram"><i class="ti ti-brand-instagram icon"></i></a><?php endif; ?>
                        <?php if ($setting->youtube ?? false): ?><a href="<?= esc($setting->youtube) ?>" target="_blank" class="yt" title="YouTube"><i class="ti ti-brand-youtube icon"></i></a><?php endif; ?>
                    </div>
                </div>
                <div class="col-6 col-lg-2"><h5>Menu</h5><ul class="list-unstyled small"><li class="mb-1"><a href="/profil">Profil</a></li><li class="mb-1"><a href="/visi-misi">Visi Misi</a></li><li class="mb-1"><a href="/sejarah">Sejarah</a></li><li class="mb-1"><a href="/guru-staff">Guru & Staff</a></li></ul></div>
                <div class="col-6 col-lg-2"><h5>Lainnya</h5><ul class="list-unstyled small"><li class="mb-1"><a href="/berita">Berita</a></li><li class="mb-1"><a href="/pengumuman">Pengumuman</a></li><li class="mb-1"><a href="/prestasi">Prestasi</a></li><li class="mb-1"><a href="/galeri">Galeri</a></li><li class="mb-1"><a href="/download">Download</a></li></ul></div>
                <div class="col-lg-4"><h5>Kontak</h5><ul class="list-unstyled small"><li class="mb-2"><i class="ti ti-map-pin icon me-2 text-primary"></i><?= esc($setting->alamat ?? '') ?></li><li class="mb-2"><i class="ti ti-phone icon me-2 text-primary"></i><?= esc($setting->telepon ?? '') ?></li><li class="mb-2"><i class="ti ti-mail icon me-2 text-primary"></i><?= esc($setting->email ?? '') ?></li></ul></div>
            </div>
        </div>
        <div class="footer-bottom"><div class="container"><?= $setting->footer_text ?? '&copy; ' . date('Y') . ' ' . esc($setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia') ?></div></div>
    </footer>

    <button class="scroll-top" id="scrollTop"><i class="ti ti-arrow-up icon"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        AOS.init({ duration: 700, once: true, offset: 80 });

        window.addEventListener('scroll', () => {
            document.getElementById('topnav').classList.toggle('scrolled', window.scrollY > 50);
            document.getElementById('scrollTop').style.display = window.scrollY > 400 ? 'flex' : 'none';
        });
        document.getElementById('scrollTop').addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        document.querySelectorAll('a[href^="#"]').forEach(a => a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
        }));
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
