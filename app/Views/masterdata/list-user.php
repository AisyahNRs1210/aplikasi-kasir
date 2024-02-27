<?= $this->extend('Layout/blank-dashboard');?>
<?= $this->section('konten');?>
<div class="container-fluid px-4">
<h1>Master Data</h1>
<hr style="color:black;"/>
<h3>Data Pengguna</h3>
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

   
        <a href="/tambah-user" class="btn btn-primary" style="float:right;">
            <i class="fa fa-plus-square" style="color: #ffffff;"></i> Tambah</a>
         

    <table id="myTable" class="table table-sm table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <?php
            if(isset($listPengguna)) :
                $html =null;
                $no = null;
            foreach($listPengguna as $baris) :
                $no++;
                $html .='<tr>';
                $html .='<td>'. $no.'</td>';
                $html .='<td>'. $baris->email.'</td>';
                $html .='<td>'. $baris->nama_user.'</td>';
                $html .='<td>'. $baris->role.'</td>';
                $html .='<td>'. $baris->status.'</td>';
                $html .='<td align="center">
                            <a href="'.site_url('edit-user/'.$baris->email).'" title="edit user" class="btn btn-primary btn-sm fw-bold">Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete(\''.site_url('hapus-user/'.$baris->email).'\')" title="hapus" class="btn btn-danger btn-sm fw-bold">Hapus</a>
                            </td>';
                $html .='</tr>';
            endforeach;
            endif;
            echo $html;
        ?>
    </table>
</div>
<?=$this->endSection();?>

