<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nip'                   => 'PEG-0001',
                'id_jabatan'            => '1',
                'id_lokasi_presensi'    => '1',
                'nama'                  => 'Jaya Wahyudi Putra',
                'jenis_kelamin'         => 'Laki-laki',
                'alamat'                => 'Jl. Harsono RM No.1, Ragunan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550',
                'no_handphone'          => '081234567891',
                'foto'                  => 'default.jpg',
            ],
            [
                'nip'                   => 'PEG-0002',
                'id_jabatan'            => '2',
                'id_lokasi_presensi'    => '1',
                'nama'                  => 'Tamani Indah Permata',
                'jenis_kelamin'         => 'Perempuan',
                'alamat'                => 'Jl. Lodan Timur No.7, Ancol, Kec. Pademangan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14430',
                'no_handphone'          => '081281010191',
                'foto'                  => 'default.jpg',
            ],
            [
                'nip'                   => 'PEG-0003',
                'id_jabatan'            => '3',
                'id_lokasi_presensi'    => '1',
                'nama'                  => 'Christoper Holand',
                'jenis_kelamin'         => 'Laki-laki',
                'alamat'                => 'Jl. Taman Suropati No.5, RT.5/RW.5, Menteng, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10310',
                'no_handphone'          => '081287761290',
                'foto'                  => 'default.jpg',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO pegawai (nip, id_jabatan, id_lokasi_presensi, nama, jenis_kelamin, alamat, no_handphone, foto) VALUES(:nip:, :id_jabatan:, :id_lokasi_presensi:, :nama:, :jenis_kelamin:, :alamat:, :no_handphone:, :foto:)', $data);

        // Using Query Builder
        $this->db->table('pegawai')->insertBatch($data);
    }
}
