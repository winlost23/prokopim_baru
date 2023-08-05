<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoKegiatanModel extends Model
{
    protected $table = 'video_kegiatan';
    protected $primaryKey = 'video_kegiatan_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'video_kegiatan_judul',
        'video_kegiatan_slug',
        'video_kegiatan_link',
        'video_kegiatan_foto',
        'video_kegiatan_videografer',
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

        return $this->where(['video_kegiatan_slug' => $slug])->first();
    }
}
