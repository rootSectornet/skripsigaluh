
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pegawai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Input Data Pegawai</b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post">
              <div class="form-group">
                <label class="control-label">Nama Pegawai : </label>
                <input type="text" name="nama_pegawai" class="form-control" required placeholder="Nama Pegawai">
              </div>
              <div class="form-group">
                <label class="control-label">No Telp : </label>
                <input type="text" name="no_tlp_pegawai" class="form-control" required placeholder="+62">
              </div>
              <div class="form-group">
                <label class="control-label">Username : </label>
                <input type="text" name="username" class="form-control" required placeholder="username*">
              </div>
              <div class="form-group">
                <label class="control-label">Password : </label>
                <input type="password" name="password" class="form-control" required placeholder="*****">
              </div>
              <div class="form-group">
                <label class="control-label">Alamat : </label>
                <textarea class="form-control" rows="5" name="alamat_pegawai" required></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Jabatan : </label>
                <select class="form-control" name="id_jabatan" required>
                  <option hidden>Pilih Jabatan Pegawai</option>
                  <?php foreach (@$jabatans as $key => $jab): ?>
                    <option value="<?= @$jab->ID_Jabatan;?>"><?= @$jab->Jabatan;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                <a href="<?= base_url();?>User" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>
