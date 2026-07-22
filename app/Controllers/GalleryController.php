<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\AlbumModel;

class GalleryController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Galeri Foto';
        $data['galleries'] = model(GalleryModel::class)->orderBy('created_at', 'DESC')->findAll(50);
        $data['albums'] = model(AlbumModel::class)->where('type', 'photo')->findAll();
        return view('admin/gallery/index', $data);
    }

    public function store()
    {
        $img = $this->uploadFile('image', 'gallery');
        $data = ['album_id' => $this->request->getPost('album_id'), 'title' => $this->request->getPost('title'), 'description' => $this->request->getPost('description'), 'image' => $img];
        if (!$img || !model(GalleryModel::class)->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal upload.');
        }
        return redirect()->back()->with('success', 'Foto berhasil diupload.');
    }

    public function update($id)
    {
        $old = model(GalleryModel::class)->find($id);
        $img = $this->uploadFile('image', 'gallery', $old->image ?? null);
        model(GalleryModel::class)->update($id, ['album_id' => $this->request->getPost('album_id'), 'title' => $this->request->getPost('title'), 'description' => $this->request->getPost('description'), 'image' => $img]);
        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = model(GalleryModel::class)->find($id);
        if ($item && $item->image) { $path = FCPATH . 'uploads/gallery/' . $item->image; if (file_exists($path)) unlink($path); }
        model(GalleryModel::class)->delete($id);
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function albums()
    {
        $data = $this->data;
        $data['title'] = 'Album';
        $data['albums'] = model(AlbumModel::class)->findAll();
        return view('admin/gallery/albums', $data);
    }

    public function storeAlbum()
    {
        if (!model(AlbumModel::class)->insert($this->request->getPost())) {
            return redirect()->back()->with('errors', model(AlbumModel::class)->errors());
        }
        return redirect()->back()->with('success', 'Album berhasil ditambahkan.');
    }

    protected function uploadFile(string $field, string $folder, ?string $old = null): ?string
    {
        $file = $this->request->getFile($field);
        if (!$file || !$file->isValid() || $file->hasMoved()) return $old;
        if ($old) { $p = FCPATH . "uploads/{$folder}/{$old}"; if (file_exists($p)) unlink($p); }
        $name = $file->getRandomName();
        $file->move(FCPATH . "uploads/{$folder}", $name);
        return $name;
    }
}
