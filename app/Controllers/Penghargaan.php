<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\BeritaFotoModel;
use App\Models\BeritaModel;
use App\Models\DownloadDetailModel;
use App\Models\DownloadModel;
use App\Models\GaleriKegiatanFotoModel;
use App\Models\GaleriKegiatanModel;
use App\Models\KategoriModel;
use App\Models\PengaturanModel;
use App\Models\PenghargaanModel;
use App\Models\PengunjungModel;
use App\Models\PidatoDetailModel;
use App\Models\PidatoPantunModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\UseronlineModel;
use App\Models\VideoKegiatanModel;

class Penghargaan extends BaseController
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
        $this->penghargaanModel = new PenghargaanModel();
        $this->galeriKegiatanFotoModel = new GaleriKegiatanFotoModel();
        $this->beritaFotoModel = new BeritaFotoModel();
        $this->videoKegiatanModel = new VideoKegiatanModel();
        $this->galeriKegiatanModel = new GaleriKegiatanModel();
        $this->downloadDetailModel = new DownloadDetailModel();
    }

    public function index()
    {
        $data['title'] = '| Penghargaan';
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
        $data['download_menu'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['jml_berita'] = $this->beritadetailModel->countAll();
		$data['jml_galeri_foto'] = $this->galeriKegiatanFotoModel->countAll();
		$data['jml_berita_foto'] = $this->beritaFotoModel->countAll();
		$data['jml_video_kegiatan'] = $this->videoKegiatanModel->countAll();
        $data['jml_pidato_pantun'] = $this->pidatoPantunModel->countAll();
		$data['jml_galeri_kegiatan'] = $this->galeriKegiatanModel->countAll();
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->find();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->find();
        $data['download'] = $this->downloadDetailModel
            ->join('download', 'download.download_id = download_detail.download_id')
            ->orderby('download_detail.download_detail_id', 'desc')
            ->limit(5)->find();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->find();

        //Content
        $data['konten'] = $this->penghargaanModel
            ->join('kategori', 'kategori.kategori_id = penghargaan.kategori_id')
            ->orderby('penghargaan.penghargaan_id', 'desc')
            ->paginate(9, 'hal');

        $data['pager'] = $this->penghargaanModel->pager;
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

        return view($this->halaman . 'penghargaan', $data);
    }

    public function detail($slugKategori, $slugKonten)
    {
        $data['title'] = '| Detail Penghargaan';
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
        $data['download_menu'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['jml_berita'] = $this->beritadetailModel->countAll();
		$data['jml_galeri_foto'] = $this->galeriKegiatanFotoModel->countAll();
		$data['jml_berita_foto'] = $this->beritaFotoModel->countAll();
		$data['jml_video_kegiatan'] = $this->videoKegiatanModel->countAll();
        $data['jml_pidato_pantun'] = $this->pidatoPantunModel->countAll();
		$data['jml_galeri_kegiatan'] = $this->galeriKegiatanModel->countAll();
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->find();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->find();
        $data['download'] = $this->downloadDetailModel
            ->join('download', 'download.download_id = download_detail.download_id')
            ->orderby('download_detail.download_detail_id', 'desc')
            ->limit(5)->find();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->find();

        $data['konten'] = $this->penghargaanModel
            ->join('kategori', 'kategori.kategori_id = penghargaan.kategori_id')
            ->where('penghargaan.penghargaan_slug', $slugKonten)
            ->first();
        $data['lainya'] = $this->penghargaanModel
            ->join('kategori', 'kategori.kategori_id = penghargaan.kategori_id')
            ->where('kategori.kategori_slug', $slugKategori)
            ->orderby('rand()')
            ->limit(6)->find();

        return view($this->halaman . 'penghargaandetail', $data);
    }

    public function cari()
    {
        $data['title'] = '| Penghargaan';
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
        $data['download_menu'] = $this->downloadModel
            ->orderby('download_id', 'asc')
            ->findAll();

        //side
        $data['jml_berita'] = $this->beritadetailModel->countAll();
		$data['jml_galeri_foto'] = $this->galeriKegiatanFotoModel->countAll();
		$data['jml_berita_foto'] = $this->beritaFotoModel->countAll();
		$data['jml_video_kegiatan'] = $this->videoKegiatanModel->countAll();
        $data['jml_pidato_pantun'] = $this->pidatoPantunModel->countAll();
		$data['jml_galeri_kegiatan'] = $this->galeriKegiatanModel->countAll();
        $data['berita_baru'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)->find();
        $data['agenda_baru'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)->find();
        $data['download'] = $this->downloadDetailModel
            ->join('download', 'download.download_id = download_detail.download_id')
            ->orderby('download_detail.download_detail_id', 'desc')
            ->limit(5)->find();

        $data['berita_populer'] = $this->beritadetailModel
            ->join('berita', 'berita.berita_id = berita_detail.berita_id')
            ->orderby('berita_detail.berita_detail_dibaca', 'desc')
            ->limit(5)->find();

        //Content
        $penghargaan_judul = $this->request->getPost('penghargaan_judul');
        $tahun = $this->request->getPost('penghargaan_tahun');
        $kategori_id = $this->request->getPost('kategori_id');

        $query = $this->penghargaanModel
            ->join('kategori', 'kategori.kategori_id = penghargaan.kategori_id');
        if ($penghargaan_judul) {
            $query->Like('penghargaan.penghargaan_judul', $penghargaan_judul);
        }
        if ($tahun) {
            $query->Like('penghargaan.penghargaan_tahun', $tahun);
        }
        if ($kategori_id) {
            $query->Like('penghargaan.kategori_id', $kategori_id);
        }
        $query->orderby('penghargaan.penghargaan_id', 'desc');

        $data['konten'] = $query->findAll();

        return view($this->halaman . 'penghargaancari', $data);
    }
}
