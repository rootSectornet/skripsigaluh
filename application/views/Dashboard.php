
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h1>Welcome Bagian <?= @$this->session->userdata('data')->Jabatan;?></h1>
      <?php if (@$absen){ ?>
        <a class="btn btn-md btn-info btn-flat" disabled href="#">Anda Sudah Absen</a>
        <?php if(@$absen->jam_keluar){?>
          <a class="btn btn-md btn-warning btn-flat" disabled href="<?= base_url();?>Home/Absen_pulang">Anda Sudah Absen Pulang</a>
        <?php }else{ ?>
          <a class="btn btn-md btn-warning btn-flat" href="<?= base_url();?>Home/Absen_pulang">Absen Pulang</a>
        <?php }?>
      <?php }else{ ?>
        <a class="btn btn-md btn-info btn-flat" href="<?= base_url();?>Home/Absen">Anda Belum Absen</a>
      <?php }?>
      <?php if (getAccess("ISDRIVER")): ?>
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
              <li class="active"><a href="#SP" data-toggle="tab">Proses Pengiriman</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="SP">
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
        </div>
      </div>
      <?php endif ?>
    </section>
    <!-- /.content -->
  </div>