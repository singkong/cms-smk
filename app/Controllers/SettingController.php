<?php

namespace App\Controllers;

use App\Models\SettingModel;

class SettingController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Pengaturan';
        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $settingModel = model(SettingModel::class);
        $fields = [
            'nama_sekolah', 'nama_singkat', 'npsn', 'nss', 'status', 'akreditasi',
            'alamat', 'kode_pos', 'telepon', 'fax', 'email', 'website',
            'kepsek', 'nip_kepsek', 'sambutan', 'visi', 'misi', 'sejarah', 'deskripsi',
            'facebook', 'instagram', 'youtube', 'tiktok', 'whatsapp', 'maps',
            'jam_operasional', 'google_analytics', 'google_search_console',
            'meta_description', 'meta_keywords',
            'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption',
            'footer_text',
        ];

        foreach ($fields as $field) {
            $settingModel->setValue($field, $this->request->getPost($field));
        }

        foreach (['logo', 'favicon', 'foto_kepsek'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $old = $settingModel->getByKey($fileField);
                if ($old && file_exists(FCPATH . 'uploads/' . $old)) {
                    unlink(FCPATH . 'uploads/' . $old);
                }
                $name = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $name);
                $settingModel->setValue($fileField, $name);
            }
        }

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
