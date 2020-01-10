   <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Order Pelanggan
        <?php if (getAccess("CREATE_ORDER")): ?>
            <a class="btn btn-success" href="<?= base_url();?>Order/create"><i class="fa fa-plus"></i></a>
        <?php endif ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Order Pelanggan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
              <li class="active"><a href="#MP" data-toggle="tab">Menunggu Pembayaran</a></li>
              <li class=""><a href="#MK" data-toggle="tab">Menunggu Konfirmasi</a></li>
              <li class=""><a href="#SP" data-toggle="tab">Proses Pengiriman</a></li>
              <li class=""><a href="#OS" data-toggle="tab">Order Selesai</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="MP">
            <div class="">
              <div class="box-body">
                <table class="table table-hover table-striped table-bordered" id="table">
                  <thead>
                    <tr>
                      <td>No Order</td>
                      <td>Nama Produk</td>
                      <td>Keterangan Produk</td>
                      <td>Harga</td>
                      <td>Tanggal</td>
                      <td>Pelanggan</td>
                      <td>Status</td>
                      <?php if (getAccess("ACTION_ORDER")): ?>
                        <td>Action</td>
                      <?php endif ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($itemsPBB as $key => $PBB): ?>
                      <tr>
                        <td><a href="<?= base_url();?>Order/Detail/<?= base64_encode($PBB->ID_Order);?>" style="text-decoration: none;"><b><?= @$PBB->ID_Order;?></b></a></td>
                        <td><?= @$PBB->nama_produk;?></td>
                        <td><?= @$PBB->keterangan;?></td>
                        <td>Rp. <?= @IDR($PBB->harga);?></td>
                        <td> <i class="fa fa-calendar"></i> <?= @tanggal($PBB->Tanggal);?></td>
                        <td><?= @$PBB->username;?></td>
                        <td><label class="label label-primary">Menunggu Pembayaran Pelanggan</label></td>
                          <?php if (getAccess("ACTION_ORDER")): ?>
                            <td>
                              <?php if (getAccess("DELETE_ORDER")): ?>
                                <?= BtnDelete("Order/delete/".@$PBB->ID_Order,@$PBB->ID_Order);?>
                              <?php endif ?>
                            </td>
                          <?php endif ?>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="MK">
            <div class="">
              <div class="box-body">
                <table class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <td>No Order</td>
                      <td>No Pembayaran</td>
                      <td>Pelanggan</td>
                      <td>Status</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($itemsPMK as $key => $PMK): ?>
                      <?php if ($PMK->Pembayaran->Status != 2): ?>
                        <tr>
                          <td><a href="<?= base_url();?>Order/Detail/<?= base64_encode($PMK->ID_Order);?>" style="text-decoration: none;"><b><?= @$PMK->ID_Order;?></b></a></td>
                          <td><?= @$PMK->Pembayaran->ID_Pembayaran;?></td>
                          <td><?= @$PBB->username;?></td>
                          <td>
                            <label class="label label-<?= $PMK->Pembayaran->Status == 0 ? 'warning' : 'success';?>"><?= $PMK->Pembayaran->Status == 0 ? "Menunggu Konfirmasi Admin" : "Sudah Di Konfirmasi";?></label>
                            <?php if ($PMK->Pembayaran->Status == 1): ?>
                              <a href="<?= base_url();?>Order/Pengiriman/<?= @$PMK->Pembayaran->ID_Pembayaran;?>" style="text-decoration: none;"><label class="label label-warning" style="cursor: pointer;">Proses Pengiriman <i class="fa fa-arrow-right"></i></label></a>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="SP">
            <div class="">
              <div class="box-body">
                <table class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <td>No Order</td>
                      <td>No Pembayaran</td>
                      <td>Pelanggan</td>
                      <td>NO Pengiriman</td>
                      <td>Status</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($itemsPP as $key => $PP): ?>
                        <tr>
                          <td><a href="<?= base_url();?>Order/Detail/<?= base64_encode($PP->ID_Order);?>" style="text-decoration: none;"><b><?= @$PP->ID_Order;?></b></a></td>
                          <td><?= @$PP->ID_Pembayaran;?></td>
                          <td><?= @$PP->username;?></td>
                          <td><?= @$PP->ID_Pengiriman;?></td>
                          <td>
                            <label class="label label-<?= $PP->statusPengiriman == 0 ? 'warning' : 'success';?>"><?= $PP->statusPengiriman == 0 ? "Sedang Proses Pengiriman" : "Pengiriman Telah Selesai";?></label>
                          </td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="OS">
            <div class="">
              <div class="box-body">
                <table class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <td>No Order</td>
                      <td>No Pembayaran</td>
                      <td>Pelanggan</td>
                      <td>NO Pengiriman</td>
                      <td>Status</td>
                      <td>Tanggal Selesai</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($OrderSelesai as $key => $OS): ?>
                        <tr>
                          <td><a href="<?= base_url();?>Order/Detail/<?= base64_encode($OS->ID_Order);?>" style="text-decoration: none;"><b><?= @$OS->ID_Order;?></b></a></td>
                          <td><?= @$OS->ID_Pembayaran;?></td>
                          <td><?= @$OS->username;?></td>
                          <td><?= @$OS->ID_Pengiriman;?></td>
                          <td>
                            <label class="label label-<?= $OS->statusPengiriman == 0 ? 'warning' : 'success';?>"><?= $OS->statusPengiriman == 0 ? "Sedang Proses Pengiriman" : "Pengiriman Telah Selesai";?></label>
                          </td>
                          <td><?= @tanggal($OS->Tanggal_selesai);?></td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>
<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
      $('#table').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
      $('#tablePMK').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
    });
 function ConfirmDialog() {
    var x=confirm("Apakah anda yakin ingin menghapus data ini?")
    if (x) {
      return true;
    } else {
      return false;
    }
  }
</script>