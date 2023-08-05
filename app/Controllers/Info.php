<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\KategoriModel;
use App\Models\InfoModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\ProfilModel;
use App\Models\UseronlineModel;

class Info extends BaseController
{
    protected $halaman = 'frontend/';

    public function __construct()
    {
        $this->ketegoriModel = new KategoriModel();
        $this->infoModel = new InfoModel();
        $this->profilModel = new ProfilModel();
        $this->beritaModel = new BeritaModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
    }

    public function index($slug)
    {
        $data['title'] = '| Info';
        $data['menu'] = 'kedua';
        $data['pengaturan'] = $this->pengaturanModel
            ->first();

        $data['profil'] = $this->ketegoriModel
            ->where('kategori_jenis', 'profil')
            ->findAll();
        $data['info'] = $this->ketegoriModel
            ->where('kategori_jenis', 'info')
            ->findAll();
        $data['berita'] = $this->ketegoriModel
            ->where('kategori_jenis', 'berita')
            ->findAll();

        //slide
        $data['infoslide'] = $this->infoModel
            ->join('kategori', 'info.kategori_id=kategori.kategori_id')
            ->orderby('info_id', 'desc')
            ->limit(5)
            ->findAll();
        $data['beritaslide'] = $this->beritaModel
            ->join('kategori', 'berita.kategori_id=kategori.kategori_id')
            ->orderby('berita_id', 'desc')
            ->limit(5)
            ->findAll();

        //cek id info
        $idinfo = $this->ketegoriModel
            ->where('kategori_slug', $slug)
            ->first();
        $data['dinfo'] = $this->ketegoriModel
            ->where('kategori_slug', $slug)
            ->first();
        $data['datainfo'] = $this->infoModel
            ->join('users', 'info.users_id = users.users_id')
            ->where('kategori_id', $idinfo->kategori_id)
            ->orderby('info_id', 'desc')
            ->findAll();

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

        return view($this->halaman . 'info', $data);
    }

    public function detail($slugKategori, $slugInfo)
    {
        $data['title'] = '| Detail Info';
        $data['menu'] = 'kedua';
        $data['pengaturan'] = $this->pengaturanModel
            ->first();

        $data['profil'] = $this->ketegoriModel
            ->where('kategori_jenis', 'profil')
            ->findAll();
        $data['info'] = $this->ketegoriModel
            ->where('kategori_jenis', 'info')
            ->findAll();
        $data['berita'] = $this->ketegoriModel
            ->where('kategori_jenis', 'berita')
            ->findAll();

        //slide
        $data['infoslide'] = $this->infoModel
            ->join('kategori', 'info.kategori_id=kategori.kategori_id')
            ->orderby('info_id', 'desc')
            ->limit(5)
            ->findAll();
        $data['beritaslide'] = $this->beritaModel
            ->join('kategori', 'berita.kategori_id=kategori.kategori_id')
            ->orderby('berita_id', 'desc')
            ->limit(5)
            ->findAll();


        $data['dinfo'] = $this->ketegoriModel
            ->where('kategori_slug', $slugKategori)
            ->first();
        $data['datainfodetail'] = $this->infoModel
            ->where('info_slug', $slugInfo)
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

        return view($this->halaman . 'infodetail', $data);
    }

    public function download($id, $slugKategori, $slugInfo)
    {
        $dinfo = $this->infoModel->find($id);
        if (file_exists('file/' . $dinfo->info_file)) {
            $this->infoModel->where('info_id', $id)->increment('info_download', 1);
            return $this->response->download('file/' . $dinfo->info_file, null);
        } else {
            $this->notif('File Download Tidak Tersedia.', 'danger');
            return redirect()->to('/info/' . $slugKategori . '/' . $slugInfo);
        }
    }

    //--------------------------------------------------------------------

}
