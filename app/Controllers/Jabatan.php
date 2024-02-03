<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Models\UsersModel;

class Jabatan extends BaseController
{
    protected $usersModel;
    protected $jabatanModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index(): string
    {
        $jabatanModel = $this->jabatanModel->getJabatan();

        $currentPage = $this->request->getVar('page_jabatan') ? $this->request->getVar('page_jabatan') : 1;
        $keyword = $this->request->getGet('keyword');
        if (!empty($keyword)) {
            $jabatanModel = $this->jabatanModel->getJabatan(false, $keyword);
        }
        if (empty($keyword)) {
            $keyword = '';
        }

        $data_jabatan = $jabatanModel['jabatan'];
        $pager = $jabatanModel['links'];
        $total = $jabatanModel['total'];
        $perPage = $jabatanModel['perPage'];

        $data = [
            'title' => 'Data Jabatan',
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'data_jabatan' => $data_jabatan,
            'currentPage' => $currentPage,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'keyword' => $keyword,
        ];

        return view('jabatan/index', $data);
    }

    public function pencarianJabatan()
    {
        $currentPage = $this->request->getVar('page_jabatan') ? $this->request->getVar('page_jabatan') : 1;

        $keyword = $this->request->getGet('keyword');
        if (empty($keyword)) {
            $keyword = '';
        }

        $data = [
            'data_jabatan' => $this->jabatanModel->getJabatan(false, $keyword)['jabatan'],
            'currentPage' => $currentPage,
            'pager' => $this->jabatanModel->getJabatan(false, $keyword)['links'],
            'total' => $this->jabatanModel->getJabatan(false, $keyword)['total'],
            'perPage' => $this->jabatanModel->getJabatan(false, $keyword)['perPage'],
        ];

        return view('jabatan/hasil-pencarian', $data);
    }

    public function store()
    {
        $rules = [
            'jabatan' => [
                'rules' => 'required|is_unique[jabatan.jabatan]',
                'errors' => [
                    'required' => 'mohon isi nama jabatan baru',
                    'is_unique' => 'nama jabatan sudah terdaftar',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/jabatan')->withInput();
        }

        $newJabatan = $this->request->getVar('jabatan');
        $slug = url_title($newJabatan, '-', true);

        $this->jabatanModel->save([
            'jabatan' => $newJabatan,
            'slug' => $slug,
        ]);

        session()->setFlashdata('berhasil', 'Data Jabatan ' . $newJabatan . ' Berhasil Ditambahkan');
        return redirect()->to('/jabatan');
    }

    public function edit($slug)
    {
        $data_jabatan = $this->jabatanModel->getJabatan($slug)['jabatan'];

        if (empty($data_jabatan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Jabatan ' . $slug . ' Tidak Ditemukan');
        }

        $data = [
            'title' => 'Edit Data Jabatan',
            'user_profile' => $this->usersModel->getUserInfo(user_id()),
            'jabatan' => $data_jabatan,
        ];

        return view('jabatan/edit', $data);
    }

    public function update()
    {
        $rules = [
            'jabatan' => [
                'rules' => 'required|is_unique[jabatan.jabatan]',
                'errors' => [
                    'required' => 'mohon isi nama jabatan baru',
                    'is_unique' => 'nama jabatan sudah terdaftar',
                ]
            ],
        ];

        $id = $this->request->getVar('id');
        $slug = $this->request->getVar('slug');
        if (!$this->validate($rules)) {
            return redirect()->to('/jabatan/' . $slug)->withInput();
        }

        $jabatan = $this->request->getVar('jabatan');
        $slug = url_title($jabatan, '-', true);

        $this->jabatanModel->save([
            'id' => $id,
            'jabatan' => $jabatan,
            'slug' => $slug,
        ]);

        session()->setFlashdata('berhasil', 'Data Jabatan ' . $jabatan . ' Berhasil Diupdate');
        return redirect()->to('/jabatan');
    }

    public function delete($id)
    {
        $this->jabatanModel->delete($id);

        session()->setFlashdata('berhasil', 'Data Jabatan Berhasil Dihapus');
        return redirect()->to('/jabatan');
    }
}
