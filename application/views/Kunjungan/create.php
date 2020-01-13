
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Barang Kunjungan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang Kunjungan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <h4><b>Input Data Kunjungan</b></h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <form method="post"   enctype="multipart/form-data" >
                  <div class="form-group">
                    <label class="control-label">Nama Toko : </label>
                    <select class="form-control" name="id_toko">
                      <option disabled="true">Pilih Toko</option>
                      <?php foreach ($toko as $key => $value): ?>
                        <option value="<?= $value->id_toko;?>"><?= $value->nama_toko;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <input type="hidden" name="id_kunjungan_toko" id="id_kunjungan_toko">
                  <div class="form-group">
                    <button id="save" type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?= base_url();?>Master/Kunjungan" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </form>
            </div>
          <div class="col-md-4 col-sm-4"> 
            <div class="card-head">
                <header>Picture</header>
            </div>
            <div class="card-body" id="bar-parent">
              <?php echo form_open_multipart('Master/Kunjungan/upload_gambar', "class='dropzone'"); ?>
   
              </form>
          </div>  
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/dropzone/dropzone.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/dropzone/basic.min.css') ?>">

<script type="text/javascript" src="<?php echo base_url('assets/plugins/dropzone/dropzone.min.js') ?>"></script>
<script type="text/javascript">
    $("#save").prop('disabled',true);
  Dropzone.autoDiscover = false;
  var foto_upload= new Dropzone(".dropzone",{
    url: "<?php echo base_url('Master/Kunjungan/upload_gambar') ?>",
    method:"post",
    acceptedFiles:"image/*",
    paramName:"userfile",
    dictInvalidFileType:"Type file ini tidak dizinkan",
    addRemoveLinks:true,
  });

  var res = [];
  var Id = null;
  var deleted_id = null;

  foto_upload.on("success",function(file,response){
    res.push(response);
    Id = JSON.stringify(res);
    file.a = response;
    $('input[name="id_kunjungan_toko"]').val(Id);
    $("#save").prop('disabled',false);
  });

  foto_upload.on('removedfile',function(file){
    $('input[name="id_kunjungan_toko"]').val(Id);
      $.ajax({
        type:"get",
        url:"<?php echo base_url('Master/Kunjungan/delete_gambar/') ?>"+file.a,
        success: function(){
          console.log("Foto terhapus");
              var i = res.indexOf(file.a);
              res.splice(i,1)
              if(res.length == 0){  
                $("#save").prop('disabled',true);
              }
            Id = JSON.stringify(res);
        },
        error: function(){
          console.log("Error");
        }
      });
  })
</script>
