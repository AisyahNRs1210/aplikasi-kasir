<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
    <h1>Master Data Pengguna</h1>
 <hr/>
<div class="row" style="min-height:350px">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3><?=$judulHalaman;?></h3>
        <p><?=$introTeks;?></p>
      <form class="mt-4 needs-validation" method="POST" novalidate>
       
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" width="20"
                    value="<?=isset($detailPengguna[0]->email) ? $detailPengguna[0]->email : null;?>"
                    placeholder="Masukkan email" required/>
                     <?php if (session()->has('errors') && session('errors.email')): ?>
                        <p class="text-danger">
                    <?= esc(session('errors.email')) ?>
                    </p>
            <?php endif; ?>
                    <div class="invalid-feedback">Email tidak boleh kosong dan harus menggunakan simbol @!</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Nama Karyawan</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="nama_user" width="20"
                    value="<?=isset($detailPengguna[0]->nama_user) ? $detailPengguna[0]->nama_user : null;?>"
                    placeholder="Masukkan nama karyawan" required/>
                    <div class="invalid-feedback">Nama Karyawan tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" width="20"
                    value="<?=isset($detailPengguna[0]->password) ? $detailPengguna[0]->password : null;?>"
                    placeholder="Masukkan password" required/>
                    <div class="invalid-feedback">Password tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
                <select class="form-control" name="role">
                    <option value="">Pilih Jabatan</option>
                    <?php
                        if(isset($listPengguna)) :
                             foreach($listPengguna as $baris) :
                                if(isset($detailPengguna[0]->role)) :
                                    $detailPengguna[0]->role == $baris->role ? $pilih = 'selected' : $pilih=null;
                        else :
                            $pilih=null;
                        endif;
                            echo '<option '.$pilih.'value="'.$baris->role.'">'.$baris->role.'</option>';
                        endforeach; 
                        endif;
                    ?>
                    <option <?= (isset($detailPengguna[0]->role) && $detailPengguna[0]->role) == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option <?= (isset($detailPengguna[0]->role) && $detailPengguna[0]->role) == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                </select>
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
