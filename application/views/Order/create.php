
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Buat Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Buat Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Buat Order Produk</b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post">
              <div class="form-group">
                <label class="control-label">Pelanggan : </label>
                <select class="form-control" name="pelanggan">
                  <option hidden>Pilih Pelanggan</option>
                  <?php foreach ($pelanggans as $key => $pelanggan): ?>
                    <option value="<?= $pelanggan->id_pelanggan;?>"><?= $pelanggan->username;?> | <?= $pelanggan->email;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Produk : </label>
                <select class="form-control" name="produk">
                  <option hidden>Pilih Produk</option>
                  <?php foreach ($produks as $key => $produk): ?>
                    <?php if ($produk->stock >= 1): ?>                      
                      <option value="<?= $produk->id_produk;?>"><?= $produk->nama_produk;?> | <?= $produk->keterangan;?></option>
                    <?php endif ?>
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
