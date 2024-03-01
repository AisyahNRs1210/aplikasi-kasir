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

      <?php
            if(isset($detail_penjualan)) :
                $html =null;
                $no = null;
            foreach($detail_penjualan as $baris) :
                $no++;
                $html .='<tr>';
                $html .='<td>'. $no.'</td>';
                $html .='<td>'. $baris['nama_produk'].'</td>';
                $html .='<td align="left">Rp. '.number_format($baris['harga_beli'],0,',','.').'</td>';
                $html .='<td align="left">Rp. '.number_format($baris['harga_jual'],0,',','.').'</td>';
                $html .='<td align="left">'.number_format($baris['qty'],0,',','.').'</td>';
                $html .='<td align="left">Rp. '.number_format($baris['total_harga'],0,',','.').'</td>';
                $html .='</tr>';
            endforeach;
            echo $html;
       else :
            echo '<tr><td colspan="6">Tidak ada data penjualan untuk periode ini.</td></tr>';
            endif;
        ?>

         <!-- Tambahkan baris untuk total penjualan dan total keuntungan -->

    </table>  
    <br/>

<?php if ($total_penjualan !== null && $total_keuntungan !== null) : ?>
    <p>Total Penjualan: <?= $total_penjualan ?></p>
    <p>Total Keuntungan: <?= $total_keuntungan ?></p>
<?php endif; ?>

</div>
<?=$this->endSection();?>
