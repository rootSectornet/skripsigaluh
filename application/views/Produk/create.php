
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data  Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data  Produk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Input Data  Produk</b></h4>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            <form method="post"   enctype="multipart/form-data" >
              <div class="form-group">
                <label class="control-label">Nama Produk : </label>
                <input type="text" name="produk" class="form-control" required placeholder="Nama produk">
              </div>
              <div class="form-group">
                <label class="control-label">Kategori : </label>
                <select name="nama_kategori" class="form-control" required>
                  <option hidden>Pilih Kategori</option>
                  <?php foreach ($kategoris as $key => $kategori): ?>
                    <option value="<?= $kategori->id_kategori;?>"><?= $kategori->nama_kategori;?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Keterangan : </label>
                <textarea name="keterangan" rows="5" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Harga : </label>
                <input type="text" name="harga" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="control-label">Stock : </label>
                <input type="number" name="stock" class="form-control" required>
              </div>
                <label>Upload Gambar</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input type="file" id="imgInp"  name="foto" required>
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly id="textImg">
                </div><br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                <a href="<?= base_url();?>Master/Produk" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>


  <script type="text/javascript">

           //image priview
      $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [label]);
          });

          $('.btn-file :file').on('fileselect', function(event, label) {
              
              var input = $(this).parents('.input-group').find(':text'),
                  log = label;
              
              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }
          
          });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                 // $('#img-upload').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });
  </script>
