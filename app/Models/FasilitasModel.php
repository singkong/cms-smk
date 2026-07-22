<?php

namespace App\Models;

class FasilitasModel extends BaseModel
{
    protected $table            = 'fasilitas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'deskripsi', 'gambar', 'ikon'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['nama' => 'required|max_length[255]'];
}
