<?php

namespace App\Controllers;

class VisitorController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Statistik Pengunjung';

        $data['total_visitors'] = $this->db->table('visitors')->countAllResults();
        $data['today_visitors'] = $this->db->table('visitors')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();
        $data['week_visitors'] = $this->db->table('visitors')
            ->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
            ->countAllResults();
        $data['month_visitors'] = $this->db->table('visitors')
            ->where('created_at >=', date('Y-m-01'))
            ->countAllResults();

        $data['visitors_per_day'] = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $count = $this->db->table('visitors')
                ->where('DATE(created_at)', $date)
                ->countAllResults();
            $data['visitors_per_day'][date('d M', strtotime($date))] = $count;
        }

        $data['recent_visitors'] = $this->db->table('visitors')
            ->orderBy('created_at', 'DESC')
            ->limit(50)
            ->get()->getResult();

        $data['device_stats'] = $this->db->table('visitors')
            ->select('device, COUNT(*) as count')
            ->groupBy('device')
            ->orderBy('count', 'DESC')
            ->get()->getResult();

        $data['browser_stats'] = $this->db->table('visitors')
            ->select('browser, COUNT(*) as count')
            ->groupBy('browser')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->get()->getResult();

        $data['page_stats'] = $this->db->table('visitors')
            ->select('page, COUNT(*) as count')
            ->where('page IS NOT NULL')
            ->groupBy('page')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->get()->getResult();

        $data['country_stats'] = $this->db->table('visitors')
            ->select('country, COUNT(*) as count')
            ->where('country IS NOT NULL')
            ->groupBy('country')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->get()->getResult();

        return view('admin/visitors/index', $data);
    }
}
