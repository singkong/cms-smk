<?php

namespace App\Models;

class StaffModel extends BaseModel
{
    protected $table            = 'staff';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'foto', 'jabatan', 'sort_order'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|min_length[3]|max_length[255]', 'jabatan' => 'required|max_length[255]'];
}
