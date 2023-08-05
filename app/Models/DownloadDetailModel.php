<?php

namespace App\Models;

use CodeIgniter\Model;

class DownloadDetailModel extends Model
{
    protected $table = 'download_detail';
    protected $primaryKey = 'download_detail_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'download_id',
        'download_detail_judul',
        'download_detail_slug',
        'download_detail_ukuran',
        'download_detail_ext',
        'download_detail_file',
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

        return $this->where(['download_detail_slug' => $slug])->first();
    }
}
