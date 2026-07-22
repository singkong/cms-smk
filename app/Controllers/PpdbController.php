<?php

namespace App\Controllers;

class PpdbController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Pengaturan PPDB';

        $data['ppdb_setting'] = $this->db->table('ppdb_settings')
            ->orderBy('id', 'DESC')
            ->get()->getRow();

        $data['jurusan_list'] = $this->db->table('jurusans')
            ->orderBy('nama', 'ASC')
            ->get()->getResult();

        if ($data['ppdb_setting']) {
            $builder = $this->db->table('ppdb_registrations')
                ->select('ppdb_registrations.*, jurusans.nama AS jurusan_name')
                ->join('jurusans', 'jurusans.id = ppdb_registrations.jurusan_id', 'left')
                ->where('ppdb_registrations.ppdb_setting_id', $data['ppdb_setting']->id)
                ->orderBy('ppdb_registrations.created_at', 'DESC');

            $result = $this->paginateBuilder($builder, 15, 'ppdb');
            $data['registrations'] = $result->data;
            $data['pager'] = $result->pager;

            $data['status_counts'] = [
                'pending'  => $this->db->table('ppdb_registrations')->where('ppdb_setting_id', $data['ppdb_setting']->id)->where('status', 'pending')->countAllResults(),
                'diterima' => $this->db->table('ppdb_registrations')->where('ppdb_setting_id', $data['ppdb_setting']->id)->where('status', 'diterima')->countAllResults(),
                'ditolak'  => $this->db->table('ppdb_registrations')->where('ppdb_setting_id', $data['ppdb_setting']->id)->where('status', 'ditolak')->countAllResults(),
                'cadangan' => $this->db->table('ppdb_registrations')->where('ppdb_setting_id', $data['ppdb_setting']->id)->where('status', 'cadangan')->countAllResults(),
            ];
        }

        return view('admin/ppdb/index', $data);
    }

    public function updateSettings()
    {
        $settingId = $this->request->getPost('id');

        $ppdbData = [
            'tahun_ajaran'       => $this->request->getPost('tahun_ajaran'),
            'is_open'            => $this->request->getPost('is_open') ? 1 : 0,
            'tanggal_buka'       => $this->request->getPost('tanggal_buka'),
            'tanggal_tutup'      => $this->request->getPost('tanggal_tutup'),
            'biaya_pendaftaran'  => $this->request->getPost('biaya_pendaftaran'),
            'kontak_info'        => $this->request->getPost('kontak_info'),
        ];

        if ($settingId) {
            $ppdbData['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('ppdb_settings')->where('id', $settingId)->update($ppdbData);
        } else {
            $ppdbData['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('ppdb_settings')->insert($ppdbData);
        }

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'PPDB',
            'action'      => 'update_settings',
            'description' => 'Memperbarui pengaturan PPDB',
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/ppdb')->with('success', 'Pengaturan PPDB berhasil diperbarui.');
    }

    public function registrations()
    {
        $data = $this->data;
        $data['title'] = 'Data Pendaftar PPDB';

        $builder = $this->db->table('ppdb_registrations')
            ->select('ppdb_registrations.*, jurusans.nama AS jurusan_name, ppdb_settings.tahun_ajaran')
            ->join('jurusans', 'jurusans.id = ppdb_registrations.jurusan_id', 'left')
            ->join('ppdb_settings', 'ppdb_settings.id = ppdb_registrations.ppdb_setting_id', 'left')
            ->orderBy('ppdb_registrations.created_at', 'DESC');

        $statusFilter = $this->request->getGet('status');
        if ($statusFilter) {
            $builder->where('ppdb_registrations.status', $statusFilter);
        }

        $jurusanFilter = $this->request->getGet('jurusan_id');
        if ($jurusanFilter) {
            $builder->where('ppdb_registrations.jurusan_id', $jurusanFilter);
        }

        $searchFilter = $this->request->getGet('search');
        if ($searchFilter) {
            $builder->groupStart()
                ->like('ppdb_registrations.nama', $searchFilter)
                ->orLike('ppdb_registrations.no_registrasi', $searchFilter)
                ->orLike('ppdb_registrations.asal_sekolah', $searchFilter)
                ->groupEnd();
        }

        $result = $this->paginateBuilder($builder, 25, 'registrasi');
        $data['registrations'] = $result->data;
        $data['pager'] = $result->pager;

        $data['jurusan_list'] = $this->db->table('jurusans')
            ->orderBy('nama', 'ASC')
            ->get()->getResult();

        $data['filters'] = [
            'status'     => $statusFilter,
            'jurusan_id' => $jurusanFilter,
            'search'     => $searchFilter,
        ];

        $data['status_counts'] = [
            'pending'  => $this->db->table('ppdb_registrations')->where('status', 'pending')->countAllResults(),
            'diterima' => $this->db->table('ppdb_registrations')->where('status', 'diterima')->countAllResults(),
            'ditolak'  => $this->db->table('ppdb_registrations')->where('status', 'ditolak')->countAllResults(),
            'cadangan' => $this->db->table('ppdb_registrations')->where('status', 'cadangan')->countAllResults(),
        ];

        return view('admin/ppdb/registrations', $data);
    }

    public function updateRegistration($id)
    {
        $registration = $this->db->table('ppdb_registrations')->where('id', $id)->get()->getRow();
        if (!$registration) {
            return redirect()->to('/admin/ppdb/registrations')->with('error', 'Data pendaftar tidak ditemukan.');
        }

        $newStatus = $this->request->getPost('status');
        $allowedStatuses = ['pending', 'diterima', 'ditolak', 'cadangan'];

        if (!in_array($newStatus, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $this->db->table('ppdb_registrations')->where('id', $id)->update([
            'status'     => $newStatus,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'PPDB',
            'action'      => 'update_status',
            'description' => 'Mengubah status pendaftar ' . $registration->nama . ' menjadi ' . $newStatus,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/ppdb/registrations')->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function export()
    {
        $builder = $this->db->table('ppdb_registrations')
            ->select('ppdb_registrations.*, jurusans.nama AS jurusan_name, ppdb_settings.tahun_ajaran')
            ->join('jurusans', 'jurusans.id = ppdb_registrations.jurusan_id', 'left')
            ->join('ppdb_settings', 'ppdb_settings.id = ppdb_registrations.ppdb_setting_id', 'left')
            ->orderBy('ppdb_registrations.created_at', 'DESC');

        $statusFilter = $this->request->getGet('status');
        if ($statusFilter) {
            $builder->where('ppdb_registrations.status', $statusFilter);
        }

        $registrations = $builder->get()->getResult();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="ppdb_registrations_' . date('Y-m-d_His') . '.csv"');

        $output = fopen('php://output', 'w');

        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($output, [
            'No Registrasi', 'Nama', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 'JK',
            'Alamat', 'Telepon', 'Email', 'Asal Sekolah', 'Jurusan',
            'Tahun Ajaran', 'Status', 'Tanggal Daftar'
        ]);

        foreach ($registrations as $row) {
            fputcsv($output, [
                $row->no_registrasi,
                $row->nama,
                $row->nik,
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->jk,
                $row->alamat,
                $row->telepon,
                $row->email,
                $row->asal_sekolah,
                $row->jurusan_name,
                $row->tahun_ajaran,
                $row->status,
                $row->created_at,
            ]);
        }

        fclose($output);

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'PPDB',
            'action'      => 'export',
            'description' => 'Mengekspor data pendaftar PPDB',
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        exit;
    }
}
