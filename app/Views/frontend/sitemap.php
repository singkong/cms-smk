<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc><?= esc(base_url()) ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc><?= esc(base_url('profil')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= esc(base_url('visi-misi')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('sejarah')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('struktur-organisasi')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('guru-staff')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('jurusan')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= esc(base_url('fasilitas')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('berita')) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc><?= esc(base_url('pengumuman')) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc><?= esc(base_url('agenda')) ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= esc(base_url('prestasi')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= esc(base_url('galeri')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('galeri-video')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('download')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?= esc(base_url('alumni')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <url>
        <loc><?= esc(base_url('kontak')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <url>
        <loc><?= esc(base_url('faq')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <url>
        <loc><?= esc(base_url('ppdb')) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.90</priority>
    </url>

    <?php foreach ($jurusans as $j): ?>
    <url>
        <loc><?= esc(base_url('jurusan/' . $j->id)) ?></loc>
        <lastmod><?= !empty($j->updated_at) ? date('Y-m-d', strtotime($j->updated_at)) : date('Y-m-d') ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach ($posts as $p): ?>
    <?php
    $urlPath = match($p->type) {
        'pengumuman' => 'pengumuman/',
        'agenda' => 'agenda/',
        'prestasi' => 'prestasi/',
        default => 'berita/',
    };
    ?>
    <url>
        <loc><?= esc(base_url($urlPath . $p->slug)) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($p->updated_at ?? 'now')) ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <?php endforeach; ?>

</urlset>
