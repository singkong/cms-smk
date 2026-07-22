<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Kategori';
        $data['categories'] = model(CategoryModel::class)->findAll();
        return view('admin/categories/index', $data);
    }

    public function store()
    {
        $model = model(CategoryModel::class);
        if (!$model->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'type' => $this->request->getPost('type'),
        ])) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = model(CategoryModel::class);
        if (!$model->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'type' => $this->request->getPost('type'),
        ])) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        model(CategoryModel::class)->delete($id);
        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil dihapus.');
    }
}
