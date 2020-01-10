   <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data  <?= @$Order->ID_Order;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data  <?= @$Order->ID_Order;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="row">
        <?php if (getAccess('INFORMASI_PELANGGAN')): ?>
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Informasi Pelanggan</h3>
              </div>
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/img/userr.png" alt="User profile picture">

                <h3 class="profile-username text-center"><?= @$pelanggan->username;?></h3>

                <p class="text-muted text-center"><?= @$pelanggan->telepon;?></p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Email : </b> <a class="pull-right"><?= @$pelanggan->email;?></a>
                  </li>
                    <b>Alamat : </b> <a class="pull-right"><?= @$pelanggan->alamat;?></a>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>  <!-- /.col-md-3 -->
        <?php endif ?>
        <?php if (getAccess('INFORMASI_ORDER')): ?>
          <div class="col-md-3">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title">Informasi Order</h3>
              </div>
              <div class="box-body box-profile">
                <img class=" img-responsive " src="<?= base_url();?>assets/img/<?= @$Order->gambar;?>" alt="User profile picture">
                <h3 class="profile-username text-center"><?= @$Order->ID_Order;?></h3>
                <p class="text-muted text-center"><?= @$Order->nama_produk;?></p>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Tanggal : </b> <a class="pull-right"><?= @tanggal($Order->Tanggal);?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Harga : </b> <a class="pull-right">Rp. <?= @IDR($Order->harga);?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status : </b> <label class="label label-primary pull-right"><?= $Order->Status == 0 ? "Menunggu Pembayaran" : "Telah Melakukan Pembayaran";?></label>
                  </li>
                </ul>
              </div>
            </div>
          </div> <!-- /.col-md-3 -->
        <?php endif ?>

        <?php if (getAccess('INFORMASI_PEMBAYARAN')): ?>
          <?php if ($pembayaran): ?>
            <div class="col-md-3">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Informasi Pembayaran</h3>
                </div>
                <div class="box-body box-profile">
                  <img class=" img-responsive " src="<?= base_url();?>assets/img/<?= @$pembayaran->Bukti_Pembayaran;?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?= @$pembayaran->ID_Pembayaran;?></h3>
                  <p class="text-muted text-center"><?= @$pembayaran->Keterangan;?></p>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Tanggal : </b> <a class="pull-right"><?= @tanggal($pembayaran->Tanggal);?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Jumlah : </b> <a class="pull-right">Rp. <?= @IDR($pembayaran->Jumlah_Bayar);?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Status : </b> <label class="label label-warning pull-right"><?= $pembayaran->Status == 0 ? "Menunggu Konfirmasi" : "Telah Di Konfirmasi";?></label>
                    </li>
                  </ul>
                  <?php if ($pembayaran->Status != 2): ?>
                    <a onclick="return ConfirmDialog()" href="<?= base_url();?>Order/<?= $pembayaran->Status == 0 ? "Konfirmasi" : "Pengiriman";?>/<?= @$pembayaran->ID_Pembayaran;?>" class="btn btn-<?= $pembayaran->Status == 0 ? "default" : "warning";?> btn-block"><b><?= $pembayaran->Status == 0 ? "Konfirmasi Pembayaran" : "Proses Pengiriman";?> <i class="fa fa-<?= $pembayaran->Status == 0 ? "check" : "arrow-right";?>"></i></b></a>
                  <?php endif ?>
                  <span style="font-size: 10px" class="text-muted"><i>* Apabila Pembayaran tidak sesuai maka lakukan konfirmasi kepada pelanggan dengan nomor telp yang tersedia.</i></span>
                </div>
              </div>
            </div> <!-- /.col-md-3 -->
          <?php endif ?>
        <?php endif ?>

        <?php if (getAccess('INFORMASI_PENGIRIMAN')): ?>
          <?php if ($pengiriman): ?>
            <div class="col-md-3">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Informasi Pengiriman</h3>
                </div>
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/img/userr.png" alt="User profile picture">
                  <h3 class="profile-username text-center">Driver</h3>
                  <p class="text-muted text-center"><?= @$pengiriman->nama_pegawai;?></p>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>No Pengiriman : </b> <a class="pull-right"><?= @$pengiriman->ID_Pengiriman;?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Tanggal : </b> <a class="pull-right"><?= @tanggal($pengiriman->Tanggal);?></a>
                    </li>
                    <?php if ($pengiriman->Status == 1): ?>
                      <li class="list-group-item">
                        <b>Tanggal Selesai : </b> <a class="pull-right"><?= @tanggal($pengiriman->Tanggal_selesai);?></a>
                      </li>
                    <?php endif ?>
                    <li class="list-group-item">
                      <b>Status : </b> <label class="label label-info pull-right"><?= $pengiriman->Status == 0 ? "Sedang Proses Pengiriman" : "Pengiriman Telah Selesai";?></label>
                    </li>
                  </ul>
                  <?php if ($pengiriman->Status == 0): ?>
                    <?php if (getAccess('BTN_PENGIRIMAN_SELESAI')): ?>
                      <a onclick="return ConfirmSelesai()" href="<?= base_url();?>Order/Selesai/<?= @$pengiriman->ID_Pengiriman;?>" class="btn btn-danger btn-block"><b>Pengiriman Selesai <i class="fa fa-check"></i></b></a>
                    <?php endif ?>
                  <?php endif ?>
                  <span style="font-size: 10px" class="text-muted"><i>* Klik Tombol Pengiriman Selasai apabila barang sudah tiba dan di terima oleh pelanggan.</i></span>
                </div>
              </div>
            </div> <!-- /.col-md-3 -->
          <?php endif ?>
        <?php endif ?>
      </div> <!-- /.row -->
    </section>
    <!-- /.content -->


  </div>

  <script type="text/javascript">
    
 function ConfirmDialog() {
    var x=confirm("Apakah anda yakin memproses data ini?")
    if (x) {
      return true;
    } else {
      return false;
    }
  }
   function ConfirmSelesai() {
    var x=confirm("Apakah anda yakin Pengiriman ini telah selesai ?")
    if (x) {
      return true;
    } else {
      return false;
    }
  }
  </script>