<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\PidatoDetailModel;
use App\Models\KategoriModel;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;
use App\Models\PidatoPantunModel;
use App\Models\User;

class Pidato extends BaseController
{
    protected $halaman = 'backend/pidato/';
    //protected $model;

    public function __construct()
    {
        $this->pidatodetailModel = new PidatoDetailModel();
        $this->pidatopantunModel = new PidatoPantunModel();
        $this->ketegoriModel = new KategoriModel();
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function pantun($id)
    {
        $data['title'] = 'Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['pidato'] = $this->pidatodetailModel->find($id);
        $data['pantun'] = $this->pidatopantunModel->where('pidato_detail_id', $id)->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'pantun', $data);
    }

    public function pantun_add($id)
    {
        $data['title'] = 'Tambah Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['pidato'] = $this->pidatodetailModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'pantun_add', $data);
    }

    public function pantun_save($id)
    {
        // validation input
        if (!$this->validate([
            'pidato_pantun_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Konten pantun harus diisi',
                ]
            ],

        ])) {
            return redirect()->to(site_url('/nimda/pidato/pantun_add/' . $id))->withInput();
        }

        $r = $this->pidatopantunModel->save([
            'kategori_id' => $this->request->getVar('kategori_id'),
            'pidato_detail_id' => $id,
            'pidato_pantun_isi' => $this->request->getVar('pidato_pantun_isi'),
        ]);
        if ($r) {
            $this->notif('Pantun Baru Berhasil disimpan.');
        } else {
            $this->notif('Pantun Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/pidato/pantun/' . $id));
    }

    public function pantun_edit($id_pidato, $id_pantun)
    {
        $data['title'] = 'Edit Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['pidato'] = $this->pidatodetailModel->find($id_pidato);
        $data['pantun'] = $this->pidatopantunModel->find($id_pantun);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'pantun_edit', $data);
    }

    public function pantun_update($id_pidato, $id_pantun)
    {
        // validation input
        if (!$this->validate([
            'pidato_pantun_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Konten pantun harus diisi',
                ]
            ],

        ])) {
            return redirect()->to(site_url('/nimda/pidato/pantun_edit/' . $id_pidato . '/' . $id_pantun))->withInput();
        }

        $r = $this->pidatopantunModel->save([
            'pidato_pantun_id' => $id_pantun,
            'pidato_pantun_isi' => $this->request->getVar('pidato_pantun_isi'),
        ]);

        if ($r) {
            $this->notif('Pantun Berhasil diubah.');
        } else {
            $this->notif('Pantun Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/pidato/pantun/' . $id_pidato));
    }

    public function pantun_delete($id_pidato, $id_pantun)
    {
        $r = $this->pidatopantunModel->delete($id_pantun);
        if ($r) {
            $this->notif('Pantun Berhasil dihapus.');
        } else {
            $this->notif('Pantun Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/pidato/pantun/' . $id_pidato));
    }

    public function index()
    {
        $data['title'] = 'Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['pidato'] = $this->pidatodetailModel
            ->join('kategori', 'pidato_detail.kategori_id = kategori.kategori_id')
            ->orderby('pidato_detail.pidato_detail_id', 'desc')
            ->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->orderby('kategori_judul', 'asc')->findAll();
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'add', $data);
    }

    public function get_download($id)
    {
        $download = $this->pidatodetailModel->find($id);
        //dd($download);
        $nama = $download->pidato_detail_judul;
        $ext = $download->pidato_detail_ext;
        $file = $download->pidato_detail_file;

        return $this->response->download('file/pidato/' . $file, null)->setFileName($nama . '.' . $ext);
    }

    public function save()
    {
        // validation input
        if (!$this->validate([
            'pidato_detail_judul' => [
                'rules' => 'required|is_unique[pidato_detail.pidato_detail_judul]',
                'errors' => [
                    'required' => '{field} Judul pidato harus diisi',
                    'is_unique' => '{field} Judul pidato sudah terdaftar'
                ]
            ],
            'pidato_detail_file' => [
                'rules' => [
                    'uploaded[pidato_detail_file]',
                    'mime_in[pidato_detail_file,application/pdf,application/msword,application/zip,application/rar,]',
                    'max_size[pidato_detail_file,6124]',
                ],
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 5M',
                    'mime_in' => 'File yang di upload harus berupa (pdf / docx / zip / rar)'
                ]
            ],
        ])) {
            return redirect()->to(site_url('/nimda/pidato/add'))->withInput();
        }

        $fileSampul = $this->request->getFile('pidato_detail_file');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = NULL;
            $ext = NULL;
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('file/pidato', $namaSampul);
            $ext = $fileSampul->getClientExtension();
        }

        $slug = url_title($this->request->getVar('pidato_detail_judul'), '-', true);
        $r = $this->pidatodetailModel->save([
            'kategori_id' => $this->request->getVar('kategori_id'),
            'pidato_detail_judul' => $this->request->getVar('pidato_detail_judul'),
            'pidato_detail_slug' => $slug,
            'pidato_detail_tgl_acara' => $this->request->getVar('pidato_detail_tgl_acara'),
            'pidato_detail_tempat' => $this->request->getVar('pidato_detail_tempat'),
            'pidato_detail_file' => $namaSampul,
            'pidato_detail_ext' => $ext,
        ]);
        if ($r) {
            $this->notif('Pidato Baru Berhasil disimpan.');
        } else {
            $this->notif('Pidato Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/pidato'));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pidato';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();

        $def = new Definisi();
        $data['kategori'] = $this->ketegoriModel->orderby('kategori_judul', 'asc')->findAll();
        $data['pidato'] = $this->pidatodetailModel->find($id);
        $data['level'] = $def->level();
        $data['validation'] = \Config\Services::validation();
        return view($this->halaman . 'edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $pidatoLama = $this->pidatodetailModel->getSlug($this->request->getPost('pidato_detail_slug'));
        if ($pidatoLama->pidato_detail_judul == $this->request->getPost('pidato_detail_judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[pidato_detail.pidato_detail_judul]';
        }
        if (!$this->validate([
            'pidato_detail_judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                    'is_unique' => '{field} Judul sudah terdaftar'
                ]
            ],
            'pidato_detail_file' => [
                'rules' => [
                    'uploaded[pidato_detail_file]',
                    'mime_in[pidato_detail_file,application/pdf,application/msword,application/zip,application/rar,]',
                    'max_size[pidato_detail_file,6124]',
                ],
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 5M',
                    'mime_in' => 'File yang di upload harus berupa (pdf / docx / zip / rar)'
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/nimda/pidato/edit/') . $this->request->getPost('pidato_detail_id'))->withInput();
        }

        $fileSampul = $this->request->getFile('pidato_detail_file');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('file_lama');
            $ext = $this->request->getPost('ext_lama');
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('file/pidato', $namaSampul);
            $ext = $fileSampul->getClientExtension();

            unlink('file/pidato/' . $this->request->getPost('file_lama'));
        }

        $slug = url_title($this->request->getPost('pidato_detail_judul'), '-', true);
        $r = $this->pidatodetailModel->save([
            'pidato_detail_id' => $id,
            'kategori_id' => $this->request->getVar('kategori_id'),
            'pidato_detail_judul' => $this->request->getVar('pidato_detail_judul'),
            'pidato_detail_slug' => $slug,
            'pidato_detail_tgl_acara' => $this->request->getVar('pidato_detail_tgl_acara'),
            'pidato_detail_tempat' => $this->request->getVar('pidato_detail_tempat'),
            'pidato_detail_file' => $namaSampul,
            'pidato_detail_ext' => $ext,
        ]);

        if ($r) {
            $this->notif('Pidato Berhasil diubah.');
        } else {
            $this->notif('Pidato Gagal diubah.', 'error');
        }

        return redirect()->to(site_url('/nimda/pidato'));
    }

    public function delete($id)
    {
        $r = $this->pidatodetailModel->delete($id);
        if ($r) {
            $this->notif('Pidato Berhasil dihapus.');
        } else {
            $this->notif('Pidato Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/pidato'));
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
            return redirect()->to(site_url('/nimda/pidato/kategori/'))->withInput();
        }

        $slug = url_title($this->request->getPost('kategori_judul'), '-', true);
        $r = $this->ketegoriModel->save([
            //'users_id' => session()->userid,
            'kategori_judul' => $this->request->getPost('kategori_judul'),
            'kategori_slug' => $slug,
        ]);
        if ($r) {
            $this->notif('Pidato kategori Berhasil disimpan.');
        } else {
            $this->notif('Pidato kategori Gagal disimpan.', 'error');
        }

        return redirect()->to(site_url('/nimda/pidato/kategori/'));
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
            return redirect()->to(site_url('/nimda/pidato/kategori_edit/') . $this->request->getPost('kategori_id'))->withInput();
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

        return redirect()->to(site_url('/nimda/pidato/kategori/'));
    }

    public function kategori_delete($id)
    {
        $r = $this->ketegoriModel->delete($id);
        if ($r) {
            $this->notif('Kategori Berhasil dihapus.');
        } else {
            $this->notif('Kategori Gagal dihapus.', 'error');
        }
        return redirect()->to(site_url('/nimda/pidato/kategori/'));
    }
}
