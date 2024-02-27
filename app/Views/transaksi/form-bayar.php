<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">

<div class="row" style="min-height:350px">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
              <h3><i class="menu-icon ti-money"></i>Pembayaran</h3>
      <form class="mt-4 needs-validation" method="POST" novalidate>
       
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Total Harga</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" width="20"
                    value="<?=isset($detailPenjualan[0]->total_harga) ? $detailPenjualan[0]->total_harga : null;?>"
                    placeholder="Masukkan email" required/>
                    <div class="invalid-feedback">total Harga tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Bayar</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="nama_user" width="20"
                    value="<?=isset($detailPenjualan[0]->bayar) ? $detailPenjualan[0]->bayar : null;?>"
                    placeholder="Masukkan nama karyawan" required/>
                    <div class="invalid-feedback">Bayar tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Kembali</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" width="20"
                    placeholder="Masukkan password" required/>
                    <div class="invalid-feedback">Kembali tidak boleh kosong</div>
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
