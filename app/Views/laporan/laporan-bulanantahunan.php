<!-- laporan/laporan-bulanan-tahunan.php -->

<!-- Di sini Anda dapat menggunakan variabel $bulan, $tahun, $jenis_laporan, $total_penjualan, dan $total_keuntungan untuk menampilkan informasi yang sesuai dengan laporan yang dihasilkan -->
<?=$this->extend('Layout/blank-dashboard');?>
<?=$this->section('konten');?>
<div class="container-fluid px-4">
<h1>Laporan Penjualan <?= ($jenis_laporan == 'bulanan') ? 'Bulanan' : 'Tahunan' ?></h1>
 <hr/>
 <hr style="color: gray;"/>
<?php if ($jenis_laporan == 'bulanan') : ?>
    <h2>Laporan Bulan <?= $bulan ?> Tahun <?= $tahun ?></h2>
<?php else : ?>
    <h2>Laporan Tahun <?= $tahun ?></h2>
<?php endif; ?>

<?php if (!empty($detail_penjualan)) : ?>
    <table id="myTable" class="table table-sm table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Jumlah Terjual</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($detail_penjualan as $detail) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $detail['nama_produk'] ?></td>
                    <td><?= $detail['harga_jual'] ?></td>
                    <td><?= $detail['harga_beli'] ?></td>
                    <td><?= $detail['qty'] ?></td>
                    <td><?= $detail['total_harga'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
            <td colspan="6">Total Keuntungan : <?= $total_keuntungan ?></td>
            </tr>
        </tbody>
    </table>
<?php else : ?>
    <p>Tidak ada data penjualan untuk periode ini.</p>
<?php endif; ?>

<?php if ($total_penjualan !== null && $total_keuntungan !== null) : ?>
    <p>Total Penjualan: <?= $total_penjualan ?></p>
    <p>Total Keuntungan: <?= $total_keuntungan ?></p>
<?php endif; ?>

</div>
<?=$this->endSection();?>
