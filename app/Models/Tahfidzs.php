<?php

namespace App\Models;

use CodeIgniter\Model;

class Tahfidzs extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tahfidz';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['anggotakelas_id', 'tanggal', 'bulan', 'akhlaq_pengurus', 'akhlaq_guru', 'kedisiplinan_ketertiban', 'kedisiplinan_kerapian', 'kedisiplinan_pelanggaran', 'absen', 'keterangan', 'nilai', 'juz'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function cols()
    {
        return $this->allowedFields;
    }
}
