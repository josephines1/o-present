<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiPresensiModel extends Model
{
    protected $db, $builder;
    protected $table = 'lokasi_presensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_lokasi', 'slug', 'alamat_lokasi', 'tipe_lokasi', 'latitude', 'longitude', 'radius', 'zona_waktu', 'jam_masuk', 'jam_pulang'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('lokasi_presensi');
    }

    public function getLokasi($slug = false, $filter = false, $print = false, $perPage = 10)
    {
        $pager = service('pager');
        $pager->setPath('lokasi-presensi', 'lokasi-presensi');

        $page = (@$_GET['page_lokasi-presensi']) ? $_GET['page_lokasi-presensi'] : 1;
        $offset = ($page - 1) * $perPage;

        $this->builder->orderBy('tipe_lokasi', 'DESC');
        $total = 0;

        if ($slug) {
            $countQuery = clone $this->builder;
            $total = $countQuery->where('slug', $slug)->countAllResults();
        } else if ($filter) {
            $filter_keyword = $filter['keyword'];
            $filter_tipe = $filter['tipe'];
            $filter_waktu = $filter['waktu'];

            if ($filter_waktu) {
                $this->builder->where('zona_waktu', $filter_waktu);
            }

            if ($filter_tipe) {
                $this->builder->where('tipe_lokasi', $filter_tipe);
            }

            if ($filter_keyword) {
                $this->builder->groupStart()
                    ->like('nama_lokasi', $filter_keyword)
                    ->orLike('alamat_lokasi', $filter_keyword)
                    ->groupEnd();
            }
        }

        $countQuery = clone $this->builder;
        $total = $countQuery->countAllResults();

        if ($print) {
            $result = $this->builder->get()->getResult();
        } else if ($slug) {
            $result = $this->builder->where('slug', $slug)->get($perPage, $offset)->getRowArray();
        } else {
            $result = $this->builder->get($perPage, $offset)->getResult();
        }

        return [
            'lokasi' => $result,
            'links' => $pager->makeLinks($page, $perPage, $total, 'my_pagination', 0, 'lokasi-presensi'),
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
        ];
    }
}
