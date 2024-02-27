<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
<h3>Tambah Produk</h3>
<p><?=$introTeks;?></p>
<div class="row" style="min-height:350px">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
      <form class="mt-4 needs-validation" method="POST" novalidate>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Kode Produk</label>
            <div class="col-sm-9"> 
               <input type="hidden" class="form-control" name="id_produk"  width="20"
                    value="<?=isset($detailProduk[0]->id_produk) ? $detailProduk[0]->id_produk : null;?>" required/>
                <input type="text" class="form-control" name="kode_produk" width="20"
                    value="<?=isset($detailProduk[0]->kode_produk) ? $detailProduk[0]->kode_produk : null;?><?= old('kode_produk') ?>"
                    placeholder="Masukkan kode produk" required/>
                    <?php if (session()->has('errors') && session('errors.kode_produk')): ?>
                <p class="text-danger">
                    <?= esc(session('errors.kode_produk')) ?>
                    </p>
            <?php endif; ?>
                    <div class="invalid-feedback">Kode Produk tidak boleh kosong!</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Nama Produk</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="nama_produk" width="20"
                    value="<?=isset($detailProduk[0]->nama_produk) ? $detailProduk[0]->nama_produk : null;?><?= old('nama_produk') ?>"
                    placeholder="Masukkan nama Produk" required/>
                    <?php if (session()->has('errors') && session('errors.nama_produk')): ?>
                <p class="text-danger">
                    <?= esc(session('errors.nama_produk')) ?>
                    </p>
            <?php endif; ?>
                    <div class="invalid-feedback">Nama Produk tidak boleh kosong!</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Harga Beli</label>
            <div class="col-sm-9">
                <input type="text" class="form-control uang" name="harga_beli" width="20"
                    value="<?= old('harga_beli') ?><?=isset($detailProduk[0]->harga_beli) ? $detailProduk[0]->harga_beli : null;?>"
                    placeholder="Masukkan harga beli" required/>
                    <div class="invalid-feedback">Harga Beli tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Harga Jual</label>
            <div class="col-sm-9">
                <input type="text" class="form-control  uang" name="harga_jual" width="20"
                    value="<?= old('harga_jual') ?><?=isset($detailProduk[0]->harga_jual) ? $detailProduk[0]->harga_jual : null;?>"
                    placeholder="Masukkan harga jual" required/>
                    <div class="invalid-feedback">Harga Jual tidak boleh kosong</div>
            </div>
        </div>

        <div class="row mb-2">
    <label class="col-sm-3 col-form-label">Satuan</label>
    <div class="col-sm-9">
        <select class="form-control" name="kode_satuan">
            <?php foreach ($listSatuan as $satuan) : ?>
                <?php
                // Tentukan apakah opsi ini harus dipilih secara default
                $selected = '';
                if (isset($detailProduk[0]->kode_satuan)) {
                    // Jika kode_satuan produk sama dengan kode_satuan opsi saat ini, maka opsi ini dipilih
                    if ($satuan->kode_satuan == $detailProduk[0]->kode_satuan) {
                        $selected = 'selected';
                    }
                }
                ?>
                <option <?= $selected ?> value="<?= $satuan->kode_satuan ?>"><?= $satuan->nama_satuan ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


            <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Kategori</label>
            <div class="col-sm-9">
                <select class="form-control" name="kode_kategori">
                    <?php
                        foreach ($listKategori as $kategori) :
    $selected = isset($detailProduk[0]->kode_kategori) && $kategori->kode_kategori == $detailProduk[0]->kode_kategori ? 'selected' : "";
    echo '<option ' .$selected. ' value="' .$kategori->kode_kategori. '">' .$kategori->nama_kategori. '</option>';
endforeach;
                   ?>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Stok</label>
            <div class="col-sm-9">
                <input type="text" class="form-control barang" name="stok" width="20"
                    value="<?= old('stok') ?><?=isset($detailProduk[0]->stok) ? $detailProduk[0]->stok : null;?>"
                    placeholder="Masukkan stok barang" required/>
                    <div class="invalid-feedback">Stok Barang tidak boleh kosong</div>
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
           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
                     <script>
        $(document).ready(function(){
            // Terapkan masker dengan format mata uang rupiah
            $('.uang').mask('000.000.000.000', {reverse: true});
            $('.barang').mask('000.000', {reverse: true});
        });
    </script>
<?=$this->endSection();?>