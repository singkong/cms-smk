<?php

namespace App\Models;

class AlbumModel extends BaseModel
{
    protected $table            = 'albums';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'slug', 'description', 'cover', 'type'];
    protected $useSoftDeletes   = false;
    protected $beforeInsert     = ['setSlug'];
    protected $validationRules  = ['name' => 'required|max_length[255]'];
}
