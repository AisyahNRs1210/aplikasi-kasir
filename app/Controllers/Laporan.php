<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use Dompdf\Dompdf;
use App\Models\MProduk;
use App\Models\MPenjualan;
use App\Models\MDetailPenjualan;

class Laporan extends BaseController
{
  public function index()
    {
        // 
    }

    public function tampilStok(){
         if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}
        $data =[
        'listProduk'=>$this->produk->laporanStok()
        ] ;

         return view('laporan/stok-barang',$data);
    }

    public function generate()
    {
        $filename = date('y-m-d-H-i-s'). ' Laporan-stok-barang';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $data =[
        'listProduk'=>$this->produk->laporanStok()
        ] ;
         // load HTML content
    
    $html = view('laporan/print-stok', $data);
    $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, $data);
    }

    public function tampilLaporanPenjualan(){
        return view('laporan/input-laporanpenjualan');
    }

   public function laporan()
{
    // Ambil data bulan, tahun, dan jenis laporan dari form
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');
    $jenis_laporan = $this->request->getPost('jenis_laporan');

    // Buat koneksi ke database
    $db = \Config\Database::connect();

    // Query untuk mengambil data penjualan
    $builder = $db->table('tbl_detailpenjualan');
    $builder->select('tbl_detailpenjualan.*, SUM(tbl_detailpenjualan.total_harga) AS total_penjualan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detailpenjualan.qty) AS total_keuntungan, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli');
    $builder->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan');
    $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    // var_dump($jenis_laporan);
    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan);
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    } elseif ($jenis_laporan == 'harian') {
        // Laporan Harian
        $tanggal = $this->request->getPost('tanggal'); // Ambil data tanggal dari form
        $builder->where('DATE(tbl_penjualan.tgl_penjualan)', $tanggal);
    } else {
        // Laporan Tahunan
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $query = $builder->get();
    $result = $query->getRow();

    // Query untuk mendapatkan detail penjualan
    $detailQuery = $db->table('tbl_detailpenjualan')
        ->select('tbl_detailpenjualan.*, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli')
        ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan)
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    } elseif ($jenis_laporan == 'harian') {
        // Laporan Harian
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('DATE(tbl_penjualan.tgl_penjualan)', $tanggal);
    } else {
        // Laporan Tahunan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $detailResult = $detailQuery->get()->getResultArray();

    $data = [
        'detail_penjualan' => $detailResult,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jenis_laporan' => $jenis_laporan,
        'total_penjualan' => isset($result->total_penjualan) ? $result->total_penjualan : null,
        'total_keuntungan' => isset($result->total_keuntungan) ? $result->total_keuntungan : null
    ];

    // Mengirim data ke view laporan
    return view('laporan/laporan-bulanantahunan', $data);
}

public function llaporan()
{
    // Ambil data bulan, tahun, dan jenis laporan dari form
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');
    $jenis_laporan = $this->request->getPost('jenis_laporan');

    // Buat koneksi ke database
    $db = \Config\Database::connect();

    // Query untuk mengambil data penjualan
    $builder = $db->table('tbl_detailpenjualan');
    $builder->select('tbl_detailpenjualan. *, SUM(tbl_detailpenjualan.total_harga) AS total_penjualan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detailpenjualan.qty) AS total_keuntungan, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli');
    $builder->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan');
    $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan);
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    } else {
        // Laporan Tahunan
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $builder->groupBy('tbl_detailpenjualan.kode_detailpenjualan'); // Tambahkan GROUP BY

    $query = $builder->get();
    $result = $query->getRow();

    // Query untuk mendapatkan detail penjualan
    $detailQuery = $db->table('tbl_detailpenjualan')
        ->select('tbl_detailpenjualan.*, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli')
        ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan)
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    
    } else {
        // Laporan Tahunan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $detailResult = $detailQuery->get()->getResultArray();

    $data = [
        'detail_penjualan' => $detailResult,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jenis_laporan' => $jenis_laporan,
        'total_penjualan' => isset($result->total_penjualan) ? $result->total_penjualan : null,
        'total_keuntungan' => isset($result->total_keuntungan) ? $result->total_keuntungan : null
    ];

    // Mengirim data ke view laporan
    return view('laporan/laporan-bulanantahunan', $data);
}

public function generate_laporan()
{
    // Ambil data bulan, tahun, dan jenis laporan dari form
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');
    $jenis_laporan = $this->request->getPost('jenis_laporan');

    // Buat koneksi ke database
    $db = \Config\Database::connect();

    // Query untuk mengambil data penjualan
    $builder = $db->table('tbl_detailpenjualan');
    $builder->select('tbl_detailpenjualan.*, SUM(tbl_detailpenjualan.total_harga) AS total_penjualan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detailpenjualan.qty) AS total_keuntungan, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli');
    $builder->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan');
    $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan);
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    } else {
        // Laporan Tahunan
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $builder->groupBy('tbl_detailpenjualan.kode_detailpenjualan'); // Tambahkan GROUP BY

    $query = $builder->get();
    $result = $query->getRow();

    // Query untuk mendapatkan detail penjualan
    $detailQuery = $db->table('tbl_detailpenjualan')
        ->select('tbl_detailpenjualan.*, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli')
        ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailpenjualan.id_produk');

    if ($jenis_laporan == 'bulanan') {
        // Laporan Bulanan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan)
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    } else {
        // Laporan Tahunan
        $detailQuery->join('tbl_penjualan', 'tbl_penjualan.kode_penjualan = tbl_detailpenjualan.kode_penjualan')
            ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    }

    $detailResult = $detailQuery->get()->getResultArray();

    $data = [
        'detail_penjualan' => $detailResult,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jenis_laporan' => $jenis_laporan,
        'total_penjualan' => isset($result->total_penjualan) ? $result->total_penjualan : null,
        'total_keuntungan' => isset($result->total_keuntungan) ? $result->total_keuntungan : null
    ];

    // Mengirim data ke view laporan
    return view('laporan/laporan-bulanantahunan', $data);
}




}
