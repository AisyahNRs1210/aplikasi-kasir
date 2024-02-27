<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
    <h1>Laporan Transaksi</h1>
 <hr/>
 <div class="row" style="min-height:350px">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3>Input Laporan Transaksi</h3>
        <p>Silakan masukkan data untuk mendapatkan laporan transaksi sesuai keinginan.</p>
<form action="/generate-laporan" method="POST" novalidate>

 
   <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Bulan</label>
            <div class="col-sm-9">
     <select class="form-control" name="bulan">
        <option value="">Pilih Bulan</option>
        <option value="Januari">Januari</option>
        <option value="Februari">Februari</option>
        <option value="Maret">Maret</option>
        <option value="April">April</option>
        <option value="Mei">Mei</option>
        <option value="Juni">Juni</option>
        <option value="Juli">Juli</option>
        <option value="Agustud">Agustus</option>
        <option value="September">September</option>
        <option value="Oktober">Oktober</option>
        <option value="November">November</option>
        <option value="Desember">Desember</option>
    </select>
      </div>
        </div>
    
   <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-9">
    <input type="number" class="form-control" name="tahun" id="tahun" min="2000" max="2099" step="1" value="<?= date('Y') ?>" required>
</div>
</div>
    
   <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Jenis Laporan</label>
            <div class="col-sm-9">
     <select class="form-control" name="jenis_laporan">
         <!-- <option value="harian">Harian</option> -->
        <option value="bulanan">Bulanan</option>
        <option value="tahunan">Tahunan</option>
    </select>
</div>
</div>
    
   <div class="row mb-2">
          <label  class="col-sm-3 col-form-label">Simpan Data</label>
          <div class="col-sm-3">
          <button type="submit" class="btn sm btn-primary">Generate Laporan</button>
          </div>
    </form>
    </div>
		</div>
	</div>
</div>
                    </div>
<?=$this->endSection();?>


