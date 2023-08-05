<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table = 'kontak';
    protected $primaryKey = 'kontak_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kontak_nama',
        'kontak_pekerjaan',
        'kontak_telp',
        'kontak_file',
        'kontak_alamat',
        'kontak_email',
        'kontak_komentar',
        'kontak_sebagai',
        'kontak_show',
        'kontak_id_parent',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
