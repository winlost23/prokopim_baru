<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriKegiatanModel extends Model
{
    protected $table = 'galeri_kegiatan';
    protected $primaryKey = 'galeri_kegiatan_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'galeri_kegiatan_judul',
        'galeri_kegiatan_slug',
        'galeri_kegiatan_fotografer',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getSlug($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['galeri_kegiatan_slug' => $slug])->first();
    }
}
