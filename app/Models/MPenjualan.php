<?php

namespace App\Models;

use CodeIgniter\Model;

class MPenjualan extends Model
{
    protected $table            = 'tbl_penjualan';
    protected $primaryKey       = 'kode_penjualan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_penjualan','tgl_penjualan','no_faktur','grand_total','email'];

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

    public function simpanPenjualan($no_faktur, $email, $id_produk, $qty)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_penjualan');

        // Memanggil stored procedure
        $builder->query("CALL tbl_penjualan('$no_faktur', '$email', $id_produk, $qty)");
    }

    public function getJumlahTransaksiHariIni()
    {
        // Mendapatkan tanggal saat ini dalam format Y-m-d (misalnya 2024-02-20)
        $tanggalSekarang = date('Y-m-d');

        // Query untuk menghitung jumlah transaksi pada hari ini
        $query = $this->where('tgl_penjualan', $tanggalSekarang)->countAllResults();

        return $query;
    }

    public function updateNomorFakturBaru($nomorFakturBaru) {
    // Mendapatkan kode penjualan terakhir
    $kodePenjualanTerakhir = session()->get('kode_penjualan');

    // Update nomor faktur terbaru
    $this->where('kode_penjualan', $kodePenjualanTerakhir)
         ->set('no_faktur', $nomorFakturBaru)
         ->update();
}

    public function generateNoFaktur(){
        // Dapatkan tahun dua angka terakhir
        $tanggal = date('Ymd');
        // no urut terakhir dari database
        $lastTransaction = $this->orderBy('kode_penjualan', 'DESC')->first();
        // Ambil nomor urut terakhir atau setel ke 0 jika belum ada transaksi sebelumnya
        $lastNumber = ($lastTransaction) ? intval(substr($lastTransaction['no_faktur'], -4)) : 0;
        // Increment nomor urut
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        // Hasilkan nomor transaksi dengan format SCDPSYYMMDDXXXX
        $no_faktur = 'INV-' . $tanggal . $nextNumber;
        // Simpan nomor transaksi dalam sesi
        session()->set('GeneratedTransactionNumber', $no_faktur);
        return $no_faktur;
    }

    public function getTotalHargaById($idPenjualan){
        $query = $this->select('grand_total')->where('kode_penjualan', $idPenjualan)->first();
            // Periksa apakah hasil kueri tidak kosong sebelum mengakses indeks 'total'
            if ($query) {
            return $query['grand_total'];
            } else {
            // Jika hasil kueri kosong, kembalikan nilai default, misalnya 0
            return 0;
            }
    }

    public function countTotalSales()
    {
        return $this->countAll(); // Menghitung jumlah semua transaksi penjualan
    }
}
