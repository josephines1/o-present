<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $db, $builder;
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jabatan', 'slug'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('jabatan');
    }

    public function getJabatan($slug = false, $keyword = false, $perPage = 10)
    {
        $pager = service('pager');
        $pager->setPath('jabatan', 'jabatan');

        $page = (@$_GET['page_jabatan']) ? $_GET['page_jabatan'] : 1;
        $offset = ($page - 1) * $perPage;

        $this->builder->select('jabatan.*, COUNT(pegawai.id) as total_pegawai');
        $this->builder->join('pegawai', 'pegawai.id_jabatan = jabatan.id', 'left');
        $this->builder->groupBy('jabatan.id');
        $this->builder->orderBy('jabatan', 'ASC');

        $total = 0;

        if ($slug) {
            $countQuery = clone $this->builder;
            $total = $countQuery->where('slug', $slug)->countAllResults();

            $result = $this->builder->where('slug', $slug)->get($perPage, $offset)->getRowArray();
        } elseif ($keyword) {
            $countQuery = clone $this->builder;

            $total = $countQuery->like('jabatan', $keyword)
                ->countAllResults();

            $result = $this->builder->like('jabatan', $keyword)
                ->get($perPage, $offset)
                ->getResult();
        } else {
            $result = $this->builder->get($perPage, $offset)->getResult();
            $total = $this->builder->countAllResults();
        }

        return [
            'jabatan' => $result,
            'links' => $pager->makeLinks($page, $perPage, $total, 'my_pagination', 0, 'jabatan'),
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
        ];
    }
}
