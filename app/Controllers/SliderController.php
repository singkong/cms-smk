<?php

namespace App\Controllers;

use App\Models\SliderModel;

class SliderController extends GuruController
{
    public function __construct()
    {
        $this->model = model(SliderModel::class);
        $this->folder = 'sliders';
        $this->viewIndex = 'admin/sliders/index';
        $this->orderBy = 'sort_order ASC';
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['image'] = $this->uploadFile('image', 'sliders');
        if (!$this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Slider berhasil ditambahkan.');
    }

    public function update($id)
    {
        $old = $this->model->find($id);
        $data = $this->request->getPost();
        $data['image'] = $this->uploadFile('image', 'sliders', $old->image ?? null);
        if (!$this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
        return redirect()->back()->with('success', 'Slider berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item && $item->image) $this->deleteFile($item->image, 'sliders');
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Slider berhasil dihapus.');
    }
}
