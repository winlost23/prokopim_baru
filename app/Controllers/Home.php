<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaDetailModel;
use App\Models\BeritaFotoModel;
use App\Models\BeritaModel;
use App\Models\DownloadModel;
use App\Models\GaleriKegiatanFotoModel;
use App\Models\GaleriKegiatanModel;
use App\Models\KategoriModel;
use App\Models\PengaturanModel;
use App\Models\PenghargaanModel;
use App\Models\PengunjungModel;
use App\Models\ProfilModel;
use App\Models\SekretariatModel;
use App\Models\SliderModel;
use App\Models\UseronlineModel;
use App\Models\VideoKegiatanModel;

class Home extends BaseController
{
	protected $halaman = 'frontend/';
	//coba nambah
	public function __construct()
	{
		$this->pengaturanModel = new PengaturanModel();
		$this->profilModel = new ProfilModel();
		$this->sekretariatModel = new SekretariatModel();
		$this->beritaModel = new BeritaModel();
		$this->kategoriModel = new KategoriModel();
		$this->downloadModel = new DownloadModel();
		$this->UseronlineModel = new UseronlineModel();
		$this->PengunjungModel = new PengunjungModel();
		$this->sliderModel = new SliderModel();
		$this->beritadetailModel = new BeritaDetailModel();
		$this->galeriKegiatanFotoModel = new GaleriKegiatanFotoModel();
		$this->beritaFotoModel = new BeritaFotoModel();
		$this->videoKegiatanModel = new VideoKegiatanModel();
		$this->penghargaanModel = new PenghargaanModel();
		$this->galeriKegiatanModel = new GaleriKegiatanModel();
	}

	public function index()
	{
		// return redirect()->to(site_url('auth/'));

		$data['title'] = '';
		// $data['menu'] = '';
		// Menu
		$data['pengaturan'] = $this->pengaturanModel
			->first();
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

		//Slider
		$data['slider'] = $this->sliderModel
			->orderby('slider_id', 'desc')
			->findAll();
		//top
		$data['berita_atas'] = $this->beritadetailModel
			->join('berita', 'berita.berita_id = berita_detail.berita_id')
			->orderby('berita_detail.berita_detail_id', 'desc')
			->limit(4)->findAll();

		//side
		$data['jml_berita'] = $this->beritadetailModel->countAll();
		$data['jml_galeri_foto'] = $this->galeriKegiatanFotoModel->countAll();
		$data['jml_berita_foto'] = $this->beritaFotoModel->countAll();
		$data['jml_video_kegiatan'] = $this->videoKegiatanModel->countAll();

		//konten
		$data['berita_foto'] = $this->beritaFotoModel
			->orderby('berita_foto_id', 'desc')
			->limit(4)->findAll();
		$data['video_kegiatan'] = $this->videoKegiatanModel
			->orderby('video_kegiatan_id', 'desc')
			->limit(3)->findAll();
		$data['penghargaan'] = $this->penghargaanModel
			->join('kategori', 'kategori.kategori_id = penghargaan.kategori_id')
			->orderby('penghargaan.penghargaan_id', 'desc')
			->limit(6)->findAll();
		$data['galeri_kegiatan'] = $this->galeriKegiatanModel
			->orderby('galeri_kegiatan_id', 'desc')
			->limit(4)->findAll();

		// $data['info'] = $this->ketegoriModel
		// 	->where('kategori_jenis', 'info')
		// 	->findAll();
		// $data['berita'] = $this->ketegoriModel
		// 	->where('kategori_jenis', 'berita')
		// 	->findAll();

		// $data['dataslider'] = $this->sliderModel
		// 	->orderby('slider_id', 'desc')
		// 	->findAll();

		// $data['dataprofil'] = $this->profilModel
		// 	->orderby('profil_id', 'asc')
		// 	->limit(3)
		// 	->find();
		// $data['datainfo'] = $this->infoModel
		// 	->join('kategori', 'info.kategori_id=kategori.kategori_id')
		// 	->orderby('info_id', 'desc')
		// 	->limit(4)
		// 	->find();
		// $data['databerita'] = $this->beritaModel
		// 	->join('kategori', 'berita.kategori_id=kategori.kategori_id')
		// 	->orderby('berita_id', 'desc')
		// 	->limit(4)
		// 	->find();
		// $data['datagaleri'] = $this->ketegoriModel
		// 	->where('kategori_jenis', 'galeri')
		// 	->orderby('kategori_id', 'desc')
		// 	->limit(6)
		// 	->find();

		//Statistik User
		$PHPSELF = $_SERVER['PHP_SELF'];
		$tgl = date("Y-m-d");
		$blan = date("Y-m");
		$thn = date("Y");
		//Hari ini
		$data['hariini'] = $this->PengunjungModel->where('pengunjung_tgl', $tgl)->countAllResults();
		//Bulan ini
		$data['bulanini'] = $this->PengunjungModel->like('pengunjung_tgl', $blan)->countAllResults();
		//Tahun ini
		$data['tahunini'] = $this->PengunjungModel->like('pengunjung_tgl', $thn)->countAllResults();
		//Online
		$data['online'] = $this->UseronlineModel->distinct('usersonline_ip')->where('usersonline_file', $PHPSELF)->selectCount('usersonline_ip')->first();

		return view($this->halaman . 'index', $data);
	}

	function unauthorized()
	{
		$data['pengaturan'] = $this->pengaturanModel
			->first();
		return view('backend/login/unauthorized', $data);
	}

	//--------------------------------------------------------------------

}
