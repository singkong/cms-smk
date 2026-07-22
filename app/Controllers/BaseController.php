<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SettingModel;

class BaseController extends Controller
{
    protected $helpers = ['frontend', 'text'];
    protected $setting;
    protected $db;
    protected $pager;
    protected $data = [];

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->db = \Config\Database::connect();
        $this->pager = \Config\Services::pager();
        $this->setting = model(SettingModel::class)->getAll();
        $this->data['setting'] = $this->setting;
        $this->data['current_uri'] = $request->getUri()->getPath();
    }

    /**
     * Paginate Query Builder results.
     * @return object { data: array, pager: string }
     */
    protected function paginateBuilder($builder, int $perPage = 12, string $group = 'default'): object
    {
        $total = $builder->countAllResults(false);
        $page  = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $data = $builder->get($perPage, $offset)->getResult();

        $pagerLinks = $this->pager->makeLinks($page, $perPage, $total, 'default_full', 0, $group);

        return (object) ['data' => $data, 'pager' => $pagerLinks];
    }
}
