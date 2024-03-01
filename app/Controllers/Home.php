<?php

namespace App\Controllers;

use App\Models\MPenjualan;
use App\Models\MUser;
use App\Models\MProduk;
use App\Models\MKategori;
use App\Models\MSatuan;


class Home extends BaseController
{
      public function index()
    {
        return view('layout/form-login');
    }

    public function dashboard()
    {
        return view('layout/blank-dashboard');
    }

    public function realDashboard(){
         if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}
        // Mengambil jumlah transaksi penjualan dari model
        $totalSales = $this->penjualan->countTotalSales();
        $totalUsers = $this->user->countTotalUsers();
        $totalProduk = $this->produk->countTotalProduk();
        $totalKategori = $this->kategori->countTotalKategori();
        $pendapatanHariIni = $this->penjualan->getPendapatanHariIni();
        $activeUsers = $this->user->countActiveUsers();
        $inactiveUsers = $this->user->countInactiveUsers();


        $data =[
            'totalSales' => $totalSales,
            'totalUsers' => $totalUsers,
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'listProduk' => $this->produk->getAllProduk(),
            'listKategori' => $this->kategori->getAllKategori(),
            'listSatuan' => $this->satuan->getAllSatuan(),
            'pendapatanHariIni' =>$pendapatanHariIni,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers
        ];
        return view('layout/dashboard', $data);
    }
}
