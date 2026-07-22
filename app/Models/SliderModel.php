<?php

namespace App\Models;

class SliderModel extends BaseModel
{
    protected $table            = 'sliders';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'description', 'image', 'url', 'sort_order', 'is_active'];
    protected $useSoftDeletes   = false;
}
