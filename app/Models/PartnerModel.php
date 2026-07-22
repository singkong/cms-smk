<?php

namespace App\Models;

class PartnerModel extends BaseModel
{
    protected $table            = 'partners';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'logo', 'website', 'sort_order'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|max_length[255]', 'logo' => 'required'];
}
