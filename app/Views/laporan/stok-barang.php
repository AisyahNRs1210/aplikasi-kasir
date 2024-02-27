<?= $this->extend('Layout/blank-dashboard');?>
<?= $this->section('konten');?>
<div class="container-fluid px-4">
    <h1>Laporan</h1>
<hr style="color: gray;"/>
<h3>Data Produk</h3>
<p>Berikut Laporan Stok Barang sampai dengan <?= date('d F Y'); ?></p>

 <?php if (!empty($listProduk) && count($listProduk) > 0): ?>
    <?php $stokKosong = false; ?>
    <?php foreach ($listProduk as $produk): ?>
        <?php if ($produk->stok == 0): ?>
            <?php $stokKosong = true; ?>
            <?php break; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- <?php if (!$stokKosong): ?> -->
        <a href="<?php echo site_url('pdf/generate') ?>" class="btn btn-primary" style="float:left;">
            <i class="fa fa-cloud-download" style="color: #ffffff;"></i> Download PDF
        </a>
    <!-- <?php else: ?>
        <button class="btn btn-primary" style="float:left;" disabled>
            <i class="fa fa-cloud-download" style="color: #ffffff;"></i> Download PDF
        </button>
    <?php endif; ?>
    <?php else: ?>
    <button class="btn btn-primary" style="float:left;" disabled>
        <i class="fa fa-cloud-download" style="color: #ffffff;"></i> Download PDF
    </button>
    <?php endif; ?> -->

<br/><br/>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
            </tr>
        </thead>

        <?php
            if(isset($listProduk)) :
                $html =null;
                $no = null;
            foreach($listProduk as $baris) :
                $no++;
                $html .='<tr>';
                $html .='<td>'. $no.'</td>';
                $html .='<td>'. $baris->nama_produk.'</td>';
                $html .='<td align="left">Rp. '.number_format($baris->harga_jual,0,',','.').'</td>';
                $html .='<td align="left">Rp. '.number_format($baris->harga_beli,0,',','.').'</td>';
               $html .= '<td align="left">' . number_format($baris->stok, 0, ',', '.') . ' ' . $baris->nama_satuan . '</td>';
                $html .='</tr>';
            endforeach;
             echo $html;
            endif;
        ?>
    </table>
</div>


<?=$this->endSection();?>