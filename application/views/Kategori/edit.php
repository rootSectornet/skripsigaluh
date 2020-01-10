
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Kategori Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Kategori Produk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Input Data Kategori Produk</b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post">
              <div class="form-group">
                <label class="control-label">Nama Kategori : </label>
                <input type="text" name="Kategori" value="<?= @$item->nama_kategori;?>" class="form-control" required placeholder="Nama Kategori">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                <a href="<?= base_url();?>Master/Kategori" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>
