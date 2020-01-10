
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  border-right: solid 2px #cacaca;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}


#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #fac138;
  color: white;
}
</style>
<body>

<!-- DAFTAR    -->
<hr/>
<div role="main" class="container checkout">
  <div class="">  
    <center><h4>DAFTAR PESANAN</h4></center>
      <div class="row">
        <div class="span12 content-wrapper clearfix" style="width: 100%">
          <?php echo $this->session->flashdata('pesan_eror'); ?>
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'MP')" id="defaultOpen">Menunggu Pembayaran</button>
              <button class="tablinks" onclick="openCity(event, 'MK')" id="defaultOpen">Menunggu Konfirmasi</button>
              <button class="tablinks" onclick="openCity(event, 'SP')">Proses Pengiriman</button>
              <button class="tablinks" onclick="openCity(event, 'OS')">Order Selesai</button>
            </div>
            <div id="MP" class="tabcontent">
              <?php if (sizeof($pesananMenungguPembayaran) != 0){ ?>
                <table id="customers">
                  <tr>
                    <th>Order Number</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  <?php foreach ($pesananMenungguPembayaran as $key => $PMP): ?>
                    <tr>
                      <td><?= $PMP->ID_Order;?></td>
                      <td><?= $PMP->nama_produk;?></td>
                      <td>RP. <?= IDR($PMP->harga);?></td>
                      <td><?= tanggal($PMP->Tanggal);?></td>
                      <td>Menunggu Pembayaran</td>
                      <td>
                        <button><a onclick="return ConfirmDialog()" href="<?= base_url();?>Front/Hapus/<?= $PMP->ID_Order;?>" style="text-decoration: none;">Hapus</a></button>
                        <button><a href="<?= base_url();?>Front/Konfirmasi/<?= base64_encode($PMP->ID_Order);?>" style="text-decoration: none;">Konfirmasi Pembayaran</a></button>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </table>
              <?php }else{ ?>
                <h6>Tidak Ada transaksi.</h6>
              <?php } ?>
            </div>

            <div id="MK" class="tabcontent">
              <?php if (sizeof($pesananMenungguKonfirmasi) != 0){ ?>
                <table id="customers">
                  <tr>
                    <th>Order Number</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Detail Pembayaran</th>
                  </tr>
                  <?php foreach ($pesananMenungguKonfirmasi as $key => $PMK): ?>
                    <?php if ($PMK->Pembayaran->Status != 2): ?>
                      <tr>
                        <td><?= $PMK->ID_Order;?></td>
                        <td><?= $PMK->nama_produk;?></td>
                        <td>RP. <?= IDR($PMK->harga);?></td>
                        <td><?= tanggal($PMK->Tanggal);?></td>
                        <td>
                          <?php if ($PMK->Status == 0){ ?>
                            <b>Menunggu Konfirmasi Admin</b>
                          <?php }else{ ?>
                            <?php if ($PMK->Pembayaran->Status == 0){ ?>
                               <b>Menunggu Konfirmasi Admin</b>
                            <?php }else{ ?>
                              <b>Sudah Di Konfirmasi Oleh Admin dan akan di proses pengiriman</b>
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td>
                          <p>NO Pembayaran : <?= @$PMK->Pembayaran->ID_Pembayaran;?></p>
                          <p>Jumlah YG Dibayar : RP. <?= @IDR($PMK->Pembayaran->Jumlah_Bayar);?></p>
                          <p>Bukti Pembayaran : <a href="<?= base_url();?>assets/img/<?= @$PMK->Pembayaran->Bukti_Pembayaran;?>"><?= @$PMK->Pembayaran->Bukti_Pembayaran;?></a></p>
                          <p>Tanggal : RP. <?= @tanggal($PMK->Pembayaran->Tanggal);?></p>
                          <p>Keterangan : <?= @$PMK->Pembayaran->Keterangan;?></p>
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                </table>
              <?php }else{ ?>
                <h6>Tidak Ada transaksi.</h6>
              <?php } ?>
            </div>

            <div id="SP" class="tabcontent">
              <?php if ($pesananProsesPengiriman){ ?>
                <table id="customers">
                  <tr>
                    <th>Order Number</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Detail Pembayaran</th>
                    <th>Detail Pengiriman</th>
                  </tr>
                  <?php foreach ($pesananProsesPengiriman as $key => $PPP): ?>
                      <tr>
                        <td><?= $PPP->ID_Order;?></td>
                        <td><?= $PPP->nama_produk;?></td>
                        <td>RP. <?= IDR($PPP->harga);?></td>
                        <td><?= tanggal($PPP->Tanggal);?></td>
                        <td><b><?= @$PPP->statusPengiriman == 0 ? "Sedang Proses Pengiriman" : "Pengiriman Telah Selesai";?></b></td>
                        <td>
                          <p>NO Pembayaran : <?= @$PPP->ID_Pembayaran;?></p>
                          <p>Jumlah YG Dibayar : RP. <?= @IDR($PPP->Jumlah_Bayar);?></p>
                          <p>Bukti Pembayaran : <a href="<?= base_url();?>assets/img/<?= @$PPP->Bukti_Pembayaran;?>"><?= @$PPP->Bukti_Pembayaran;?></a></p>
                          <p>Tanggal : RP. <?= @tanggal($PPP->tanggalPembayaran);?></p>
                          <p>Keterangan : <?= @$PPP->keteranganPembayaran;?></p>
                        </td>
                        <td>
                          <p>NO Pengiriman : <?= @$PPP->ID_Pengiriman;?></p>
                          <p>Tanggal Pengiriman : <?= @tanggal($PPP->tanggalPengiriman);?></p>
                          <p>Tanggal Sampai : - </p>
                          <p>Driver : <?= $PPP->driver;?> </p>
                          <p>Telp Driver : <?= $PPP->no_tlp_pegawai;?> </p>
                        </td>
                      </tr>
                  <?php endforeach ?>
                </table>
              <?php }else{ ?>
                <h6>Tidak Ada transaksi.</h6>
              <?php } ?>
            </div>

            <div id="OS" class="tabcontent">
              <?php if ($OrderSelesai){ ?>
                <table id="customers">
                  <tr>
                    <th>Order Number</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Detail Pembayaran</th>
                    <th>Detail Pengiriman</th>
                  </tr>
                  <?php foreach ($OrderSelesai as $key => $OS): ?>
                      <tr>
                        <td><?= $OS->ID_Order;?></td>
                        <td><?= $OS->nama_produk;?></td>
                        <td>RP. <?= IDR($OS->harga);?></td>
                        <td><?= tanggal($OS->Tanggal);?></td>
                        <td><b><?= @$OS->statusPengiriman == 0 ? "Sedang Proses Pengiriman" : "Pengiriman Telah Selesai";?></b></td>
                        <td>
                          <p>NO Pembayaran : <?= @$OS->ID_Pembayaran;?></p>
                          <p>Jumlah YG Dibayar : RP. <?= @IDR($OS->Jumlah_Bayar);?></p>
                          <p>Bukti Pembayaran : <a href="<?= base_url();?>assets/img/<?= @$OS->Bukti_Pembayaran;?>"><?= @$OS->Bukti_Pembayaran;?></a></p>
                          <p>Tanggal : RP. <?= @tanggal($OS->tanggalPembayaran);?></p>
                          <p>Keterangan : <?= @$OS->keteranganPembayaran;?></p>
                        </td>
                        <td>
                          <p>NO Pengiriman : <?= @$OS->ID_Pengiriman;?></p>
                          <p>Tanggal Pengiriman : <?= @tanggal($OS->tanggalPengiriman);?></p>
                          <p>Tanggal Sampai : <?= @tanggal($OS->Tanggal_selesai);?></p>
                          <p>Driver : <?= $OS->driver;?> </p>
                          <p>Telp Driver : <?= $OS->no_tlp_pegawai;?> </p>
                        </td>
                      </tr>
                  <?php endforeach ?>
                </table>
              <?php }else{ ?>
                <h6>Tidak Ada transaksi.</h6>
              <?php } ?>
            </div>

        </div>                      
      </div>
</div>     
<!-- DAFTAR -->

</body>
<footer>
<div class="bottom">
    Copyright &copy; 2019. Nisa
</div>
</footer>
<script>window.jQuery || document.write('<script src="<?= base_url();?>assets/front/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
<script src="<?= base_url();?>assets/front/js/plugins.js"></script>
<script src="<?= base_url();?>assets/front/js/main.js"></script>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

 function ConfirmDialog() {
    var x=confirm("Apakah anda yakin ingin menghapus Pesanan ini?")
    if (x) {
      return true;
    } else {
      return false;
    }
  }
</script>

</body>
</html>