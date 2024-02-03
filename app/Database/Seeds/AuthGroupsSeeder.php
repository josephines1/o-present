<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'head',
                'description'   => 'Unit manajerial tingkat tinggi yang bertanggung jawab memimpin, mengelola, dan mengkoordinasikan berbagai tim di organisasi untuk mencapai tujuan strategis.',
            ],
            [
                'name'          => 'admin',
                'description'   => 'Mengelola dan mengawasi fungsi administratif sistem, termasuk manajemen pengguna dan hak akses, untuk mendukung operasional harian.',
            ],
            [
                'name'          => 'pegawai',
                'description'   => 'Mencakup anggota yang fokus pada kehadiran dan aktivitas presensi, dengan akses terbatas untuk memastikan pencatatan dan pemantauan presensi yang akurat.',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO auth_groups (name, description) VALUES(:name:, :description:)', $data);

        // Using Query Builder
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
