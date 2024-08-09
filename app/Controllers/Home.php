<?php

namespace App\Controllers;

use App\Models\KetidakhadiranModel;
use App\Models\UsersModel;
use App\Models\PresensiModel;
use App\Models\LokasiPresensiModel;

class Home extends BaseController
{
    protected $usersModel;
    protected $lokasiModel;
    protected $presensiModel;
    protected $ketidakhadiranModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->lokasiModel = new LokasiPresensiModel();
        $this->presensiModel = new PresensiModel();
        $this->ketidakhadiranModel = new KetidakhadiranModel();
    }

    public function index(): string
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $user_lokasi = $this->lokasiModel->getWhere(['nama_lokasi' => $user_profile->lokasi_presensi])->getFirstRow();
        $presensi_masuk = $this->presensiModel->cekPresensiMasuk($user_profile->id_pegawai, date('Y-m-d'));
        $jumlah_presensi_masuk = $this->presensiModel->cekPresensiMasuk($user_profile->id_pegawai, date('Y-m-d'), true);
        $status_ketidakhadiran = $this->ketidakhadiranModel->getDataIzinHariIni($user_profile->id_pegawai);

        $data = [
            'title' => 'Home',
            'user_profile' => $user_profile,
            'user_lokasi_presensi' => $user_lokasi,
            'jumlah_presensi_masuk' => $jumlah_presensi_masuk,
            'jam_pulang' => $user_lokasi->jam_pulang,
            'data_presensi_masuk' => $presensi_masuk,
            'status_ketidakhadiran' =>  $status_ketidakhadiran,
        ];

        return view('home/index', $data);
    }

    public function getWaktu()
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $user_lokasi_presensi = $this->lokasiModel->getWhere(['nama_lokasi' => $user_profile->lokasi_presensi])->getFirstRow();

        if (in_array($user_lokasi_presensi->zona_waktu, timezone_identifiers_list())) {
            date_default_timezone_set($user_lokasi_presensi->zona_waktu);
        } else {
            date_default_timezone_set('Asia/Jakarta');
        }

        $waktu = [
            'tanggal' => date('j'),
            'bulan' => date('F'),
            'tahun' => date('Y'),
            'jam' => date('H'),
            'menit' => date('i'),
            'detik' => date('s')
        ];

        return $this->response->setJSON($waktu);
    }
}
