<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
<h3><?=$judulHalaman;?></h3>
<p><?=$introTeks;?></p>
<div class="row" style="min-height:350px">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form method="POST">
<div class="row mb-2">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control" name="email" width="20" value="<?=isset($detailPengguna[0]->email)? $detailPengguna[0]->email : null; ?>" placeholder="Masukkan email" readonly/>
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
<label class="col-sm-3 col-form-label">Password Baru</label>
<div class="col-sm-9">
<input type="hidden" class="form-control" id="password" value="<?=isset($detailPenggunal[0]->password) ? $detailPengguna[0]->password : null;?>" name="password_lama" readonly>
<input type="hidden" name="password_lama_2" value="<?=isset($detailPengguna[0]->password) ? $detailPengguna[0]->password : null; ?>" class="form-control" readonly>
<input type="password" class="form-control" name="passwordbaru" width="20" value="<?=isset($pengguna[0]->password) ? $pengguna[0]->password : null;?>" placeholder="Masukkan password" required/>
</div>
</div>
<div class="row mb-2">
<label class="col-sm-3 col-form-label">Repeat Password</label>
<div class="col-sm-9">
<input type="password" class="form-control" name="repeat" width="20" placeholder="Masukkan kembali password" required/>
<?=session()->getFlashData('pesan');?>
</div>
</div>

<div class="row mb-2">
<label class="col-sm-3 col-form-label">Simpan Perubahan</label>
<div class="col-sm-3">
<button type="submit" class="btn sm btn-primary">Simpan</button>
</div>
</form>
</div>
<?=$this->endSection();?>