<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersRoleModel extends Model
{
    protected $table = 'auth_groups_users';
    protected $allowedFields = ['group_id', 'user_id'];

    public function getUsersRole($user_id = false)
    {
        if ($user_id) {
            return $this->find($user_id);
        } else {
            return $this->findAll();
        }
    }
}
