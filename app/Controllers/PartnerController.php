<?php

namespace App\Controllers;

use App\Models\PartnerModel;

class PartnerController extends GuruController
{
    public function __construct()
    {
        $this->model = model(PartnerModel::class);
        $this->folder = 'partners';
        $this->viewIndex = 'admin/partners/index';
        $this->imageField = 'logo';
        $this->orderBy = 'sort_order ASC';
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['logo'] = $this->uploadFile('logo', 'partners');
        if (!$this->model->insert($data)) return redirect()->back()->withInput()->with('errors', $this->model->errors());
        return redirect()->back()->with('success', 'Partner berhasil ditambahkan.');
    }

    public function update($id)
    {
        $old = $this->model->find($id);
        $data = $this->request->getPost();
        $data['logo'] = $this->uploadFile('logo', 'partners', $old->logo ?? null);
        if (!$this->model->update($id, $data)) return redirect()->back()->withInput()->with('errors', $this->model->errors());
        return redirect()->back()->with('success', 'Partner berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item && $item->logo) $this->deleteFile($item->logo, 'partners');
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Partner berhasil dihapus.');
    }
}
