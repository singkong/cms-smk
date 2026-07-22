<?php

namespace App\Controllers;

use App\Models\ContactModel;

class ContactController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Pesan Masuk';
        $data['messages'] = model(ContactModel::class)->orderBy('created_at', 'DESC')->findAll();
        return view('admin/contacts/index', $data);
    }

    public function show($id)
    {
        $contactModel = model(ContactModel::class);
        $data = $this->data;
        $data['message'] = $contactModel->find($id);
        if (!$data['message']) {
            return redirect()->to('/admin/contacts')->with('error', 'Pesan tidak ditemukan.');
        }
        if (!$data['message']->is_read) {
            $contactModel->update($id, ['is_read' => 1]);
        }
        $data['title'] = 'Detail Pesan';
        return view('admin/contacts/show', $data);
    }

    public function delete($id)
    {
        model(ContactModel::class)->delete($id);
        return redirect()->to('/admin/contacts')->with('success', 'Pesan berhasil dihapus.');
    }
}
