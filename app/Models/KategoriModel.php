<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_judul',
        'kategori_slug',
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

        return $this->where(['kategori_slug' => $slug])->first();
    }
}
