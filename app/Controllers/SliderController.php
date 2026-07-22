<?php

namespace App\Controllers;

use App\Models\SliderModel;

class SliderController extends GuruController
{
    public function __construct()
    {
        $this->model = model(SliderModel::class);
        $this->folder = 'sliders';
        $this->viewIndex = 'admin/sliders/index';
        $this->orderBy = 'sort_order ASC';
    }
}
