   <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-database"></i> Data Toko
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data BaTokorang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <?php if (getAccess('CREATE_TOKO')): ?>
            <a href="<?= base_url();?>Master/Toko/Create" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Tambah Toko</a>
          <?php endif ?>
        </div>
        <div class="box-body">
          <table class="table table-hover table-striped table-bordered" id="table">
            <thead>
              <tr>
                <td>No</td>
                <td>Nama Toko</td>
                <td>Alamat</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $key => $value): ?>
                <tr>
                  <td><?= $key + 1;?></td>
                  <td><?= $value->nama_toko;?></td>
                  <td><?= $value->alamat_toko;?></td>
                  <td>
                    <?php if (getAccess('EDIT_TOKO')): ?>
                      <a href="<?= base_url();?>Master/Toko/Edit/<?= $value->id_toko;?>" class="btn btn-sm btn-warning btn-flat"><i class="fa fa-edit"></i> Edit</a>
                    <?php endif ?>
                    <?php if (getAccess('HAPUS_TOKO')): ?>
                    <?= BtnDelete("Master/Toko/Delete/".$value->id_toko,$value->nama_toko);?>
                    <?php endif ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
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