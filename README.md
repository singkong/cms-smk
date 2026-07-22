# CMS Sekolah SMK — CodeIgniter 4

Sistem Manajemen Konten (CMS) website sekolah SMK berbasis **CodeIgniter 4.7** dengan fitur lengkap untuk mengelola website sekolah secara profesional.

![CI4](https://img.shields.io/badge/CodeIgniter-4.7-red) ![PHP](https://img.shields.io/badge/PHP-8.3+-blue) ![Bootstrap](https://img.shields.io/badge/UI-Tabler%20%2B%20Custom-purple) ![License](https://img.shields.io/badge/license-MIT-green)

---

## Fitur

### Frontend (22 Halaman Publik)
| Halaman | Deskripsi |
|---------|-----------|
| Home | Hero slider, statistik, berita, pengumuman, galeri, partner, testimoni |
| Profil | Informasi sekolah, struktur, kepsek |
| Visi Misi | Visi dan misi sekolah |
| Sejarah | Sejarah sekolah |
| Guru & Staff | Daftar guru dan staff dengan foto |
| Jurusan | Daftar kompetensi keahlian + detail |
| Fasilitas | Sarana dan prasarana |
| Berita | Artikel berita dengan pagination |
| Pengumuman | Pengumuman sekolah |
| Agenda | Kalender kegiatan |
| Prestasi | Prestasi sekolah dan siswa |
| Galeri Foto | Album foto + lightbox |
| Galeri Video | Video YouTube |
| Download | File download grouped by kategori |
| Alumni | Data alumni |
| PPDB | Landing page PPDB online |
| FAQ | Pertanyaan umum |
| Kontak | Form kontak + Google Maps |
| Search | Pencarian konten |
| Sitemap | XML Sitemap |

### Admin Panel (20+ Modul)
| Modul | Fitur |
|-------|-------|
| Dashboard | Statistik + Chart.js (postingan, user, visitor, pesan) |
| Postingan | CRUD + draft/published + featured/headline + SEO meta + CKEditor 5 |
| Kategori | Multi-tipe (berita, pengumuman, download, gallery) |
| Tag | Tag management dengan post count |
| Komentar | Approve/reject/spam komentar |
| Galeri Foto | Upload foto + album management + modal edit |
| Galeri Video | Embed YouTube |
| Album | Album foto/video |
| Slider | Hero slider images |
| Download | Upload file + tracking download count |
| Guru | CRUD guru + foto + sorting |
| Staff | CRUD staff |
| Jurusan | CRUD jurusan + visi/misi/kurikulum/prospek |
| Fasilitas | CRUD fasilitas |
| Alumni | Data alumni |
| Partner | Logo partner DU/DI |
| Testimoni | Testimoni alumni |
| FAQ | FAQ management |
| Menu Builder | Nested menu header/footer |
| PPDB | Settings + registrasi + export CSV |
| Pengguna | User management + role assignment |
| Role & Permission | Permission matrix grouped by module |
| Pesan Masuk | Kontak form messages |
| Pengunjung | Visitor tracking + chart (negara, browser, device) |
| Log Aktivitas | Audit trail semua aktivitas admin |
| Log Login | Login history (success/failed) |
| Pengaturan | General, SEO, Sosial Media, SMTP, Logo, Favicon |

---

## Tech Stack

- **Framework**: CodeIgniter 4.7
- **PHP**: 8.3+
- **Database**: MySQL / MariaDB (34 tabel)
- **Frontend UI**: Tabler CSS (admin) + Custom modern design (public)
- **JavaScript Libraries**:
  - CKEditor 5 — Rich text editor
  - Chart.js — Dashboard charts
  - SweetAlert2 — Beautiful alerts & confirmations
  - DataTables — Sortable/searchable tables
  - Swiper.js — Carousel (partner, testimoni)
  - AOS.js — Scroll animations

---

## Requirements

- PHP >= 8.2
- MySQL >= 5.7 / MariaDB >= 10.3
- Composer
- PHP Extensions: `intl`, `mbstring`, `mysqli`, `json`, `curl`, `gd`

---

## Installation

```bash
# 1. Clone repository
git clone https://github.com/singkong/cms-smk.git
cd cms-smk

# 2. Install dependencies
composer install

# 3. Copy environment file
cp env .env

# 4. Edit .env — sesuaikan database
# database.default.hostname = localhost
# database.default.database = cms_smk
# database.default.username = root
# database.default.password = 
# app.baseURL = 'http://localhost:8080'

# 5. Buat database
mysql -u root -e "CREATE DATABASE cms_smk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 6. Jalankan migration
php spark migrate

# 7. Jalankan seeder
php spark db:seed MainSeeder

# 8. Buat folder uploads
mkdir -p public/uploads/{posts,gallery,jurusan,guru,staff,partners,sliders,downloads,videos,testimoni,fasilitas,alumni,avatars}

# 9. Jalankan server
php spark serve
```

Buka `http://localhost:8080` untuk frontend dan `http://localhost:8080/login` untuk admin panel.

---

## Default Login

| Username | Password | Role |
|----------|----------|------|
| `superadmin` | `admin123` | Super Admin (akses penuh) |
| `admin` | `admin123` | Admin |
| `editor` | `editor123` | Editor |

---

## Project Structure

```
cms-smk/
├── app/
│   ├── Controllers/     # 25 controller (Auth, Dashboard, CRUD modules, Frontend)
│   ├── Models/          # 18 model (BaseModel with soft delete + slug)
│   ├── Database/
│   │   ├── Migrations/  # 34 migration files
│   │   └── Seeds/       # MainSeeder (roles, permissions, users, settings)
│   ├── Filters/         # AuthFilter (authentication + permission check)
│   ├── Helpers/         # frontend_helper (search highlight)
│   └── Views/
│       ├── layouts/     # admin.php (Tabler sidebar), main.php (frontend)
│       ├── admin/       # 23 subdirectories — semua modul admin CRUD
│       ├── auth/        # login.php
│       ├── frontend/    # 22 halaman publik
│       └── errors/      # Error pages
├── public/
│   ├── index.php        # Entry point
│   ├── .htaccess        # URL rewriting
│   └── uploads/         # User uploaded files
├── writable/            # Cache, logs, sessions
├── vendor/              # Composer dependencies
├── .env                 # Environment configuration
├── spark                # CLI tool
└── composer.json        # Dependencies
```

---

## Database Schema

34 tabel relational: `roles`, `permissions`, `role_permissions`, `users`, `user_roles`, `categories`, `tags`, `posts`, `post_tags`, `post_images`, `comments`, `albums`, `gallery`, `videos`, `download_categories`, `downloads`, `guru`, `staff`, `jurusans`, `fasilitas`, `alumni`, `partners`, `testimoni`, `faq`, `sliders`, `menus`, `menu_items`, `settings`, `contacts`, `ppdb_settings`, `ppdb_registrations`, `visitors`, `login_logs`, `activity_logs`.

---

## Security

- Password hashing dengan **bcrypt**
- **CSRF protection** pada semua form
- **XSS filtering** via `esc()` pada semua output
- **Authentication filter** dengan middleware
- **Permission-based access control** (RBAC)
- **Soft deletes** pada data penting
- **Login throttling** via login_logs
- **Activity audit trail** untuk semua aksi admin

---

## Deployment

1. Set `CI_ENVIRONMENT = production` di `.env`
2. Set `app.baseURL` ke domain production
3. Point web server ke folder `public/`
4. Pastikan `writable/` dapat ditulis oleh web server
5. Jalankan `composer install --no-dev` untuk production

---

## License

MIT License. Free to use, modify, and distribute.

---

**Dibangun dengan CodeIgniter 4** | **UI oleh Tabler** | **2024**
