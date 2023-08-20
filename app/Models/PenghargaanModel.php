<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghargaanModel extends Model
{
    protected $table = 'penghargaan';
    protected $primaryKey = 'penghargaan_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_id',
        'penghargaan_judul',
        'penghargaan_slug',
        'penghargaan_gambar',
        'penghargaan_isi',
        'penghargaan_tahun',
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

        return $this->where(['penghargaan_slug' => $slug])->first();
    }
}
