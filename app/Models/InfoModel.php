<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
    protected $table = 'info';
    protected $primaryKey = 'info_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'users_id',
        'kategori_id',
        'info_judul',
        'info_slug',
        'info_isi',
        'info_gambar',
        'info_file',
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

        return $this->where(['info_slug' => $slug])->first();
    }
}
