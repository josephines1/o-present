<?php

namespace App\Models;

use CodeIgniter\Model;

class KetidakhadiranModel extends Model
{
    protected $builder;
    protected $table = 'ketidakhadiran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pegawai', 'tipe_ketidakhadiran', 'tanggal_mulai', 'tanggal_berakhir', 'deskripsi', 'file', 'status_pengajuan'];
    protected $useTimestamps = true;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('ketidakhadiran');
    }

    public function getDataKetidakhadiran($id_pegawai = false, $filter = false, $print = false, $perPage = 10)
    {
        $pager = service('pager');
        if ($id_pegawai === false) {
            $pager->setPath('kelola-ketidakhadiran', 'ketidakhadiran');
            $page = (@$_GET['page_ketidakhadiran']) ? $_GET['page_ketidakhadiran'] : 1;
        } else {
            $page = (@$_GET['page']) ? $_GET['page'] : 1;
        }

        $offset = ($page - 1) * $perPage;

        $this->builder->select('ketidakhadiran.*, pegawai.nip, pegawai.nama');
        $this->builder->join('pegawai', 'pegawai.id = ketidakhadiran.id_pegawai');
        $this->builder->orderBy('ketidakhadiran.updated_at', 'DESC');

        $total = 0;
        $bulan_sekarang = date('Y-m');

        if ($id_pegawai) {
            $this->builder->where('id_pegawai', $id_pegawai);
        }

        if ($filter) {
            $filter_keyword = $filter['keyword'];
            $filter_bulan = $filter['bulan'];
            $filter_tahun = $filter['tahun'];
            $filter_status = $filter['status'];
            $filter_tipe = $filter['tipe'];

            if ($filter_status) {
                $this->builder->where('status_pengajuan', $filter_status);
            }

            if ($filter_tipe) {
                $this->builder->where('tipe_ketidakhadiran', $filter_tipe);
            }

            if ($filter_keyword) {
                if ($id_pegawai) {
                    $this->builder->groupStart()
                        ->like('deskripsi', $filter_keyword)
                        ->groupEnd();
                } else {
                    $this->builder->groupStart()
                        ->like('nama', $filter_keyword)
                        ->orLike('deskripsi', $filter_keyword)
                        ->groupEnd();
                }
            }

            if ($filter_bulan !== null && $filter_tahun !== null) {
                $bulan_filter = $filter_tahun . '-' . $filter_bulan;
                $this->builder->groupStart()
                    ->where('DATE_FORMAT(tanggal_mulai, "%Y-%m")', $bulan_filter)
                    ->orwhere('DATE_FORMAT(tanggal_berakhir, "%Y-%m")', $bulan_filter)
                    ->groupEnd();
            }

            if ($filter_bulan === null && $filter_tahun === null) {
                $this->builder->groupStart()
                    ->where('DATE_FORMAT(tanggal_mulai, "%Y-%m")', $bulan_sekarang)
                    ->orWhere('DATE_FORMAT(tanggal_berakhir, "%Y-%m")', $bulan_sekarang)
                    ->groupEnd();
            }
        }

        $countQuery = clone $this->builder;
        $total = $countQuery->countAllResults();

        if ($print) {
            $result = $this->builder->get()->getResult();
        } else {
            $result = $this->builder->get($perPage, $offset)->getResult();
        }

        if ($id_pegawai === false) {
            $links = $pager->makeLinks($page, $perPage, $total, 'my_pagination', 0, 'ketidakhadiran');
        } else {
            $links = $pager->makeLinks($page, $perPage, $total, 'my_pagination');
        }

        return [
            'ketidakhadiran' => $result,
            'links' => $links,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
        ];
    }

    public function findDataKetidakhadiran($id)
    {
        $this->builder->select('ketidakhadiran.*, pegawai.nip, pegawai.nama');
        $this->builder->join('pegawai', 'pegawai.id = ketidakhadiran.id_pegawai');
        $this->builder->where('ketidakhadiran.id', $id);

        $this->builder->orderBy('ketidakhadiran.updated_at', 'DESC');
        $query = $this->builder->get();

        return $query->getRow();
    }

    public function getDataIzinHariIni($id_pegawai = false, $startDate = false, $endDate = false)
    {
        $this->builder->select('ketidakhadiran.*');

        if ($id_pegawai) {
            $this->builder->where('id_pegawai', $id_pegawai);
        }

        if ($startDate && $endDate) {
            $query = $this->builder->where('tanggal_mulai <=', $startDate)
                ->where('tanggal_berakhir >=', $endDate)
                ->where('status_pengajuan', 'APPROVED')
                ->get();
        } else {
            $query = $this->builder->where('tanggal_mulai <=', date('Y-m-d'))
                ->where('tanggal_berakhir >=', date('Y-m-d'))
                ->where('status_pengajuan', 'APPROVED')
                ->get();
        }

        return $query->getNumRows();
    }

    public function getMinYear()
    {
        $this->builder->selectMin('YEAR(tanggal_mulai)', 'min_year');
        $query = $this->builder->get();

        $result = $query->getRow();

        return $result ? $result->min_year : null;
    }

    public function checkAndUpdateStatus()
    {
        $today = date('Y-m-d');
        $this->builder->where('tanggal_mulai <', $today);
        $this->builder->where('status_pengajuan', 'PENDING');
        $this->builder->update(['status_pengajuan' => 'REJECTED']);
    }
}
