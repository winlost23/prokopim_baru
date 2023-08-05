<?php

namespace App\Models;

use CodeIgniter\Model;

class UseronlineModel extends Model
{
    protected $table = 'usersonline';
    protected $primaryKey = 'usersonline_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'usersonline_id',
        'usersonline_timestamp',
        'usersonline_ip',
        'usersonline_file',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
