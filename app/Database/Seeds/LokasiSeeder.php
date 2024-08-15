<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_lokasi'       => 'Gedung Jaya Raya',
                'slug'              => 'gedung-jaya-raya',
                'alamat_lokasi'     => 'RT.5/RW.2, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110',
                'tipe_lokasi'       => 'Pusat',
                'latitude'          => '-6.195590234157995',
                'longitude'         => '106.81301455947505',
                'radius'            => 500,
                'zona_waktu'        => 'Asia/Jakarta',
                'jam_masuk'         => '08:00:00',
                'jam_pulang'        => '18:00:00',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO lokasi_presensi (nama_lokasi, alamat_lokasi, tipe_lokasi, latitude, longitude, radius, zona_waktu, jam_masuk, jam_pulang) VALUES(:nama_lokasi:, :alamat_lokasi:, :tipe_lokasi:, :latitude:, :longitude:, :radius:, :zona_waktu:, :jam_masuk:, :jam_pulang:)', $data);

        // Using Query Builder
        $this->db->table('lokasi_presensi')->insertBatch($data);
    }
}
