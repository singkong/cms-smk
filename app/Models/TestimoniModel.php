<?php

namespace App\Models;

class TestimoniModel extends BaseModel
{
    protected $table            = 'testimoni';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'foto', 'jurusan', 'angkatan', 'pesan', 'is_active'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|max_length[255]', 'pesan' => 'required'];
}
