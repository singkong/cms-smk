<?php

namespace App\Controllers;

class LogController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Log Aktivitas';

        $builder = $this->db->table('activity_logs')
            ->orderBy('created_at', 'DESC');

        $userFilter = $this->request->getGet('user');
        if ($userFilter) {
            $builder->like('username', $userFilter);
        }

        $moduleFilter = $this->request->getGet('module');
        if ($moduleFilter) {
            $builder->where('module', $moduleFilter);
        }

        $dateFrom = $this->request->getGet('date_from');
        if ($dateFrom) {
            $builder->where('DATE(created_at) >=', $dateFrom);
        }

        $dateTo = $this->request->getGet('date_to');
        if ($dateTo) {
            $builder->where('DATE(created_at) <=', $dateTo);
        }

        $result = $this->paginateBuilder($builder, 25, 'activity');
        $data['logs'] = $result->data;
        $data['pager'] = $result->pager;

        $data['modules'] = $this->db->table('activity_logs')
            ->select('module')
            ->distinct()
            ->orderBy('module', 'ASC')
            ->get()->getResult();

        $data['filters'] = [
            'user'      => $userFilter,
            'module'    => $moduleFilter,
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
        ];

        return view('admin/logs/index', $data);
    }

    public function loginLogs()
    {
        $data = $this->data;
        $data['title'] = 'Log Login';

        $builder = $this->db->table('login_logs')
            ->orderBy('created_at', 'DESC');

        $userFilter = $this->request->getGet('user');
        if ($userFilter) {
            $builder->like('username', $userFilter);
        }

        $statusFilter = $this->request->getGet('status');
        if ($statusFilter) {
            $builder->where('status', $statusFilter);
        }

        $dateFrom = $this->request->getGet('date_from');
        if ($dateFrom) {
            $builder->where('DATE(created_at) >=', $dateFrom);
        }

        $dateTo = $this->request->getGet('date_to');
        if ($dateTo) {
            $builder->where('DATE(created_at) <=', $dateTo);
        }

        $result = $this->paginateBuilder($builder, 25, 'login');
        $data['logs'] = $result->data;
        $data['pager'] = $result->pager;

        $data['filters'] = [
            'user'      => $userFilter,
            'status'    => $statusFilter,
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
        ];

        $data['success_count'] = $this->db->table('login_logs')->where('status', 'success')->countAllResults();
        $data['failed_count'] = $this->db->table('login_logs')->where('status', 'failed')->countAllResults();

        return view('admin/logs/login', $data);
    }
}
