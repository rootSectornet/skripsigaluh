
<?php
 header("Content-type: application/octet-stream");
 header("Content-Disposition: attachment; filename=LaporanPenjualan.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<section>
		<center><h1>Laporan Penjualan Tanggal <?= $dari;?> Sampai <?= $sampai;?></h1></center>
		<br>
          <table class="table table-hover table-striped table-bordered" id="table" width="100%">
            <thead style="font-weight: bold;">
              <tr>
                <th>No Order</th>
                <th>Pelanggan</th>
                <th>No Pembayaran</th>
                <th>No Pengiriman</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Order Tanggal</th>
                <th>Tanggal Bayar</th>
                <th>Tanggal Pengiriman</th>
                <th>Tanggal Selesai</th>
                <th>Driver</th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($items)): ?>
                <?php foreach ($items as $key => $item): ?>
                  <tr>
                    <td><?= $item->ID_Order;?></td>
                    <td><?= $item->username;?></td>
                    <td><?= $item->ID_Pembayaran;?></td>
                    <td><?= $item->ID_Pengiriman;?></td>
                    <td><?= $item->nama_produk;?></td>
                    <td>Rp. <?= IDR($item->harga);?></td>
                    <td><?= tanggal($item->Tanggal);?></td>
                    <td><?= tanggal($item->tanggalPembayaran);?></td>
                    <td><?= tanggal($item->tanggalPengiriman);?></td>
                    <td><?= tanggal($item->Tanggal_selesai);?></td>
                    <td><?= $item->driver;?></td>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>
            </tbody>
          </table>
	</section>

</body>
</html>