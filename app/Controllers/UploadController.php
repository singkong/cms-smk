<?php

namespace App\Controllers;

class UploadController extends BaseController
{
    public function image()
    {
        $file = $this->request->getFile('upload');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['uploaded' => false, 'error' => ['message' => 'Upload gagal']]);
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON(['uploaded' => false, 'error' => ['message' => 'File terlalu besar (max 2MB)']]);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return $this->response->setJSON(['uploaded' => false, 'error' => ['message' => 'Format tidak didukung']]);
        }

        $name = $file->getRandomName();
        $file->move(FCPATH . 'uploads/posts', $name);

        return $this->response->setJSON([
            'uploaded' => true,
            'url'      => base_url('uploads/posts/' . $name),
        ]);
    }
}
