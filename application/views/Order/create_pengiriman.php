
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Proses Pengiriman
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Proses Pengiriman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Pilih Driver untuk Pengiriman <?= @$tmpPembayaran->ID_Order;?></b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post">
              <div class="form-group">
                <label class="control-label">Nomor Pengiriman : </label>
                <input type="text" disabled name="ID_Pengiriman" class="form-control" value="<?= $codePengiriman;?>">
              </div>
              <div class="form-group">
                <label class="control-label">Driver : </label>
                <select class="form-control" name="driver">
                  <option hidden>Pilih Driver</option>
                  <?php foreach ($drivers as $key => $driver): ?>
                    <option value="<?= $driver->ID_Pegawai;?>"><?= $driver->nama_pegawai;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                <button onclick="window.history.back();" type="button" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>
