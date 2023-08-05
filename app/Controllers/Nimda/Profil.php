<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\User;

class Profil extends BaseController
{
    protected $halaman = 'backend/profil/';
    //protected $model;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Profil';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['profil'] = $this->profilModel
            ->orderby('profil_id', 'asc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Profil';

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
            'profil_judul' => [
                'rules' => 'required|is_unique[profil.profil_judul]',
                'errors' => [
                    'required' => '{field} Judul profil harus diisi',
                    'is_unique' => '{field} Judul profil sudah terdaftar'
                ]
            ],
            'profil_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi profil harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/profil/add'))->withInput();
        }


        $slug = url_title($this->request->getVar('profil_judul'), '-', true);
        $r = $this->profilModel->save([
            'profil_judul' => $this->request->getVar('profil_judul'),
            'profil_slug' => $slug,
            'profil_isi' => $this->request->getVar('profil_isi'),
        ]);
        if ($r) {
            $this->notif('Profil Baru Berhasil disimpan.');
        } else {
            $this->notif('Profil Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/profil'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Profil';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['profil'] = $this->profilModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $profilLama = $this->profilModel->getSlug($this->request->getPost('profil_slug'));
        if ($profilLama->profil_judul == $this->request->getPost('profil_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[profil.profil_judul]';
        }
        if (!$this->validate([
            'profil_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/profil/edit/') . $this->request->getPost('profil_id'))->withInput();
        }

        $slug = url_title($this->request->getPost('profil_judul'), '-', true);
        $r = $this->profilModel->save([
            'profil_id' => $id,
            'profil_judul' => $this->request->getPost('profil_judul'),
            'profil_slug' => $slug,
            'profil_isi' => $this->request->getPost('profil_isi'),
        ]);

        if ($r) {
            $this->notif('Profil Berhasil diubah.');
        } else {
            $this->notif('Profil Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/profil'));
    }

    public function delete($id)
    {
        $r = $this->profilModel->delete($id);
        if ($r) {
            $this->notif('Profil Berhasil dihapus.');
        } else {
            $this->notif('Profil Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/profil'));
    }
}
