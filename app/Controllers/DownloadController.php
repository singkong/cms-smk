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
}
