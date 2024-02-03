<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_pegawai'        => '1',
                'email'             => 'jaya@present.com',
                'username'          => 'jayaputra',
                'password_hash'     => '$2y$10$.g0bOzk.wZdSJS6/QwQX7.xgvxYxESFH7r/GuDZyFWcPLGq2fqXTe',
                'active'            => '1',
            ],
            [
                'id_pegawai'        => '2',
                'email'             => 'tamani@present.com',
                'username'          => 'tamanindah',
                'password_hash'     => '$2y$10$EdFcZIe2FO5BFecVBHB58e0zI1aLswPtOKZkaE.Fw2oA/caUwbm7q',
                'active'            => '1',
            ],
            [
                'id_pegawai'        => '3',
                'email'             => 'choland@present.com',
                'username'          => 'choland',
                'password_hash'     => '$2y$10$HslMKgwyZ/4gR7qAfJRUS.WFKiZaT58kwReAZQOQHZdtX3tw4wsAG',
                'active'            => '1',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (id_pegawai, email, username, password_hash, active) VALUES(:id_pegawai:, :email:, :username:, :password_hash:, :active:', $data);

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
