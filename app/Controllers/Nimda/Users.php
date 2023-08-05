<?php

namespace App\Controllers\Nimda;

use App\Controllers\BaseController;

use App\Models\User;
use App\Libraries\Definisi;
use App\Models\PengaturanModel;

class Users extends BaseController
{
	protected $halaman = 'backend/user/';
	protected $model;

	public function __construct()
	{
		$this->model = new User();
		$this->pengaturanModel = new PengaturanModel();
	}

	public function index()
	{
		$data['title'] = 'User';

		$data['users'] = $this->model->find(session()->userid);
		$data['pengaturan'] = $this->pengaturanModel->first();

		$def = new Definisi();
		$data['user'] = $this->model->findAll();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'index', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah User';

		$data['users'] = $this->model->find(session()->userid);
		$data['pengaturan'] = $this->pengaturanModel->first();

		$def = new Definisi();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		return view($this->halaman . 'add', $data);
	}

	public function save()
	{
		$valid = $this->model->getOwnValidationRules();
		$avatar = $this->request->getFile('foto');
		$foto = 'default.png';
		if ($avatar->isValid()) {
			$avatar->move(ROOTPATH . getenv('PUBLIC_PATH') . '/avatar');
			$foto = $avatar->getName();
		}
		$valid['password_ulangi'] = 'matches[password]';
		if (!$this->validate($valid)) {
			return redirect()
				->to(site_url('/nimda/users/add'))
				->withInput();
		}


		$data = [
			'users_name' => $this->request->getPost('name'),
			'users_password' => $this->request->getPost('password'),
		];

		$data['users_foto'] = $foto;
		$r = $this->model->save($data);
		if ($r) {
			$this->notif('User Berhasil disimpan.');
		} else {
			$this->notif('User Gagal disimpan.', 'error');
		}
		return redirect()->to(site_url('/nimda/users/'));
	}

	public function edit($id)
	{
		$data['title'] = 'Edit User';

		$data['users'] = $this->model->find(session()->userid);
		$data['pengaturan'] = $this->pengaturanModel->first();

		$def = new Definisi();
		$data['level'] = $def->level();
		$data['validation'] = \Config\Services::validation();
		$data['user'] = $this->model->find($id);
		return view($this->halaman . 'edit', $data);
	}

	public function update($id)
	{
		$valid = $this->model->getOwnValidationRules();
		$data = [];
		$avatar = $this->request->getFile('foto');
		if ($avatar->isValid()) {
			$valid['foto'] = 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg]';
		}

		$valid['password_ulangi'] = 'matches[password]';
		unset($valid['password']);
		// dd($valid);
		if (!$this->validate($valid)) {
			return redirect()
				->to(site_url('/nimda/users/edit/') . $id)
				->withInput();
		}

		$data = array_merge($data, [
			'users_id' => $id,
			'users_name' => $this->request->getPost('name'),
		]);

		if ($avatar->isValid()) {
			$avatar->move(ROOTPATH . getenv('PUBLIC_PATH') . '/avatar');
			$data['users_foto'] = $avatar->getName();
		}

		if ($this->request->getPost('password')) {
			$data['users_password'] = $this->request->getPost('password');
		}

		$r = $this->model->save($data);

		if ($r) {
			$this->notif('User Berhasil disimpan.');
		} else {
			$this->notif('User Gagal disimpan.', 'error');
		}
		return redirect()->to(site_url('/nimda/users'));
	}

	public function delete($id)
	{
		$r = $this->model->delete($id);

		if ($r) {
			$this->notif('User Berhasil dihapus.');
		} else {
			$this->notif('User Gagal dihapus.', 'error');
		}
		return redirect()->to(site_url('/nimda/users'));
	}
}
