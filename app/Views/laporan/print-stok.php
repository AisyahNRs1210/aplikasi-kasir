<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuzushi Gift Store</title>

    <!-- Internal CSS -->
    <style>
        h1, p{
            font-family: "Arial, Helvetica, sans-serif;";
        }
        table  {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td,  th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2;}
        tr:hover {background-color: #ddd;}
        th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: gray;
        color: white;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="<?=base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet"/>
</head>
<body>
    <div class="container-fluid px-4">
         <h1 align="center">Data Stok Produk Yuzushi Gift Store</h3>
        <p align="center">Berikut Laporan Stok Barang sampai dengan <?= date('d F Y'); ?></p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="<?=base_url('bootstrap/js/jquery.min.js');?>"></script>
    <script src="<?=base_url('bootstrap/js/bootstrap.bundle.min.js');?>"></script>
</body>
</html>


















