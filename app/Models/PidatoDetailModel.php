<?php

namespace App\Models;

use CodeIgniter\Model;

class PidatoDetailModel extends Model
{
    protected $table = 'pidato_detail';
    protected $primaryKey = 'pidato_detail_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_id',
        'pidato_detail_judul',
        'pidato_detail_slug',
        'pidato_detail_tgl_acara',
        'pidato_detail_tempat',
        'pidato_detail_file',
        'pidato_detail_ext',
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

        return $this->where(['pidato_detail_slug' => $slug])->first();
    }
}
