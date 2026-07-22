<?php

namespace App\Controllers;

use App\Models\StaffModel;

class StaffController extends GuruController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = model(StaffModel::class);
        $this->folder = 'staff';
        $this->viewIndex = 'admin/staff/index';
        $this->orderBy = 'sort_order ASC';
    }
}
