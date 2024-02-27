<?php

namespace App\Models;

use CodeIgniter\Model;

class MKategori extends Model
{
    protected $table            = 'tbl_kategori';
    protected $primaryKey       = 'kode_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_kategori','nama_kategori'];

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

    public function __construct()
    {
        parent::__construct();
        $this->produk = new MProduk();
    }

     public function getAllKategori(){
        $kategori= NEW MKategori;
        $queryKategori = $kategori->query("CALL lihat_kategori()")->getResult();
        return $queryKategori;
    }

    public function tambahKategori($data){
        $kategori = NEW MKategori;
        $nama = $data['nama_kategori'];
        $kategori->query("CALL tambah_kategori('$nama')");
    }

    public function detailKategori($idKategori){
        $kategori = NEW MKategori;
        $queryKategori = $kategori->query("CALL detail_kategori('".$idKategori."')")->getResult();
        return $queryKategori;
    }

    public function updateKategori($data){
        $kategori = NEW MKategori;
        $idKategori = $data['kode_kategori'];
        $nama = $data['nama_kategori'];
        $kategori->query("CALL update_kategori('$idKategori','$nama')");
    }

    public function hapusKategori($idKategori){
        $kategori = NEW MKategori;
        $kategori->query("CALL hapus_kategori('".$idKategori."')");
    }

    public function cariKategori($idKategori){
         $kategori = NEW MKategori;
        $queryKategori = $kategori->query("CALL cari_kategori('".$idKategori."')")->getResult();
        return $queryKategori;
    }

    public function countTotalKategori(){
        return $this->countAll();
    }

    

}
