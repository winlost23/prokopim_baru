<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;
use App\Models\VideoKegiatanModel;

class Video_kegiatan extends BaseController
{
    protected $halaman = 'backend/video_kegiatan/';
    //protected $model;

    public function __construct()
    {
        $this->videokegiatanModel = new VideoKegiatanModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Video Kegiatan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['video'] = $this->videokegiatanModel
            ->orderby('video_kegiatan_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Video Kegiatan';

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
            'video_kegiatan_judul' => [
                'rules' => 'required|is_unique[video_kegiatan.video_kegiatan_judul]',
                'errors' => [
                    'required' => '{field} Judul video harus diisi',
                    'is_unique' => '{field} Judul video sudah terdaftar'
                ]
            ],
            'video_kegiatan_link' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Link video harus diisi',
                ]
            ],
            'video_kegiatan_foto' => [
                'rules' => 'max_size[video_kegiatan_foto,2224]|is_image[video_kegiatan_foto]|mime_in[video_kegiatan_foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'video_kegiatan_videografer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Videografer harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/video_kegiatan/add'))->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('video_kegiatan_foto');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/berita', $namaSampul);
        }


        $slug = url_title($this->request->getVar('video_kegiatan_judul'), '-', true);
        $r = $this->videokegiatanModel->save([
            'video_kegiatan_judul' => $this->request->getVar('video_kegiatan_judul'),
            'video_kegiatan_slug' => $slug,
            'video_kegiatan_link' => $this->request->getVar('video_kegiatan_link'),
            'video_kegiatan_foto' => $namaSampul,
            'video_kegiatan_videografer' => $this->request->getVar('video_kegiatan_videografer'),
        ]);
        if ($r) {
            $this->notif('Video Kegiatan Baru Berhasil disimpan.');
        } else {
            $this->notif('Video Kegiatan Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/video_kegiatan'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita Foto';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['video'] = $this->videokegiatanModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $beritaLama = $this->videokegiatanModel->getSlug($this->request->getPost('video_kegiatan_slug'));
        if ($beritaLama->video_kegiatan_judul == $this->request->getPost('video_kegiatan_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[video_kegiatan.video_kegiatan_judul]';
        }
        if (!$this->validate([
            'video_kegiatan_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'video_kegiatan_foto' => [
                'rules' => 'max_size[video_kegiatan_foto,2224]|is_image[video_kegiatan_foto]|mime_in[video_kegiatan_foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/berita/edit/') . $this->request->getPost('video_kegiatan_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('video_kegiatan_foto');
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

        $slug = url_title($this->request->getPost('video_kegiatan_judul'), '-', true);
        $r = $this->videokegiatanModel->save([
            'video_kegiatan_id' => $id,
            'video_kegiatan_judul' => $this->request->getPost('video_kegiatan_judul'),
            'video_kegiatan_slug' => $slug,
            'video_kegiatan_link' => $this->request->getPost('video_kegiatan_link'),
            'video_kegiatan_foto' => $namaSampul,
            'video_kegiatan_videografer' => $this->request->getPost('video_kegiatan_videografer'),
        ]);

        if ($r) {
            $this->notif('Video Kegiatan Berhasil diubah.');
        } else {
            $this->notif('Video Kegiatan Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/video_kegiatan'));
    }

    public function delete($id)
    {
        $r = $this->videokegiatanModel->delete($id);
        if ($r) {
            $this->notif('Video Kegiatan Berhasil dihapus.');
        } else {
            $this->notif('Video Kegiatan Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/video_kegiatan'));
    }
}
