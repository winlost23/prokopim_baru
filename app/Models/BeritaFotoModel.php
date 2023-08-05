<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaFotoModel extends Model
{
    protected $table = 'berita_foto';
    protected $primaryKey = 'berita_foto_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'berita_foto_judul',
        'berita_foto_slug',
        'berita_foto_gambar',
        'berita_foto_deskripsi',
        'berita_foto_fotografer',
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

        return $this->where(['berita_foto_slug' => $slug])->first();
    }
}
