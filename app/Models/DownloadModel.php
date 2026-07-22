<?php

namespace App\Models;

class DownloadModel extends BaseModel
{
    protected $table            = 'downloads';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'description', 'file', 'category_id', 'file_size', 'downloads'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['title' => 'required|max_length[255]', 'file' => 'required'];
}
