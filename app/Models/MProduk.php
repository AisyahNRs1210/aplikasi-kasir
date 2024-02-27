<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk','kode_produk','nama_produk',
                                                           'harga_beli','harga_jual','diskon','kode_satuan','kode_kategori','stok'];

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

     public function getAllProduk(){
        $produk = NEW MProduk;
        $queryProduk = $produk->query("CALL lihat_produk()")->getResult();
        return $queryProduk;
    }

     public function laporanStok(){
        $produk = NEW MProduk;
        $queryProduk = $produk->query("CALL laporan_stok()")->getResult();
        return $queryProduk;
    }

    public function tambahProduk ($data){
        $produk = NEW MProduk;
        $kode = $data['kode_produk'];
        $nama = $data['nama_produk'];
        $beli = $data['harga_beli'];
        $jual = $data['harga_jual'];
        $satuan = $data['kode_satuan'];
        $kategori = $data['kode_kategori'];
        $stok = $data['stok'];

        $produk->query("CALL tambah_produk('$kode', '$nama', '$beli', '$jual', '$satuan', '$kategori', '$stok')");
    }

    public function detailProduk($idProduk){
        $produk = NEW MProduk;
        $queryProduk = $produk->query("CALL detail_produk('".$idProduk."')")->getResult();
        return $queryProduk;
    }

    public function getHargaById($idProduk){
        $produk = NEW MProduk;
        $queryProduk = $produk->query("CALL get_harga('".$idProduk."')")->getResult();
        return $queryProduk;
    }

    public function updateProduk($data){
        if(is_array($data) && isset($data['id_produk'])
                                       && isset($data['kode_produk'])
                                       && isset($data['nama_produk'])
                                       && isset($data['harga_beli'])
                                       && isset($data['harga_jual'])
                                       && isset($data['kode_satuan'])
                                       && isset($data['kode_kategori'])
                                       && isset($data['stok'])){ 
                                   
                $produk = NEW MProduk;
                $idProduk = $data['id_produk'];
                $kode = $data['kode_produk'];
                $nama = $data['nama_produk'];
                $beli = $data['harga_beli'];
                $jual = $data['harga_jual'];
                $satuan = $data['kode_satuan'];
                $kategori = $data['kode_kategori'];
                $stok = $data['stok'];

                 $produk->query("CALL update_produk('$idProduk', '$kode','$nama','$beli','$jual','$satuan','$kategori','$stok')");

        }
    }

    public function hapusProduk($idProduk){
        $produk = NEW MProduk;
        $produk->query("CALL hapus_produk('".$idProduk."')");
    }

    public function cariProduk($idProduk){
        $produk = NEW MProduk;
        $queryProduk = $produk->query("CALL cari_produk('".$idProduk."')")->getResult();
        return $queryProduk;
    }

   public function countProductsByCategory($kategori_id)
    {
        return $this->where('kode_kategori', $kategori_id)->countAllResults();
    }

   public function countProductsBySatuan($satuan_id)
    {
        return $this->where('kode_satuan', $satuan_id)->countAllResults();
    }


    public function getAllDetailProduk(){
        $produk= NEW MProduk;
        $queryproduk=$produk->query("CALL lihat_detailproduk()")->getResult();
        return $queryproduk;
    }

    public function countTotalProduk(){
        return $this->countAll();
    }

    
}
