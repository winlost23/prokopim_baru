<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\SliderModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Slider extends BaseController
{
    protected $halaman = 'backend/slider/';
    //protected $model;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Slider';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['slider'] = $this->sliderModel
            ->orderby('slider_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Slider';

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
            'slider_judul_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Text 1 slider harus diisi',
                ]
            ],
            'slider_judul_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Text 2 slider harus diisi',
                ]
            ],
            'slider_gambar' => [
                'rules' => 'max_size[slider_gambar,1024]|is_image[slider_gambar]|mime_in[slider_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/slider/add'))->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('slider_gambar');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/slider', $namaSampul);
        }

        $r = $this->sliderModel->save([
            'slider_judul_1' => $this->request->getPost('slider_judul_1'),
            'slider_judul_2' => $this->request->getPost('slider_judul_2'),
            'slider_gambar' => $namaSampul,
        ]);
        if ($r) {
            $this->notif('Slider Baru Berhasil disimpan.');
        } else {
            $this->notif('Slider Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/slider'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Slider';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['slider'] = $this->sliderModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'slider_judul_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Text 1 slider harus diisi',
                ]
            ],
            'slider_judul_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Text 2 slider harus diisi',
                ]
            ],
            'slider_gambar' => [
                'rules' => 'max_size[slider_gambar,1024]|is_image[slider_gambar]|mime_in[slider_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/slider/edit/') . $this->request->getPost('slider_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('slider_gambar');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('slider_gambar_lama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img/slider', $namaSampul);
            //hapus file gambar lama
            unlink('img/slider/' . $this->request->getPost('slider_gambar_lama'));
        }

        $r = $this->sliderModel->save([
            'slider_id' => $id,
            'slider_judul_1' => $this->request->getPost('slider_judul_1'),
            'slider_judul_2' => $this->request->getPost('slider_judul_2'),
            'slider_gambar' => $namaSampul,
        ]);

        if ($r) {
            $this->notif('Slider Berhasil diubah.');
        } else {
            $this->notif('Slider Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/slider'));
    }

    public function delete($id)
    {
        $r = $this->sliderModel->delete($id);
        if ($r) {
            $this->notif('Slider Berhasil dihapus.');
        } else {
            $this->notif('Slider Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/slider'));
    }
}
