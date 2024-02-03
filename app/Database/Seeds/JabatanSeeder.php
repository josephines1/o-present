<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'jabatan' => 'Chief Executive Officer',
                'slug'    => 'chief-executive-officer',
            ],
            [
                'jabatan' => 'Sales Lead',
                'slug'    => 'sales-lead',
            ],
            [
                'jabatan' => 'Sales Admin',
                'slug'    => 'sales-admin',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO jabatan (jabatan, slug) VALUES(:jabatan:, :slug:)', $data);

        // Using Query Builder
        // $this->db->table('jabatan')->insert($data);
        $this->db->table('jabatan')->insertBatch($data);
    }
}
