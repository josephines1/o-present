<?php

namespace App\Controllers;

use App\Models\LokasiPresensiModel;
use App\Models\UsersModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LokasiPresensi extends BaseController
{
    protected $usersModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->lokasiModel = new LokasiPresensiModel();
    }

    public function index(): string
    {
        $lokasiModel = $this->lokasiModel->getLokasi();
        $currentPage = $this->request->getVar('page_lokasi-presensi') ? $this->request->getVar('page_lokasi-presensi') : 1;

        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'tipe' => $this->request->getGet('tipe'),
            'waktu' => $this->request->getGet('waktu'),
        ];

        if (!empty($filter)) {
            if ($filter['keyword'] === null) {
                $filter['keyword'] = '';
            }
            if ($filter['tipe'] === null) {
                $filter['tipe'] = '';
            }
            if ($filter['waktu'] === null) {
                $filter['waktu'] = '';
            }
            $lokasiModel = $this->lokasiModel->getLokasi(false, $filter);
        }

        $filtered = false;
        if (($filter['waktu'] !== null && $filter['waktu'] !== '') || ($filter['tipe'] !== null && $filter['tipe'] !== '')) {
            $filtered = true;
        }

        $data_lokasi = $lokasiModel['lokasi'];
        $pager = $lokasiModel['links'];
        $total = $lokasiModel['total'];
        $perPage = $lokasiModel['perPage'];

        $data = [
            'title' => 'Data Lokasi Presensi',
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'lokasi' => $data_lokasi,
            'currentPage' => $currentPage,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'filter' => $filter,
            'isFiltered' => $filtered,
        ];

        return view('lokasi_presensi/index', $data);
    }

    public function dataLokasiExcel()
    {
        $filter = [
            'keyword' => $this->request->getPost('keyword'),
            'tipe' => $this->request->getPost('tipe'),
            'waktu' => $this->request->getPost('waktu'),
        ];

        $lokasiModel = $this->lokasiModel->getLokasi(false, $filter, true);
        $data_lokasi = $lokasiModel['lokasi'];

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        if ($filter['tipe'] === '') {
            $filter['tipe'] = 'Semua Tipe';
        }

        if ($filter['waktu'] === '') {
            $filter['waktu'] = 'Semua Zona Waktu';
        }

        $worksheet->setCellValue('A1', 'Data Lokasi Presensi');
        $worksheet->setCellValue('A3', 'Filter Tipe');
        $worksheet->setCellValue('A4', 'Filter Zona Waktu');
        $worksheet->setCellValue('C3', $filter['tipe']);
        $worksheet->setCellValue('C4', $filter['waktu']);
        $worksheet->setCellValue('A6', '#');
        $worksheet->setCellValue('B6', 'NAMA LOKASI');
        $worksheet->setCellValue('C6', 'ALAMAT');
        $worksheet->setCellValue('D6', 'TIPE');
        $worksheet->setCellValue('E6', 'LATITUDE');
        $worksheet->setCellValue('F6', 'LONGITUDE');
        $worksheet->setCellValue('G6', 'RADIUS (m)');
        $worksheet->setCellValue('H6', 'ZONA WAKTU');
        $worksheet->setCellValue('I6', 'JAM MASUK');
        $worksheet->setCellValue('J6', 'JAM PULANG');

        $worksheet->mergeCells('A1:J1');
        $worksheet->mergeCells('A3:B3');
        $worksheet->mergeCells('A4:B4');

        $data_start_row = 7;
        $nomor = 1;

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];

        if (!empty($data_lokasi)) {
            // dd($data_lokasi);
            foreach ($data_lokasi as $data) {
                $worksheet->setCellValue('A' . $data_start_row, $nomor++);
                $worksheet->setCellValue('B' . $data_start_row, $data->nama_lokasi);
                $worksheet->setCellValue('C' . $data_start_row, $data->alamat_lokasi);
                $worksheet->setCellValue('D' . $data_start_row, $data->tipe_lokasi);
                $worksheet->setCellValue('E' . $data_start_row, $data->latitude);
                $worksheet->setCellValue('F' . $data_start_row, $data->longitude);
                $worksheet->setCellValue('G' . $data_start_row, $data->radius);
                $worksheet->setCellValue('H' . $data_start_row, $data->zona_waktu);
                $worksheet->setCellValue('I' . $data_start_row, $data->jam_masuk);
                $worksheet->setCellValue('J' . $data_start_row, $data->jam_pulang);

                $worksheet->getStyle('A' . $data_start_row - 1 . ':J' . $data_start_row)->applyFromArray($styleArray);
                $worksheet->getStyle('A' . $data_start_row - 1 . ':J' . $data_start_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                $worksheet->getStyle('D' . $data_start_row - 1 . ':J' . $data_start_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A' . $data_start_row - 1 . ':A' . $data_start_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $worksheet->getStyle('C')->getAlignment()->setWrapText(true);
                $data_start_row++;
            }
        } else {
            $worksheet->setCellValue('A' . $data_start_row, 'Tidak Ada Data');
            $worksheet->getStyle('A' . $data_start_row - 1 . ':J' . $data_start_row)->applyFromArray($styleArray);
            $worksheet->mergeCells('A' . $data_start_row . ':J' . $data_start_row);
        }

        $columns = ['A', 'B', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        foreach ($columns as $column) {
            $worksheet->getColumnDimension($column)->setAutoSize(true);
        }

        $worksheet->getStyle('A3:C4')->applyFromArray($styleArray);
        $worksheet->getStyle('A3:C4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $worksheet->getStyle('A3:A4')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ffff00');
        $worksheet->getStyle('A6:J6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A6:J6')->getFont()->setBold(true);
        $worksheet->getColumnDimension('C')->setWidth(150, 'px');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="O-Present_Data Lokasi Presensi_' . date('Y-m-d-His') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function pencarianLokasi()
    {
        $currentPage = $this->request->getVar('page_lokasi-presensi') ? $this->request->getVar('page_lokasi-presensi') : 1;
        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'tipe' => $this->request->getGet('tipe'),
            'waktu' => $this->request->getGet('waktu'),
        ];

        if (empty($filter['keyword'])) {
            $filter['keyword'] = '';
        }

        $data = [
            'lokasi' => $this->lokasiModel->getLokasi(false, $filter)['lokasi'],
            'currentPage' => $currentPage,
            'pager' => $this->lokasiModel->getLokasi(false, $filter)['links'],
            'total' => $this->lokasiModel->getLokasi(false, $filter)['total'],
            'perPage' => $this->lokasiModel->getLokasi(false, $filter)['perPage'],
        ];

        return view('lokasi_presensi/hasil-pencarian', $data);
    }

    public function detail($slug): string
    {
        $lokasi = $this->lokasiModel->getLokasi($slug)['lokasi'];

        if (empty($lokasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Lokasi ' . $slug . ' Tidak Ditemukan');
        }

        $data = [
            'title' => 'Detail ' . $lokasi['nama_lokasi'],
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'lokasi' => $lokasi,
        ];

        return view('lokasi_presensi/detail', $data);
    }

    public function add(): string
    {
        $data = [
            'title' => 'Tambah Data Lokasi Presensi',
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
        ];

        return view('lokasi_presensi/tambah', $data);
    }

    public function store()
    {
        $rules = [
            'nama_lokasi' => [
                'rules' => 'required|is_unique[lokasi_presensi.nama_lokasi]',
                'errors' => [
                    'required' => 'mohon isi nama lokasi',
                    'is_unique' => 'lokasi sudah terdaftar',
                ]
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'mohon isi alamat lokasi',
                ]
            ],
            'tipe_lokasi' => [
                'rules' => 'required|in_list[Pusat,Cabang]',
                'errors' => [
                    'required' => 'mohon pilih tipe lokasi',
                    'in_list' => 'mohon pilih pada pilihan yang tersedia',
                ]
            ],
            'latitude' => [
                'rules' => 'required|numeric|decimal',
                'errors' => [
                    'required' => 'mohon isi latitude lokasi',
                    'numeric' => 'mohon isi nilai latitude berupa angka yang valid',
                    'decimal' => 'mohon isi nilai latitude berupa angka yang valid',
                ]
            ],
            'longitude' => [
                'rules' => 'required|numeric|decimal',
                'errors' => [
                    'required' => 'mohon isi longitude lokasi',
                    'numeric' => 'mohon isi nilai latitude berupa angka yang valid',
                    'decimal' => 'mohon isi nilai latitude berupa angka yang valid',
                ]
            ],
            'radius' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'mohon isi radius presensi',
                    'numeric' => 'mohon isi tipe data angka',
                ]
            ],
            'zona_waktu' => [
                'rules' => 'required|valid_timezone',
                'errors' => [
                    'required' => 'mohon pilih zona waktu',
                    'valid_timezone' => 'mohon pilih zona waktu yang tersedia',
                ]
            ],
            'jam_masuk' => [
                'rules' => 'required|regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]',
                'errors' => [
                    'required' => 'mohon isi waktu untuk jam masuk',
                    'regex_match' => 'mohon isi dengan format waktu yang benar',
                ]
            ],
            'jam_pulang' => [
                'rules' => 'required|regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]',
                'errors' => [
                    'required' => 'mohon isi waktu untuk jam pulang',
                    'regex_match' => 'mohon isi dengan format waktu yang benar',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/tambah-lokasi-presensi')->withInput();
        }

        $newLokasi = $this->request->getVar('nama_lokasi');
        $slug = url_title($newLokasi, '-', true);

        $this->lokasiModel->save([
            'nama_lokasi' => $this->request->getVar('nama_lokasi'),
            'slug' => $slug,
            'alamat_lokasi' => $this->request->getVar('alamat_lokasi'),
            'tipe_lokasi' => $this->request->getVar('tipe_lokasi'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'radius' => $this->request->getVar('radius'),
            'zona_waktu' => $this->request->getVar('zona_waktu'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
        ]);

        session()->setFlashdata('berhasil', 'Lokasi ' . $newLokasi . ' Berhasil Ditambahkan');
        return redirect()->to('/lokasi-presensi');
    }

    public function edit($slug): string
    {
        $lokasi = $this->lokasiModel->getLokasi($slug)['lokasi'];

        if (empty($lokasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Lokasi ' . $slug . ' Tidak Ditemukan');
        }

        $data = [
            'title' => 'Edit Data Lokasi Presensi ' . $lokasi['nama_lokasi'],
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'lokasi' => $lokasi,
        ];

        return view('lokasi_presensi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $slug = $this->request->getVar('slug');

        $lokasi_db = $this->lokasiModel->getWhere(['id' => $id])->getFirstRow();
        $nama_lokasi_db = $lokasi_db->nama_lokasi;
        $nama_lokasi_edit = $this->request->getVar('nama_lokasi');

        if ($nama_lokasi_db === $nama_lokasi_edit) {
            $rules_nama_lokasi = 'required';
        } else {
            $rules_nama_lokasi = 'required|is_unique[lokasi_presensi.nama_lokasi]';
        }

        $rules = [
            'nama_lokasi' => [
                'rules' => $rules_nama_lokasi,
                'errors' => [
                    'required' => 'mohon isi nama lokasi',
                    'is_unique' => 'lokasi sudah terdaftar',
                ]
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'mohon isi alamat lokasi',
                ]
            ],
            'tipe_lokasi' => [
                'rules' => 'required|in_list[Pusat,Cabang]',
                'errors' => [
                    'required' => 'mohon pilih tipe lokasi',
                    'in_list' => 'mohon pilih pada pilihan yang tersedia',
                ]
            ],
            'latitude' => [
                'rules' => 'required|numeric|decimal',
                'errors' => [
                    'required' => 'mohon isi latitude lokasi',
                    'numeric' => 'mohon isi nilai latitude berupa angka yang valid',
                    'decimal' => 'mohon isi nilai latitude berupa angka yang valid',
                ]
            ],
            'longitude' => [
                'rules' => 'required|numeric|decimal',
                'errors' => [
                    'required' => 'mohon isi longitude lokasi',
                    'numeric' => 'mohon isi nilai latitude berupa angka yang valid',
                    'decimal' => 'mohon isi nilai latitude berupa angka yang valid',
                ]
            ],
            'radius' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'mohon isi radius presensi',
                    'numeric' => 'mohon isi tipe data angka',
                ]
            ],
            'zona_waktu' => [
                'rules' => 'required|valid_timezone',
                'errors' => [
                    'required' => 'mohon pilih zona waktu',
                    'valid_timezone' => 'mohon pilih zona waktu yang tersedia',
                ]
            ],
            'jam_masuk' => [
                'rules' => 'required|regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]',
                'errors' => [
                    'required' => 'mohon isi waktu untuk jam masuk',
                    'regex_match' => 'mohon isi dengan format waktu yang benar',
                ]
            ],
            'jam_pulang' => [
                'rules' => 'required|regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]',
                'errors' => [
                    'required' => 'mohon isi waktu untuk jam pulang',
                    'regex_match' => 'mohon isi dengan format waktu yang benar',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/lokasi-presensi/edit/' . $slug)->withInput();
        }

        $newLokasi = $this->request->getVar('nama_lokasi');
        $slug = url_title($newLokasi, '-', true);

        $this->lokasiModel->save([
            'id' => $id,
            'nama_lokasi' => $this->request->getVar('nama_lokasi'),
            'slug' => $slug,
            'alamat_lokasi' => $this->request->getVar('alamat_lokasi'),
            'tipe_lokasi' => $this->request->getVar('tipe_lokasi'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'radius' => $this->request->getVar('radius'),
            'zona_waktu' => $this->request->getVar('zona_waktu'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
        ]);

        session()->setFlashdata('berhasil', 'Lokasi ' . $newLokasi . ' Berhasil Diedit');
        return redirect()->to('/lokasi-presensi');
    }

    public function delete($id)
    {
        $this->lokasiModel->delete($id);

        session()->setFlashdata('berhasil', 'Data Lokasi Berhasil Dihapus');
        return redirect()->to('/lokasi-presensi');
    }
}
