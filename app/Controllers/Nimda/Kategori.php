<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Kategori extends BaseController
{
    protected $halaman = 'backend/kategori/';

    public function __construct()
    {
        $this->ketegoriModel = new KategoriModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    //protected $urls = $this->request->uri->getSegment(1);

    public function index()
    {
        $data['title'] = 'Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $urls = $this->request->uri->getSegment(4);
        $def = new Definisi();
        $data['segmentasi'] = $urls;
        $data['kategori'] = $this->ketegoriModel
            ->where('kategori_jenis', $urls)
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();


        return view($this->halaman . 'index', $data);
    }

    public function save()
    {
        $kategoriJenis = $this->request->getPost('kategori_jenis');
        // validation input
        if (!$this->validate([
            'kategori_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul kategori harus diisi'
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/kategori/index/') . $kategoriJenis)->withInput();
        }


        $slug = url_title($this->request->getPost('kategori_judul'), '-', true);
        $r = $this->ketegoriModel->save([
            //'users_id' => session()->userid,
            'kategori_judul' => $this->request->getPost('kategori_judul'),
            'kategori_slug' => $slug,
            'kategori_jenis' => $kategoriJenis,
        ]);
        if ($r) {
            $this->notif('Kategori ' . ucfirst($kategoriJenis) . ' Berhasil disimpan.');
        } else {
            $this->notif('Kategori ' . ucfirst($kategoriJenis) . ' Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/kategori/index/') . $kategoriJenis);
    }

    public function edit($kategori, $id)
    {
        $data['title'] = 'Edit Kategori';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['segmentasi'] = $kategori;
        $data['kategori'] = $this->ketegoriModel
            ->where('kategori_jenis', $kategori)
            ->findAll();
        $data['kategori_edit'] = $this->ketegoriModel
            ->where('kategori_jenis', $kategori)
            ->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($kategori)
    {

        if (!$this->validate([
            'kategori_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Kategori harus diisi',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/kategori/edit/') . $kategori . '/' . $this->request->getPost('kategori_id'))->withInput();
        }
        $slug = url_title($this->request->getPost('kategori_judul'), '-', true);
        $r = $this->ketegoriModel->save([
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kategori_judul' => $this->request->getPost('kategori_judul'),
            'kategori_slug' => $slug,
        ]);

        if ($r) {
            $this->notif('Kategori ' . ucfirst($kategori) . ' Berhasil diubah.');
        } else {
            $this->notif('Kategori ' . ucfirst($kategori) . ' Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/kategori/index/') . $kategori);
    }

    public function delete($kategori, $id)
    {
        $r = $this->ketegoriModel->delete($id);
        if ($r) {
            $this->notif('Berita Berhasil dihapus.');
        } else {
            $this->notif('Berita Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/kategori/index/') . $kategori);
    }
}
