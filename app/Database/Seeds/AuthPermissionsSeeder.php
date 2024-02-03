<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthPermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'kelola_data',
                'description'   => 'Mengelola Data Presensi, Data Lokasi Presensi, Data Jabatan, dan Data Pegawai',
            ],
            [
                'name'          => 'isi_presensi',
                'description'   => 'Izin untuk pengguna dapat melakukan dan melihat riwayat kehadiran, serta mengajukan ketidakhadiran.',
            ],
            [
                'name'          => 'kelola_pengajuan_cuti',
                'description'   => 'Izin yang memberikan akses untuk menyetujui atau memberikan persetujuan terhadap permintaan cuti yang diajukan oleh karyawan. Izin ini memungkinkan pengguna untuk mengelola dan memproses permintaan cuti melalui sistem.',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO auth_permissions (name, description) VALUES(:name:, :description:)', $data);

        // Using Query Builder
        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
