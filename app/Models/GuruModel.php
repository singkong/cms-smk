<?php

namespace App\Models;

class GuruModel extends BaseModel
{
    protected $table            = 'guru';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'nip', 'nama', 'foto', 'jabatan', 'bidang', 'pendidikan', 'alamat', 'telepon', 'email', 'facebook', 'instagram', 'sort_order', 'is_active'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|min_length[3]|max_length[255]', 'nip' => 'permit_empty|max_length[30]|is_unique[guru.nip,id,{id}]'];
}
