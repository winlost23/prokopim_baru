<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\GaleriModel;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\GaleriKegiatanFotoModel;
use App\Models\GaleriKegiatanModel;
use App\Models\PengaturanModel;
use App\Models\User;

class Galeri_kegiatan extends BaseController
{
    protected $halaman = 'backend/galeri_kegiatan/';
    //protected $model;

    public function __construct()
    {
        $this->galerikegiatanModel = new GaleriKegiatanModel();
        $this->galerikegiatanfotoModel = new GaleriKegiatanFotoModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Galeri Kegiatan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        // $data['galeri'] = $this->galeriModel->getAll();
        $data['galeri'] = $this->galerikegiatanModel
            ->orderby('galeri_kegiatan_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Galeri Kegiatan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['foto'] = $this->galerikegiatanfotoModel
            ->join('galeri_kegiatan', 'galeri_kegiatan.galeri_kegiatan_id = galeri_kegiatan_foto.galeri_kegiatan_id')
            ->where('galeri_kegiatan_foto.galeri_kegiatan_id', $id)
            ->orderby('galeri_kegiatan_foto.galeri_kegiatan_foto_id', 'desc')
            ->findAll();
        $data['galeri'] = $this->galerikegiatanModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'detail', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Galeri Kegiatan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function addDetail($id)
    {
        $data['title'] = 'Tambah Detail Foto Galeri';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['galeri'] = $this->galerikegiatanModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'adddetail', $data);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'galeri_kegiatan_judul' => [
                'rules' => 'required|is_unique[galeri_kegiatan.galeri_kegiatan_judul]',
                'errors' => [
                    'required' => '{field} Judul galeri harus diisi',
                    'is_unique' => '{field} Judul galeri sudah terdaftar'
                ]
            ],
            'galeri_kegiatan_fotografer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Nama fotografer harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/galeri_kegiatan/add'))->withInput();
        }

        $slug = url_title($this->request->getPost('galeri_kegiatan_judul'), '-', true);
        $r = $this->galerikegiatanModel->save([
            'galeri_kegiatan_judul' => $this->request->getPost('galeri_kegiatan_judul'),
            'galeri_kegiatan_slug' => $slug,
            'galeri_kegiatan_fotografer' => $this->request->getPost('galeri_kegiatan_fotografer'),
        ]);
        if ($r) {
            $this->notif('Galeri Kegiatan Baru Berhasil disimpan.');
        } else {
            $this->notif('Galeri Kegiatan Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/galeri_kegiatan'));
    }

    public function saveDetail($id)
    {
        // validation input
        if (!$this->validate([
            'galeri_kegiatan_foto_file' => [
                'rules' => 'max_size[galeri_kegiatan_foto_file,2224]|is_image[galeri_kegiatan_foto_file]|mime_in[galeri_kegiatan_foto_file,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/galeri/addDetail/') . $id)->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('galeri_kegiatan_foto_file');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/galeri', $namaSampul);
        }

        $r = $this->galerikegiatanfotoModel->save([
            'galeri_kegiatan_id' => $id,
            'galeri_kegiatan_foto_file' => $namaSampul,
        ]);
        if ($r) {
            $this->notif('Foto Galeri Baru Berhasil disimpan.');
        } else {
            $this->notif('Foto Galeri Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/galeri_kegiatan/detail/') . $id);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Galeri';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['galeri'] = $this->galerikegiatanModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function editDetail($idGaleri, $idFoto)
    {
        $data['title'] = 'Edit Detail Galeri';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['galeri'] = $this->galerikegiatanModel->find($idGaleri);
        $data['foto'] = $this->galerikegiatanfotoModel->find($idFoto);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'editdetail', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'galeri_kegiatan_judul' => [
                'rules' => 'required|is_unique[galeri_kegiatan.galeri_kegiatan_judul]',
                'errors' => [
                    'required' => '{field} Judul galeri harus diisi',
                    'is_unique' => '{field} Judul galeri sudah terdaftar'
                ]
            ],
            'galeri_kegiatan_fotografer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Nama fotografer harus diisi',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/galeri_kegiatan/edit/') . $this->request->getPost('galeri_kegiatan_id'))->withInput();
        }

        $slug = url_title($this->request->getPost('galeri_kegiatan_judul'), '-', true);
        $r = $this->galerikegiatanModel->save([
            'galeri_kegiatan_id' => $id,
            'galeri_kegiatan_judul' => $this->request->getPost('galeri_kegiatan_judul'),
            'kategori_slug' => $slug,
            'galeri_kegiatan_fotografer' => $this->request->getPost('galeri_kegiatan_fotografer'),
        ]);

        if ($r) {
            $this->notif('Galeri Berhasil diubah.');
        } else {
            $this->notif('Galeri Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/galeri_kegiatan'));
    }

    public function updateDetail($idGaleri, $idFoto)
    {
        if (!$this->validate([
            'galeri_kegiatan_foto_file' => [
                'rules' => 'max_size[galeri_kegiatan_foto_file,2224]|is_image[galeri_kegiatan_foto_file]|mime_in[galeri_kegiatan_foto_file,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/galeri_kegiatan/editDetail/') . $idGaleri . '/' . $idFoto)->withInput();
        }

        $fileSampul = $this->request->getFile('galeri_kegiatan_foto_file');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('galeri_gambar_lama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img/galeri', $namaSampul);
            //hapus file gambar lama
            unlink('img/galeri/' . $this->request->getPost('galeri_gambar_lama'));
        }

        $r = $this->galerikegiatanfotoModel->save([
            'galeri_kegiatan_foto_id' => $idFoto,
            'galeri_kegiatan_foto_file' => $namaSampul,
        ]);

        if ($r) {
            $this->notif('Foto Galeri Berhasil diubah.');
        } else {
            $this->notif('Foto Galeri Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/galeri_kegiatan/detail/') . $idGaleri);
    }

    public function delete($id)
    {
        $r = $this->galerikegiatanModel->delete($id);
        if ($r) {
            $this->notif('Galeri Berhasil dihapus.');
        } else {
            $this->notif('Galeri Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/galeri_kegiatan'));
    }

    public function deleteDetail($idGaleri, $idFoto)
    {
        $r = $this->galerikegiatanfotoModel->delete($idFoto);
        if ($r) {
            $this->notif('Foto Galeri Berhasil dihapus.');
        } else {
            $this->notif('Foto Galeri Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/galeri_kegiatan/detail/') . $idGaleri);
    }
}
