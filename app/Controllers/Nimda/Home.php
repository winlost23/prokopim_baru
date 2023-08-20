<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;
use App\Models\AgendaModel;
use App\Models\BeritaDetailModel;
use App\Models\PengaturanModel;
use App\Models\PengunjungModel;
use App\Models\PidatoDetailModel;
use App\Models\SliderModel;
use App\Models\User;
use App\Models\UseronlineModel;

class Home extends BaseController
{
    protected $halaman = 'backend/dashboard/';
    protected $model;

    public function __construct()
    {
        $this->userModel = new User();
        $this->pengaturanModel = new PengaturanModel();
        $this->beritadetailModel = new BeritaDetailModel();
        $this->pidatodetailModel = new PidatoDetailModel();
        $this->agendaModel = new AgendaModel();
        $this->sliderModel = new SliderModel();
        $this->UseronlineModel = new UseronlineModel();
        $this->PengunjungModel = new PengunjungModel();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['users'] = $this->userModel->find(session()->userid);
        $data['pengaturan'] = $this->pengaturanModel->first();
        $data['jmlberita'] = $this->beritadetailModel->selectCount('berita_detail_id')->first();
        $data['jmlpidato'] = $this->pidatodetailModel->selectCount('pidato_detail_id')->first();
        $data['jmlagenda'] = $this->agendaModel->selectCount('agenda_id')->first();
        $data['jmlslider'] = $this->sliderModel->selectCount('slider_id')->first();
        $data['berita'] = $this->beritadetailModel
            ->join('berita', 'berita_detail.berita_id = berita.berita_id')
            ->orderby('berita_detail.berita_detail_id', 'desc')
            ->limit(5)
            ->findAll();
        $data['agenda'] = $this->agendaModel
            ->orderby('agenda_id', 'desc')
            ->limit(5)
            ->findAll();

        //grafik user
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(agenda_tanggal)as jml, agenda_tanggal FROM agenda WHERE year(agenda_tanggal) = YEAR(NOW()) GROUP BY month(agenda_tanggal)');
        $results = $query->getResult();
        $data['pengunjung'] = $results;

        $jmlos = $this->PengunjungModel->countAllResults();
        //grafik browser
        $queryb = $db->query('SELECT (COUNT(pengunjung_browser)/' . $jmlos . ')*100 as jml, pengunjung_browser FROM pengunjung GROUP BY pengunjung_browser');
        $resultsb = $queryb->getResult();
        $data['browser'] = $resultsb;

        //statistik OS
        $w10 = $this->PengunjungModel->selectCount('pengunjung_os')->where('pengunjung_os', 'Windows 10')->countAllResults();
        $data['w10'] = ceil(($w10 / $jmlos) * 100);
        $w8 = $this->PengunjungModel->selectCount('pengunjung_os')->where('pengunjung_os', 'Windows 8')->countAllResults();
        $data['w8'] = ceil(($w8 / $jmlos) * 100);
        $mac = $this->PengunjungModel->selectCount('pengunjung_os')->where('pengunjung_os', 'Mac OS')->countAllResults();
        $data['mac'] = ceil(($mac / $jmlos) * 100);
        $android = $this->PengunjungModel->selectCount('pengunjung_os')->where('pengunjung_os', 'Android')->countAllResults();
        $data['android'] = ceil(($android / $jmlos) * 100);
        $other = $this->PengunjungModel->selectCount('pengunjung_os')->where('pengunjung_os', 'Other')->countAllResults();
        $data['other'] = ceil(($other / $jmlos) * 100);

        return view($this->halaman . 'index', $data);
    }
}
