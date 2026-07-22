<?php

namespace App\Controllers;

use App\Models\FasilitasModel;

class FasilitasController extends GuruController
{
    public function __construct()
    {
        $this->model = model(FasilitasModel::class);
        $this->folder = 'fasilitas';
        $this->viewIndex = 'admin/fasilitas/index';
    }
}
