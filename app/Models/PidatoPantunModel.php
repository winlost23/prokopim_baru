<?php

namespace App\Models;

use CodeIgniter\Model;

class PidatoPantunModel extends Model
{
    protected $table = 'pidato_pantun';
    protected $primaryKey = 'pidato_pantun_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_id',
        'pidato_detail_id',
        'pidato_pantun_isi',
        'pidato_pantun_dibaca',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
