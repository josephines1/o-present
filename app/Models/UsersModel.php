<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pegawai', 'email', 'username', 'password_hash', 'active', 'activate_hash'];
    protected $useTimestamps = true;

    public function getUserInfo($userId)
    {
        // Tabel users
        $builder = $this->db->table('users');

        $builder->select('
            users.id as userid, 
            users.*,
            auth_groups.name as role,
            auth_groups.id as role_id,
            pegawai.*,
            jabatan.jabatan, 
            lokasi_presensi.nama_lokasi as lokasi_presensi, 
        ');

        // Join Tabel auth_groups_users
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');

        // Join Tabel auth_groups
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        // Join Tabel pegawai
        $builder->join('pegawai', 'pegawai.id = users.id_pegawai');

        // Join Tabel jabatan
        $builder->join('jabatan', 'jabatan.id = pegawai.id_jabatan');

        // Join Tabel lokasi_presensi
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.id_lokasi_presensi');

        // Hanya untuk satu user, berdasarkan user_id yang sedang Login
        $builder->where('users.id', $userId);

        $query = $builder->get();
        return $query->getRow();
    }

    public function hashPassword($password_string)
    {
        return password_hash(base64_encode(hash('sha384', $password_string, true)), PASSWORD_DEFAULT);
    }
}
