<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'berita_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'berita_judul',
        'berita_slug',
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

        return $this->where(['berita_slug' => $slug])->first();
    }
}
