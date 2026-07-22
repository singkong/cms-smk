<?php

namespace App\Controllers;

use App\Models\DownloadModel;

class DownloadController extends GuruController
{
    public function __construct()
    {
        $this->model = model(DownloadModel::class);
        $this->folder = 'downloads';
        $this->viewIndex = 'admin/downloads/index';
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Download';
        $data['items'] = $this->model->orderBy($this->orderBy)->findAll();
        $data['categories'] = $this->db->table('download_categories')->orderBy('name', 'ASC')->get()->getResult();
        return view($this->viewIndex, $data);
    }

    public function store()
    {
        $file = $this->request->getFile('file');
        $fileName = null;
        $fileSize = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $fileSize = $this->formatBytes($file->getSize());
            $file->move(FCPATH . 'uploads/downloads', $fileName);
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'file'        => $fileName,
            'file_size'   => $fileSize,
            'category_id' => $this->request->getPost('category_id') ?: null,
            'downloads'   => 0,
        ];

        if (!$this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->back()->with('success', 'File berhasil diupload.');
    }

    public function update($id)
    {
        $old = $this->model->find($id);
        if (!$old) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $file = $this->request->getFile('file');
        $fileName = $old->file;
        $fileSize = $old->file_size;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($fileName && file_exists(FCPATH . 'uploads/downloads/' . $fileName)) {
                unlink(FCPATH . 'uploads/downloads/' . $fileName);
            }
            $fileName = $file->getRandomName();
            $fileSize = $this->formatBytes($file->getSize());
            $file->move(FCPATH . 'uploads/downloads', $fileName);
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'file'        => $fileName,
            'file_size'   => $fileSize,
            'category_id' => $this->request->getPost('category_id') ?: null,
        ];

        if (!$this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->back()->with('success', 'File berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item && $item->file && file_exists(FCPATH . 'uploads/downloads/' . $item->file)) {
            unlink(FCPATH . 'uploads/downloads/' . $item->file);
        }
        $this->model->delete($id);
        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }

    private function formatBytes($bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
