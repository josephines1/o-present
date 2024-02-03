<?php

namespace App\Controllers;

use App\Models\KetidakhadiranModel;
use App\Models\PegawaiModel;
use App\Models\PresensiModel;
use App\Models\UsersModel;

class Admin extends BaseController
{
    protected $usersModel;
    protected $pegawaiModel;
    protected $presensiModel;
    protected $ketidakhadiranModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->presensiModel = new PresensiModel();
        $this->ketidakhadiranModel = new KetidakhadiranModel();
    }

    public function index(): string
    {
        $jumlah_pegawai_aktif = $this->pegawaiModel->getJumlahPegawaiAktif();
        $jumlah_pegawai_hadir = $this->presensiModel->getDataPresensiHariIni();
        $jumlah_pegawai_izin = $this->ketidakhadiranModel->getDataIzinHariIni();
        $jumlah_pegawai_alpha = $jumlah_pegawai_aktif - ($jumlah_pegawai_hadir + $jumlah_pegawai_izin);

        $data = [
            'title' => 'Dashboard',
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'jumlah_pegawai_aktif' => $jumlah_pegawai_aktif,
            'jumlah_pegawai_hadir' => $jumlah_pegawai_hadir,
            'jumlah_pegawai_izin' => $jumlah_pegawai_izin,
            'jumlah_pegawai_alpha' => $jumlah_pegawai_alpha,
        ];

        return view('admin/index', $data);
    }
}
