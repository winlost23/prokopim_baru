<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\BeritaFotoModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Berita_foto extends BaseController
{
    protected $halaman = 'backend/berita_foto/';
    //protected $model;

    public function __construct()
    {
        $this->beritafotoModel = new BeritaFotoModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Berita Foto';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['berita'] = $this->beritafotoModel
            ->orderby('berita_foto_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Berita Foto';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'berita_foto_judul' => [
                'rules' => 'required|is_unique[berita_foto.berita_foto_judul]',
                'errors' => [
                    'required' => '{field} Judul berita harus diisi',
                    'is_unique' => '{field} Judul berita sudah terdaftar'
                ]
            ],
            'berita_foto_deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi berita harus diisi',
                ]
            ],
            'berita_foto_gambar' => [
                'rules' => 'max_size[berita_foto_gambar,2224]|is_image[berita_foto_gambar]|mime_in[berita_foto_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'berita_foto_fotografer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Fotografer harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/berita_foto/add'))->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('berita_foto_gambar');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/berita', $namaSampul);
        }


        $slug = url_title($this->request->getVar('berita_foto_judul'), '-', true);
        $r = $this->beritafotoModel->save([
            'berita_foto_judul' => $this->request->getVar('berita_foto_judul'),
            'berita_foto_slug' => $slug,
            'berita_foto_deskripsi' => $this->request->getVar('berita_foto_deskripsi'),
            'berita_foto_gambar' => $namaSampul,
            'berita_foto_fotografer' => $this->request->getVar('berita_foto_fotografer'),
        ]);
        if ($r) {
            $this->notif('Berita Foto Baru Berhasil disimpan.');
        } else {
            $this->notif('Berita Foto Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita_foto'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita Foto';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['berita'] = $this->beritafotoModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $beritaLama = $this->beritafotoModel->getSlug($this->request->getPost('berita_foto_slug'));
        if ($beritaLama->berita_foto_judul == $this->request->getPost('berita_foto_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[berita_foto.berita_foto_judul]';
        }
        if (!$this->validate([
            'berita_foto_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'berita_foto_gambar' => [
                'rules' => 'max_size[berita_foto_gambar,2224]|is_image[berita_foto_gambar]|mime_in[berita_foto_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/berita/edit/') . $this->request->getPost('berita_detail_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('berita_foto_gambar');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('berita_gambar_lama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img/berita', $namaSampul);
            //hapus file gambar lama
            unlink('img/berita/' . $this->request->getPost('berita_gambar_lama'));
        }

        $slug = url_title($this->request->getPost('berita_foto_judul'), '-', true);
        $r = $this->beritafotoModel->save([
            'berita_foto_id' => $id,
            'berita_foto_judul' => $this->request->getPost('berita_foto_judul'),
            'berita_foto_slug' => $slug,
            'berita_foto_deskripsi' => $this->request->getPost('berita_foto_deskripsi'),
            'berita_foto_gambar' => $namaSampul,
            'berita_foto_fotografer' => $this->request->getPost('berita_foto_fotografer'),
        ]);

        if ($r) {
            $this->notif('Berita Foto Berhasil diubah.');
        } else {
            $this->notif('Berita Foto Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita_foto'));
    }

    public function delete($id)
    {
        $r = $this->beritafotoModel->delete($id);
        if ($r) {
            $this->notif('Berita Foto Berhasil dihapus.');
        } else {
            $this->notif('Berita Foto Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/berita_foto'));
    }
}
