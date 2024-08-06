<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOPresentTables extends Migration
{
    public function up()
    {
        // Jabatan
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'jabatan'          => ['type' => 'varchar', 'constraint' => 255],
            'slug'             => ['type' => 'varchar', 'constraint' => 255],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('jabatan', true);

        // Lokasi Presensi
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_lokasi'       => ['type' => 'varchar', 'constraint' => 255],
            'slug'              => ['type' => 'varchar', 'constraint' => 255],
            'alamat_lokasi'     => ['type' => 'varchar', 'constraint' => 255],
            'tipe_lokasi'       => ['type' => 'varchar', 'constraint' => 255],
            'latitude'          => ['type' => 'varchar', 'constraint' => 50],
            'longitude'         => ['type' => 'varchar', 'constraint' => 50],
            'radius'            => ['type' => 'int', 'constraint' => 11],
            'zona_waktu'        => ['type' => 'varchar', 'constraint' => 100],
            'jam_masuk'         => ['type' => 'time'],
            'jam_pulang'        => ['type' => 'time'],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lokasi_presensi', true);

        // Pegawai
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nip'                   => ['type' => 'varchar', 'constraint' => 50, 'unique' => true],
            'id_jabatan'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_lokasi_presensi'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'nama'                  => ['type' => 'varchar', 'constraint' => 255],
            'jenis_kelamin'         => ['type' => 'varchar', 'constraint' => 10],
            'alamat'                => ['type' => 'varchar', 'constraint' => 255],
            'no_handphone'          => ['type' => 'varchar', 'constraint' => 255],
            'foto'                  => ['type' => 'varchar', 'constraint' => 255],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_jabatan', 'jabatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_lokasi_presensi', 'lokasi_presensi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pegawai', true);

        // Presensi
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pegawai'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'tanggal_masuk'         => ['type' => 'date'],
            'jam_masuk'             => ['type' => 'time'],
            'foto_masuk'            => ['type' => 'varchar', 'constraint' => 255],
            'tanggal_keluar'        => ['type' => 'date'],
            'jam_keluar'            => ['type' => 'time'],
            'foto_keluar'           => ['type' => 'varchar', 'constraint' => 255],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pegawai', 'pegawai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('presensi', true);

        // Ketidakhadiran
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pegawai'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'tipe_ketidakhadiran'   => ['type' => 'varchar', 'constraint' => 255],
            'tanggal_mulai'         => ['type' => 'date'],
            'tanggal_berakhir'      => ['type' => 'date'],
            'deskripsi'             => ['type' => 'varchar', 'constraint' => 255],
            'file'                  => ['type' => 'varchar', 'constraint' => 255],
            'status_pengajuan'      => ['type' => 'varchar', 'constraint' => 20],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pegawai', 'pegawai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ketidakhadiran', true);

        // Email Tokens
        $fields = [
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'                 => ['type' => 'varchar', 'constraint' => 255, 'unique' => true],
            'token'                 => ['type' => 'varchar', 'constraint' => 255],
            'created_time'          => ['type' => 'int', 'constraint' => 11],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('email_tokens', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver !== 'SQLite3') { // @phpstan-ignore-line
            $this->forge->dropForeignKey('pegawai', 'pegawai_id_jabatan_foreign');
            $this->forge->dropForeignKey('pegawai', 'pegawai_id_lokasi_presensi_foreign');
            $this->forge->dropForeignKey('presensi', 'presensi_id_pegawai_foreign');
            $this->forge->dropForeignKey('ketidakhadiran', 'ketidakhadiran_id_pegawai_foreign');
        }

        $this->forge->dropTable('jabatan', true);
        $this->forge->dropTable('lokasi_presensi', true);
        $this->forge->dropTable('pegawai', true);
        $this->forge->dropTable('presensi', true);
        $this->forge->dropTable('ketidakhadiran', true);
        $this->forge->dropTable('email_tokens', true);
    }
}
