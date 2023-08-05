<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Libraries\Definisi;
use App\Models\AgendaModel;
use App\Models\PengaturanModel;
use App\Models\User;

class Agenda extends BaseController
{
    protected $halaman = 'backend/agenda/';
    //protected $model;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data['title'] = 'Agenda';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['agenda'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Agenda';

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
            'agenda_judul' => [
                'rules' => 'required|is_unique[agenda.agenda_judul]',
                'errors' => [
                    'required' => '{field} Judul agenda harus diisi',
                    'is_unique' => '{field} Judul agenda sudah terdaftar'
                ]
            ],
            'agenda_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/agenda/add'))->withInput();
        }


        $slug = url_title($this->request->getVar('agenda_judul'), '-', true);
        $r = $this->agendaModel->save([
            'agenda_judul' => $this->request->getVar('agenda_judul'),
            'agenda_slug' => $slug,
            'agenda_tanggal' => $this->request->getVar('agenda_tanggal'),
            'agenda_jam' => $this->request->getVar('agenda_jam'),
            'agenda_lokasi' => $this->request->getVar('agenda_lokasi'),
            'agenda_petugas' => $this->request->getVar('agenda_petugas'),
        ]);
        if ($r) {
            $this->notif('Agenda Baru Berhasil disimpan.');
        } else {
            $this->notif('Agenda Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/agenda'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Berita Foto';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['agenda'] = $this->agendaModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $beritaLama = $this->agendaModel->getSlug($this->request->getPost('agenda_slug'));
        if ($beritaLama->agenda_judul == $this->request->getPost('agenda_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[agenda.agenda_judul]';
        }
        if (!$this->validate([
            'agenda_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul Agenda harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/berita/edit/') . $this->request->getPost('agenda_id'))->withInput();
        }

        $slug = url_title($this->request->getPost('agenda_judul'), '-', true);
        $r = $this->agendaModel->save([
            'agenda_id' => $id,
            'agenda_judul' => $this->request->getPost('agenda_judul'),
            'agenda_slug' => $slug,
            'agenda_tanggal' => $this->request->getPost('agenda_tanggal'),
            'agenda_jam' => $this->request->getPost('agenda_jam'),
            'agenda_lokasi' => $this->request->getPost('agenda_lokasi'),
            'agenda_petugas' => $this->request->getPost('agenda_petugas'),
        ]);

        if ($r) {
            $this->notif('Agenda Berhasil diubah.');
        } else {
            $this->notif('Agenda Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/agenda'));
    }

    public function delete($id)
    {
        $r = $this->agendaModel->delete($id);
        if ($r) {
            $this->notif('Agenda Berhasil dihapus.');
        } else {
            $this->notif('Agenda Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/agenda'));
    }
}
