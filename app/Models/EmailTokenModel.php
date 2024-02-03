<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTokenModel extends Model
{
    protected $table = 'email_tokens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'token', 'created_time'];
    protected $useTimestamps = true;
}
