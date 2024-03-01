<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MPenjualan;
use App\Models\MDetailPenjualan;
use App\Models\MProduk;

class Penjualan extends BaseController
{
    public function index()
    {
        //
    }

    

     public function get_harga_produk($id_produk) {
    // Ambil harga produk dari database berdasarkan ID produk
    $harga_produk = $this->produk->getHargaById($id_produk);

    // Jika harga produk ditemukan, kirimkan respon dalam bentuk JSON
    if($harga_produk) {
        echo json_encode(['harga_jual' => $harga_produk]);
    } else {
        // Jika harga produk tidak ditemukan, kirimkan respon dengan status 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "Harga produk tidak ditemukan";
    }
}



public function lihatPenjualan(){
     if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
		}
        
    $no_faktur = $this->penjualan->generateNoFaktur();

    $data =[
        'no_faktur'=>$no_faktur,
        'listProduk'=> $this->produk->getAllDetailProduk(),
        'listTransaksi' => $this->detailPenjualan->getDetailPenjualan(session()->get('idPenjualan')),
        'totalHarga' => $this->penjualan->getTotalHargaById(session()->get('idPenjualan'))
    ];

    return view('transaksi/form-penjualan', $data);

}

public function savePenjualan() {
    // ambil detail barang yang dijual
    $where=['id_produk'=>$this->request->getPost('id_produk')];
    $cekBarang=$this->produk->where($where)->findAll(); 
    $hargaJual=$cekBarang[0]['harga_jual'];

    if(session()->get('idPenjualan') == null){            
        // 1. Menyiapkan data penjualan
        date_default_timezone_set('Asia/Jakarta');
        // Mendapatkan waktu saat ini dalam zona waktu yang telah diatur
        $tanggal_sekarang = date('Y-m-d H:i:s');

        $grandTotal = $hargaJual * $this->request->getPost('jumlah'); // Hitung grand total dari barang pertama kali ditambahkan

        $dataPenjualan=[
            'no_faktur'=>$this->request->getPost('no_faktur'),
            'tgl_penjualan'=>$tanggal_sekarang, // Perbaiki format tanggal
            'email'=> session()->get('email'),
            'grand_total'=> $grandTotal // Simpan grand total sebagai total harga barang pertama kali
        ];
        
        // 2. Menyimpan data ke dalam tabel penjualan
        $this->penjualan->insert($dataPenjualan);

        // 3. Menyiapkan data untuk menyimpan detail penjualan
        $idPenjualanBaru = $this->penjualan->insertID(); // Mendapatkan ID penjualan baru
        $dataDetailPenjualan=[
            'kode_penjualan'=>$idPenjualanBaru,
            'id_produk'=>$this->request->getPost('id_produk'),
            'qty'=> $this->request->getPost('jumlah'),
            'total_harga'=>$hargaJual*$this->request->getPost('jumlah') // Perbaiki perhitungan total harga
        ];

        // 4. Menyimpan data ke dalam tabel detail penjualan
        $this->detailPenjualan->insert($dataDetailPenjualan);

        // 5. Membuat session untuk penjualan baru
        session()->set('idPenjualan', $idPenjualanBaru);
    } else {
        // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
        $idPenjualanSaatIni = session()->get('idPenjualan');
        $dataDetailPenjualan=[
            'kode_penjualan'=>$idPenjualanSaatIni,
            'id_produk'=>$this->request->getPost('id_produk'),
            'qty'=> $this->request->getPost('jumlah'),
            'total_harga'=>$hargaJual*$this->request->getPost('jumlah') // Perbaiki perhitungan total harga
        ];

        // Simpan data ke dalam tabel detail penjualan
        $this->detailPenjualan->insert($dataDetailPenjualan);

        // Perbarui grand total dalam tabel penjualan dengan menambahkan total harga barang baru
        $grandTotalSebelumnya = $this->penjualan->getTotalHargaById($idPenjualanSaatIni);
        $grandTotalBaru = $grandTotalSebelumnya + ($hargaJual * $this->request->getPost('jumlah'));
        $this->penjualan->update($idPenjualanSaatIni, ['grand_total' => $grandTotalBaru]);
    }

    // Mengarahkan pengguna kembali ke halaman transaksi penjualan
    return redirect()->to('/form-penjualan');
}

public function savePembayaran()
{
    // Mendapatkan ID penjualan yang selesai
    $idPenjualanSelesai = session()->get('idPenjualan');
    
    // Reset session kode penjualan untuk transaksi baru
    session()->remove('idPenjualan');

    // Mengarahkan pengguna kembali ke halaman transaksi penjualan
    return redirect()->to('/form-penjualan');
}

public function hapus($idNya){
       $this->detailPenjualan->hapusDetail($idNya);
        session()->setFlashdata('hapus','Data berhasil dihapus');
        return redirect()->to('/form-penjualan');
}


