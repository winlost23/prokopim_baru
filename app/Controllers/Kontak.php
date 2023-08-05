<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\BeritaModel;
use App\Models\DownloadModel;
use App\Models\KategoriModel;
use App\Models\KontakModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\PidatoDetailModel;
use App\Models\PidatoPantunModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\UseronlineModel;

class Kontak extends BaseController
{
    protected $halaman = 'frontend/';

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->beritaModel = new BeritaModel();
        $this->beritadetailModel = new BeritaDetailModel();
        $this->profilModel = new ProfilModel();
        $this->sekretariatModel = new SekretariatModel();
        $this->downloadModel = new DownloadModel();
        $this->pengaturanModel = new PengaturanModel();
        // $this->sessionviewerModel = new SessionViewerModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
        $this->agendaModel = new AgendaModel();
        $this->pidatoDetailModel = new PidatoDetailModel();
        $this->pidatoPantunModel = new PidatoPantunModel();
        $this->kontakModel = new KontakModel();
    }

    public function index()
    {
        $data['title'] = '| Kontak';
        $data['menu'] = 'kedua';
        $data['pengaturan'] = $this->pengaturanModel
            ->first();

        //Menu
        $data['profil'] = $this->profilModel
            ->orderby('profil_id', 'asc')
            ->findAll();
        $data['sekretariat'] = $this->sekretariatModel
            ->orderby('sekretariat_id', 'asc')
            ->findAll();
        $data['berita'] = $this->beritaModel
            ->orderby('berita_id', 'asc')
            ->findAll();
        $data['kategori'] = $this->kategoriModel
            ->orderby('kategori_id', 'asc')
            ->findAll();
        $data['download'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->findAll();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->findAll();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->findAll();

        //Content
        $data['konten'] = $this->kontakModel
            ->where('kontak_show', 1)
            ->orderby('kontak_id', 'desc')
            ->paginate(6, 'hal');

        $data['pager'] = $this->kontakModel->pager;
        $data['nomor'] = nomor($this->request->getVar('page_hal'), 6);
        //Statistik User
        // $PHPSELF = $_SERVER['PHP_SELF'];
        // $tgl = date("Y-m-d");
        // $blan = date("Y-m");
        // $thn = date("Y");
        // //Hari ini
        // $data['hariini'] = $this->PengunjungModel->where('pengunjung_tgl', $tgl)->countAllResults();
        // //Bulan ini
        // $data['bulanini'] = $this->PengunjungModel->like('pengunjung_tgl', $blan)->countAllResults();
        // //Tahun ini
        // $data['tahunini'] = $this->PengunjungModel->like('pengunjung_tgl', $thn)->countAllResults();
        // //Online
        // $data['online'] = $this->UseronlineModel->distinct('usersonline_ip')->where('usersonline_file', $PHPSELF)->selectCount('usersonline_ip')->first();

        return view($this->halaman . 'kontak', $data);
    }

    public function form()
    {
        $data['title'] = '| Kontak';
        $data['menu'] = 'kedua';
        $data['pengaturan'] = $this->pengaturanModel
            ->first();

        //Menu
        $data['profil'] = $this->profilModel
            ->orderby('profil_id', 'asc')
            ->findAll();
        $data['sekretariat'] = $this->sekretariatModel
            ->orderby('sekretariat_id', 'asc')
            ->findAll();
        $data['berita'] = $this->beritaModel
            ->orderby('berita_id', 'asc')
            ->findAll();
        $data['kategori'] = $this->kategoriModel
            ->orderby('kategori_id', 'asc')
            ->findAll();
        $data['download'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->findAll();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->findAll();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->findAll();

        return view($this->halaman . 'kontak_form', $data);
    }

    public function detail($slugKategori, $slugKonten)
    {
        $data['title'] = '| Detail Berita';
        $data['menu'] = 'kedua';
        $data['pengaturan'] = $this->pengaturanModel
            ->first();

        //Menu
        $data['profil'] = $this->profilModel
            ->orderby('profil_id', 'asc')
            ->findAll();
        $data['sekretariat'] = $this->sekretariatModel
            ->orderby('sekretariat_id', 'asc')
            ->findAll();
        $data['berita'] = $this->beritaModel
            ->orderby('berita_id', 'asc')
            ->findAll();
        $data['kategori'] = $this->kategoriModel
            ->orderby('kategori_id', 'asc')
            ->findAll();
        $data['download'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->findAll();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->findAll();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->findAll();

        $data['konten'] = $this->pidatoDetailModel
            ->join('kategori', 'kategori.kategori_id = pidato_detail.kategori_id')
            ->where('pidato_detail.pidato_detail_slug', $slugKonten)
            ->orderby('pidato_detail.pidato_detail_id', 'desc')
            ->first();
        $data['jml_pantun'] = $this->pidatoPantunModel
            ->where('pidato_detail_id', $data['konten']->pidato_detail_id)
            ->countAllResults();

        return view($this->halaman . 'pidatodetail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kontak_kami_nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Nama harus diisi',
                ]
            ],
            'kontak_kami_email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Email harus diisi',
                    'valid_email' => '{field} Email yang di input salah',
                ]
            ],
            'kontak_kami_judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Judul harus diisi',
                ]
            ],
            'kontak_kami_pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Pesan harus diisi',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/nimda/kontak')->withInput();
        }

        $r = $this->kontakModel->save([
            'kontak_kami_nama' => $this->request->getPost('kontak_kami_nama'),
            'kontak_kami_email' => $this->request->getPost('kontak_kami_email'),
            'kontak_kami_judul' => $this->request->getPost('kontak_kami_judul'),
            'kontak_kami_pesan' => $this->request->getPost('kontak_kami_pesan'),
        ]);

        if ($r) {
            $this->notif('Kontak Berhasil diubah.');
        } else {
            $this->notif('Kontak Gagal diubah.', 'error');
        }

        return redirect()->to('/kontak');
    }

    //--------------------------------------------------------------------

}
