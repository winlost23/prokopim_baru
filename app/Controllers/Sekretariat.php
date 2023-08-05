<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\BeritaModel;
use App\Models\DownloadModel;
use App\Models\KategoriModel;
use App\Models\InfoModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\UseronlineModel;

class Sekretariat extends BaseController
{
    protected $halaman = 'frontend/';

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->infoModel = new InfoModel();
        $this->profilModel = new ProfilModel();
        $this->beritaModel = new BeritaModel();
        $this->sekretariatModel = new SekretariatModel();
        $this->downloadModel = new DownloadModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
        $this->beritadetailModel = new BeritaDetailModel();
        $this->agendaModel = new AgendaModel();
    }

    public function index($slug)
    {
        $data['title'] = '| Profil';
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

        //Konten
        $data['konten'] = $this->sekretariatModel
            ->where('sekretariat_slug', $slug)
            ->first();

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

        return view($this->halaman . 'sekretariat', $data);
    }

    //--------------------------------------------------------------------

}
