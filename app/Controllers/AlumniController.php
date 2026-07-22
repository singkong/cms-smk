<?php

namespace App\Controllers;

use App\Models\AlumniModel;

class AlumniController extends GuruController
{
    public function __construct()
    {
        $this->model = model(AlumniModel::class);
        $this->folder = 'alumni';
        $this->viewIndex = 'admin/alumni/index';
    }
}
