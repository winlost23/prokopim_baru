<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'users_id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = [
		'users_name',
		'users_password',
		'users_salt',
		'users_foto',
		'users_lastlogin',
		'users_lastip',
	];

	protected $useTimestamps = true;
	protected $createdField = 'users_created';
	protected $updatedField = 'users_updated';
	protected $deletedField = 'users_deleted';

	protected $validationRules = [
		'users_name' => 'required|alpha_numeric|min_length[5]|is_unique[users.users_name,users_id,{users_id}]',
		'users_password' => 'required|min_length[5]',
		'users_level' => 'required'
	];

	protected $validationMessages = [];
	protected $skipValidation = false;

	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];

	protected function hashPassword(array $data)
	{
		if (!isset($data['data']['users_password'])) {
			return $data;
		}

		$data['data']['users_salt'] = $this->generate_random_string();
		$data['data']['users_password'] = password_hash($data['data']['users_password'] . $data['data']['users_salt'], PASSWORD_DEFAULT);
		return $data;
	}

	public function getOwnValidationRules()
	{
		$prefixed_array = [];
		$len = strlen($this->table) + 1;

		foreach ($this->validationRules as $key => $value) {
			$prefixed_array[substr($key, $len)] = $value;
		}

		return $prefixed_array;
	}

	function generate_random_string($name_length = 25)
	{
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwqyz1234567890~!@#$%^&*()_+';
		return substr(str_shuffle($alpha_numeric), 0, $name_length);
	}
}
