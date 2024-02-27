<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MKategori;
use App\Models\MProduk;


class Kategori extends BaseController
{
    public function __construct()
    {
        // Load model
        $this->produk = new MProduk();
    }

    public function index()
    {
        //
    }

      public function tampilKategori(){
         if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}

        
        $data =[
        'judulHalaman' =>'Daftar Kategori Produk',
        'introTeks'=>'Berikut data kategori produk Aneka kado yang tersedia',  
        'listKategori' => $this->kategori->getAllKategori()
    ] ;

    
    return view('produk/list-kategori',$data);
    }

    public function hapus($kodeKategori)
    {
      
         // Periksa apakah kategori terhubung dengan produk
    $terhubungProduk = $this->produk->countProductsByCategory($kodeKategori);
    
    if ($terhubungProduk) {
        // Tampilkan alert bahwa kategori tidak dapat dihapus karena terhubung dengan produk
        session()->setFlashdata('hapus', 'Kategori tidak dapat dihapus karena terhubung dengan produk.');
    } else {
        // Lanjutkan dengan proses penghapusan kategori
        $this->kategori->hapusKategori($kodeKategori);
        session()->setFlashdata('hapus', 'Data berhasil dihapus.');
    }

        return redirect()->to('/list-kategori');
        }
    

     public function formtambah(){
    // mengambil data kategori untuk komponen select
    $data=[
    'judulHalaman' =>'Form Penambahan Data Kategori',
    'introTeks'=>'Untuk menambah data baru, silakan masukkan data kategori produk pada form dibawah ini'
    ];

    return view('masterdata/list-kategori',$data);
}

    public function tambah(){
         $validation = \Config\Services::validation();
         $validation->setRule('nama_kategori', 'Nama Kategori', 'required|is_unique[tbl_kategori.nama_kategori]', [
            'is_unique' => '{field} sudah digunakan!',
        ]);

        $datavalid = [
            'nama_kategori'=>$this->request->getPost('nama_kategori')
        ];

         if (!$validation->run($datavalid)) {
             // Custom error messages will be used if validation fails
             return redirect()->back()->withInput()->with('errors', $validation->getErrors());
         }
    
    // jika tombol simpan ditekan
   
    $data=[
    // 'id_kategori' =>$this->request->getPost('idkategori'),    
    'nama_kategori' =>$this->request->getPost('nama_kategori'),
    ];
  
        $this->kategori->tambahKategori($data);
        session()->setFlashdata('success','Data berhasil ditambahkan');

         return redirect()->to('/list-kategori');
        }
       
        
      
    
        public function edit($idKategori){
            $detailKategori = $this->kategori->detailKategori($idKategori);
        
            if ($detailKategori) {
                $data = [
                    'judulHalaman' => 'Form Perubahan Kategori Produk',
                    'introTeks' => 'Untuk merubah data silakan lakukan perubahan pada form dibawah ini',
                    'idKategori' => $idKategori,
                    'detailKategori' => $detailKategori
                ];
                return view('masterdata/tambah-kategori', $data);
            } else {
                // Handle kasus jika data kategori tidak ditemukan (redirect atau tampilkan pesan error)
                return redirect()->to('masterdata/list-kategori')->with('error', 'Data kategori tidak ditemukan.');
            }
        }
        public function update(){
            var_dump($_POST);
            $idNya = $this->request->getPost('kode_kategori');
            $namaNya = $this->request->getPost('nama_kategori');
            error_log('kode_kategori: ' . $idNya); // Log ID kategori
            error_log('nama_kategori: ' . $namaNya); // Log Nama kategori
        
            $data = [
                'kode_kategori' => $idNya,
                'nama_kategori' => $namaNya
            ];
        
            $this->kategori->updateKategori($data);
            session()->setFlashdata('edit','Data berhasil diupdate');
        
            // Redirect ke halaman kategori setelah proses update selesai
            return redirect()->to('/list-kategori') ;
        }

        
}
