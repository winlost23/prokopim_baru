<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Models\InfoModel;
use App\Models\KategoriModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\UseronlineModel;

class Galeri extends BaseController
{
    protected $halaman = 'frontend/';

    public function __construct()
    {
        $this->ketegoriModel = new KategoriModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->galeriModel = new GaleriModel();
        $this->infoModel = new InfoModel();
        $this->beritaModel = new BeritaModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
    }

    public function index()
    {
        $data['title'] = '| Galeri';
        $data['menu'] = 'kedua';
        $data['profil'] = $this->ketegoriModel
            ->where('kategori_jenis', 'profil')
            ->findAll();
        $data['info'] = $this->ketegoriModel
            ->where('kategori_jenis', 'info')
            ->findAll();
        $data['berita'] = $this->ketegoriModel
            ->where('kategori_jenis', 'berita')
            ->findAll();

        $data['datagaleri'] = $this->ketegoriModel
            ->where('kategori_jenis', 'galeri')
            ->orderby('kategori_id', 'desc')
            ->find();

        $data['pengaturan'] = $this->pengaturanModel
            ->first();

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

        return view($this->halaman . 'galeri', $data);
    }

    public function detail($slug)
    {
        $data['title'] = '| Detail Galeri';
        $data['menu'] = 'kedua';
        $data['profil'] = $this->ketegoriModel
            ->where('kategori_jenis', 'profil')
            ->findAll();
        $data['info'] = $this->ketegoriModel
            ->where('kategori_jenis', 'info')
            ->findAll();
        $data['berita'] = $this->ketegoriModel
            ->where('kategori_jenis', 'berita')
            ->findAll();
        //cek id info
        $idkategori = $this->ketegoriModel
            ->where('kategori_slug', $slug)
            ->first();

        $data['datagaleri'] = $this->galeriModel
            ->where('kategori_id', $idkategori->kategori_id)
            ->orderby('galeri_id', 'desc')
            ->find();
        $data['kategori'] = $this->ketegoriModel
            ->where('kategori_slug', $slug)
            ->first();

        $data['pengaturan'] = $this->pengaturanModel
            ->first();

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

        return view($this->halaman . 'galeridetail', $data);
    }


    //--------------------------------------------------------------------

}
