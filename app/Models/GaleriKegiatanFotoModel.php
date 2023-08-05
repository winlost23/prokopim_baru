<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriKegiatanFotoModel extends Model
{
    protected $table = 'galeri_kegiatan_foto';
    protected $primaryKey = 'galeri_kegiatan_foto_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'galeri_kegiatan_id',
        'galeri_kegiatan_foto_file',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
