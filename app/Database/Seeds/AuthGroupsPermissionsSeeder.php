<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsPermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id'          => 1,
                'permission_id'     => 1,
            ],
            [
                'group_id'          => 1,
                'permission_id'     => 2,
            ],
            [
                'group_id'          => 2,
                'permission_id'     => 2,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 1,
            ],
            [
                'group_id'          => 3,
                'permission_id'     => 3,
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO auth_groups_permissions (group_id, permission_id) VALUES(:group_id:, :permission_id:)', $data);

        // Using Query Builder
        $this->db->table('auth_groups_permissions')->insertBatch($data);
    }
}
