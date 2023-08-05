<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\InfoModel;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Info extends BaseController
{
    protected $halaman = 'backend/info/';
    //protected $model;

    public function __construct()
    {
        $this->infoModel = new InfoModel();
        $this->ketegoriModel = new KategoriModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function download($files)
    {
        header("Content-Disposition: attachment; filename=" . basename($files));
        header("Content-Type: application/octet-stream;");
        readfile("file/" . $files);
    }

    public function index()
    {
        $data['title'] = 'Info';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        // $data['info'] = $this->infoModel->getAll();
        $data['info'] = $this->infoModel
            ->join('users', 'info.users_id = users.users_id')
            ->join('kategori', 'info.kategori_id = kategori.kategori_id')
            ->orderby('info.info_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Info';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->where('kategori_jenis', 'info')->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'info_judul' => [
                'rules' => 'required|is_unique[info.info_judul]',
                'errors' => [
                    'required' => '{field} Judul info harus diisi',
                    'is_unique' => '{field} Judul info sudah terdaftar'
                ]
            ],
            'info_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi info harus diisi',
                ]
            ],
            'info_gambar' => [
                'rules' => 'max_size[info_gambar,2024]|is_image[info_gambar]|mime_in[info_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'info_file' => [
                'rules' => 'max_size[info_file,10000]|mime_in[info_file,application/pdf,application/zip,application/rar,application/x-compressed]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 9M',
                    'mime_in' => 'File yang bisa di upload hanya "PDF, ZIP, RAR"'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/info/add'))->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('info_gambar');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/info', $namaSampul);
        }
        //ambil file
        $fileUpload = $this->request->getFile('info_file');
        //generate nama file random
        $namaFile = rand(111, 999) . '-' . $fileUpload->getName();
        //pindahkan file ke folder file
        $fileUpload->move('file', $namaFile);


        $slug = url_title($this->request->getVar('info_judul'), '-', true);
        $r = $this->infoModel->save([
            'users_id' => session()->userid,
            'kategori_id' => $this->request->getVar('kategori_id'),
            'info_judul' => $this->request->getVar('info_judul'),
            'info_slug' => $slug,
            'info_isi' => $this->request->getVar('info_isi'),
            'info_gambar' => $namaSampul,
            'info_file' => $namaFile,
        ]);
        if ($r) {
            $this->notif('Info Baru Berhasil disimpan.');
        } else {
            $this->notif('Info Gagal disimpan.', 'error');
        }


        return redirect()->to(site_url('/nimda/info'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Info';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->where('kategori_jenis', 'info')->findAll();
        $data['info'] = $this->infoModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $infoLama = $this->infoModel->getSlug($this->request->getPost('info_slug'));
        if ($infoLama->info_judul == $this->request->getPost('info_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[info.info_judul]';
        }
        if (!$this->validate([
            'info_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'info_gambar' => [
                'rules' => 'max_size[info_gambar,1024]|is_image[info_gambar]|mime_in[info_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/info/edit/') . $this->request->getPost('info_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('info_gambar');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('info_gambar_lama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img/info', $namaSampul);
            //hapus file gambar lama
            unlink('img/info/' . $this->request->getPost('info_gambar_lama'));
        }

        $slug = url_title($this->request->getPost('info_judul'), '-', true);
        $r = $this->infoModel->save([
            'info_id' => $id,
            'users_id' => session()->userid,
            'kategori_id' => $this->request->getPost('kategori_id'),
            'info_judul' => $this->request->getPost('info_judul'),
            'info_slug' => $slug,
            'info_isi' => $this->request->getPost('info_isi'),
            'info_gambar' => $namaSampul,
        ]);

        if ($r) {
            $this->notif('Info Berhasil diubah.');
        } else {
            $this->notif('Info Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/info'));
    }

    public function delete($id)
    {
        $r = $this->infoModel->delete($id);
        if ($r) {
            $this->notif('Info Berhasil dihapus.');
        } else {
            $this->notif('Info Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/info'));
    }
}
