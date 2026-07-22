<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // --- Roles ---
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'superadmin', 'description' => 'Akses penuh ke seluruh sistem', 'is_default' => 0],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator konten dan master data', 'is_default' => 0],
            ['name' => 'Operator', 'slug' => 'operator', 'description' => 'Mengelola PPDB dan data operasional', 'is_default' => 0],
            ['name' => 'Editor', 'slug' => 'editor', 'description' => 'Penulis dan pengelola berita/konten', 'is_default' => 0],
            ['name' => 'Guru', 'slug' => 'guru', 'description' => 'Akun guru/staff pengajar', 'is_default' => 0],
            ['name' => 'Guest', 'slug' => 'guest', 'description' => 'Pengunjung publik', 'is_default' => 1],
        ];
        $this->db->table('roles')->insertBatch($roles);

        // --- Permissions ---
        $perms = [
            // Dashboard
            ['name' => 'Akses Dashboard', 'slug' => 'dashboard.access', 'group' => 'Dashboard'],
            // Posts
            ['name' => 'Lihat Postingan', 'slug' => 'posts.view', 'group' => 'Postingan'],
            ['name' => 'Tambah Postingan', 'slug' => 'posts.create', 'group' => 'Postingan'],
            ['name' => 'Edit Postingan', 'slug' => 'posts.edit', 'group' => 'Postingan'],
            ['name' => 'Hapus Postingan', 'slug' => 'posts.delete', 'group' => 'Postingan'],
            // Categories
            ['name' => 'Kelola Kategori', 'slug' => 'categories.manage', 'group' => 'Kategori'],
            // Tags
            ['name' => 'Kelola Tag', 'slug' => 'tags.manage', 'group' => 'Tag'],
            // Comments
            ['name' => 'Kelola Komentar', 'slug' => 'comments.manage', 'group' => 'Komentar'],
            // Gallery
            ['name' => 'Kelola Galeri', 'slug' => 'gallery.manage', 'group' => 'Galeri'],
            // Videos
            ['name' => 'Kelola Video', 'slug' => 'videos.manage', 'group' => 'Video'],
            // Downloads
            ['name' => 'Kelola Download', 'slug' => 'downloads.manage', 'group' => 'Download'],
            // Master Data
            ['name' => 'Kelola Guru', 'slug' => 'guru.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Staff', 'slug' => 'staff.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Jurusan', 'slug' => 'jurusan.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Fasilitas', 'slug' => 'fasilitas.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Alumni', 'slug' => 'alumni.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Partner', 'slug' => 'partner.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Testimoni', 'slug' => 'testimoni.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola FAQ', 'slug' => 'faq.manage', 'group' => 'Master Data'],
            ['name' => 'Kelola Slider', 'slug' => 'slider.manage', 'group' => 'Master Data'],
            // Menu
            ['name' => 'Kelola Menu', 'slug' => 'menu.manage', 'group' => 'Menu'],
            // PPDB
            ['name' => 'Kelola PPDB', 'slug' => 'ppdb.manage', 'group' => 'PPDB'],
            // Users
            ['name' => 'Kelola Users', 'slug' => 'users.manage', 'group' => 'Users'],
            ['name' => 'Kelola Roles', 'slug' => 'roles.manage', 'group' => 'Users'],
            // Settings
            ['name' => 'Kelola Settings', 'slug' => 'settings.manage', 'group' => 'Settings'],
            // Contacts
            ['name' => 'Kelola Kontak', 'slug' => 'contacts.manage', 'group' => 'Kontak'],
            // Logs
            ['name' => 'Lihat Logs', 'slug' => 'logs.view', 'group' => 'Logs'],
            // Visitors
            ['name' => 'Lihat Visitors', 'slug' => 'visitors.view', 'group' => 'Visitors'],
            // SEO
            ['name' => 'Kelola SEO', 'slug' => 'seo.manage', 'group' => 'SEO'],
        ];
        $this->db->table('permissions')->insertBatch($perms);

        // Attach all permissions to superadmin
        $permsAll = $this->db->table('permissions')->get()->getResultArray();
        $rolePerms = [];
        foreach ($permsAll as $p) {
            $rolePerms[] = ['role_id' => 1, 'permission_id' => $p['id']];
        }
        $this->db->table('role_permissions')->insertBatch($rolePerms);

        // Admin gets most perms except roles & logs
        $adminPerms = $this->db->table('permissions')
            ->whereNotIn('slug', ['roles.manage', 'logs.view'])
            ->get()->getResultArray();
        $adminRolePerms = [];
        foreach ($adminPerms as $p) {
            $adminRolePerms[] = ['role_id' => 2, 'permission_id' => $p['id']];
        }
        $this->db->table('role_permissions')->insertBatch($adminRolePerms);

        // Editor gets content perms
        $editorSlugs = ['dashboard.access', 'posts.view', 'posts.create', 'posts.edit', 'categories.manage', 'tags.manage', 'gallery.manage'];
        $editorPerms = $this->db->table('permissions')->whereIn('slug', $editorSlugs)->get()->getResultArray();
        $editorRolePerms = [];
        foreach ($editorPerms as $p) {
            $editorRolePerms[] = ['role_id' => 4, 'permission_id' => $p['id']];
        }
        $this->db->table('role_permissions')->insertBatch($editorRolePerms);

        // --- Users ---
        $users = [
            [
                'username' => 'superadmin', 'email' => 'superadmin@smk.sch.id',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'Super Administrator', 'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'admin', 'email' => 'admin@smk.sch.id',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'Admin Sekolah', 'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'editor', 'email' => 'editor@smk.sch.id',
                'password' => password_hash('editor123', PASSWORD_DEFAULT),
                'full_name' => 'Editor Konten', 'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);

        // Assign roles
        $this->db->table('user_roles')->insertBatch([
            ['user_id' => 1, 'role_id' => 1], // superadmin -> superadmin
            ['user_id' => 2, 'role_id' => 2], // admin -> admin
            ['user_id' => 3, 'role_id' => 4], // editor -> editor
        ]);

        // --- Settings ---
        $settings = [
            ['key' => 'nama_sekolah', 'value' => 'SMK Negeri 1 Indonesia'],
            ['key' => 'nama_singkat', 'value' => 'SMKN 1'],
            ['key' => 'npsn', 'value' => '12345678'],
            ['key' => 'nss', 'value' => '401020304001'],
            ['key' => 'status', 'value' => 'Negeri'],
            ['key' => 'akreditasi', 'value' => 'A'],
            ['key' => 'alamat', 'value' => 'Jl. Pendidikan No. 123, Kec. Cilandak, Jakarta Selatan'],
            ['key' => 'kode_pos', 'value' => '12430'],
            ['key' => 'telepon', 'value' => '(021) 12345678'],
            ['key' => 'fax', 'value' => '(021) 87654321'],
            ['key' => 'email', 'value' => 'info@smkn1indonesia.sch.id'],
            ['key' => 'website', 'value' => 'https://smkn1indonesia.sch.id'],
            ['key' => 'logo', 'value' => 'default-logo.png'],
            ['key' => 'favicon', 'value' => ''],
            ['key' => 'kepsek', 'value' => 'Drs. H. Ahmad Fauzi, M.Pd'],
            ['key' => 'nip_kepsek', 'value' => '196501011990031012'],
            ['key' => 'foto_kepsek', 'value' => 'default-kepsek.jpg'],
            ['key' => 'sambutan', 'value' => 'Assalamualaikum Warahmatullahi Wabarakatuh. Selamat datang di website resmi SMK Negeri 1 Indonesia. Kami berkomitmen untuk memberikan pendidikan vokasi berkualitas yang menghasilkan lulusan kompeten, berkarakter, dan siap bersaing di dunia kerja maupun melanjutkan ke jenjang yang lebih tinggi.'],
            ['key' => 'visi', 'value' => 'Terwujudnya SMK unggulan yang menghasilkan lulusan kompeten, berkarakter, berbudaya, dan berdaya saing global.'],
            ['key' => 'misi', 'value' => '1. Menyelenggarakan pendidikan dan pelatihan vokasi berkualitas sesuai standar industri.\n2. Mengembangkan potensi peserta didik secara holistik.\n3. Membangun karakter dan jiwa kewirausahaan.\n4. Menjalin kemitraan strategis dengan dunia usaha dan industri.\n5. Meningkatkan profesionalisme tenaga pendidik dan kependidikan.'],
            ['key' => 'sejarah', 'value' => 'SMK Negeri 1 Indonesia didirikan pada tahun 1980 dengan SK Menteri Pendidikan dan Kebudayaan No. 020/O/1980. Sejak didirikan, sekolah ini terus berkembang menjadi salah satu SMK unggulan di Indonesia dengan berbagai program keahlian yang sesuai dengan kebutuhan industri.'],
            ['key' => 'deskripsi', 'value' => 'SMK Negeri 1 Indonesia adalah lembaga pendidikan menengah kejuruan unggulan yang berfokus pada pengembangan kompetensi vokasi sesuai standar industri nasional dan internasional.'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/smkn1indonesia'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/smkn1indonesia'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/@smkn1indonesia'],
            ['key' => 'tiktok', 'value' => ''],
            ['key' => 'whatsapp', 'value' => '6281234567890'],
            ['key' => 'maps', 'value' => '<iframe src="https://maps.google.com/maps?q=jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="350"></iframe>'],
            ['key' => 'jam_operasional', 'value' => 'Senin - Jumat: 07:00 - 16:00 WIB\nSabtu: 07:00 - 12:00 WIB'],
            ['key' => 'google_analytics', 'value' => ''],
            ['key' => 'google_search_console', 'value' => ''],
            ['key' => 'meta_description', 'value' => 'Website resmi SMK Negeri 1 Indonesia. Informasi profil, jurusan, berita, PPDB, dan prestasi.'],
            ['key' => 'meta_keywords', 'value' => 'SMK, SMK Negeri 1 Indonesia, sekolah kejuruan, vokasi, PPDB, pendidikan'],
            ['key' => 'smtp_host', 'value' => ''],
            ['key' => 'smtp_port', 'value' => '587'],
            ['key' => 'smtp_username', 'value' => ''],
            ['key' => 'smtp_password', 'value' => ''],
            ['key' => 'smtp_encryption', 'value' => 'tls'],
            ['key' => 'footer_text', 'value' => '&copy; ' . date('Y') . ' SMK Negeri 1 Indonesia. All Rights Reserved.'],
        ];
        $this->db->table('settings')->insertBatch($settings);

        // --- Sample Menu ---
        $this->db->table('menus')->insert([
            'name' => 'Header Menu', 'location' => 'header',
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $menuItems = [
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Beranda', 'url' => '/', 'icon' => 'bi-house', 'sort_order' => 1],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Profil', 'url' => '#', 'icon' => 'bi-info-circle', 'sort_order' => 2],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Jurusan', 'url' => '/jurusan', 'icon' => 'bi-building', 'sort_order' => 3],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Berita', 'url' => '/berita', 'icon' => 'bi-newspaper', 'sort_order' => 4],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Galeri', 'url' => '/galeri', 'icon' => 'bi-images', 'sort_order' => 5],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'PPDB', 'url' => '/ppdb', 'icon' => 'bi-pencil-square', 'sort_order' => 6],
            ['menu_id' => 1, 'parent_id' => null, 'title' => 'Kontak', 'url' => '/kontak', 'icon' => 'bi-envelope', 'sort_order' => 7],
        ];
        $this->db->table('menu_items')->insertBatch($menuItems);
    }
}
