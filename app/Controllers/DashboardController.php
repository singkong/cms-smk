<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Dashboard';

        $data['total_posts']     = model(PostModel::class)->countAllResults();
        $data['total_published'] = model(PostModel::class)->where('status', 'published')->countAllResults();
        $data['total_users']     = model(UserModel::class)->countAllResults();
        $data['total_visitors']  = $this->db->table('visitors')->countAllResults();
        $data['today_visitors']  = $this->db->table('visitors')->where('DATE(created_at)', date('Y-m-d'))->countAllResults();
        $data['unread_messages'] = $this->db->table('contacts')->where('is_read', 0)->countAllResults();
        $data['recent_posts']    = model(PostModel::class)->orderBy('created_at', 'DESC')->findAll(5);
        $data['recent_logins']   = $this->db->table('login_logs')->orderBy('created_at', 'DESC')->limit(10)->get()->getResult();

        $data['post_types_chart'] = [
            'berita'     => model(PostModel::class)->where('type', 'berita')->countAllResults(),
            'pengumuman' => model(PostModel::class)->where('type', 'pengumuman')->countAllResults(),
            'agenda'     => model(PostModel::class)->where('type', 'agenda')->countAllResults(),
            'prestasi'   => model(PostModel::class)->where('type', 'prestasi')->countAllResults(),
            'halaman'    => model(PostModel::class)->where('type', 'halaman')->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}
