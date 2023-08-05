<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\KategoriModel;
use App\Models\BeritaModel;
use App\Models\DownloadModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\SessionViewerModel;
use App\Models\UseronlineModel;

class Berita extends BaseController
{
    protected $halaman = 'frontend/';

    public function __construct()
    {
        $this->ketegoriModel = new KategoriModel();
        $this->beritaModel = new BeritaModel();
        $this->beritadetailModel = new BeritaDetailModel();
        $this->profilModel = new ProfilModel();
        $this->sekretariatModel = new SekretariatModel();
        $this->kategoriModel = new KategoriModel();
        $this->downloadModel = new DownloadModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->sessionviewerModel = new SessionViewerModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
        $this->agendaModel = new AgendaModel();
    }

    public function index($slug)
    {
        $data['title'] = '| Berita';
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
        $data['slug'] = $this->beritaModel
            ->where('berita_slug', $slug)
            ->first();
        $data['konten'] = $this->beritadetailModel
            ->where('berita_id', $data['slug']->berita_id)
            ->orderby('berita_detail_id', 'desc')
            ->paginate(9, 'hal');

        $data['pager'] = $this->beritadetailModel->where('berita_id', $data['slug']->berita_id)->pager;
        $data['nomor'] = nomor($this->request->getVar('page_hal'), 9);
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

        return view($this->halaman . 'berita', $data);
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


        $data['slug'] = $this->beritaModel
            ->where('berita_slug', $slugKategori)
            ->first();
        $data['konten'] = $this->beritadetailModel
            ->where('berita_detail_slug', $slugKonten)
            ->first();
        $data['lainya'] = $this->beritadetailModel
            ->where('berita_id', $data['slug']->berita_id)
            ->orderby('rand()')
            ->limit(6)->findAll();

        $id_b = $data['konten']->berita_detail_id;
        $ip_user = $_SERVER['REMOTE_ADDR'];
        $tgl  = date("Y-m-d");

        $cek_viewer = $this->sessionviewerModel->where('berita_detail_id', $id_b)->where('session_viewer_ip', $ip_user)->where('session_viewer_tgl', $tgl)->countAllResults();
        //dd($cek_viewer);
        if ($cek_viewer > 0) {
            $cek_ip = $this->sessionviewerModel->where('berita_detail_id', $id_b)->where('session_viewer_ip', $ip_user)->where('session_viewer_tgl', $tgl)->countAllResults();
            if ($cek_ip > 0) {
            } else {
                $this->beritadetailModel->where('berita_detail_id', $id_b)->increment('berita_detail_dibaca', 1);
            }
        } else {
            $r = $this->sessionviewerModel->save([
                'berita_detail_id' => $id_b,
                'session_viewer_ip' =>  $ip_user,
                'session_viewer_tgl' => $tgl,
            ]);
            $this->beritadetailModel->where('berita_id', $id_b)->increment('berita_detail_dibaca', 1);
        }

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

        return view($this->halaman . 'beritadetail', $data);
    }

    //--------------------------------------------------------------------

}
