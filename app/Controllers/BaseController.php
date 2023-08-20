<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\PengunjungModel;
use App\Models\UseronlineModel;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		helper(['myhelper','tanggal']);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();

		$this->PengunjungModel = new PengunjungModel();
		$this->UseronlineModel = new UseronlineModel();

		//Pengunjung
		$ip    = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP user
		$tgl  = date("Y-m-d"); // Mendapatkan tanggal sekarang

		// Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
		$cekip = $this->PengunjungModel->where('pengunjung_ip', $ip)->where('pengunjung_tgl', $tgl)->countAllResults();

		$ss = isset($cekip) ? ($cekip) : 0;
		//browser
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
			$browser = 'Netscape';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
			$browser = 'Firefox';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
			$browser = 'Chrome';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
			$browser = 'Opera';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
			$browser = 'Internet Explorer';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari'))
			$browser = 'Safari';
		else
			$browser = 'Other';

		//windows
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows nt 10.0'))
			$windows = 'Windows 10';
		else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows nt 6.2'))
			$windows = 'Windows 8';
		else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'macintosh|mac os x'))
			$windows = 'Mac OS';
		else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'mac_powerpc'))
			$windows = 'Mac OS';
		else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android'))
			$windows = 'Android';
		else
			$windows = 'Other';
		// Kalau belum ada, simpan data user tersebut ke database
		if ($ss == 0) {
			$r = $this->PengunjungModel->save([
				'pengunjung_ip' => $ip,
				'pengunjung_browser' => $browser,
				'pengunjung_os' => $windows,
				'pengunjung_sistem_operasi' => $_SERVER['HTTP_USER_AGENT'],
				'pengunjung_tgl' => $tgl,
			]);
		}
		//END Pengunjung

		//simpan data info pengguna
		$data = [
			'browser' => $browser,
			'os' => $windows,
			'ip' => $ip,
		];
		session()->set($data);

		//User Online
		$to_secs = 30;
		$t_stamp = time();
		$timeout = $t_stamp - $to_secs;
		$REMOTEADDR = $_SERVER['REMOTE_ADDR'];
		$PHPSELF = $_SERVER['PHP_SELF'];

		$this->UseronlineModel->save([
			'usersonline_timestamp' => $t_stamp,
			'usersonline_ip' => $REMOTEADDR,
			'usersonline_file' => $PHPSELF,
		]);

		$this->UseronlineModel->where('usersonline_timestamp <', $timeout)->delete();
		//END Online
	}

	public function notif($pesan, $tipe = 'success')
	{
		session()->setFlashdata('tipe', $tipe);
		session()->setFlashdata('pesan', $pesan);
	}
}
