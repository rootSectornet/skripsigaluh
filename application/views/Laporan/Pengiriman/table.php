     <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-motorcycle "></i> Laporan Pengiriman
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Pengiriman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo $this->session->flashdata('pesan_eror'); ?>
      <div class="box">
        <div class="box-header">
          <fieldset class="col-md-6 col-md-offset-3">
            <legend>Filter : </legend>
            <form class="form-horizontal" method="GET">
                <div class="form-group">
                  <label class="control-label">Dari  : </label>
                  <input type="text"  name="dari" value="<?= $dari;?>" class="form-control datepicker">
                </div>
                <div class="form-group">
                  <label class="control-label">Sampai  : </label>
                  <input type="text"  name="sampai" value="<?= $sampai;?>" class="form-control datepicker">
                </div>
                <div class="form-group">
                  <label class="control-label">Status Pengiriman  : </label>
                  <select name="status" class="form-control">
                    <option value="all">ALL</option>
                    <option value="0">Belum Selesai</option>
                    <option value="1">Sudah Selesai</option>
                  </select>
                </div>
              <div class="form-group">
                <button type="submit" id="filter" class="btn btn-warning btn-flat"><i class="fa fa-filter"></i>  </button>
                <a href="<?= base_url();?>Laporan/downloadPengiriman/<?=  $dari;?>/<?=  $sampai;?>" class="btn btn-default btn-flat"><i class="fa fa-download"></i></a>
              </div>
            </form>
          </fieldset>
        </div>
        <div class="box-body">
          <table class="table table-hover table-striped table-bordered" id="table" width="100%">
            <thead>
              <tr>
                <th>No Order</th>
                <th>Pelanggan</th>
                <th>No Pengiriman</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Order Tanggal</th>
                <th>Tanggal Pengiriman</th>
                <th>Tanggal Selesai</th>
                <th>Driver</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($items)): ?>
                <?php foreach ($items as $key => $item): ?>
                  <tr>
                    <td><?= $item->ID_Order;?></td>
                    <td><?= $item->username;?></td>
                    <td><?= $item->ID_Pengiriman;?></td>
                    <td><?= $item->nama_produk;?></td>
                    <td>Rp. <?= IDR($item->harga);?></td>
                    <td><?= tanggal($item->Tanggal);?></td>
                    <td><?= tanggal($item->tanggalPengiriman);?></td>
                    <td><?= tanggal($item->Tanggal_selesai);?></td>
                    <td><?= $item->driver;?></td>
                    <td><?= $item->statusPengiriman == 0 ? "Belum Selesai" : "Sudah Selesai";?></td>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>
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

      $('.datepicker').datetimepicker({
        format:'Y-m-d',
        mask:false,
        timepicker:false,
        maxDate: '<?= date("Y-m-d");?>',
      });
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