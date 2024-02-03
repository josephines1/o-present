<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsUsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id'          => 1,
                'user_id'           => 1,
            ],
            [
                'group_id'          => 2,
                'user_id'           => 2,
            ],
            [
                'group_id'          => 3,
                'user_id'           => 3,
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO auth_groups_users (group_id, user_id) VALUES(:group_id:, :user_id:)', $data);

        // Using Query Builder
        $this->db->table('auth_groups_users')->insertBatch($data);
    }
}
