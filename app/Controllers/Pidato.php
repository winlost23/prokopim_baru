<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\BeritaModel;
use App\Models\DownloadModel;
use App\Models\KategoriModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\PidatoDetailModel;
use App\Models\PidatoPantunModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\UseronlineModel;

class Pidato extends BaseController
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
    }

    public function index($slug)
    {
        $data['title'] = '| Pidato';
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
        $data['slug'] = $this->kategoriModel
            ->where('kategori_slug', $slug)
            ->first();
        $data['konten'] = $this->pidatoDetailModel
            ->join('kategori', 'kategori.kategori_id = pidato_detail.kategori_id')
            ->where('pidato_detail.kategori_id', $data['slug']->kategori_id)
            ->orderby('pidato_detail.pidato_detail_id', 'desc')
            ->findAll();
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

        return view($this->halaman . 'pidato', $data);
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

    public function cari()
    {
        $data['title'] = '| Cari Pidato';
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

        $pidato_detail_judul = $this->request->getPost('pidato_detail_judul');
        $pidato_detail_tempat = $this->request->getPost('pidato_detail_tempat');
        $kategori_id = $this->request->getPost('kategori_id');

        $query = $this->pidatoDetailModel
            ->join('kategori', 'kategori.kategori_id = pidato_detail.kategori_id');
        if ($pidato_detail_judul) {
            $query->Like('pidato_detail.pidato_detail_judul', $pidato_detail_judul);
        }
        if ($pidato_detail_tempat) {
            $query->Like('pidato_detail.pidato_detail_tempat', $pidato_detail_tempat);
        }
        if ($kategori_id) {
            $query->Like('pidato_detail.kategori_id', $kategori_id);
        }
        $query->orderby('pidato_detail.pidato_detail_id', 'desc');

        $data['konten'] = $query->findAll();

        // $data['jml_pantun'] = $this->pidatoPantunModel
        //     ->where('pidato_detail_id', $data['konten']->pidato_detail_id)
        //     ->countAllResults();

        return view($this->halaman . 'pidatocari', $data);
    }

    public function get_download($id)
    {
        $download = $this->pidatoDetailModel->find($id);
        //dd($download);
        $nama = $download->pidato_detail_judul;
        $ext = $download->pidato_detail_ext;
        $file = $download->pidato_detail_file;

        return $this->response->download('file/pidato/' . $file, null)->setFileName($nama . '.' . $ext);
    }
}
