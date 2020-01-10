<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Absensi & Report Stock</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/iCheck/square/blue.css">
  <script type="text/javascript">
    const BASE_URL = '<?= base_url();?>'
  </script>
    <!-- <link rel="shortcut icon" href="<?= base_url();?>assets/img/logo.jpeg" type="image/x-icon"/> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="background: #fff; padding: 15px;">
  <!-- <img style="margin: auto; height: 130px;" src="<?= base_url();?>assets/img/logo.jpeg"  class="img-responsive"> -->
  <div class="login-logo">
    <span>Absensi & Report Stock <b>PT. Tot Totan</b></span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Masukan Username Dan Password.</p>

    <?php echo $this->session->flashdata('pesan_eror'); ?>
    <?= form_open();?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" id="Username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="Password" placeholder="Password" required name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="clickLogin" class="btn btn-primary  btn-flat" name="submit">Masuk</button>
        </div>
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
      </div>
   <?= form_close(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url();?>assets/plugins/bootbox/bootbox.min.js"> </script>
<script src="<?= base_url();?>assets/costum/js/login.min.js"></script>
</body>
</html>
