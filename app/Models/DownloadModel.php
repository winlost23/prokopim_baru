<?php

namespace App\Models;

use CodeIgniter\Model;

class DownloadModel extends Model
{
    protected $table = 'download';
    protected $primaryKey = 'download_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'download_judul',
        'download_slug',
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

        return $this->where(['download_slug' => $slug])->first();
    }
}
