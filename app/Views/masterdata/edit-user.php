<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
<h3><?=$judulHalaman;?></h3>
<p><?=$introTeks;?></p>
<div class="row" style="min-height:350px">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
      <form class="mt-4 needs-validation" method="POST" novalidate>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" width="20"
                    value="<?=isset($detailPengguna[0]->email) ? $detailPengguna[0]->email : null;?>"
                    placeholder="Masukkan email" readonly/>
                    <!-- <div class="invalid-feedback">Email tidak boleh kosong</div> -->
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Nama Karyawan</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="nama_user" width="20"
                    value="<?=isset($detailPengguna[0]->nama_user) ? $detailPengguna[0]->nama_user : null;?>"
                    placeholder="Masukkan nama karyawan" readonly/>
                    <!-- <div class="invalid-feedback">Nama Karyawan tidak boleh kosong</div> -->
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
                <select class="form-control" name="role">
                  <?php
                       $jabatanOptions = ['admin', 'petugas'];
                       foreach ($jabatanOptions as $role) {
                           $selected = $role == $detailPengguna[0]->role ? 'selected' : '';
                           echo '<option ' . $selected . ' value="' . $role . '">' . $role . '</option>';
                       }
                    ?>
                </select>
            </div>
        </div>

         <div class="row mb-2">
        <label class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-3">
        <div class="rdbutton">
            <p>
            <input type='radio' name='status' value='aktif' <?= (isset($detailPengguna[0]->status) && $detailPengguna[0]->status == 'aktif') ? 'checked' : ''; ?>/> Aktif 
            <input type='radio' name='status' value='nonaktif' <?= (isset($detailPengguna[0]->status) && $detailPengguna[0]->status == 'nonaktif') ? 'checked' : ''; ?>/> Nonaktif</p>
        </div>
        </div>
        </div>

        <div class="row mb-2">
          <label  class="col-sm-3 col-form-label">Simpan Data</label>
          <div class="col-sm-3">
          <button type="submit" class="btn sm btn-primary">Simpan</button>
          </div>
    </form>
    </div>
		</div>
	</div>
</div>
                    </div>
<?=$this->endSection();?>
