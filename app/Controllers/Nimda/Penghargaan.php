<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\PidatoDetailModel;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\PenghargaanModel;
use App\Models\PidatoPantunModel;
use App\Models\User;

class Penghargaan extends BaseController
{
    protected $halaman = 'backend/penghargaan/';
    //protected $model;

    public function __construct()
    {
        $this->penghargaanModel = new PenghargaanModel();
        $this->ketegoriModel = new KategoriModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Penghargaan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['penghargaan'] = $this->penghargaanModel
            ->join('kategori', 'penghargaan.kategori_id = kategori.kategori_id')
            ->orderby('penghargaan.penghargaan_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Penghargaan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->orderby('kategori_judul', 'asc')->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'penghargaan_judul' => [
                'rules' => 'required|is_unique[penghargaan.penghargaan_judul]',
                'errors' => [
                    'required' => '{field} Judul penghargaan harus diisi',
                    'is_unique' => '{field} Judul penghargaan sudah terdaftar'
                ]
            ],
            'penghargaan_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi penghargaan harus diisi',
                ]
            ],
            'penghargaan_gambar' => [
                'rules' => 'max_size[penghargaan_gambar,2224]|is_image[penghargaan_gambar]|mime_in[penghargaan_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/penghargaan/add'))->withInput();
        }

        //ambil gambar
        $fileSampul = $this->request->getFile('penghargaan_gambar');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/berita', $namaSampul);
        }

        $slug = url_title($this->request->getVar('penghargaan_judul'), '-', true);
        $r = $this->penghargaanModel->save([
            'kategori_id' => $this->request->getVar('kategori_id'),
            'penghargaan_judul' => $this->request->getVar('penghargaan_judul'),
            'penghargaan_slug' => $slug,
            'penghargaan_gambar' => $namaSampul,
            'penghargaan_isi' => $this->request->getVar('penghargaan_isi'),
        ]);
        if ($r) {
            $this->notif('Penghargaan Baru Berhasil disimpan.');
        } else {
            $this->notif('Penghargaan Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/penghargaan'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->orderby('kategori_judul', 'asc')->findAll();
        $data['penghargaan'] = $this->penghargaanModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $pidatoLama = $this->penghargaanModel->getSlug($this->request->getPost('penghargaan_slug'));
        if ($pidatoLama->penghargaan_judul == $this->request->getPost('penghargaan_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[penghargaan.penghargaan_judul]';
        }
        if (!$this->validate([
            'penghargaan_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'penghargaan_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi penghargaan harus diisi',
                ]
            ],
            'penghargaan_gambar' => [
                'rules' => 'max_size[penghargaan_gambar,2224]|is_image[penghargaan_gambar]|mime_in[penghargaan_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/penghargaan/edit/') . $this->request->getPost('penghargaan_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('penghargaan_gambar');
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

        $slug = url_title($this->request->getPost('penghargaan_judul'), '-', true);
        $r = $this->penghargaanModel->save([
            'penghargaan_id' => $id,
            'kategori_id' => $this->request->getVar('kategori_id'),
            'penghargaan_judul' => $this->request->getVar('penghargaan_judul'),
            'penghargaan_slug' => $slug,
            'penghargaan_gambar' => $namaSampul,
            'penghargaan_isi' => $this->request->getVar('penghargaan_isi'),
        ]);

        if ($r) {
            $this->notif('Penghargaan Berhasil diubah.');
        } else {
            $this->notif('Penghargaan Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/penghargaan'));
    }

    public function delete($id)
    {
        $r = $this->penghargaanModel->delete($id);
        if ($r) {
            $this->notif('Penghargaan Berhasil dihapus.');
        } else {
            $this->notif('Penghargaan Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/penghargaan'));
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $urls = $this->request->uri->getSegment(4);
        $def = new Definisi();
        $data['segmentasi'] = $urls;
        $data['kategori'] = $this->ketegoriModel
            ->orderby('kategori_judul', 'asc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();


        return view($this->halaman . 'kategori', $data);
    }

    public function savekategori()
    {
        // validation input
        if (!$this->validate([
            'kategori_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul kategori harus diisi'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/penghargaan/kategori/'))->withInput();
        }

        $slug = url_title($this->request->getPost('kategori_judul'), '-', true);
        $r = $this->ketegoriModel->save([
            //'users_id' => session()->userid,
            'kategori_judul' => $this->request->getPost('kategori_judul'),
            'kategori_slug' => $slug,
        ]);
        if ($r) {
            $this->notif('Kategori Berhasil disimpan.');
        } else {
            $this->notif('Kategori Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/penghargaan/kategori/'));
    }

    public function kategori_edit($id)
    {
        $data['title'] = 'Edit Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel
            ->orderby('kategori_judul', 'asc')
            ->findAll();
        $data['kategori_edit'] = $this->ketegoriModel
            ->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'kategori_edit', $data);
    }

    public function kategori_update()
    {

        if (!$this->validate([
            'kategori_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul kategori harus diisi',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/penghargaan/kategori_edit/') . $this->request->getPost('kategori_id'))->withInput();
        }
        $slug = url_title($this->request->getPost('kategori_judul'), '-', true);
        $r = $this->ketegoriModel->save([
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kategori_judul' => $this->request->getPost('kategori_judul'),
            'kategori_slug' => $slug,
        ]);

        if ($r) {
            $this->notif('Kategori Berhasil diubah.');
        } else {
            $this->notif('Kategori Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/penghargaan/kategori/'));
    }

    public function kategori_delete($id)
    {
        $r = $this->ketegoriModel->delete($id);
        if ($r) {
            $this->notif('Kategori Berhasil dihapus.');
        } else {
            $this->notif('Kategori Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/penghargaan/kategori/'));
    }
}
