
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Barang Toko
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang Toko</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Input Data  Barang</b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post"   enctype="multipart/form-data" >
              <div class="form-group">
                <label class="control-label">Nama Barang : </label>
                <select class="form-control" name="id_barang" required>
                  <option disabled="true">Pilih Barang</option>
                  <?php foreach ($produk as $key => $value): ?>
                    <option value="<?= $value->id_barang; ?>" <?php @$produk_toko->id_barang == $value->id_barang ? 'selected' : "" ?> ><?= $value->nama_barang;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Nama Toko : </label>
                <select class="form-control" name="id_toko">
                  <option disabled="true">Pilih Toko</option>
                  <?php foreach ($toko as $key => $value): ?>
                    <option value="<?= $value->id_toko;?>" <?php @$produk_toko->id_toko == $value->id_toko ? 'selected' : "" ?>><?= $value->nama_toko;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                <a href="<?= base_url();?>Master/Produk_toko" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>

