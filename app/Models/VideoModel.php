<?php

namespace App\Models;

class VideoModel extends BaseModel
{
    protected $table            = 'videos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'url', 'embed_code', 'thumbnail', 'album_id'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['title' => 'required|max_length[255]', 'url' => 'required|max_length[255]'];
}
