<?php

namespace App\Controllers;

use App\Models\VideoModel;

class VideoController extends GuruController
{
    public function __construct()
    {
        $this->model = model(VideoModel::class);
        $this->folder = 'videos';
        $this->viewIndex = 'admin/videos/index';
    }
}
