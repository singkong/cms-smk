<?php

namespace App\Models;

class CategoryModel extends BaseModel
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'slug', 'description', 'parent_id', 'type'];
    protected $useSoftDeletes   = false;
    protected $beforeInsert     = ['setSlug'];
    protected $beforeUpdate     = ['setSlug'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'type' => 'required|in_list[berita,pengumuman,agenda,prestasi,download,gallery]',
    ];
}
