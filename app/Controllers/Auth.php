<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\User;

class Auth extends BaseController
{
	protected $halaman = 'backend/login/';
	protected $model;

	public function __construct()
	{
		$this->model = new User();
		$this->pengaturanModel = new PengaturanModel();
	}

	public function index()
	{
		if (session()->isLoggedIn) {
			return redirect()->to('/nimda');
		}
		$data['data'] = '';
		$data['pengaturan'] = $this->pengaturanModel->first();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function check_login()
	{
		$rules = [
			'username' => 'required|min_length[5]',
			'password' => 'required|min_length[5]|checkLogin[username,password]',
		];
		$errors = [
			'password' => [
				'checkLogin' => 'Username dan password tidak terdaftar.',
			],
		];

		if (!$this->validate($rules, $errors)) {
			// $validation = \Config\Services::validation();
			return redirect()
				->to('/auth')
				->withInput();
		}

		// $data = $this->model
		// 	->where('users_name', $this->request->getPost('username'))
		// 	->find();
		// dd($data);
		var_dump($this->request->getPost('username'));
		$data = $this->model
			->where('users_name', $this->request->getPost('username'))
			->find()[0];
		$this->regSession($data);
		return redirect()->to(site_url('/nimda/home'));
	}

	protected function regSession($x)
	{
		$data = [
			'isLoggedIn' => true,
			'userid' => $x->users_id,
			'username' => $x->users_name,
			'level' => $x->users_level,
		];
		session()->set($data);
		return true;
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(site_url('/'));
	}
}
