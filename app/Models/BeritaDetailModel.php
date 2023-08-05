<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaDetailModel extends Model
{
    protected $table = 'berita_detail';
    protected $primaryKey = 'berita_detail_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'berita_id',
        'berita_detail_judul',
        'berita_detail_slug',
        'berita_detail_gambar',
        'berita_detail_isi',
        'berita_detail_dibaca',
        'berita_detail_editor',
        'berita_detail_rep',
        'berita_detail_foto',
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

        return $this->where(['berita_detail_slug' => $slug])->first();
    }
}