public function simpanPenjualan(){
        // ambil detail barang yang dijual
        $where=['id_produk'=>$this->request->getPost('id_produk')];
        $cekBarang=$this->produk->where($where)->findAll(); 
        $hargaJual=$cekBarang[0]['harga_jual'];
    
        if(session()->get('kode_penjualan') == null){            
            // 1. Menyiapkan data penjualan
            date_default_timezone_set('Asia/Jakarta');
            // Mendapatkan waktu saat ini dalam zona waktu yang telah diatur
            $tanggal_sekarang = date('Y-m-d H:i:s');

            $dataPenjualan=[
                'no_faktur'=>$this->generateNomorFaktur(),
                'tgl_penjualan'=>$tanggal_sekarang, // Perbaiki format tanggal
                'email'=> session()->get('email'),
                'total'=>0
            ];
            
            // 2. Menyimpan data ke dalam tabel penjualan
            $this->penjualan->insert($dataPenjualan);
    
            // 3. Menyiapkan data untuk menyimpan detail penjualan
            $idPenjualanBaru = $this->penjualan->insertID(); // Mendapatkan ID penjualan baru
            $dataDetailPenjualan=[
                'kode_penjualan'=>$idPenjualanBaru,
                'id_produk'=>$this->request->getPost('id_produk'),
                'qty'=> $this->request->getPost('jumlah'),
                'total_harga'=>$hargaJual*$this->request->getPost('jumlah') * $hargaJual
            ];
    
            // 4. Menyimpan data ke dalam tabel detail penjualan
            $this->detailPenjualan->insert($dataDetailPenjualan);
    
            // 5. Membuat session untuk penjualan baru
            session()->set('kode_penjualan', $idPenjualanBaru);
        } else {
            // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
            $idPenjualanSaatIni = session()->get('kode_penjualan');
            $dataDetailPenjualan=[
                'kode_penjualan'=>$idPenjualanSaatIni,
                'id_produk'=>$this->request->getPost('id_produk'),
                'qty'=> $this->request->getPost('jumlah'),
                'total_harga'=>$hargaJual*$this->request->getPost('jumlah') * $hargaJual
            ];
    
            // Simpan data ke dalam tabel detail penjualan
            $this->detailPenjualan->insert($dataDetailPenjualan);
        }
    
        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('/form-penjualan');
    }
    public function saveePembayaran(){
        // Mendapatkan ID penjualan yang selesai
        $idPenjualanSelesai = session()->get('kode_penjualan');
        
        // Menghapus ID penjualan dari sesi
        session()->remove('kode_penjualan');

        // Update nomor faktur untuk transaksi yang selesai
    $nomorFakturBaru = $this->generateNomorFaktur();
    // Anda mungkin perlu menyimpan nomor faktur ini ke dalam database juga, tergantung pada kebutuhan aplikasi Anda
        
        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('/form-penjualan');
    }

// Fungsi untuk mengupdate nomor faktur
// private function updateNomorFaktur() {
//     // Panggil fungsi untuk menghasilkan nomor faktur baru
//     $nomorFakturBaru = $this->generateNomorFaktur();

//     // Lakukan proses update nomor faktur terbaru di tabel penjualan
//     // Anda perlu menyesuaikan dengan struktur tabel dan model yang Anda gunakan
//     $this->penjualan->updateNomorFakturBaru($nomorFakturBaru);
// }


    public function simpanPembayaran() {
    // Panggil fungsi untuk mengupdate nomor faktur
    // $this->updateNomorFaktur();

    // Hapus session kode_penjualan
    session()->remove('kode_penjualan');

    // Redirect ke halaman penjualan atau ke halaman lain sesuai kebutuhan
    return redirect()->to('form-penjualan');
}

// private function updateNomorFaktur() {
//     // Generate new invoice number after payment
//     $nomorFakturBaru = $this->generateNomorFaktur();

//     // Get the current transaction ID from session
//     $kodePenjualan = session()->get('kode_penjualan');

//     // Update the invoice number in the database
//     $this->penjualan->update($kodePenjualan, ['no_faktur' => $nomorFakturBaru]);
// }



// public function prosesPenjualan()
// {
//     // Validasi form penjualan
//     $this->validate([
//         'email' => 'required|valid_email',
//         'jumlah' => 'required|numeric',
//         'harga' => 'required|numeric',
//     ]);

//     // Simpan data penjualan ke dalam tabel penjualan
//     $nomorFaktur = $this->generateNomorFaktur();
    
//     $penjualan = new MPenjualan();
//     $dataPenjualan = [
//         'tgl_penjualan' => date('Y-m-d H:i:s'),
//         'no_faktur' => $nomorFaktur,
//          'email' => session()->get('email') 
//     ];
//     $penjualan->save($dataPenjualan);

//     // Simpan data detail penjualan ke dalam tabel detail penjualan
//     $detailPenjualan = new MDetailPenjualan();
//     $dataDetailPenjualan = [
//         'kode_penjualan' => $penjualan->insertID(),
//         'id_produk' => $this->request->getPost('id_produk'),
//         'qty' => $this->request->getPost('jumlah'),
//         'total_harga' => $this->request->getPost('jumlah') * $this->request->getPost('harga_jual'),
//     ];
//     $detailPenjualan->save($dataDetailPenjualan);

//     return redirect()->to('/form-penjualan')->with('success', 'Data penjualan berhasil disimpan');
// }

// public function prosesPembayaran()
// {
//     // Validasi form pembayaran
//     $this->validate([
//         'total_harga' => 'required|numeric',
//         'bayar' => 'required|numeric',
//         'kembali' => 'required|numeric',
//     ]);

//     // Simpan data pembayaran ke dalam tabel pembayaran
    
//     $kembali = $bayar - $totalHarga;

//     $pembayaran = new PembayaranModel();
//     $dataPembayaran = [
//         'total_harga' => $this->request->getPost('total_harga'),
//         'bayar' => $this->request->getPost('bayar'),
//         'kembali' => $this->request->getPost('kembali'),
//     ];
//     $pembayaran->save($dataPembayaran);

//     return redirect()->to('/pembayaran')->with('success', 'Data pembayaran berhasil disimpan');
// }


}
