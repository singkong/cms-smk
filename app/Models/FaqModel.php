<?php

namespace App\Models;

class FaqModel extends BaseModel
{
    protected $table            = 'faq';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['question', 'answer', 'sort_order'];
    protected $useSoftDeletes   = false;
    protected $validationRules  = ['question' => 'required', 'answer' => 'required'];
}
