<?php

namespace App\Models;

class AlumniModel extends BaseModel
{
    protected $table            = 'alumni';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'foto', 'angkatan', 'jurusan', 'pekerjaan', 'perusahaan'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|max_length[255]'];
}
