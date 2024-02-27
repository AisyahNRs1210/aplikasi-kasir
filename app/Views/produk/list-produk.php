<?= $this->extend('Layout/blank-dashboard');?>
<?= $this->section('konten');?>
<div class="container-fluid px-4">
<h3>Data Produk</h3>
<p><?=$introTeks;?></p>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php 
// Periksa apakah flashdata 'success' ada
if (session()->has('pesan')) {
    // Panggil fungsi helper untuk menampilkan SweetAlert
    echo flash_swal('success', 'Berhasil', session('pesan'));
}
?>

<?php
// Periksa apakah flashdata 'success' ada
if (session()->has('edit')) {
    // Panggil fungsi helper untuk menampilkan SweetAlert
    echo flash_swal('success', 'Berhasil', session('edit'));
}
?> 

<?php
// Periksa apakah flashdata 'success' ada
if (session()->has('hapus')) {
    // Panggil fungsi helper untuk menampilkan SweetAlert
    echo flash_swal('success', 'Berhasil', session('hapus'));
}
?>

   
        <a href="/tambah-produk" class="btn btn-primary" style="float:right;">
            <i class="fa fa-plus-square" style="color: #ffffff;"></i> Tambah</a>
         

    <table id="myTable" class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <?php
            if(isset($listProduk)) :
                $html =null;
                $no = null;
            foreach($listProduk as $baris) :
                $no++;
                $html .='<tr>';
                $html .='<td>'. $no.'</td>';
                $html .='<td>'. $baris->kode_produk.'</td>';
                $html .='<td>'. $baris->nama_produk.'</td>';
                $html .='<td align="left">Rp. '.number_format($baris->harga_beli,0,',','.').'</td>';
                $html .='<td align="left">Rp. '.number_format($baris->harga_jual,0,',','.').'</td>';
                $html .='<td>'. $baris->nama_satuan.'</td>';
                $html .='<td>'. $baris->nama_kategori.'</td>';
                $html .='<td align="left">'.number_format($baris->stok,0,',','.').'</td>';
                $html .='<td align="center">
                            <a href="'.site_url('edit-produk/'.$baris->id_produk).'" title="edit user" class="btn btn-primary btn-sm fw-bold">Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete(\''.site_url('hapus-produk/'.$baris->id_produk).'\')" title="hapus" class="btn btn-danger btn-sm fw-bold">Hapus</a>
                            </td>';
                $html .='</tr>';
            endforeach;
            endif;
            echo $html;
        ?>
    </table>
</div>
<?=$this->endSection();?>

