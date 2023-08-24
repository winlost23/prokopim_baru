<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Pengaturan extends BaseController
{
    protected $halaman = 'backend/pengaturan/';
    //protected $model;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
        $this->userModel = new User();
    }

    public function index()
    {
        $data['title'] = 'Pengaturan';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'pengaturan_alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Alamat harus diisi',
                ]
            ],
            'pengaturan_logo_header' => [
                'rules' => 'max_size[pengaturan_logo_header,1024]|is_image[pengaturan_logo_header]|mime_in[pengaturan_logo_header,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'pengaturan_favicon' => [
                'rules' => 'max_size[pengaturan_favicon,1024]|is_image[pengaturan_favicon]|mime_in[pengaturan_favicon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'pengaturan_banner' => [
                'rules' => 'max_size[pengaturan_banner,1024]|is_image[pengaturan_banner]|mime_in[pengaturan_banner,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'pengaturan_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Telp harus diisi',
                ]
            ],
            'pengaturan_fax' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                ]
            ],
            'pengaturan_email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Email harus diisi',
                    'valid_email' => '{field} Email yang di input salah',
                ]
            ],
            'pengaturan_footer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/pengaturan/'))->withInput();
        }

        //Logo Header
        $fileSampulHeader = $this->request->getFile('pengaturan_logo_header');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampulHeader->getError() == 4) {
            $namaSampulHeader = $this->request->getPost('pengaturan_logo_header_lama');
        } else {
            $namaSampulHeader = $fileSampulHeader->getRandomName();
            //dd($namaSampul);
            //pindahkan gambar
            $fileSampulHeader->move('img/', $namaSampulHeader);
            //hapus file gambar lama
            unlink('img/' . $this->request->getPost('pengaturan_logo_header_lama'));
        }
        //end Logo Header

        //Favicon
        $fileSampulFavicon = $this->request->getFile('pengaturan_favicon');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampulFavicon->getError() == 4) {
            $namaSampulFavicon = $this->request->getPost('pengaturan_favicon_lama');
        } else {
            $namaSampulFavicon = $fileSampulFavicon->getRandomName();
            //dd($namaSampul);
            //pindahkan gambar
            $fileSampulFavicon->move('img/', $namaSampulFavicon);
            //hapus file gambar lama
            unlink('img/' . $this->request->getPost('pengaturan_favicon_lama'));
        }
        //end Favicon
        //Banner
        $fileSampulBanner = $this->request->getFile('pengaturan_banner');
        //cek gambar, apakah tetap gambar lama
        if ($fileSampulBanner->getError() == 4) {
            $namaSampulBanner = $this->request->getPost('pengaturan_banner_lama');
        } else {
            $namaSampulBanner = $fileSampulBanner->getRandomName();
            //dd($namaSampul);
            //pindahkan gambar
            $fileSampulBanner->move('img/', $namaSampulBanner);
            //hapus file gambar lama
            unlink('img/' . $this->request->getPost('pengaturan_banner_lama'));
        }
        //end Banner
        //dd($namaSampul);

        $r = $this->pengaturanModel->save([
            'pengaturan_id' => $id,

            'pengaturan_alamat' => $this->request->getPost('pengaturan_alamat'),
            'pengaturan_telp' => $this->request->getPost('pengaturan_telp'),
            'pengaturan_fax' => $this->request->getPost('pengaturan_fax'),
            'pengaturan_email' => $this->request->getPost('pengaturan_email'),
            'pengaturan_facebook' => $this->request->getPost('pengaturan_facebook'),
            'pengaturan_twitter' => $this->request->getPost('pengaturan_twitter'),
            'pengaturan_instagram' => $this->request->getPost('pengaturan_instagram'),
            'pengaturan_youtube' => $this->request->getPost('pengaturan_youtube'),
            'pengaturan_footer' => $this->request->getPost('pengaturan_footer'),
            'pengaturan_logo_header' => $namaSampulHeader,
            'pengaturan_favicon' => $namaSampulFavicon,
            'pengaturan_banner' => $namaSampulBanner,
        ]);

        if ($r) {
            $this->notif('Pengaturan Berhasil diubah.');
        } else {
            $this->notif('Pengaturan Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/pengaturan'));
    }
}
