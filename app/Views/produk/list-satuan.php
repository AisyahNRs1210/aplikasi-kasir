<?= $this->extend('Layout/blank-dashboard');?>
<?= $this->section('konten');?>
<div class="container-fluid px-4">
<h3>Data Satuan</h3>
<p><?=$introTeks;?></p>
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
// Periksa apakah flashdata 'success' ada
if (session()->has('success')) {
    // Panggil fungsi helper untuk menampilkan SweetAlert
    echo flash_swal('success', 'Berhasil', session('success'));
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
   // Tentukan jenis ikon berdasarkan hasil penghapusan
    $type = strpos(session()->getFlashdata('hapus'), 'berhasil') !== false ? 'success' : 'warning';
    // Panggil fungsi helper untuk menampilkan SweetAlert
    echo flash_swal($type, $type == 'success' ? 'Berhasil' : 'Peringatan', session()->getFlashdata('hapus'));
}
?>

        
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#smallmodal"  style="float:right;"  href="<?=site_url('list-satuan');?>"><i class="fa fa-plus-square" style="color: #ffffff;"></i> Tambah</button>
       
    <!-- </div> -->

<table id="myTable" class="table table-sm table-striped table-bordered text-center">
  <thead>
    <tr>
        <th>No</th>
        <th>Nama Satuan</th>
        <th>Aksi</th>
    </tr>
  </thead>

<?php
  //  $id_kategori = 1;
   if(isset($listSatuan)) :
        $html =null;
        $no = 0;
      foreach($listSatuan as $baris) :
          $no++;
          $html .='<tr>';
          $html .='<td>'. $no.'</td>';
          $html .='<td>'. $baris->nama_satuan.'</td>';
          $html .='<td>
          <a href="'.site_url('list-satuan').'"  data-toggle="modal" data-target="#editmodal'.$baris->kode_satuan.'" title="edit" class="btn btn-primary btn-sm fw-bold">Edit</a>
          <a href="javascript:void(0);" onclick="confirmDelete(\''.site_url('hapus-satuan/'.$baris->kode_satuan).'\')" title="hapus" class="btn btn-danger btn-sm fw-bold">Hapus</a>
          </td>';
          $html .='</tr>';
      endforeach;
      echo $html;
   endif;
     
?> 
</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(url) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Anda tidak bisa mengembalikan data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke URL hapus dengan ID
            window.location.href = url;
        }
    });
}
</script> 

<!-- Modal Data -->
<!-- Modal Tambah -->
<div class="modal fade  <?= (session()->has('errors')) ? 'show' : '' ?>" id="smallmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Form Penambahan Data Satuan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" class="needs-validation" novalidate>
      <div class="modal-body">
      
    <div class="row mb-2">
            <div class="col-sm-13">
            <input type="hidden" class="form-control" name="kode_satuan" value="<?=isset($detailSatuan[0]->kode_satuan) ? $detailSatuan[0]->kode_satuan : null;?> "placeholder="Masukan Nama Satuan"/>
                <input class="form-control" type="text" name="nama_satuan" width="30"
                    value="<?=isset($detailSatuan[0]->nama_satuan) ? $detailSatuan[0]->nama_satuan : null;?>" placeholder="Masukan Nama Satuan" required/>
                     <?php if (session()->has('errors') && session('errors.nama_satuan')): ?>
                <p class="text-danger">
                    <?= esc(session('errors.nama_satuan')) ?>
                    </p>
            <?php endif; ?>
                     <div class="invalid-feedback">Nama Satuan tidak boleh kosong!</div>
            </div>
      </div>

      <div class="modal-footer">
      <div class="col-sm-4">
              <div class="col-sm-20">
            <button class="btn btn-block btn-primary btn-sm" type="submit">Simpan</button>
            </div>
            </div>
      </div>
</form>
    </div>
  </div>
</div>
</div>

<script>
    // Tambahkan event listener untuk memeriksa apakah terjadi kesalahan validasi saat tampilan dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Periksa apakah ada pesan kesalahan validasi
        var errors = document.querySelectorAll('.text-danger');
        
        // Jika ada pesan kesalahan validasi, tampilkan kembali modal
        if (errors.length > 0) {
            var modal = new bootstrap.Modal(document.getElementById('smallmodal'));
            modal.show();
        }
    });
</script>

<!-- Modal edit -->
<?php
   if(isset($listSatuan)) :
        $html =null;
        $no = 0;
      foreach($listSatuan as $baris) :
          $no++;
          $html .='<div class="modal fade" id="editmodal'.$baris->kode_satuan.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editmodalLabel">Form Perubahan Data Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="edit-satuan" class="needs-validation" novalidate>
              <div class="modal-body">
              
            <div class="row mb-2">
                    <div class="col-sm-13">
                    <input type="hidden" class="form-control" name="kode_satuan" value="'.$baris->kode_satuan.'" placeholder="Masukan Nama kategori"/>
                        <input class="form-control" type="text" name="nama_satuan" width="30"
                            value="'.$baris->nama_satuan.'" placeholder="Masukan Nama satuan" required/>
                            <div class="invalid-feedback">Nama kategori tidak boleh kosong!</div>
                    </div>
              </div>
        
              <div class="modal-footer">
              <div class="col-sm-4">
                      <div class="col-sm-20">
                    <button class="btn btn-block btn-primary btn-sm" type="submit">Simpan</button>
                    </div>
                    </div>
              </div>
        </form>
            </div>
          </div>
        </div>
        </div>';  
      endforeach;
      echo $html;
   endif; 
?> 
<!-- Akhir Modal -->

  <script src="<?= base_url('vendor/jquery/jquery/dist/jquery.min.js'); ?>"></script>
  


</div>
<?=$this->endSection();?>