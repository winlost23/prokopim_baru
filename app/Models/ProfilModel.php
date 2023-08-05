<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'profil';
    protected $primaryKey = 'profil_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_id',
        'profil_judul',
        'profil_slug',
        'profil_isi',
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

        return $this->where(['profil_slug' => $slug])->first();
    }
}
