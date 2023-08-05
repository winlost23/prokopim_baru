<?php

namespace App\Validation;

use App\Models\User;
use CodeIgniter\I18n\Time;

class UserRules {
	public function checkLogin(string $str, string $fields, array $data) {
		$model = new User();
		$user = $model->where('users_name', $data['username'])->find();
		if (!$user || count($user) > 1) {
			return false;
		}

		$result = password_verify(
			$data['password'] . $user[0]->users_salt,
			$user[0]->users_password
		);
		if ($result) {
			$request = \Config\Services::request();
			$model->save([
				'users_id' => $user[0]->users_id,
				'users_lastip' => $request->getIPAddress(),
				'users_lastlogin' => Time::now(),
			]);
		}
		return $result;
	}
}
