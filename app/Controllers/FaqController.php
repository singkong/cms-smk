<?php

namespace App\Controllers;

use App\Models\FaqModel;

class FaqController extends GuruController
{
    protected $hasFile = false;

    public function __construct()
    {
        $this->model = model(FaqModel::class);
        $this->viewIndex = 'admin/faq/index';
        $this->orderBy = 'sort_order ASC';
    }
}
