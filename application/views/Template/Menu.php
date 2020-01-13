
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ARS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Absensi & Report Stock</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url();?>assets/img/userr.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('data')->nama_pegawai;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url();?>assets/img/userr.png" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('data')->nama_pegawai;?>
                  <small> ON : <?= date('d-m-Y');?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url();?>Auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url();?>assets/img/userr.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('data')->nama_pegawai;?></p>
          <span><i class="fa fa-circle"></i> <?= $this->session->userdata('data')->Jabatan;?>
          </span>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if (getAccess('MENU_HOME')): ?>
          <li class="">
            <a href="<?= base_url();?>Home">
              <i class="fa fa-chain text-aqua"></i> <span>Home</span>
            </a>
          </li>
        <?php endif ?>
        <?php if (getAccess('MENU_BARANG')): ?>
          <li class="">
            <a href="<?= base_url();?>Master/Produk">
              <i class="fa fa-chain text-aqua"></i> <span>Barang</span>
            </a>
          </li>
        <?php endif ?>
        <?php if(getAccess('MENU_BARANG_TOKO')): ?>
          <li class="">
            <a href="<?= base_url();?>Master/Produk_toko">
              <i class="fa fa-chain text-aqua"></i> <span>Barang Toko</span>
            </a>
          </li>
        <?php endif ?>
        <?php if (getAccess('MENU_TOKO')): ?>
          <li class="">
            <a href="<?= base_url();?>Master/Toko">
              <i class="fa fa-chain text-aqua"></i> <span>Toko</span>
            </a>
          </li>
        <?php endif ?>
        <?php if(getAccess("MENU_KUNJUNGAN")):?>
          <li class="">
            <a href="<?= base_url();?>Master/Kunjungan">
              <i class="fa fa-chain text-aqua"></i> <span>Kunjungan Toko</span>
            </a>
          </li>
        <?php endif ?>
        <?php if (getAccess('MENU_JABATAN')): ?>
          <li class="">
            <a href="<?= base_url();?>Jabatan">
              <i class="fa fa-chain text-aqua"></i> <span>Jabatan</span>
            </a>
          </li>
        <?php endif ?>
        <?php if (getAccess('MENU_PEGAWAI')): ?>
          <li class="">
            <a href="<?= base_url();?>User">
              <i class="fa fa-chain text-aqua"></i> <span>Pegawai</span>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
