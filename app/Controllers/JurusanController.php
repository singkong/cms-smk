<?php

namespace App\Controllers;

use App\Models\JurusanModel;

class JurusanController extends GuruController
{
    public function __construct()
    {
        $this->model = model(JurusanModel::class);
        $this->folder = 'jurusan';
        $this->viewIndex = 'admin/jurusan/index';
        $this->field = 'gambar';
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['gambar'] = $this->uploadFile('gambar', 'jurusan');
        if (!$this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $old = $this->model->find($id);
        $data['gambar'] = $this->uploadFile('gambar', 'jurusan', $old->gambar ?? null);
        if (!$this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item && $item->gambar) $this->deleteFile($item->gambar, 'jurusan');
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
