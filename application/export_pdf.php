<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Transaksi</title>
<style>
body {font-family:sans-serif ;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>
<div style="text-align: center;">
          <img src="<?= base_url('assets/dist/img/logoku.png'); ?>" style="height: 25%;">
          <div>Ujung Harapan Rt001/014 Bahagia Babelan Bekasi</div>
          <div style="font-family:dejavusanscondensed;">&#9742;</span> 081999239325</div>    
</div> 
    <hr style="height: 2px; color:black solid"> 
    <p>Tanggal : <?= date('d F Y'); ?></p>
    <p>Laporan Transaksi</p>


<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">

<thead>
<tr>
<td width="5%"><b>No</b></td>
<td width="15%"><b>Nama</b></td>
<td width="15%"><b>Nama Toko</b></td>
<td width="15%"><b>Nama Produk</b></td>
<td width="15%"><b>Harga Produk</b></td>
<td width="12%"><b>Kuantitas</b></td>
<td width="15%"><b>Taruh / Ambil Barang</b></td>
<td width="12%"><b>Tanggal</b></td>
<td width="10%"><b>Sub Total</b></td>

</tr>
</thead>
<tbody>

	<?php $no = 1; ?>

    <?php foreach ($records as $record) { ?>
<!-- ITEMS HERE -->
<tr>
	<td align="center"><?= $no; ?></td>
	<td align="center"><?= $record->name; ?></td>
    <td align="center"><?= $record->store_name; ?></td>
    <td align="center"><?= $record->product_name; ?></td>
    <td align="center"><?= $record->product_price; ?></td>
    <td align="center"><?= $record->total_product; ?></td>
    <td align="center"><?= ($record->type == 'give') ? 'Taruh Barang' : 'Ambil Barang' ?></td>
    <td align="center"><?= $record->date; ?></td>
    <td align="center"><?= $record->product_price * $record->total_product; ?></td>
</tr>
	<?php $no++; } ?>
</tbody>

        
    </table>
    </div>
</body>
</html>