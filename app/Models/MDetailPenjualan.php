<?php

namespace App\Models;

use CodeIgniter\Model;

class MDetailPenjualan extends Model
{
    protected $table            = 'tbl_detailpenjualan';
    protected $primaryKey       = 'kode_detailpenjualan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_detailpenjualan','kode_penjualan','id_produk','qty','diskon','total_harga'];

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

    // public function getAllDetail(){
    //      $detailPenjualan = NEW MDetailPenjualan;
    //     $queryDetail = $detailPenjualan->query("CALL lihat_daftartransaksi()")->getResult();
    //     return $queryDetail;
    // }

    public function getDetailPenjualan($idPenjualan){
        return $this->db->table('tbl_detailpenjualan')
            ->select('tbl_detailpenjualan.*, tbl_penjualan.no_faktur,tbl_produk.nama_produk')
            ->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk')
            ->where('tbl_detailpenjualan.kode_penjualan', $idPenjualan)
            ->get()
            ->getResultArray();
    }

    public function hapusdetail($idDetail){
        $detailPenjualan = NEW MDetailPenjualan;
        $detailPenjualan->query("CALL hapus_detailPenjualan('".$idDetail."')");
    }
}
