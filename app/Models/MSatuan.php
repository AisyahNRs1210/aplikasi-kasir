<?php

namespace App\Models;

use CodeIgniter\Model;

class MSatuan extends Model
{
    protected $table            = 'tbl_satuan';
    protected $primaryKey       = 'kode_satuan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_satuan','nama_satuan'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
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

    public function getAllSatuan(){
        $satuan= NEW MSatuan;
        $querySatuan = $satuan->query("CALL lihat_satuan()")->getResult();
        return $querySatuan;
    }

     public function tambahSatuan($data){
        $satuan = NEW MSatuan;
        $nama = $data['nama_satuan'];
        $satuan->query("CALL tambah_satuan('$nama')");
    }

    public function detailSatuan($idSatuan){
        $satuan = NEW MSatuan;
        $querySatuan = $satuan->query("CALL detail_satuan('".$idSatuan."')")->getResult();
        return $querySatuan;
    }

    public function updateSatuan($data){
        $satuan = NEW MSatuan;
        $idSatuan= $data['kode_satuan'];
        $nama = $data['nama_satuan'];
        $satuan->query("CALL update_satuan('$idSatuan','$nama')");
    }

    public function hapusSatuan($idSatuan){
        $satuan = NEW MSatuan;
        $satuan->query("CALL hapus_satuan('".$idSatuan."')");
    }

    public function cariSatuan($idSatuan){
         $satuan = NEW MSatuan;
        $querySatuan = $satuan->query("CALL cari_satuan('".$idSatuan."')")->getResult();
        return $querySatuan;
    }

}
