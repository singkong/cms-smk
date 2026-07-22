<?php

namespace App\Models;

class ContactModel extends BaseModel
{
    protected $table            = 'contacts';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'email', 'phone', 'subject', 'message', 'is_read', 'is_replied', 'reply', 'replied_at'];
    protected $useSoftDeletes   = false;
}
