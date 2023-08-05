<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'slider_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'slider_judul_1',
        'slider_judul_2',
        'slider_gambar',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
