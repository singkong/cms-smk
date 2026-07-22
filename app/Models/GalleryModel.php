<?php

namespace App\Models;

class GalleryModel extends BaseModel
{
    protected $table            = 'gallery';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['album_id', 'title', 'description', 'image', 'thumbnail', 'sort_order'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['title' => 'required|max_length[255]', 'image' => 'required'];
}
