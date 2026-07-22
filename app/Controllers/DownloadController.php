<?php

namespace App\Controllers;

use App\Models\DownloadModel;

class DownloadController extends GuruController
{
    public function __construct()
    {
        $this->model = model(DownloadModel::class);
        $this->folder = 'downloads';
        $this->viewIndex = 'admin/downloads/index';
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Download';
        $data['items'] = $this->model->orderBy($this->orderBy)->findAll();
        $data['categories'] = $this->db->table('download_categories')->orderBy('name', 'ASC')->get()->getResult();
        return view($this->viewIndex, $data);
    }
}
