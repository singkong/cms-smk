<?php

namespace App\Controllers;

use App\Models\GuruModel;

class GuruController extends BaseController
{
    protected $model;
    protected $folder = 'guru';
    protected $viewIndex = 'admin/guru/index';
    protected $orderBy = 'id DESC';

    public function __construct()
    {
        $this->model = model(GuruModel::class);
        $this->orderBy = 'sort_order ASC';
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Guru & Staff';
        $data['items'] = $this->model->orderBy($this->orderBy)->findAll();
        return view($this->viewIndex, $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['foto'] = $this->uploadFile('foto', 'guru');
        if (!$this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $old = $this->model->find($id);
        $data['foto'] = $this->uploadFile('foto', 'guru', $old->foto ?? null);
        if (!$this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item && $item->foto) $this->deleteFile($item->foto, 'guru');
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    protected function uploadFile(string $field, string $folder, ?string $old = null): ?string
    {
        $file = $this->request->getFile($field);
        if (!$file || !$file->isValid() || $file->hasMoved()) return $old;
        if ($old) $this->deleteFile($old, $folder);
        $name = $file->getRandomName();
        $file->move(FCPATH . "uploads/{$folder}", $name);
        return $name;
    }

    protected function deleteFile(?string $file, string $folder): void
    {
        if ($file && file_exists($path = FCPATH . "uploads/{$folder}/{$file}")) unlink($path);
    }
}
