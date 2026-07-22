<?php

namespace App\Models;

class JurusanModel extends BaseModel
{
    protected $table            = 'jurusans';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'singkatan', 'deskripsi', 'gambar', 'visi', 'misi', 'akreditasi', 'kepala_jurusan', 'prospek_kerja', 'kurikulum'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|min_length[3]|max_length[255]', 'singkatan' => 'required|max_length[10]'];
}
