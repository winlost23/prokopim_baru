<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\SekretariatModel;
use App\Models\User;

class Sekretariat extends BaseController
{
    protected $halaman = 'backend/sekretariat/';
    //protected $model;

    public function __construct()
    {
        $this->sekretariatModel = new SekretariatModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Sekretariat';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['sekretariat'] = $this->sekretariatModel
            ->orderby('sekretariat_judul', 'asc')
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
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'sekretariat_judul' => [
                'rules' => 'required|is_unique[sekretariat.sekretariat_judul]',
                'errors' => [
                    'required' => '{field} Judul sekretariat harus diisi',
                    'is_unique' => '{field} Judul sekretariat sudah terdaftar'
                ]
            ],
            'sekretariat_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi sekretariat harus diisi',
                ]
            ]
        ])) {
            return redirect()->to(site_url('/nimda/sekretariat/add'))->withInput();
        }


        $slug = url_title($this->request->getVar('sekretariat_judul'), '-', true);
        $r = $this->sekretariatModel->save([
            'sekretariat_judul' => $this->request->getVar('sekretariat_judul'),
            'sekretariat_slug' => $slug,
            'sekretariat_isi' => $this->request->getVar('sekretariat_isi'),
        ]);
        if ($r) {
            $this->notif('sekretariat Baru Berhasil disimpan.');
        } else {
            $this->notif('sekretariat Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/sekretariat'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['sekretariat'] = $this->sekretariatModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $sekretariatLama = $this->sekretariatModel->getSlug($this->request->getPost('sekretariat_slug'));
        if ($sekretariatLama->sekretariat_judul == $this->request->getPost('sekretariat_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[sekretariat.sekretariat_judul]';
        }
        if (!$this->validate([
            'sekretariat_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'sekretariat_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi sekretariat harus diisi',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/sekretariat/edit/') . $this->request->getPost('sekretariat_id'))->withInput();
        }

        $slug = url_title($this->request->getPost('sekretariat_judul'), '-', true);
        $r = $this->sekretariatModel->save([
            'sekretariat_id' => $id,
            'sekretariat_judul' => $this->request->getPost('sekretariat_judul'),
            'sekretariat_slug' => $slug,
            'sekretariat_isi' => $this->request->getPost('sekretariat_isi'),
        ]);

        if ($r) {
            $this->notif('Sekretariat Berhasil diubah.');
        } else {
            $this->notif('Sekretariat Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/sekretariat'));
    }

    public function delete($id)
    {
        $r = $this->sekretariatModel->delete($id);
        if ($r) {
            $this->notif('Sekretariat Berhasil dihapus.');
        } else {
            $this->notif('Sekretariat Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/sekretariat'));
    }
}
