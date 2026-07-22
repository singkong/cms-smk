<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoryModel;

class PostController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Postingan';
        $data['posts'] = model(PostModel::class)
            ->select('posts.*, users.full_name AS author, categories.name AS category_name')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->orderBy('posts.created_at', 'DESC')->findAll();

        return view('admin/posts/index', $data);
    }

    public function create()
    {
        $data = $this->data;
        $data['title'] = 'Tambah Postingan';
        $data['categories'] = model(CategoryModel::class)->findAll();
        return view('admin/posts/form', $data);
    }

    public function store()
    {
        $postModel = model(PostModel::class);
        $image = $this->uploadImage('image', 'posts');
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'image' => $image,
            'category_id' => $this->request->getPost('category_id') ?: null,
            'user_id' => session()->get('id'),
            'type' => $this->request->getPost('type'),
            'status' => $this->request->getPost('status'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'is_headline' => $this->request->getPost('is_headline') ? 1 : 0,
            'published_at' => $this->request->getPost('status') === 'published' ? date('Y-m-d H:i:s') : null,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
        ];

        if (!$postModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $postModel->errors());
        }

        return redirect()->to('/admin/posts')->with('success', 'Postingan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->data;
        $data['post'] = model(PostModel::class)->find($id);
        if (!$data['post']) return redirect()->to('/admin/posts')->with('error', 'Postingan tidak ditemukan.');
        $data['title'] = 'Edit Postingan';
        $data['categories'] = model(CategoryModel::class)->findAll();
        return view('admin/posts/form', $data);
    }

    public function update($id)
    {
        $postModel = model(PostModel::class);
        $post = $postModel->find($id);
        if (!$post) return redirect()->to('/admin/posts')->with('error', 'Postingan tidak ditemukan.');

        $image = $this->uploadImage('image', 'posts', $post->image);

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'image' => $image,
            'category_id' => $this->request->getPost('category_id') ?: null,
            'type' => $this->request->getPost('type'),
            'status' => $this->request->getPost('status'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'is_headline' => $this->request->getPost('is_headline') ? 1 : 0,
            'published_at' => ($this->request->getPost('status') === 'published' && $post->status !== 'published') ? date('Y-m-d H:i:s') : $post->published_at,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
        ];

        if (!$postModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $postModel->errors());
        }

        return redirect()->to('/admin/posts')->with('success', 'Postingan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $post = model(PostModel::class)->find($id);
        if ($post && $post->image) {
            $this->deleteFile($post->image, 'posts');
        }
        model(PostModel::class)->delete($id);
        return redirect()->to('/admin/posts')->with('success', 'Postingan berhasil dihapus.');
    }

    protected function uploadImage(string $field, string $folder, ?string $old = null): ?string
    {
        $file = $this->request->getFile($field);
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return $old;
        }
        if ($old) $this->deleteFile($old, $folder);
        $name = $file->getRandomName();
        $file->move(FCPATH . "uploads/{$folder}", $name);
        return $name;
    }

    protected function deleteFile(?string $file, string $folder): void
    {
        if ($file && file_exists($path = FCPATH . "uploads/{$folder}/{$file}")) {
            unlink($path);
        }
    }
}
