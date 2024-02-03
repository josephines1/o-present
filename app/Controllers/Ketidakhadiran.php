<?php

namespace App\Controllers;

use DateTime;
use App\Models\UsersModel;
use App\Models\KetidakhadiranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ketidakhadiran extends BaseController
{
    protected $usersModel;
    protected $ketidakhadiranModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->ketidakhadiranModel = new KetidakhadiranModel();
    }

    public function index(): string
    {
        $this->ketidakhadiranModel->checkAndUpdateStatus();
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $user_profile = $this->usersModel->getUserInfo(user_id());
        $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai);

        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'bulan' => $this->request->getGet('bulan'),
            'tahun' => $this->request->getGet('tahun'),
            'status' => $this->request->getGet('status'),
            'tipe' => $this->request->getGet('tipe'),
        ];

        if (!empty($filter)) {
            $filter['bulan'] === '' ? date('m') : $filter['bulan'];
            $filter['tahun'] === '' ? date('Y') : $filter['tahun'];
            $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter);
        }

        if (empty($filter['bulan']) || empty($filter['tahun'])) {
            $data_bulan = date('Y-m');
        } else {
            $data_bulan = $filter['tahun'] . '-' . $filter['bulan'];
        }

        if (empty($filter['bulan'])) {
            $filter['bulan'] = date('m');
        }

        if (empty($filter['tahun'])) {
            $filter['tahun'] = date('Y');
        }

        $filtered = false;
        if (($filter['tahun'] !== date('Y') || $filter['bulan'] !== date('m')) || ($filter['status'] !== null && $filter['status'] !== '') || ($filter['tipe'] !== null && $filter['tipe'] !== '')) {
            $filtered = true;
        }

        $data_ketidakhadiran = $data_ketidakhadiran_pegawai['ketidakhadiran'];
        $pager = $data_ketidakhadiran_pegawai['links'];
        $total = $data_ketidakhadiran_pegawai['total'];
        $perPage = $data_ketidakhadiran_pegawai['perPage'];

        if ($this->ketidakhadiranModel->getMinYear()) {
            $tahun_mulai = $this->ketidakhadiranModel->getMinYear();
        } else {
            $tahun_mulai = date('Y');
        }

        $data = [
            'title' => 'Ketidakhadiran',
            'user_profile' => $user_profile,
            'data_ketidakhadiran' => $data_ketidakhadiran,
            'data_bulan' => $data_bulan,
            'currentPage' => $currentPage,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'tahun_mulai' => $tahun_mulai,
            'filter' => $filter,
            'isFiltered' => $filtered,
        ];

        return view('ketidakhadiran/index', $data);
    }

    public function pencarianKetidakhadiranPegawai()
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'bulan' => $this->request->getGet('bulan'),
            'tahun' => $this->request->getGet('tahun'),
            'status' => $this->request->getGet('status'),
            'tipe' => $this->request->getGet('tipe'),
        ];

        if (empty($filter['keyword'])) {
            $filter['keyword'] = '';
        }

        if (empty($filter['bulan']) || empty($filter['tahun'])) {
            $data_bulan = date('Y-m');
        } else {
            $data_bulan = $filter['tahun'] . '-' . $filter['bulan'];
        }

        $data = [
            'data_ketidakhadiran' => $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter)['ketidakhadiran'],
            'currentPage' => $currentPage,
            'pager' => $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter)['links'],
            'total' => $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter)['total'],
            'perPage' => $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter)['perPage'],
            'data_bulan' => $data_bulan,

        ];

        return view('ketidakhadiran/hasil-pencarian-data-pegawai', $data);
    }

    public function dataKetidakhadiranExcel()
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $filter = [
            'keyword' => $this->request->getPost('keyword'),
            'bulan' => $this->request->getPost('bulan'),
            'tahun' => $this->request->getPost('tahun'),
            'status' => $this->request->getPost('status'),
            'tipe' => $this->request->getPost('tipe'),
        ];
        if ($filter['bulan'] === '') {
            $filter['bulan'] = date('m');
        }
        if ($filter['bulan'] === '') {
            $filter['bulan'] = date('Y');
        }
        $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran($user_profile->id_pegawai, $filter, true)['ketidakhadiran'];

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $bulan = DateTime::createFromFormat('Y-m-d', date('Y') . '-' . $filter['bulan'] . '-01');
        $nama_bulan = $bulan->format('F');

        if ($filter['tipe'] === '') {
            $filter['tipe'] = 'Semua Tipe';
        }

        if ($filter['status'] === '') {
            $filter['status'] = 'Semua Status';
        }

        $worksheet->setCellValue('A1', 'Data Ketidakhadiran');
        $worksheet->setCellValue('A3', 'Nama');
        $worksheet->setCellValue('A4', 'NIP');
        $worksheet->setCellValue('F3', 'Bulan');
        $worksheet->setCellValue('F4', 'Tahun');
        $worksheet->setCellValue('F5', 'Filter Tipe');
        $worksheet->setCellValue('F6', 'Filter Status');
        $worksheet->setCellValue('C3', $user_profile->nama);
        $worksheet->setCellValue('C4', $user_profile->nip);
        $worksheet->setCellValue('G3', $nama_bulan);
        $worksheet->setCellValue('G4', $filter['tahun']);
        $worksheet->setCellValue('G5', $filter['tipe']);
        $worksheet->setCellValue('G6', $filter['status']);
        $worksheet->setCellValue('A8', '#');
        $worksheet->setCellValue('B8', 'TIPE');
        $worksheet->setCellValue('C8', 'TANGGAL MULAI');
        $worksheet->setCellValue('D8', 'TANGGAL BERAKHIR');
        $worksheet->setCellValue('E8', 'TOTAL DURASI');
        $worksheet->setCellValue('F8', 'Status Pengajuan');
        $worksheet->setCellValue('G8', 'DESKRIPSI');

        $worksheet->mergeCells('A1:G1');
        $worksheet->mergeCells('A3:B3');
        $worksheet->mergeCells('A4:B4');

        $data_start_row = 9;
        $nomor = 1;

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];

        if (!empty($data_ketidakhadiran_pegawai)) {
            foreach ($data_ketidakhadiran_pegawai as $data) {
                $tanggal_mulai = new DateTime($data->tanggal_mulai);
                $tanggal_berakhir = new DateTime($data->tanggal_berakhir);

                $selisih = $tanggal_mulai->diff($tanggal_berakhir);
                $total_durasi = $selisih->days + 1;

                // Format string
                $total_durasi_format = sprintf("%d Hari", $total_durasi);

                $worksheet->setCellValue('A' . $data_start_row, $nomor++);
                $worksheet->setCellValue('B' . $data_start_row, $data->tipe_ketidakhadiran);
                $worksheet->setCellValue('C' . $data_start_row, $data->tanggal_mulai);
                $worksheet->setCellValue('D' . $data_start_row, $data->tanggal_berakhir);
                $worksheet->setCellValue('E' . $data_start_row, $total_durasi_format);
                $worksheet->setCellValue('F' . $data_start_row, $data->status_pengajuan);
                $worksheet->setCellValue('G' . $data_start_row, $data->deskripsi);

                $worksheet->getStyle('A' . $data_start_row - 1 . ':G' . $data_start_row)->applyFromArray($styleArray);
                $worksheet->getStyle('A' . $data_start_row - 1 . ':G' . $data_start_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

                $worksheet->getStyle('G')->getAlignment()->setWrapText(true);
                $data_start_row++;
            }
        } else {
            $worksheet->setCellValue('A' . $data_start_row, 'Tidak Ada Data');
            $worksheet->mergeCells('A' . $data_start_row . ':G' . $data_start_row);
            $worksheet->getStyle('A' . $data_start_row - 1 . ':G' . $data_start_row)->applyFromArray($styleArray);
        }

        $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
        foreach ($columns as $column) {
            $worksheet->getColumnDimension($column)->setAutoSize(true);
        }

        $worksheet->getStyle('A3:C4')->applyFromArray($styleArray);
        $worksheet->getStyle('F3:G6')->applyFromArray($styleArray);
        $worksheet->getStyle('A1')->getFont()->setBold(true);
        $worksheet->getStyle('A3:A4')->getFont()->setBold(true);
        $worksheet->getStyle('F3:F6')->getFont()->setBold(true);
        $worksheet->getStyle('A8:G8')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A8:G8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ffff00');
        $worksheet->getStyle('A3:C4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $worksheet->getStyle('F3:G6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $worksheet->getColumnDimension('G')->setWidth(250, 'px');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="O-Present_Data Ketidakhadiran_' . $user_profile->username . '_' . $nama_bulan . '_' . $filter['tahun'] . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function add(): string
    {
        // Untuk User Profile
        $user_profile = $this->usersModel->getUserInfo(user_id());

        $data = [
            'title' => 'Form Pengajuan Ketidakhadiran',
            'user_profile' => $user_profile,
        ];

        return view('ketidakhadiran/form-pengajuan', $data);
    }

    public function store()
    {
        // cek validasi
        $rules = [
            'tipe_ketidakhadiran' => [
                'rules' => 'required|in_list[CUTI,IZIN,SAKIT]',
                'errors' => [
                    'required' => 'Tipe ketidakhadiran wajib diisi.',
                    'in_list' => 'Pilih tipe ketidakhadiran yang tersedia.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi ketidakhadiran wajib diisi.',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required|valid_date[Y-m-d]|plusThreeDates',
                'errors' => [
                    'required' => 'Tanggal mulai ketidakhadiran wajib diisi.',
                    'valid_date' => 'Tanggal harus dalam format YYYY-MM-DD.',
                    'plusThreeDates' => 'Pengajuan harus minimal 3 hari sebelum tanggal yang diinginkan.',
                ]
            ],
            'tanggal_berakhir' => [
                'rules' => 'required|valid_date[Y-m-d]|offLimitRule[3]',
                'errors' => [
                    'required' => 'Tanggal berakhir ketidakhadiran wajib diisi.',
                    'valid_date' => 'Tanggal harus dalam format YYYY-MM-DD.',
                    'offLimitRule' => 'Durasi ketidakhadiran maksimal 3 bulan.'
                ]
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,application/pdf]',
                'errors' => [
                    'uploaded' => 'File PDF Surat Keterangan wajib diupload.',
                    'max_size' => 'File PDF harus berukuran kurang dari 2 MB',
                    'mime_in' => 'File harus berekstensi PDF',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/pengajuan-ketidakhadiran')->withInput();
        }

        $file = $this->request->getFile('file');
        $nama_file = 'SuratKeterangan-' . user()->username . '-' . date('Y-m-d-His') . '.pdf';
        $file->move(FCPATH . 'assets/file/surat_keterangan_ketidakhadiran/', $nama_file);

        $this->ketidakhadiranModel->save([
            'id_pegawai' => $this->request->getVar('id_pegawai'),
            'tipe_ketidakhadiran' => $this->request->getVar('tipe_ketidakhadiran'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_berakhir' => $this->request->getVar('tanggal_berakhir'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'file' => $nama_file,
            'status_pengajuan' => 'PENDING',
        ]);

        session()->setFlashdata('berhasil', 'Pengajuan Ketidakhadiran berhasil dikirim');
        return redirect()->to(base_url('/ketidakhadiran'));
    }

    public function edit($id)
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $data_pengajuan = $this->ketidakhadiranModel->where(['id' => $id])->get()->getRow();

        if (empty($data_pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pengajuan Tidak Ditemukan');
        }

        if ($data_pengajuan->status_pengajuan === 'REJECTED') {
            session()->setFlashdata('info', 'Status Pengajuan adalah REJECTED. Tidak bisa melakukan edit pengajuan. Silahkan membuat pengajuan baru.');
            return redirect()->to(base_url('/ketidakhadiran'));
        } else if ($data_pengajuan->status_pengajuan === 'APPROVED') {
            session()->setFlashdata('info', 'Status Pengajuan adalah APPROVED. Tidak bisa melakukan edit pengajuan. Silahkan membuat pengajuan baru.');
            return redirect()->to(base_url('/ketidakhadiran'));
        }

        $data = [
            'title' => 'Form Edit Pengajuan Ketidakhadiran',
            'user_profile' => $user_profile,
            'data_pengajuan' => $data_pengajuan,
        ];

        return view('ketidakhadiran/edit', $data);
    }

    public function update()
    {
        // cek validasi
        $rules = [
            'tipe_ketidakhadiran' => [
                'rules' => 'required|in_list[CUTI,IZIN,SAKIT]',
                'errors' => [
                    'required' => 'Mohon pilih tipe ketidakhadiran.',
                    'in_list' => 'Mohon pilih tipe ketidakhadiran yang tersedia.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon isi deskripsi untuk ketidakhadiran.',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required|valid_date[Y-m-d]|plusThreeDates',
                'errors' => [
                    'required' => 'Tanggal mulai ketidakhadiran wajib diisi.',
                    'valid_date' => 'Tanggal harus dalam format YYYY-MM-DD.',
                    'plusThreeDates' => 'Pengajuan cuti harus minimal 3 hari sebelum tanggal cuti yang diinginkan.'
                ]
            ],
            'tanggal_berakhir' => [
                'rules' => 'required|valid_date[Y-m-d]|offLimitRule[3]',
                'errors' => [
                    'required' => 'Tanggal berakhir ketidakhadiran wajib diisi.',
                    'valid_date' => 'Tanggal harus dalam format YYYY-MM-DD.',
                    'offLimitRule' => 'Durasi ketidakhadiran maksimal 3 bulan.'
                ]
            ],
            'file' => [
                'rules' => 'max_size[file,2048]|mime_in[file,application/pdf]',
                'errors' => [
                    'max_size' => 'Mohon upload file PDF berukuran kurang dari 2 MB',
                    'mime_in' => 'Mohon upload file berekstensi PDF',
                ]
            ]
        ];

        $id = $this->request->getPost('id');

        if (!$this->validate($rules)) {
            return redirect()->to('/ketidakhadiran/edit/' . $id)->withInput();
        }

        $file = $this->request->getFile('file');

        if ($file->getError() == 4) {
            $nama_file = $this->request->getVar('file_old');
        } else {
            $nama_file = 'SuratKeterangan-' . user()->username . '-' . date('Y-m-d-His') . '.pdf';
            $file->move(FCPATH . 'assets/file/surat_keterangan_ketidakhadiran/', $nama_file);

            unlink('assets/file/surat_keterangan_ketidakhadiran/' . $this->request->getVar('file_old'));
        }

        $this->ketidakhadiranModel->save([
            'id' => $this->request->getVar('id'),
            'id_pegawai' => $this->request->getVar('id_pegawai'),
            'tipe_ketidakhadiran' => $this->request->getVar('tipe_ketidakhadiran'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_berakhir' => $this->request->getVar('tanggal_berakhir'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'file' => $nama_file,
        ]);

        session()->setFlashdata('berhasil', 'Pengajuan Ketidakhadiran berhasil diedit');
        return redirect()->to(base_url('/ketidakhadiran'));
    }

    public function delete($id)
    {
        $data_pengajuan = $this->ketidakhadiranModel->find($id);

        if ($data_pengajuan['status_pengajuan'] === 'REJECTED') {
            session()->setFlashdata('info', 'Pengajuan Sudah DI-REJECT. Tidak bisa hapus pengajuan.');
            return redirect()->to(base_url('/ketidakhadiran'));
        } else if ($data_pengajuan['status_pengajuan'] === 'APPROVED') {
            session()->setFlashdata('info', 'Pengajuan Sudah DI-APPROVE. Tidak bisa melakukan hapus pengajuan.');
            return redirect()->to(base_url('/ketidakhadiran'));
        }

        $file = $data_pengajuan['file'];

        unlink('assets/file/surat_keterangan_ketidakhadiran/' . $file);
        $this->ketidakhadiranModel->delete($id);

        session()->setFlashdata('berhasil', 'Data Pengajuan Ketidakhadiran Berhasil Dihapus');
        return redirect()->to('/ketidakhadiran');
    }

    public function kelolaKetidakhadiran()
    {
        $this->ketidakhadiranModel->checkAndUpdateStatus();
        $currentPage = $this->request->getVar('page_ketidakhadiran') ? $this->request->getVar('page_ketidakhadiran') : 1;

        $user_profile = $this->usersModel->getUserInfo(user_id());
        $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran();

        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'bulan' => $this->request->getGet('bulan'),
            'tahun' => $this->request->getGet('tahun'),
            'status' => $this->request->getGet('status'),
            'tipe' => $this->request->getGet('tipe'),
        ];

        if (!empty($filter)) {
            $filter['bulan'] === '' ? date('m') : $filter['bulan'];
            $filter['tahun'] === '' ? date('Y') : $filter['tahun'];
            $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter);
        }

        if (empty($filter['bulan']) || empty($filter['tahun'])) {
            $data_bulan = date('Y-m');
        } else {
            $data_bulan = $filter['tahun'] . '-' . $filter['bulan'];
        }

        if (empty($filter['bulan'])) {
            $filter['bulan'] = date('m');
        }

        if (empty($filter['tahun'])) {
            $filter['tahun'] = date('Y');
        }

        $filtered = false;
        if (($filter['tahun'] !== date('Y') || $filter['bulan'] !== date('m')) || ($filter['status'] !== null && $filter['status'] !== '') || ($filter['tipe'] !== null && $filter['tipe'] !== '')) {
            $filtered = true;
        }

        $data_ketidakhadiran = $data_ketidakhadiran_pegawai['ketidakhadiran'];
        $pager = $data_ketidakhadiran_pegawai['links'];
        $total = $data_ketidakhadiran_pegawai['total'];
        $perPage = $data_ketidakhadiran_pegawai['perPage'];

        if ($this->ketidakhadiranModel->getMinYear()) {
            $tahun_mulai = $this->ketidakhadiranModel->getMinYear();
        } else {
            $tahun_mulai = date('Y');
        }

        $data = [
            'title' => 'Kelola Ketidakhadiran',
            'user_profile' => $user_profile,
            'data_ketidakhadiran' => $data_ketidakhadiran,
            'data_bulan' => $data_bulan,
            'currentPage' => $currentPage,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'tahun_mulai' => $tahun_mulai,
            'filter_bulan' => $filter['bulan'],
            'filter_tahun' => $filter['tahun'],
            'filter_status' => $filter['status'],
            'filter_tipe' => $filter['tipe'],
            'keyword' => $filter['keyword'],
            'isFiltered' => $filtered,
        ];

        return view('ketidakhadiran/kelola-pengajuan', $data);
    }

    public function pencarianDataKetidakhadiran()
    {
        $currentPage = $this->request->getVar('page_ketidakhadiran') ? $this->request->getVar('page_ketidakhadiran') : 1;
        $filter = [
            'keyword' => $this->request->getGet('keyword'),
            'bulan' => $this->request->getGet('bulan'),
            'tahun' => $this->request->getGet('tahun'),
            'status' => $this->request->getGet('status'),
            'tipe' => $this->request->getGet('tipe'),
        ];

        if (empty($filter['keyword'])) {
            $filter['keyword'] = '';
        }

        if (empty($filter['bulan']) || empty($filter['tahun'])) {
            $data_bulan = date('Y-m');
        } else {
            $data_bulan = $filter['tahun'] . '-' . $filter['bulan'];
        }

        $data = [
            'data_ketidakhadiran' => $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter)['ketidakhadiran'],
            'currentPage' => $currentPage,
            'pager' => $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter)['links'],
            'total' => $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter)['total'],
            'perPage' => $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter)['perPage'],
            'data_bulan' => $data_bulan,

        ];

        return view('ketidakhadiran/hasil-pencarian-data', $data);
    }

    public function kelolaKetidakhadiranExcel()
    {
        $filter = [
            'keyword' => $this->request->getPost('keyword'),
            'bulan' => $this->request->getPost('bulan'),
            'tahun' => $this->request->getPost('tahun'),
            'status' => $this->request->getPost('status'),
            'tipe' => $this->request->getPost('tipe'),
        ];
        if ($filter['bulan'] === '') {
            $filter['bulan'] = date('m');
        }
        if ($filter['bulan'] === '') {
            $filter['bulan'] = date('Y');
        }
        $data_ketidakhadiran_pegawai = $this->ketidakhadiranModel->getDataKetidakhadiran(false, $filter, true)['ketidakhadiran'];

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $bulan = DateTime::createFromFormat('Y-m-d', date('Y') . '-' . $filter['bulan'] . '-01');
        $nama_bulan = $bulan->format('F');

        if ($filter['tipe'] === '') {
            $filter['tipe'] = 'Semua Tipe';
        }

        if ($filter['status'] === '') {
            $filter['status'] = 'Semua Status';
        }

        $worksheet->setCellValue('A1', 'Laporan Ketidakhadiran');
        $worksheet->setCellValue('A3', 'Bulan');
        $worksheet->setCellValue('A4', 'Tahun');
        $worksheet->setCellValue('C3', $nama_bulan);
        $worksheet->setCellValue('C4', $filter['tahun']);
        $worksheet->setCellValue('E3', 'Tipe');
        $worksheet->setCellValue('E4', 'Status');
        $worksheet->setCellValue('F3', $filter['tipe']);
        $worksheet->setCellValue('F4', $filter['status']);
        $worksheet->setCellValue('A6', '#');
        $worksheet->setCellValue('B6', 'NIP');
        $worksheet->setCellValue('C6', 'NAMA PEGAWAI');
        $worksheet->setCellValue('D6', 'TIPE');
        $worksheet->setCellValue('E6', 'TANGGAL MULAI');
        $worksheet->setCellValue('F6', 'TANGGAL BERAKHIR');
        $worksheet->setCellValue('G6', 'TOTAL DURASI');
        $worksheet->setCellValue('H6', 'Status Pengajuan');
        $worksheet->setCellValue('I6', 'DESKRIPSI');

        $worksheet->mergeCells('A1:I1');
        $worksheet->mergeCells('A3:B3');
        $worksheet->mergeCells('A4:B4');

        $data_start_row = 7;
        $nomor = 1;

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];

        if (!empty($data_ketidakhadiran_pegawai)) {
            foreach ($data_ketidakhadiran_pegawai as $data) {
                $tanggal_mulai = new DateTime($data->tanggal_mulai);
                $tanggal_berakhir = new DateTime($data->tanggal_berakhir);

                $selisih = $tanggal_mulai->diff($tanggal_berakhir);
                $total_durasi = $selisih->days + 1;

                // Format string
                $total_durasi_format = sprintf("%d Hari", $total_durasi);

                $worksheet->setCellValue('A' . $data_start_row, $nomor++);
                $worksheet->setCellValue('B' . $data_start_row, $data->nip);
                $worksheet->setCellValue('C' . $data_start_row, $data->nama);
                $worksheet->setCellValue('D' . $data_start_row, $data->tipe_ketidakhadiran);
                $worksheet->setCellValue('E' . $data_start_row, $data->tanggal_mulai);
                $worksheet->setCellValue('F' . $data_start_row, $data->tanggal_berakhir);
                $worksheet->setCellValue('G' . $data_start_row, $total_durasi_format);
                $worksheet->setCellValue('H' . $data_start_row, $data->status_pengajuan);
                $worksheet->setCellValue('I' . $data_start_row, $data->deskripsi);

                $worksheet->getStyle('A' . $data_start_row - 1 . ':I' . $data_start_row)->applyFromArray($styleArray);
                $worksheet->getStyle('A' . $data_start_row - 1 . ':I' . $data_start_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

                $worksheet->getStyle('I')->getAlignment()->setWrapText(true);
                $data_start_row++;
            }
        } else {
            $worksheet->setCellValue('A' . $data_start_row, 'Tidak Ada Data');
            $worksheet->mergeCells('A' . $data_start_row . ':I' . $data_start_row);
            $worksheet->getStyle('A' . $data_start_row - 1 . ':I' . $data_start_row)->applyFromArray($styleArray);
        }

        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        foreach ($columns as $column) {
            $worksheet->getColumnDimension($column)->setAutoSize(true);
        }

        $worksheet->getStyle('A3:C4')->applyFromArray($styleArray);
        $worksheet->getStyle('E3:F4')->applyFromArray($styleArray);
        $worksheet->getStyle('A6:I6')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ffff00');
        $worksheet->getStyle('C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $worksheet->getColumnDimension('I')->setWidth(250, 'px');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="O-Present_Laporan Ketidakhadiran_' . $nama_bulan . '_' . $filter['tahun'] . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function kelolaKetidakhadiranAksi($id)
    {
        $user_profile = $this->usersModel->getUserInfo(user_id());
        $data_ketidakhadiran = $this->ketidakhadiranModel->findDataKetidakhadiran($id);

        if (empty($data_ketidakhadiran)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pengajuan Tidak Ditemukan');
        }

        if ($data_ketidakhadiran->tanggal_mulai <= date('Y-m-d')) {
            session()->setFlashdata('info', 'Tanggal ketidakhadiran sudah terlewat. Tidak dapat merubah status pengajuan.');
            return redirect()->to(base_url('/kelola-ketidakhadiran'));
        }

        $data = [
            'title' => 'Detail Ketidakhadiran',
            'user_profile' => $user_profile,
            'data_ketidakhadiran' => $data_ketidakhadiran,
        ];

        return view('ketidakhadiran/kelola-pengajuan-aksi', $data);
    }

    public function updateStatusKetidakhadiran()
    {
        $rules = [
            'status_pengajuan' => [
                'rules' => 'required|in_list[PENDING,APPROVED,REJECTED]',
                'errors' => [
                    'required' => 'Mohon isi status pengajuan.',
                    'in_list' => 'Mohon pilih status pengajuan yang tersedia.',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/kelola-ketidakhadiran/' . $this->request->getVar('id')))->withInput();
        }

        $this->ketidakhadiranModel->save([
            'id' => $this->request->getVar('id'),
            'status_pengajuan' => $this->request->getVar('status_pengajuan'),
        ]);

        session()->setFlashdata('berhasil', 'Status Pengajuan Ketidakhadiran berhasil diupdate');
        return redirect()->to(base_url('/kelola-ketidakhadiran'));
    }
}
