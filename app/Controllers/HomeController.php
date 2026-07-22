<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = $this->setting->nama_sekolah ?? 'SMK Negeri 1 Indonesia';
        $data['jurusans'] = $this->db->table('jurusans')->limit(6)->get()->getResult();
        $data['sliders'] = $this->db->table('sliders')->where('is_active', 1)->orderBy('sort_order', 'ASC')->get()->getResult();
        $data['berita'] = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.status', 'published')->where('posts.type', 'berita')
            ->orderBy('posts.created_at', 'DESC')->limit(6)->get()->getResult();
        $data['partners'] = $this->db->table('partners')->orderBy('sort_order', 'ASC')->get()->getResult();
        $data['testimoni'] = $this->db->table('testimoni')->where('is_active', 1)->limit(6)->get()->getResult();
        $data['pengumuman'] = $this->db->table('posts')->where('type', 'pengumuman')->where('status', 'published')->orderBy('created_at', 'DESC')->limit(5)->get()->getResult();
        $data['galeri_home'] = $this->db->table('gallery')->orderBy('id', 'DESC')->limit(8)->get()->getResult();
        $data['total_guru'] = $this->db->table('guru')->where('is_active', 1)->countAllResults();
        $data['total_alumni'] = $this->db->table('alumni')->countAllResults();
        $data['total_prestasi'] = $this->db->table('posts')->where('type', 'prestasi')->where('status', 'published')->countAllResults();
        return view('frontend/home', $data);
    }

    public function profil()
    {
        $data = $this->data;
        $data['title'] = 'Profil Sekolah';
        $data['kepsek_foto'] = $this->setting->kepsek_foto ?? null;
        $data['kepsek'] = $this->setting->kepsek ?? null;
        $data['sambutan'] = $this->setting->sambutan ?? null;
        return view('frontend/profil', $data);
    }

    public function visiMisi()
    {
        $data = $this->data;
        $data['title'] = 'Visi & Misi';
        return view('frontend/visi-misi', $data);
    }

    public function sejarah()
    {
        $data = $this->data;
        $data['title'] = 'Sejarah Sekolah';
        $data['sejarah'] = $this->setting->sejarah ?? null;
        return view('frontend/sejarah', $data);
    }

    public function struktur()
    {
        $data = $this->data;
        $data['title'] = 'Struktur Organisasi';
        $data['struktur_image'] = $this->setting->struktur_image ?? null;
        $data['struktur_organisasi'] = $this->setting->struktur_organisasi ?? null;
        return view('frontend/struktur', $data);
    }

    public function guruStaff()
    {
        $data = $this->data;
        $data['title'] = 'Guru & Staff';
        $data['guru'] = $this->db->table('guru')->where('is_active', 1)->orderBy('sort_order', 'ASC')->get()->getResult();
        $data['staff'] = $this->db->table('staff')->orderBy('sort_order', 'ASC')->get()->getResult();
        return view('frontend/guru-staff', $data);
    }

    public function jurusan()
    {
        $data = $this->data;
        $data['title'] = 'Kompetensi Keahlian';
        $data['jurusans'] = $this->db->table('jurusans')->orderBy('id', 'ASC')->get()->getResult();
        return view('frontend/jurusan', $data);
    }

    public function jurusanDetail($id = null)
    {
        if (!$id) return redirect()->to('/jurusan');
        $data = $this->data;
        $data['jurusan'] = $this->db->table('jurusans')->where('id', $id)->get()->getRow();
        if (!$data['jurusan']) return redirect()->to('/jurusan');
        $data['title'] = $data['jurusan']->nama;
        return view('frontend/jurusan-detail', $data);
    }

    public function fasilitas()
    {
        $data = $this->data;
        $data['title'] = 'Fasilitas';
        $data['fasilitas'] = $this->db->table('fasilitas')->orderBy('id', 'ASC')->get()->getResult();
        return view('frontend/fasilitas', $data);
    }

    public function berita()
    {
        $data = $this->data;
        $data['title'] = 'Berita';
        $perPage = 9;
        $builder = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author, categories.name AS category_name, categories.slug AS category_slug')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->where('posts.status', 'published')
            ->where('posts.type', 'berita')
            ->orderBy('posts.published_at', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['berita'] = $result->data;
        $data['pager'] = $result->pager;
        $data['categories'] = $this->db->table('categories')->where('type', 'berita')->get()->getResult();
        $data['recent'] = $this->db->table('posts')
            ->select('posts.id, posts.title, posts.slug, posts.image, posts.created_at')
            ->where('status', 'published')->where('type', 'berita')
            ->orderBy('created_at', 'DESC')->limit(5)->get()->getResult();
        return view('frontend/berita', $data);
    }

    public function beritaDetail($slug = null)
    {
        if (!$slug) return redirect()->to('/berita');
        $post = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author, categories.name AS category_name, categories.slug AS category_slug')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->where('posts.slug', $slug)
            ->where('posts.type', 'berita')
            ->where('posts.status', 'published')
            ->get()->getRow();
        if (!$post) return redirect()->to('/berita')->with('error', 'Berita tidak ditemukan.');
        $this->db->table('posts')->where('id', $post->id)->set('views', 'views + 1', false)->update();
        $data = $this->data;
        $data['title'] = $post->title;
        $data['post'] = $post;
        $data['recent'] = $this->db->table('posts')
            ->select('posts.id, posts.title, posts.slug, posts.image, posts.created_at')
            ->where('status', 'published')->where('type', 'berita')
            ->where('id !=', $post->id)
            ->orderBy('created_at', 'DESC')->limit(5)->get()->getResult();
        $data['categories'] = $this->db->table('categories')->where('type', 'berita')->get()->getResult();
        return view('frontend/berita-detail', $data);
    }

    public function pengumuman()
    {
        $data = $this->data;
        $data['title'] = 'Pengumuman';
        $perPage = 10;
        $builder = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.status', 'published')
            ->where('posts.type', 'pengumuman')
            ->orderBy('posts.published_at', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['pengumuman'] = $result->data;
        $data['pager'] = $result->pager;
        return view('frontend/pengumuman', $data);
    }

    public function pengumumanDetail($slug = null)
    {
        if (!$slug) return redirect()->to('/pengumuman');
        $post = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.slug', $slug)
            ->where('posts.type', 'pengumuman')
            ->where('posts.status', 'published')
            ->get()->getRow();
        if (!$post) return redirect()->to('/pengumuman')->with('error', 'Pengumuman tidak ditemukan.');
        $this->db->table('posts')->where('id', $post->id)->set('views', 'views + 1', false)->update();
        $data = $this->data;
        $data['title'] = $post->title;
        $data['post'] = $post;
        $data['recent'] = $this->db->table('posts')
            ->select('id, title, slug, created_at')
            ->where('status', 'published')->where('type', 'pengumuman')
            ->where('id !=', $post->id)
            ->orderBy('created_at', 'DESC')->limit(5)->get()->getResult();
        return view('frontend/pengumuman-detail', $data);
    }

    public function agenda()
    {
        $data = $this->data;
        $data['title'] = 'Agenda';
        $perPage = 10;
        $builder = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.status', 'published')
            ->where('posts.type', 'agenda')
            ->orderBy('posts.published_at', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['agenda'] = $result->data;
        $data['pager'] = $result->pager;
        return view('frontend/agenda', $data);
    }

    public function prestasi()
    {
        $data = $this->data;
        $data['title'] = 'Prestasi';
        $perPage = 9;
        $builder = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.status', 'published')
            ->where('posts.type', 'prestasi')
            ->orderBy('posts.published_at', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['prestasi'] = $result->data;
        $data['pager'] = $result->pager;
        return view('frontend/prestasi', $data);
    }

    public function prestasiDetail($slug = null)
    {
        if (!$slug) return redirect()->to('/prestasi');
        $post = $this->db->table('posts')
            ->select('posts.*, users.full_name AS author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.slug', $slug)
            ->where('posts.type', 'prestasi')
            ->where('posts.status', 'published')
            ->get()->getRow();
        if (!$post) return redirect()->to('/prestasi')->with('error', 'Prestasi tidak ditemukan.');
        $this->db->table('posts')->where('id', $post->id)->set('views', 'views + 1', false)->update();
        $data = $this->data;
        $data['title'] = $post->title;
        $data['post'] = $post;
        $data['recent'] = $this->db->table('posts')
            ->select('id, title, slug, image, created_at')
            ->where('status', 'published')->where('type', 'prestasi')
            ->where('id !=', $post->id)
            ->orderBy('created_at', 'DESC')->limit(5)->get()->getResult();
        return view('frontend/prestasi-detail', $data);
    }

    public function galeri()
    {
        $data = $this->data;
        $data['title'] = 'Galeri Foto';
        $albumId = $this->request->getGet('album');
        $builder = $this->db->table('gallery')->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC');
        if ($albumId) {
            $builder->where('album_id', $albumId);
        }
        $perPage = 12;
        $result = $this->paginateBuilder($builder, $perPage);
        $data['photos'] = $result->data;
        $data['pager'] = $result->pager;
        $data['albums'] = $this->db->table('albums')->orderBy('name', 'ASC')->get()->getResult();
        $data['current_album'] = $albumId;
        return view('frontend/galeri', $data);
    }

    public function galeriVideo()
    {
        $data = $this->data;
        $data['title'] = 'Galeri Video';
        $perPage = 9;
        $builder = $this->db->table('videos')->orderBy('id', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['videos'] = $result->data;
        $data['pager'] = $result->pager;
        return view('frontend/galeri-video', $data);
    }

    public function download()
    {
        $data = $this->data;
        $data['title'] = 'Download';
        $perPage = 15;
        $builder = $this->db->table('downloads')
            ->select('downloads.*, categories.name AS category_name')
            ->join('categories', 'categories.id = downloads.category_id', 'left')
            ->orderBy('downloads.id', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['downloads'] = $result->data;
        $data['pager'] = $result->pager;
        $data['categories'] = $this->db->table('categories')->where('type', 'download')->get()->getResult();
        return view('frontend/download', $data);
    }

    public function downloadFile($id = null)
    {
        if (!$id) return redirect()->to('/download');
        $file = $this->db->table('downloads')->where('id', $id)->get()->getRow();
        if (!$file) return redirect()->to('/download');
        $this->db->table('downloads')->where('id', $id)->set('downloads', 'downloads + 1', false)->update();
        return redirect()->to($file->file);
    }

    public function downloadDetail($id = null)
    {
        if (!$id) return redirect()->to('/download');
        $file = $this->db->table('downloads')->where('id', $id)->get()->getRow();
        if (!$file) return redirect()->to('/download');
        $this->db->table('downloads')->where('id', $id)->set('downloads', 'downloads + 1', false)->update();
        $filePath = FCPATH . ltrim($file->file, '/');
        if (is_file($filePath)) {
            return $this->response->download($filePath, null);
        }
        return redirect()->to($file->file);
    }

    public function alumni()
    {
        $data = $this->data;
        $data['title'] = 'Alumni';
        $perPage = 12;
        $builder = $this->db->table('alumni')->orderBy('angkatan', 'DESC')->orderBy('id', 'DESC');
        $result = $this->paginateBuilder($builder, $perPage);
        $data['alumni'] = $result->data;
        $data['pager'] = $result->pager;
        return view('frontend/alumni', $data);
    }

    public function kontak()
    {
        $data = $this->data;
        $data['title'] = 'Kontak Kami';
        return view('frontend/kontak', $data);
    }

    public function sendContact()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('contacts')->insert($data);
        return redirect()->to('/kontak')->with('success', 'Pesan Anda telah terkirim.');
    }

    public function faq()
    {
        $data = $this->data;
        $data['title'] = 'FAQ';
        $data['faqs'] = $this->db->table('faq')->orderBy('sort_order', 'ASC')->get()->getResult();
        return view('frontend/faq', $data);
    }

    public function ppdb()
    {
        $data = $this->data;
        $data['title'] = 'PPDB';
        $data['ppdb'] = $this->db->table('ppdb_settings')->get()->getRow();
        $data['jurusans'] = $this->db->table('jurusans')->orderBy('nama', 'ASC')->get()->getResult();

        if ($data['ppdb']) {
            $settingId = $data['ppdb']->id;
            $data['total_pendaftar'] = $this->db->table('ppdb_registrations')
                ->where('ppdb_setting_id', $settingId)->countAllResults();
        }

        return view('frontend/ppdb', $data);
    }

    public function ppdbRegister()
    {
        $ppdb = $this->db->table('ppdb_settings')->orderBy('id', 'DESC')->get()->getRow();

        if (!$ppdb || !$ppdb->is_open) {
            return redirect()->to('/ppdb')->with('error', 'Pendaftaran PPDB belum dibuka.');
        }

        if ($ppdb->tanggal_tutup && date('Y-m-d') > $ppdb->tanggal_tutup) {
            return redirect()->to('/ppdb')->with('error', 'Pendaftaran PPDB sudah ditutup.');
        }

        $rules = [
            'nama'           => 'required|min_length[3]',
            'nik'            => 'permit_empty|min_length[16]|max_length[20]',
            'tempat_lahir'   => 'permit_empty',
            'tanggal_lahir'  => 'permit_empty',
            'alamat'         => 'required',
            'telepon'        => 'required',
            'asal_sekolah'   => 'required',
            'jurusan_id'     => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noReg = 'PPDB-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

        $this->db->table('ppdb_registrations')->insert([
            'ppdb_setting_id' => $ppdb->id,
            'no_registrasi'   => $noReg,
            'nama'            => $this->request->getPost('nama'),
            'nik'             => $this->request->getPost('nik'),
            'tempat_lahir'    => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
            'jk'              => $this->request->getPost('jk'),
            'alamat'          => $this->request->getPost('alamat'),
            'telepon'         => $this->request->getPost('telepon'),
            'email'           => $this->request->getPost('email'),
            'asal_sekolah'    => $this->request->getPost('asal_sekolah'),
            'jurusan_id'      => $this->request->getPost('jurusan_id'),
            'status'          => 'pending',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/ppdb?registered=1&no=' . $noReg)->with('success',
            'Pendaftaran berhasil! Nomor registrasi Anda: <strong>' . $noReg . '</strong>. Harap simpan nomor ini untuk keperluan selanjutnya.');
    }

    public function sitemap()
    {
        $data = $this->data;
        $data['posts'] = $this->db->table('posts')
            ->select('slug, type, updated_at')
            ->where('status', 'published')
            ->orderBy('updated_at', 'DESC')
            ->get()->getResult();
        $data['jurusans'] = $this->db->table('jurusans')
            ->select('id, nama, updated_at')
            ->orderBy('id', 'ASC')
            ->get()->getResult();
        $this->response->setHeader('Content-Type', 'application/xml; charset=utf-8');
        return view('frontend/sitemap', $data);
    }

    public function search()
    {
        $data = $this->data;
        $q = $this->request->getGet('q');
        $data['title'] = 'Pencarian';
        $data['query'] = $q;
        $data['results'] = [];
        $data['pager'] = null;
        if ($q && strlen(trim($q)) > 0) {
            $keyword = $q;
            $perPage = 10;
            $searchBuilder = $this->db->table('posts')
                ->select('posts.*, users.full_name AS author, categories.name AS category_name')
                ->join('users', 'users.id = posts.user_id')
                ->join('categories', 'categories.id = posts.category_id', 'left')
                ->groupStart()
                ->like('posts.title', $keyword)
                ->orLike('posts.content', $keyword)
                ->orLike('posts.excerpt', $keyword)
                ->groupEnd()
                ->where('posts.status', 'published')
                ->orderBy('posts.published_at', 'DESC');
            $searchResult = $this->paginateBuilder($searchBuilder, $perPage);
            $data['results'] = $searchResult->data;
            $data['pager'] = $searchResult->pager;
            $data['pager'] = $this->db->table('posts')->pager;
        }
        return view('frontend/search', $data);
    }
}
