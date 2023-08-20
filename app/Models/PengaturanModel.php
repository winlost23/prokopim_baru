<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'pengaturan_id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'pengaturan_logo_header',
        'pengaturan_favicon',
        'pengaturan_alamat',
        'pengaturan_telp',
        'pengaturan_fax',
        'pengaturan_email',
        'pengaturan_website',
        'pengaturan_facebook',
        'pengaturan_twitter',
        'pengaturan_instagram',
        'pengaturan_youtube',
        'pengaturan_footer',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
