<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
    protected $table = 'pengunjung';
    protected $primaryKey = 'pengunjung_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'pengunjung_ip',
        'pengunjung_browser',
        'pengunjung_os',
        'pengunjung_sistem_operasi',
        'pengunjung_tgl',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
