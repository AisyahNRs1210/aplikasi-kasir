<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MProduk;

class Produk extends BaseController
{
    public function index()
    {
        //
    }

     public function tampilProduk(){
         if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}
        $data =[
        'judulHalaman' =>'Data Produk',
        'introTeks'=>'Berikut data Produk Aneka kado yang tersedia',  
        'listProduk'=>$this->produk->getAllProduk()
        ] ;

         return view('produk/list-produk',$data);
    }

    public function formtambah(){
        $data=[
                'judulHalaman' =>'Form Penambahan Data Produk',
                'introTeks'=>'Untuk menambah data baru, silakan masukkan data karyawan baru pada form dibawah ini',
                'listSatuan'=>$this->satuan->getAllSatuan(),
                'listKategori'=>$this->kategori->getAllKategori()
                ];
                return view('produk/tambah-produk',$data);
    }

    public function tambah(){
        $validation = \Config\Services::validation();
        $validation->setRule('kode_produk', 'Kode Produk', 'required|is_unique[tbl_produk.kode_produk]', [
            'is_unique' => '{field} sudah digunakan!',
        ]);
        $validation->setRule('nama_produk', 'Nama Produk', 'required|is_unique[tbl_produk.nama_produk]', [
            'is_unique' => '{field} sudah digunakan!',
        ]);
        $validation->setRule('harga_beli', 'Harga Beli', 'required|greater_than[0]');
        $hargaBeli = str_replace('.', '', $this->request->getPost('harga_beli'));
      $validation->setRule('harga_jual', 'Harga Jual', 'required|greater_than[' . $hargaBeli . ']', [
    'greater_than' => 'Harga Jual harus lebih tinggi dari Harga Beli!'
    ]);

        $datavalid = [
            'kode_produk'=>$this->request->getPost('kode_produk'),
             'nama_produk'=>$this->request->getPost('nama_produk'),
            'harga_beli' => $hargaBeli, // Gunakan variabel hargaBeli yang telah dihapus separator titik
            'harga_jual'=>str_replace('.','',$this->request->getPost('harga_jual')), // Menghapus titik pemisah ribuan
          ];
          if (!$validation->run($datavalid)) {
             // Custom error messages will be used if validation fails
             return redirect()->back()->withInput()->with('errors', $validation->getErrors());
         }
        
         $data=[
            // 'id_produk'=>$this->request->getPost('id_produk'),
            'kode_produk'=>$this->request->getPost('kode_produk'),
            'nama_produk'=>$this->request->getPost('nama_produk'),
            'harga_beli'=>str_replace('.','',$this->request->getPost('harga_beli')),
            'harga_jual'=>str_replace('.','',$this->request->getPost('harga_jual')),
            'kode_satuan'=>$this->request->getPost('kode_satuan'),
            'kode_kategori'=>$this->request->getPost('kode_kategori'),
            'stok'=>str_replace('.','',$this->request->getPost('stok'))
         ];

         
                                    $this->produk->tambahProduk($data);
                                    session()->setFlashdata('pesan','Data berhasil ditambahkan');
                                
                            return redirect()->to('/list-produk');
       
    }

     public function edit($idProduk){
        $data =[
        'judulHalaman' =>'Form Perubahan Data Produk',
        'introTeks'=>'Untuk merubah data silakan lakukan perubahan pada form dibawah ini',
        'detailProduk'=>$this->produk->detailProduk($idProduk),
        'listSatuan'=>$this->satuan->getAllSatuan(),
        'listKategori'=>$this->kategori->getAllKategori()
        ] ;

        return view('produk/edit-produk',$data);
        }

        public function update(){
            var_dump($_POST);
             $idNya = $this->request->getPost('id_produk');  //tak ditampilkan di form 
             $kodeNya = $this->request->getPost('kode_produk');  
             $namaNya = $this->request->getPost('nama_produk');  
             $beliNya = str_replace('.','',$this->request->getPost('harga_beli'));
            $jualNya =str_replace('.','',$this->request->getPost('harga_jual'));
             $satuanNya = $this->request->getPost('kode_satuan');  
             $kategoriNya = $this->request->getPost('kode_kategori');  
             $stokNya = $this->request->getPost('stok');  

             error_log('id_produk: ' . $idNya); //log id produk
             error_log('kode_produk: ' . $idNya); 
             error_log('nama_produk: ' . $idNya); 
             error_log('harga_beli: ' . $idNya); 
             error_log('harga_jual: ' . $idNya); 
             error_log('kode_satuan: ' . $idNya); 
             error_log('kode_kategori: ' . $idNya); 
             error_log('stok: ' . $idNya); 

             $data =[
                'id_produk' => $idNya,
                'kode_produk' => $kodeNya,
                'nama_produk' => $namaNya,
                'harga_beli' => $beliNya,
                'harga_jual' => $jualNya,
                'kode_satuan' => $satuanNya,
                'kode_kategori' => $kategoriNya,
                'stok' => $stokNya,
             ];

             $this->produk->updateProduk($data);
             session()->setFlashdata('edit','Data berhasil diupdate');
            return redirect()->to('/list-produk') ;
        }

    public function hapus($idNya){
          $this->produk->hapusProduk($idNya);
        session()->setFlashdata('hapus','Data berhasil dihapus');
        return redirect()->to('/list-produk');
    }

    public function countTotalProduk(){
        return $this->countAll();
    }
}
