<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\BeritaDetailModel;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Berita extends BaseController
{
    protected $halaman = 'backend/berita/';
    //protected $model;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->beritadetailModel = new BeritaDetailModel();
        $this->ketegoriModel = new KategoriModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Berita';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        // $data['berita'] = $this->beritaModel->getAll();
        $data['berita'] = $this->beritadetailModel
            ->join('berita', 'berita_detail.berita_id = berita.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Berita';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->beritaModel->orderby('berita_judul', 'asc')->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $urls = $this->request->uri->getSegment(4);
        $def = new Definisi();
        $data['segmentasi'] = $urls;
        $data['kategori'] = $this->beritaModel
            ->orderby('berita_judul', 'asc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();


        return view($this->halaman . 'kategori', $data);
    }

    public function savekategori()
    {
        // validation input
        if (!$this->validate([
            'berita_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul kategori harus diisi'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/berita/kategori/'))->withInput();
        }


        $slug = url_title($this->request->getPost('berita_judul'), '-', true);
        $r = $this->beritaModel->save([
            //'users_id' => session()->userid,
            'berita_judul' => $this->request->getPost('berita_judul'),
            'berita_slug' => $slug,
        ]);
        if ($r) {
            $this->notif('Kategori Berita Berhasil disimpan.');
        } else {
            $this->notif('Kategori Berita Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita/kategori/'));
    }

    public function kategori_edit($id)
    {
        $data['title'] = 'Edit Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['segmentasi'] = $kategori;
        $data['kategori'] = $this->beritaModel
            ->findAll();
        $data['kategori_edit'] = $this->beritaModel
            ->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'kategori_edit', $data);
    }

    public function kategori_update()
    {

        if (!$this->validate([
            'berita_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul berita harus diisi',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/berita/kategori_edit/') . $this->request->getPost('berita_id'))->withInput();
        }
        $slug = url_title($this->request->getPost('berita_judul'), '-', true);
        $r = $this->beritaModel->save([
            'berita_id' => $this->request->getPost('berita_id'),
            'berita_judul' => $this->request->getPost('berita_judul'),
            'berita_slug' => $slug,
        ]);

        if ($r) {
            $this->notif('Kategori Berita Berhasil diubah.');
        } else {
            $this->notif('Kategori Berita Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita/kategori/'));
    }

    public function kategori_delete($id)
    {
        $r = $this->beritaModel->delete($id);
        if ($r) {
            $this->notif('Berita Berhasil dihapus.');
        } else {
            $this->notif('Berita Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/berita/kategori/'));
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'berita_detail_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Judul berita harus diisi',
                ]
            ],
            'berita_detail_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi berita harus diisi',
                ]
            ],
            'berita_detail_gambar' => [
                'rules' => 'max_size[berita_detail_gambar,2224]|is_image[berita_detail_gambar]|mime_in[berita_detail_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2M',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/berita/add'))->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('berita_detail_gambar');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img/berita', $namaSampul);
        }


        $slug = url_title($this->request->getVar('berita_detail_judul'), '-', true);
        $r = $this->beritadetailModel->save([
            'berita_id' => $this->request->getVar('berita_id'),
            'berita_detail_judul' => $this->request->getVar('berita_detail_judul'),
            'berita_detail_slug' => $slug,
            'berita_detail_isi' => $this->request->getVar('berita_detail_isi'),
            'berita_detail_gambar' => $namaSampul,
            'berita_detail_editor' => $this->request->getVar('berita_detail_editor'),
            'berita_detail_rep' => $this->request->getVar('berita_detail_rep'),
            'berita_detail_foto' => $this->request->getVar('berita_detail_foto'),
        ]);
        if ($r) {
            $this->notif('Berita Baru Berhasil disimpan.');
        } else {
            $this->notif('Berita Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->beritaModel->orderby('berita_judul', 'asc')->findAll();
        $data['berita'] = $this->beritadetailModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $beritaLama = $this->beritadetailModel->getSlug($this->request->getPost('berita_detail_slug'));
        if ($beritaLama->berita_detail_judul == $this->request->getPost('berita_detail_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[berita_detail.berita_detail_judul]';
        }
        if (!$this->validate([
            'berita_detail_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'berita_detail_gambar' => [
                'rules' => 'max_size[berita_detail_gambar,2224]|is_image[berita_detail_gambar]|mime_in[berita_detail_gambar,image/jpg,image/jpeg,image/png]',
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

        $fileSampul = $this->request->getFile('berita_detail_gambar');
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

        $slug = url_title($this->request->getPost('berita_detail_judul'), '-', true);
        $r = $this->beritadetailModel->save([
            'berita_detail_id' => $id,
            'berita_id' => $this->request->getPost('berita_id'),
            'berita_detail_judul' => $this->request->getPost('berita_detail_judul'),
            'berita_detail_slug' => $slug,
            'berita_detail_isi' => $this->request->getPost('berita_detail_isi'),
            'berita_detail_gambar' => $namaSampul,
            'berita_detail_editor' => $this->request->getPost('berita_detail_editor'),
            'berita_detail_rep' => $this->request->getPost('berita_detail_rep'),
            'berita_detail_foto' => $this->request->getPost('berita_detail_foto'),
        ]);

        if ($r) {
            $this->notif('Berita Berhasil diubah.');
        } else {
            $this->notif('Berita Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/berita'));
    }

    public function delete($id)
    {
        $r = $this->beritadetailModel->delete($id);
        if ($r) {
            $this->notif('Berita Berhasil dihapus.');
        } else {
            $this->notif('Berita Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/berita'));
    }
}
