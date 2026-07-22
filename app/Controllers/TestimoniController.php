<?php

namespace App\Controllers;

use App\Models\TestimoniModel;

class TestimoniController extends GuruController
{
    public function __construct()
    {
        $this->model = model(TestimoniModel::class);
        $this->folder = 'testimoni';
        $this->viewIndex = 'admin/testimoni/index';
    }
}
