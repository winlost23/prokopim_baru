<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'agenda_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'agenda_judul',
        'agenda_slug',
        'agenda_tanggal',
        'agenda_jam',
        'agenda_lokasi',
        'agenda_petugas',
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

        return $this->where(['agenda_slug' => $slug])->first();
    }
}
