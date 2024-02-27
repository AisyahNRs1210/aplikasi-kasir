<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MSatuan;
use App\Models\MProduk;

class Satuan extends BaseController
{
    public function index()
    {
        //
    }

    public function tampilSatuan(){
         if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}
        $data =[
        'judulHalaman' =>'Daftar Satuan Produk',
        'introTeks'=>'Berikut data Satuan Produk Aneka kado yang tersedia',  
        'listSatuan'=>$this->satuan->getAllSatuan()
    ] ;
    
    return view('produk/list-satuan',$data);
    }

    public function hapus($idNya){
        
         // Periksa apakah kategori terhubung dengan produk
    $terhubungProduk = $this->produk->countProductsBySatuan($idNya);
    
    if ($terhubungProduk) {
        // Tampilkan alert bahwa kategori tidak dapat dihapus karena terhubung dengan produk
        session()->setFlashdata('hapus', 'Satuan tidak dapat dihapus karena terhubung dengan produk.');
    } else {
        // Lanjutkan dengan proses penghapusan kategori
        $this->satuan->hapusSatuan($idNya);
        session()->setFlashdata('hapus', 'Data berhasil dihapus.');
    }
        return redirect()->to('/list-satuan');
    }

     public function formtambah(){
    // mengambil data kategori untuk komponen select
    $data=[
    'judulHalaman' =>'Form Penambahan Data Satuan Produk',
    'introTeks'=>'Untuk menambah data baru, silakan masukkan data kategori produk pada form dibawah ini'
    ];

    return view('masterdata/list-satuan',$data);
}
   
    public function tambah(){
         $validation = \Config\Services::validation();
         $validation->setRule('nama_satuan', 'Nama Satuan', 'required|is_unique[tbl_satuan.nama_satuan]', [
            'is_unique' => '{field} sudah digunakan!',
        ]);

        $datavalid = [
            'nama_satuan'=>$this->request->getPost('nama_satuan')
        ];

         if (!$validation->run($datavalid)) {
             // Custom error messages will be used if validation fails
             return redirect()->back()->withInput()->with('errors', $validation->getErrors());
         }
    
    // jika tombol simpan ditekan
    $data=[
    // 'id_kategori' =>$this->request->getPost('idkategori'),    
    'nama_satuan' =>$this->request->getPost('nama_satuan'),
    ];
  
        $this->satuan->tambahSatuan($data);
        session()->setFlashdata('success','Data berhasil ditambahkan');
        return redirect()->to('/list-satuan');
    }
    
        public function edit($idSatuan){
            $detailKategori = $this->satuan->detailSatuan($idSatuan);
        
            if ($detailSatuan) {
                $data = [
                    'judulHalaman' => 'Form Perubahan Satuan Produk',
                    'introTeks' => 'Untuk merubah data silakan lakukan perubahan pada form dibawah ini',
                    'idSatuan' => $idSatuan,
                    'detailSatuan' => $detailSatuan
                ];
                return view('masterdata/tambah-satuan', $data);
            } else {
                // Handle kasus jika data kategori tidak ditemukan (redirect atau tampilkan pesan error)
                return redirect()->to('masterdata/list-satuan')->with('error', 'Data kategori tidak ditemukan.');
            }
        }
        public function update(){
            var_dump($_POST);
            $idNya = $this->request->getPost('kode_satuan');
            $namaNya = $this->request->getPost('nama_satuan');
            error_log('kode_satuan: ' . $idNya); // Log ID kategori
            error_log('nama_satuan: ' . $namaNya); // Log Nama kategori
        
            $data = [
                'kode_satuan' => $idNya,
                'nama_satuan' => $namaNya
            ];
        
            $this->satuan->updateSatuan($data);
            session()->setFlashdata('edit','Data berhasil diupdate');
        
            // Redirect ke halaman kategori setelah proses update selesai
            return redirect()->to('/list-satuan') ;
        }
}
