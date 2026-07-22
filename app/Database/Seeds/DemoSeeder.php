<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $uid = 1;

        // ========== KATEGORI ==========
        $categories = [
            ['name' => 'Akademik', 'slug' => 'akademik', 'description' => 'Berita seputar akademik dan pembelajaran', 'type' => 'berita', 'created_at' => $now],
            ['name' => 'Kesiswaan', 'slug' => 'kesiswaan', 'description' => 'Kegiatan kesiswaan dan OSIS', 'type' => 'berita', 'created_at' => $now],
            ['name' => 'Lomba', 'slug' => 'lomba', 'description' => 'Informasi lomba dan kompetisi', 'type' => 'berita', 'created_at' => $now],
            ['name' => 'Industri', 'slug' => 'industri', 'description' => 'Kerjasama dengan dunia industri', 'type' => 'berita', 'created_at' => $now],
            ['name' => 'Administrasi', 'slug' => 'administrasi', 'description' => 'Pengumuman administrasi sekolah', 'type' => 'pengumuman', 'created_at' => $now],
            ['name' => 'Kurikulum', 'slug' => 'kurikulum', 'description' => 'File kurikulum dan perangkat pembelajaran', 'type' => 'download', 'created_at' => $now],
            ['name' => 'Formulir', 'slug' => 'formulir', 'description' => 'Formulir dan blangko', 'type' => 'download', 'created_at' => $now],
        ];
        $this->db->table('categories')->insertBatch($categories);

        // ========== TAG ==========
        $tags = ['Prestasi', 'Teknologi', 'Kewirausahaan', 'Praktik Kerja', 'UNBK', 'Kurikulum Merdeka', 'Bursa Kerja', 'Beasiswa', 'Industri 4.0', 'Soft Skill'];
        $tagData = [];
        foreach ($tags as $t) {
            $tagData[] = ['name' => $t, 'slug' => mb_url_title($t, '-', true), 'created_at' => $now];
        }
        $this->db->table('tags')->insertBatch($tagData);
        $tagIds = $this->db->table('tags')->get()->getResult();

        // ========== POSTS ==========
        $posts = [
            ['title' => 'SMKN 1 Indonesia Raih Juara 1 LKS Tingkat Provinsi Bidang Web Technology', 'type' => 'berita', 'status' => 'published', 'is_featured' => 1, 'is_headline' => 1, 'views' => 245, 'category_id' => 3,
                'content' => '<p>Tim Web Technology SMKN 1 Indonesia berhasil meraih <strong>Juara 1</strong> dalam ajang Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi tahun 2024. Kompetisi yang diadakan di Gedung Graha Pemuda ini diikuti oleh 40 SMK se-provinsi.</p><p>Tim yang terdiri dari Ahmad Rizki (XII RPL 1) dan Siti Nurhaliza (XII RPL 2) berhasil menyelesaikan tantangan membuat aplikasi web full-stack dalam waktu 8 jam. Mereka mengalahkan juara bertahan dari SMKN 2 Surabaya dan SMKN 3 Bandung.</p><blockquote><p>"Kami sangat bangga dengan prestasi ini. Ini membuktikan bahwa lulusan SMK mampu bersaing di tingkat provinsi bahkan nasional," ujar Kepala Sekolah.</p></blockquote><p>Selamat kepada para pemenang! Semoga bisa melanjutkan prestasi ke tingkat nasional.</p>',
                'excerpt' => 'Tim Web Technology SMKN 1 Indonesia meraih Juara 1 LKS Tingkat Provinsi 2024.', 'image' => 'post-1.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['title' => 'Pelepasan Siswa Praktik Kerja Industri Tahun Ajaran 2024/2025', 'type' => 'berita', 'status' => 'published', 'is_featured' => 1, 'views' => 189, 'category_id' => 4,
                'content' => '<p>Sebanyak 350 siswa kelas XII dari 6 kompetensi keahlian resmi dilepas untuk mengikuti <strong>Praktik Kerja Industri (Prakerin)</strong> tahun ajaran 2024/2025. Upacara pelepasan dilaksanakan di lapangan utama sekolah pada Senin pagi.</p><p>Siswa akan ditempatkan di 85 perusahaan mitra selama 6 bulan ke depan, meliputi perusahaan IT, manufaktur, otomotif, perhotelan, dan perbankan.</p><p>Kepala Sekolah dalam sambutannya berpesan, "Jaga nama baik sekolah, tunjukkan kompetensi dan etos kerja yang telah kalian pelajari. Dunia industri menanti kontribusi kalian."</p>',
                'excerpt' => '350 siswa kelas XII resmi dilepas untuk Praktik Kerja Industri di 85 perusahaan mitra.', 'image' => 'post-2.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            ['title' => 'Workshop Implementasi Kurikulum Merdeka Bersama BBPPMPV BMTI', 'type' => 'berita', 'status' => 'published', 'is_featured' => 1, 'views' => 167, 'category_id' => 1,
                'content' => '<p>SMKN 1 Indonesia menggelar workshop <strong>"Implementasi Kurikulum Merdeka di SMK"</strong> bekerjasama dengan Balai Besar Pengembangan Penjaminan Mutu Pendidikan Vokasi (BBPPMPV) BMTI Cimahi.</p><p>Workshop yang diikuti 85 guru produktif dan adaptif ini membahas:</p><ul><li>Penyusunan modul ajar berbasis proyek</li><li>Asesmen diagnostik dan formatif</li><li>Project Based Learning (PjBL)</li><li>Teaching Factory</li></ul><p>Narasumber dari BBPPMPV, Dr. Hendra Gunawan, M.Pd menyampaikan bahwa SMK harus menjadi ujung tombak implementasi Kurikulum Merdeka karena karakteristik pembelajarannya yang berbasis proyek.</p>',
                'excerpt' => 'Workshop Kurikulum Merdeka bekerjasama dengan BBPPMPV BMTI diikuti 85 guru.', 'image' => 'post-3.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['title' => 'Kunjungan Industri ke PT Astra Honda Motor', 'type' => 'berita', 'status' => 'published', 'is_headline' => 1, 'views' => 312, 'category_id' => 4,
                'content' => '<p>Siswa jurusan Teknik Sepeda Motor (TSM) melakukan kunjungan industri ke <strong>PT Astra Honda Motor</strong> Plant Cikarang. Kegiatan ini merupakan bagian dari program link and match sekolah dengan industri.</p><p>Dalam kunjungan ini, siswa melihat langsung proses produksi sepeda motor dari assembly line hingga quality control. Siswa juga mendapat penjelasan tentang teknologi terkini yang diterapkan di pabrik.</p>',
                'excerpt' => 'Siswa TSM kunjungi pabrik Astra Honda Motor Cikarang untuk pembelajaran industri.', 'image' => 'post-4.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['title' => 'Penerimaan Raport Semester Ganjil TP 2024/2025', 'type' => 'pengumuman', 'status' => 'published', 'views' => 520, 'category_id' => 5,
                'content' => '<p>Diberitahukan kepada seluruh orang tua/wali siswa bahwa <strong>Penerimaan Raport Semester Ganjil</strong> Tahun Pelajaran 2024/2025 akan dilaksanakan pada:</p><table><tr><td><strong>Hari/Tanggal</strong></td><td>: Jumat, 20 Desember 2024</td></tr><tr><td><strong>Waktu</strong></td><td>: 08.00 - 12.00 WIB</td></tr><tr><td><strong>Tempat</strong></td><td>: Ruang kelas masing-masing</td></tr></table><p>Orang tua/wali wajib hadir untuk mengambil raport. Tidak diwakilkan.</p>',
                'excerpt' => 'Penerimaan raport semester ganjil dilaksanakan Jumat, 20 Desember 2024.', 'image' => 'post-5.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-1 days'))],
            ['title' => 'Jadwal Ujian Akhir Semester (UAS) Ganjil 2024/2025', 'type' => 'pengumuman', 'status' => 'published', 'views' => 780, 'category_id' => 5,
                'content' => '<p>Berikut jadwal <strong>Ujian Akhir Semester (UAS) Ganjil</strong> Tahun Pelajaran 2024/2025:</p><p><strong>Kelas XII:</strong> 2-7 Desember 2024<br><strong>Kelas XI:</strong> 9-14 Desember 2024<br><strong>Kelas X:</strong> 16-21 Desember 2024</p><p>Ujian dilaksanakan secara online menggunakan platform CBT sekolah. Pastikan akun sudah aktif sebelum ujian.</p>',
                'excerpt' => 'UAS Ganjil 2024/2025 dimulai 2 Desember untuk kelas XII.', 'image' => 'post-6.png', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['title' => 'Peringatan Hari Guru Nasional 2024', 'type' => 'agenda', 'status' => 'published', 'views' => 92,
                'content' => '<p>Dalam rangka memperingati Hari Guru Nasional, akan diadakan upacara bendera dan berbagai perlombaan.</p>', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('+10 days'))],
            ['title' => 'Job Fair SMK 2025: Bursa Kerja Khusus Lulusan SMK', 'type' => 'agenda', 'status' => 'published', 'views' => 340,
                'content' => '<p>Bursa Kerja Khusus untuk lulusan SMK dengan 30+ perusahaan mitra yang akan membuka lowongan.</p><p><strong>Lokasi:</strong> Aula Utama SMKN 1 Indonesia</p>', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('+30 days'))],
            ['title' => 'Siswa RPL Ciptakan Aplikasi E-Library untuk Perpustakaan Daerah', 'type' => 'prestasi', 'status' => 'published', 'is_featured' => 1, 'views' => 156,
                'content' => '<p>Lima siswa jurusan Rekayasa Perangkat Lunak berhasil menciptakan aplikasi <strong>E-Library</strong> yang kini digunakan oleh Dinas Perpustakaan Daerah.</p><p>Aplikasi ini memungkinkan masyarakat mengakses katalog buku digital, melakukan peminjaman online, dan membaca e-book secara gratis.</p>',
                'excerpt' => 'Siswa RPL ciptakan aplikasi E-Library untuk Perpustakaan Daerah.', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-15 days'))],
            ['title' => 'Tim Robotik Raih Medali Perak di International Robot Olympiad', 'type' => 'prestasi', 'status' => 'published', 'is_featured' => 1, 'views' => 430,
                'content' => '<p>Tim Robotik SMKN 1 Indonesia berhasil meraih <strong>Medali Perak</strong> dalam International Robot Olympiad (IRO) 2024 di Athena, Yunani. Indonesia mengirimkan 5 tim dan tim SMKN 1 menjadi satu-satunya perwakilan SMK.</p>',
                'excerpt' => 'Tim Robotik raih Medali Perak di International Robot Olympiad 2024, Athena.', 'user_id' => $uid, 'published_at' => date('Y-m-d H:i:s', strtotime('-20 days'))],
            ['title' => 'Tentang Sekolah', 'type' => 'halaman', 'status' => 'published', 'views' => 100,
                'content' => '<h3>Sejarah Singkat</h3><p>SMK Negeri 1 Indonesia berdiri sejak tahun 1980 dan telah menghasilkan puluhan ribu lulusan yang tersebar di berbagai industri nasional dan internasional.</p><h3>Visi</h3><p>Terwujudnya SMK unggulan yang menghasilkan lulusan kompeten, berkarakter, berbudaya, dan berdaya saing global.</p><h3>Misi</h3><ol><li>Menyelenggarakan pendidikan vokasi berkualitas</li><li>Mengembangkan potensi peserta didik secara holistik</li><li>Membangun karakter dan jiwa kewirausahaan</li></ol>',
                'excerpt' => 'Halaman tentang SMK Negeri 1 Indonesia', 'user_id' => $uid, 'published_at' => $now],
        ];
        foreach ($posts as $p) {
            $p['slug'] = mb_url_title($p['title'], '-', true);
            $p['created_at'] = $p['published_at'] ?? $now;
            $p['updated_at'] = $now;
            $p['meta_title'] = $p['title'];
            $p['meta_description'] = $p['excerpt'] ?? '';
            $this->db->table('posts')->insert($p);
        }

        // ========== POST TAGS ==========
        $postTagData = [];
        $allPosts = $this->db->table('posts')->get()->getResult();
        foreach ($allPosts as $i => $post) {
            $tagCount = rand(2, 4);
            $usedTags = array_rand(array_flip(range(0, count($tagIds) - 1)), $tagCount);
            if (!is_array($usedTags)) $usedTags = [$usedTags];
            foreach ($usedTags as $ti) {
                $postTagData[] = ['post_id' => $post->id, 'tag_id' => $tagIds[$ti]->id];
            }
        }
        $this->db->table('post_tags')->insertBatch($postTagData);

        // ========== GURU ==========
        $guru = [
            ['nip' => '196501011990031012', 'nama' => 'Drs. H. Ahmad Fauzi, M.Pd', 'foto' => 'guru-1.png', 'jabatan' => 'Kepala Sekolah', 'bidang' => 'Manajemen Pendidikan', 'pendidikan' => 'S2 Manajemen Pendidikan', 'sort_order' => 1, 'is_active' => 1],
            ['nip' => '197203152000121004', 'nama' => 'Dra. Siti Aminah, M.Pd', 'foto' => 'guru-2.png', 'jabatan' => 'Wakasek Kurikulum', 'bidang' => 'Bahasa Indonesia', 'pendidikan' => 'S2 Pendidikan Bahasa', 'sort_order' => 2, 'is_active' => 1],
            ['nip' => '198005202005011008', 'nama' => 'Rudi Hartono, S.Kom, M.T', 'foto' => 'guru-3.png', 'jabatan' => 'Wakasek Sarana', 'bidang' => 'Rekayasa Perangkat Lunak', 'pendidikan' => 'S2 Teknik Informatika', 'sort_order' => 3, 'is_active' => 1],
            ['nip' => '198511102010012015', 'nama' => 'Dewi Lestari, S.Pd, M.Pd', 'foto' => 'guru-4.png', 'jabatan' => 'Wakasek Kesiswaan', 'bidang' => 'Matematika', 'pendidikan' => 'S2 Pendidikan Matematika', 'sort_order' => 4, 'is_active' => 1],
            ['nip' => '199008152014021005', 'nama' => 'Bambang Sulistyo, S.T', 'foto' => 'guru-5.png', 'jabatan' => 'Kaprodi TSM', 'bidang' => 'Teknik Sepeda Motor', 'pendidikan' => 'S1 Teknik Mesin', 'sort_order' => 5, 'is_active' => 1],
            ['nip' => '199203202015032008', 'nama' => 'Nurul Hidayah, S.Pd', 'foto' => 'guru-6.png', 'jabatan' => 'Guru Produktif', 'bidang' => 'Akuntansi', 'pendidikan' => 'S1 Pendidikan Akuntansi', 'sort_order' => 6, 'is_active' => 1],
            ['nip' => '198807252011011010', 'nama' => 'Agus Wijaya, S.Kom', 'foto' => 'guru-7.png', 'jabatan' => 'Kaprodi RPL', 'bidang' => 'Pemrograman Web', 'pendidikan' => 'S1 Teknik Informatika', 'sort_order' => 7, 'is_active' => 1],
            ['nip' => '199501012019031015', 'nama' => 'Fitriani Putri, S.Pd', 'foto' => 'guru-8.png', 'jabatan' => 'Guru BK', 'bidang' => 'Bimbingan Konseling', 'pendidikan' => 'S1 Bimbingan Konseling', 'sort_order' => 8, 'is_active' => 1],
        ];
        foreach ($guru as &$g) { $g['created_at'] = $now; $g['updated_at'] = $now; }
        $this->db->table('guru')->insertBatch($guru);

        // ========== STAFF ==========
        $staff = [
            ['nama' => 'Herman Setiawan', 'jabatan' => 'Kepala Tata Usaha', 'sort_order' => 1],
            ['nama' => 'Ratna Dewi', 'jabatan' => 'Staff Administrasi', 'sort_order' => 2],
            ['nama' => 'Suryadi', 'jabatan' => 'Staff Keuangan', 'sort_order' => 3],
            ['nama' => 'Tuti Hartati', 'jabatan' => 'Staff Perpustakaan', 'sort_order' => 4],
            ['nama' => 'Joko Prasetyo', 'jabatan' => 'Teknisi IT', 'sort_order' => 5],
            ['nama' => 'Ani Maryani', 'jabatan' => 'Staff Kebersihan', 'sort_order' => 6],
        ];
        foreach ($staff as &$s) { $s['created_at'] = $now; $s['updated_at'] = $now; }
        $this->db->table('staff')->insertBatch($staff);

        // ========== JURUSAN ==========
        $jurusans = [
            ['nama' => 'Rekayasa Perangkat Lunak', 'singkatan' => 'RPL', 'akreditasi' => 'A', 'gambar' => 'jurusan-1.png',
                'deskripsi' => 'Kompetensi keahlian yang mempelajari pengembangan perangkat lunak, aplikasi web, mobile, dan desktop. Fokus pada pemrograman, database, UI/UX design, dan software engineering.',
                'visi' => 'Menjadi program keahlian unggulan di bidang pengembangan perangkat lunak.',
                'misi' => 'Menghasilkan lulusan yang kompeten dalam software development dan siap bersaing di industri IT.',
                'kepala_jurusan' => 'Agus Wijaya, S.Kom', 'prospek_kerja' => 'Programmer, Web Developer, Mobile Developer, UI/UX Designer, Software Tester, IT Consultant'],
            ['nama' => 'Teknik Sepeda Motor', 'singkatan' => 'TSM', 'akreditasi' => 'A', 'gambar' => 'jurusan-2.png',
                'deskripsi' => 'Kompetensi keahlian di bidang perawatan dan perbaikan sepeda motor. Mencakup teknologi mesin, kelistrikan, dan chassis sepeda motor.',
                'visi' => 'Menjadi pusat unggulan pelatihan teknik sepeda motor.',
                'misi' => 'Menyiapkan tenaga teknik yang profesional di bidang otomotif.',
                'kepala_jurusan' => 'Bambang Sulistyo, S.T', 'prospek_kerja' => 'Mekanik, Service Advisor, Wirausaha Bengkel, Teknisi AHASS'],
            ['nama' => 'Akuntansi dan Keuangan Lembaga', 'singkatan' => 'AKL', 'akreditasi' => 'A', 'gambar' => 'jurusan-3.png',
                'deskripsi' => 'Kompetensi keahlian yang mempelajari siklus akuntansi, perpajakan, audit, dan software akuntansi seperti MYOB dan Accurate.',
                'visi' => 'Mencetak lulusan akuntansi yang profesional dan berintegritas.',
                'misi' => 'Membekali siswa dengan kompetensi akuntansi sesuai standar industri.',
                'kepala_jurusan' => 'Nurul Hidayah, S.Pd', 'prospek_kerja' => 'Staff Accounting, Auditor, Tax Officer, Finance Admin, Wirausaha'],
            ['nama' => 'Teknik Komputer Jaringan', 'singkatan' => 'TKJ', 'akreditasi' => 'B', 'gambar' => 'jurusan-4.png',
                'deskripsi' => 'Kompetensi keahlian di bidang jaringan komputer, administrasi server, keamanan jaringan, dan Internet of Things.',
                'visi' => 'Menjadi program keahlian unggulan di bidang jaringan komputer.',
                'misi' => 'Menyiapkan lulusan yang ahli dalam infrastruktur dan keamanan jaringan.',
                'kepala_jurusan' => 'Drs. Supriyanto', 'prospek_kerja' => 'Network Administrator, IT Support, Security Engineer, Cloud Engineer'],
            ['nama' => 'Desain Komunikasi Visual', 'singkatan' => 'DKV', 'akreditasi' => 'A', 'gambar' => 'jurusan-5.png',
                'deskripsi' => 'Kompetensi keahlian yang mempelajari desain grafis, motion graphics, fotografi, videografi, dan branding.',
                'visi' => 'Menjadi pusat kreativitas desain digital di tingkat SMK.',
                'misi' => 'Mengembangkan bakat kreatif siswa dalam komunikasi visual.',
                'kepala_jurusan' => 'Ratih Anggraini, S.Ds', 'prospek_kerja' => 'Graphic Designer, UI Designer, Content Creator, Animator, Fotografer'],
            ['nama' => 'Manajemen Perkantoran', 'singkatan' => 'MP', 'akreditasi' => 'B', 'gambar' => 'jurusan-6.png',
                'deskripsi' => 'Kompetensi keahlian di bidang administrasi perkantoran, kearsipan, korespondensi, dan otomatisasi perkantoran.',
                'visi' => 'Mencetak tenaga administrasi perkantoran yang profesional.',
                'misi' => 'Membekali siswa dengan keterampilan manajemen kantor modern.',
                'kepala_jurusan' => 'Sri Wahyuni, S.Pd', 'prospek_kerja' => 'Admin Officer, Secretary, Customer Service, Office Manager'],
        ];
        foreach ($jurusans as &$j) { $j['created_at'] = $now; $j['updated_at'] = $now; }
        $this->db->table('jurusans')->insertBatch($jurusans);

        // ========== FASILITAS ==========
        $fasilitas = [
            ['nama' => 'Laboratorium Komputer', 'deskripsi' => '4 lab komputer dengan total 160 unit PC spesifikasi terkini', 'ikon' => 'device-desktop'],
            ['nama' => 'Perpustakaan Digital', 'deskripsi' => 'Koleksi 5000+ buku fisik dan akses e-book', 'ikon' => 'books'],
            ['nama' => 'Workshop Otomotif', 'deskripsi' => 'Bengkel praktik dengan peralatan standar industri', 'ikon' => 'tool'],
            ['nama' => 'Studio Desain', 'deskripsi' => 'Studio dengan perangkat desain grafis dan fotografi', 'ikon' => 'palette'],
            ['nama' => 'Aula Serbaguna', 'deskripsi' => 'Kapasitas 800 orang dengan sound system dan AC', 'ikon' => 'building-community'],
            ['nama' => 'Lapangan Olahraga', 'deskripsi' => 'Lapangan basket, futsal, voli, dan trek lari', 'ikon' => 'ball-football'],
            ['nama' => 'Teaching Factory', 'deskripsi' => 'Unit produksi untuk praktik kewirausahaan siswa', 'ikon' => 'building-factory'],
            ['nama' => 'Kantin Sehat', 'deskripsi' => 'Menyediakan makanan sehat dan bergizi', 'ikon' => 'coffee'],
        ];
        foreach ($fasilitas as &$f) { $f['created_at'] = $now; $f['updated_at'] = $now; }
        $this->db->table('fasilitas')->insertBatch($fasilitas);

        // ========== ALUMNI ==========
        $alumni = [
            ['nama' => 'Dimas Prasetyo', 'angkatan' => 2020, 'jurusan' => 'RPL', 'pekerjaan' => 'Software Engineer', 'perusahaan' => 'Gojek'],
            ['nama' => 'Rina Maharani', 'angkatan' => 2019, 'jurusan' => 'AKL', 'pekerjaan' => 'Senior Auditor', 'perusahaan' => 'PwC Indonesia'],
            ['nama' => 'Bayu Setiawan', 'angkatan' => 2020, 'jurusan' => 'TKJ', 'pekerjaan' => 'Network Engineer', 'perusahaan' => 'Telkom'],
            ['nama' => 'Putri Anggraini', 'angkatan' => 2018, 'jurusan' => 'DKV', 'pekerjaan' => 'Creative Director', 'perusahaan' => 'XYZ Agency'],
            ['nama' => 'Arief Rachman', 'angkatan' => 2019, 'jurusan' => 'TSM', 'pekerjaan' => 'Kepala Bengkel', 'perusahaan' => 'AHASS Mandiri Motor'],
            ['nama' => 'Salsa Dilla', 'angkatan' => 2021, 'jurusan' => 'MP', 'pekerjaan' => 'Executive Secretary', 'perusahaan' => 'Pertamina'],
        ];
        foreach ($alumni as &$a) { $a['created_at'] = $now; $a['updated_at'] = $now; }
        $this->db->table('alumni')->insertBatch($alumni);

        // ========== TESTIMONI ==========
        $testimoni = [
            ['nama' => 'Dimas Prasetyo', 'jurusan' => 'RPL', 'angkatan' => 2020, 'pesan' => 'Ilmu yang saya dapatkan di SMK sangat relevan dengan pekerjaan saya sekarang. Teaching Factory benar-benar mempersiapkan kami untuk dunia kerja.', 'is_active' => 1],
            ['nama' => 'Rina Maharani', 'jurusan' => 'AKL', 'angkatan' => 2019, 'pesan' => 'Berkat bimbingan guru yang profesional, saya berhasil mendapatkan sertifikasi akuntansi sebelum lulus. Terima kasih SMKN 1 Indonesia!', 'is_active' => 1],
            ['nama' => 'Bayu Setiawan', 'jurusan' => 'TKJ', 'angkatan' => 2020, 'pesan' => 'Fasilitas lab jaringan yang lengkap dan program sertifikasi MikroTik sangat membantu karir saya di dunia IT.', 'is_active' => 1],
            ['nama' => 'Putri Anggraini', 'jurusan' => 'DKV', 'angkatan' => 2018, 'pesan' => 'Portofolio yang saya bangun selama di SMK menjadi modal utama saya mendapatkan klien pertama. Kurikulumnya sangat praktikal.', 'is_active' => 1],
        ];
        foreach ($testimoni as &$t) { $t['created_at'] = $now; }
        $this->db->table('testimoni')->insertBatch($testimoni);

        // ========== PARTNER ==========
        $partners = [
            ['nama' => 'PT Telkom Indonesia', 'logo' => 'partner-1.png', 'website' => 'https://telkom.co.id', 'sort_order' => 1],
            ['nama' => 'PT Astra International', 'logo' => 'partner-2.png', 'website' => 'https://astra.co.id', 'sort_order' => 2],
            ['nama' => 'Microsoft Indonesia', 'logo' => 'partner-3.png', 'website' => 'https://microsoft.com', 'sort_order' => 3],
            ['nama' => 'Google Indonesia', 'logo' => 'partner-4.png', 'website' => 'https://google.com', 'sort_order' => 4],
            ['nama' => 'PT Honda Prospect Motor', 'logo' => 'partner-5.png', 'website' => 'https://honda-indonesia.com', 'sort_order' => 5],
            ['nama' => 'Bank Mandiri', 'logo' => 'partner-6.png', 'website' => 'https://bankmandiri.co.id', 'sort_order' => 6],
        ];
        foreach ($partners as &$p) { $p['created_at'] = $now; $p['updated_at'] = $now; }
        $this->db->table('partners')->insertBatch($partners);

        // ========== FAQ ==========
        $faq = [
            ['question' => 'Apakah SMKN 1 Indonesia menerima siswa dari luar kota?', 'answer' => 'Ya, kami menerima siswa dari seluruh Indonesia. Tidak ada batasan domisili.', 'sort_order' => 1],
            ['question' => 'Berapa biaya pendaftaran PPDB?', 'answer' => 'Biaya pendaftaran mengikuti ketentuan dinas pendidikan setempat. Informasi detail dapat dilihat di halaman PPDB.', 'sort_order' => 2],
            ['question' => 'Apakah ada program beasiswa?', 'answer' => 'Ya, tersedia beasiswa dari pemerintah (KIP, BSM) dan beasiswa dari perusahaan mitra untuk siswa berprestasi.', 'sort_order' => 3],
            ['question' => 'Apa saja jurusan yang tersedia?', 'answer' => 'Terdapat 6 jurusan: RPL, TSM, AKL, TKJ, DKV, dan Manajemen Perkantoran.', 'sort_order' => 4],
            ['question' => 'Apakah lulusan langsung disalurkan kerja?', 'answer' => 'Ya, melalui Bursa Kerja Khusus (BKK) kami bekerja sama dengan 85+ perusahaan untuk penyaluran lulusan.', 'sort_order' => 5],
        ];
        foreach ($faq as &$f) { $f['created_at'] = $now; $f['updated_at'] = $now; }
        $this->db->table('faq')->insertBatch($faq);

        // ========== SLIDERS ==========
        $sliders = [
            ['title' => 'Selamat Datang di SMKN 1 Indonesia', 'description' => 'Mencetak Generasi Unggul dan Kompeten', 'image' => 'slider-1.png', 'url' => null, 'sort_order' => 1, 'is_active' => 1],
            ['title' => 'PPDB 2024/2025 Telah Dibuka', 'description' => 'Daftarkan diri Anda sekarang!', 'image' => 'slider-2.png', 'url' => '/ppdb', 'sort_order' => 2, 'is_active' => 1],
            ['title' => 'Prestasi Membanggakan', 'description' => 'Juara LKS Tingkat Provinsi 2024', 'image' => 'slider-3.png', 'url' => null, 'sort_order' => 3, 'is_active' => 1],
        ];
        foreach ($sliders as &$s) { $s['created_at'] = $now; $s['updated_at'] = $now; }
        $this->db->table('sliders')->insertBatch($sliders);

        // ========== ALBUMS ==========
        $albums = [
            ['name' => 'LKS 2024', 'slug' => 'lks-2024', 'description' => 'Lomba Kompetensi Siswa 2024', 'type' => 'photo'],
            ['name' => 'Perpisahan 2024', 'slug' => 'perpisahan-2024', 'description' => 'Acara perpisahan kelas XII', 'type' => 'photo'],
            ['name' => 'Workshop Kurikulum', 'slug' => 'workshop-kurikulum', 'description' => 'Workshop Kurikulum Merdeka', 'type' => 'photo'],
        ];
        foreach ($albums as &$a) { $a['created_at'] = $now; $a['updated_at'] = $now; }
        $this->db->table('albums')->insertBatch($albums);

        // Gallery photos
        $gallery = [];
        for ($i = 1; $i <= 8; $i++) {
            $gallery[] = [
                'album_id'    => rand(1, 3),
                'title'       => 'Foto Kegiatan ' . $i,
                'description' => 'Dokumentasi kegiatan sekolah',
                'image'       => 'gallery-' . $i . '.png',
                'sort_order'  => $i,
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }
        $this->db->table('gallery')->insertBatch($gallery);

        // ========== VIDEOS ==========
        $videos = [
            ['title' => 'Profil SMKN 1 Indonesia 2024', 'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'embed_code' => null],
            ['title' => 'Kegiatan Prakerin 2024', 'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'embed_code' => null],
            ['title' => 'LKS Tingkat Provinsi', 'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'embed_code' => null],
        ];
        foreach ($videos as &$v) { $v['created_at'] = $now; $v['updated_at'] = $now; }
        $this->db->table('videos')->insertBatch($videos);

        // ========== DOWNLOAD ==========
        $downloadCats = [
            ['name' => 'Kurikulum', 'slug' => 'kurikulum'],
            ['name' => 'Formulir', 'slug' => 'formulir'],
            ['name' => 'Buku Panduan', 'slug' => 'buku-panduan'],
        ];
        foreach ($downloadCats as &$dc) { $dc['created_at'] = $now; $dc['updated_at'] = $now; }
        $this->db->table('download_categories')->insertBatch($downloadCats);

        $downloads = [
            ['title' => 'Kalender Pendidikan 2024/2025', 'description' => 'Kalender pendidikan resmi', 'file' => null, 'category_id' => 1, 'file_size' => '2.4 MB', 'downloads' => 320],
            ['title' => 'Formulir Pendaftaran PPDB', 'description' => 'Formulir pendaftaran PPDB', 'file' => null, 'category_id' => 2, 'file_size' => '1.1 MB', 'downloads' => 580],
            ['title' => 'Buku Panduan Prakerin', 'description' => 'Panduan praktik kerja industri', 'file' => null, 'category_id' => 3, 'file_size' => '5.2 MB', 'downloads' => 145],
            ['title' => 'Struktur Kurikulum Merdeka', 'description' => 'Struktur kurikulum terbaru', 'file' => null, 'category_id' => 1, 'file_size' => '3.8 MB', 'downloads' => 210],
            ['title' => 'Formulir Izin Orang Tua', 'description' => 'Formulir izin kegiatan', 'file' => null, 'category_id' => 2, 'file_size' => '0.5 MB', 'downloads' => 450],
        ];
        foreach ($downloads as &$d) { $d['created_at'] = $now; $d['updated_at'] = $now; }
        $this->db->table('downloads')->insertBatch($downloads);

        // ========== PPDB ==========
        $this->db->table('ppdb_settings')->insert([
            'tahun_ajaran' => date('Y').'/'.(date('Y')+1),
            'is_open' => 1,
            'tanggal_buka' => date('Y-m-d', strtotime('-30 days')),
            'tanggal_tutup' => date('Y-m-d', strtotime('+60 days')),
            'biaya_pendaftaran' => 250000,
            'kontak_info' => 'Hubungi panitia PPDB di (021) 12345678 atau WA 6281234567890',
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $jurusanList = $this->db->table('jurusans')->get()->getResult();
        $regStatus = ['pending', 'diterima', 'ditolak', 'cadangan'];
        $sampleReg = [];
        for ($i = 1; $i <= 25; $i++) {
            $sampleReg[] = [
                'ppdb_setting_id' => 1,
                'no_registrasi' => 'PPDB-'.date('Ymd').'-'.strtoupper(substr(bin2hex(random_bytes(3)), 0, 6)),
                'nama' => 'Calon Siswa '.$i,
                'nik' => '3201'.str_pad(rand(1,999999999999), 12, '0', STR_PAD_LEFT),
                'tempat_lahir' => ['Jakarta','Bandung','Surabaya','Semarang','Medan'][array_rand(['Jakarta','Bandung','Surabaya','Semarang','Medan'])],
                'tanggal_lahir' => date('Y-m-d', strtotime('-'.(15+rand(0,3)).' years')),
                'jk' => $i % 2 == 0 ? 'L' : 'P',
                'alamat' => 'Jl. Contoh No. '.$i.', Kota '. ['Jakarta','Bandung','Surabaya'][$i%3],
                'telepon' => '08'.str_pad(rand(1,9999999999), 10, '0', STR_PAD_LEFT),
                'asal_sekolah' => 'SMP Negeri '.rand(1,50).' '.['Jakarta','Bandung','Surabaya'][$i%3],
                'jurusan_id' => $jurusanList[array_rand($jurusanList)]->id,
                'status' => $regStatus[array_rand($regStatus)],
                'created_at' => date('Y-m-d H:i:s', strtotime('-'.rand(1,30).' days')),
                'updated_at' => $now,
            ];
        }
        $this->db->table('ppdb_registrations')->insertBatch($sampleReg);

        echo "Demo data berhasil di-generate!\n";
        echo "- " . count($posts) . " postingan\n";
        echo "- " . count($categories) . " kategori\n";
        echo "- " . count($guru) . " guru\n";
        echo "- " . count($jurusans) . " jurusan\n";
        echo "- " . count($fasilitas) . " fasilitas\n";
        echo "- " . count($alumni) . " alumni\n";
        echo "- " . count($partners) . " partner\n";
        echo "- " . count($testimoni) . " testimoni\n";
        echo "- " . count($faq) . " FAQ\n";
        echo "- " . count($sliders) . " slider\n";
        echo "- " . count($videos) . " video\n";
        echo "- " . count($downloads) . " download\n";
        echo "- 25 pendaftar PPDB\n";
    }
}
