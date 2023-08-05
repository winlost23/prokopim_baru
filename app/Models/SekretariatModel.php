<?php

namespace App\Models;

use CodeIgniter\Model;

class SekretariatModel extends Model
{
    protected $table = 'sekretariat';
    protected $primaryKey = 'sekretariat_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'sekretariat_judul',
        'sekretariat_slug',
        'sekretariat_isi',
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

        return $this->where(['sekretariat_slug' => $slug])->first();
    }
}
