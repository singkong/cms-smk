<?php

namespace App\Controllers;

class TagController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Manajemen Tag';

        $data['tags'] = $this->db->table('tags')
            ->select('tags.*')
            ->orderBy('tags.name', 'ASC')
            ->get()->getResult();

        foreach ($data['tags'] as $tag) {
            $tag->post_count = $this->db->table('post_tags')
                ->where('tag_id', $tag->id)
                ->countAllResults();
        }

        return view('admin/tags/index', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $slug = mb_url_title($name, '-', true);

        $exists = $this->db->table('tags')->where('slug', $slug)->get()->getRow();
        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Tag dengan nama tersebut sudah ada.');
        }

        $this->db->table('tags')->insert([
            'name'       => $name,
            'slug'       => $slug,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'Tags',
            'action'      => 'create',
            'description' => 'Membuat tag: ' . $name,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/tags')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function update($id)
    {
        $tag = $this->db->table('tags')->where('id', $id)->get()->getRow();
        if (!$tag) {
            return redirect()->to('/admin/tags')->with('error', 'Tag tidak ditemukan.');
        }

        $name = $this->request->getPost('name');
        $slug = mb_url_title($name, '-', true);

        $exists = $this->db->table('tags')->where('slug', $slug)->where('id !=', $id)->get()->getRow();
        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Tag dengan nama tersebut sudah ada.');
        }

        $this->db->table('tags')->where('id', $id)->update([
            'name' => $name,
            'slug' => $slug,
        ]);

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'Tags',
            'action'      => 'update',
            'description' => 'Memperbarui tag: ' . $name,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/tags')->with('success', 'Tag berhasil diperbarui.');
    }

    public function delete($id)
    {
        $tag = $this->db->table('tags')->where('id', $id)->get()->getRow();
        if ($tag) {
            $this->db->table('post_tags')->where('tag_id', $id)->delete();
            $this->db->table('tags')->where('id', $id)->delete();

            $this->db->table('activity_logs')->insert([
                'user_id'     => session()->get('id'),
                'username'    => session()->get('username'),
                'module'      => 'Tags',
                'action'      => 'delete',
                'description' => 'Menghapus tag: ' . $tag->name,
                'ip_address'  => $this->request->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/admin/tags')->with('success', 'Tag berhasil dihapus.');
    }
}
