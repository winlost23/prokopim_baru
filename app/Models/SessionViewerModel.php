<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionViewerModel extends Model
{
    protected $table = 'session_viewer';
    protected $primaryKey = 'session_viewer_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'berita_detail_id',
        'session_viewer_ip',
        'session_viewer_tgl',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
