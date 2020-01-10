<!DOCTYPE html>
<html class="no-js">
<head>
<title>E-Commerce MOTOR</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?= base_url();?>assets/front/css/normalize.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/front/css/main.css">		
<link rel="stylesheet" href="<?= base_url();?>assets/front/css/media-queries.css">		
<link rel="stylesheet" href="<?= base_url();?>assets/front/css/bootstrap.css">		
      
<link rel="stylesheet" href="<?= base_url();?>assets/front/css_ticker/style.css">  
<script type="text/javascript" src="<?= base_url();?>assets/front/js_ticker/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/front/js_ticker/jquery.totemticker.js"></script>
<script type="text/javascript">
    $(function(){
        $('#vertical-ticker').totemticker({
            row_height	:	'100px',
            next		:	'#ticker-next',
            previous	:	'#ticker-previous',
            stop		:	'#stop',
            start		:	'#start',
            mousestop	:	true,
        });
    });
</script>
</head>
<body>
<!-- BAR ATAS -->
<div class="top-bar">
    <div class="container">
    <div class="row">
          
    <div class="span3 shipping">
	    <SCRIPT language=JavaScript>var d = new Date();
        var h = d.getHours();
        if (h < 11) { document.write('Selamat pagi, <?= $this->session->userdata('pelanggan') ? $this->session->userdata('pelanggan')->username : "Pengunjung ...";?>'); }
        else { if (h < 15) { document.write('Selamat siang, <?= $this->session->userdata('pelanggan') ? $this->session->userdata('pelanggan')->username : "Pengunjung  ...";?>'); }
        else { if (h < 19) { document.write('Selamat sore, <?= $this->session->userdata('pelanggan') ? $this->session->userdata('pelanggan')->username : "Pengunjung ...";?>'); }
        else { if (h <= 23) { document.write('Selamat malam, <?= $this->session->userdata('pelanggan') ? $this->session->userdata('pelanggan')->username : "Pengunjung ...";?>'); }
        }}}</SCRIPT> 
    </div>
            
    <div class="span9 menu clearfix">
    <ul class="clearfix rr">
    <li>
        <span class="ir icon my-account"></span>
        <span style="color:#FFF; font-size:10px">Selamat, &nbsp; Belanja &nbsp; <?= $this->session->userdata('pelanggan') ? $this->session->userdata('pelanggan')->username : "";?></span>
    </li>
    <li>
        <a href="<?= base_url();?>Front/Check_login">
        <span class="ir icon log-in"></span>
        <span style="color:#FFF;font-size:10px">&nbsp;<?= $this->session->userdata('pelanggan') ? "Logout" : "Login";?></span>
        </a>
    </li>
    </ul>
    </div>
            
    </div>
    </div>
</div>
<!-- BAR ATAS     -->
      
<header class="container">      
<div class="row">
    <div class="span3 logo-wrapper">
    <a href="<?= base_url();?>" class="logo">
    <span class="icon ir" style="background: url('<?= base_url();?>assets/img/logo.png') no-repeat left top;">FathStudio</span>
    <h1>Mitra Mulia Anugerah</h1>
    </a>
</div>
          
<div class="span5 collections">
</div>
<div class="span4">
    <form method=POST action='produk.html'>
    <input type="text" name="cari" class="search-box" placeholder="Search..." value="" style="background:#FFF"/>
    </form>
</div>

</div>
<!-- KERANJANG -->
</div>  

<div class="row main-menu-wrapper">
    <div class="span9">
    <ul class="main-menu clearfix rr" id="main-menu">
    <li><a href="<?= base_url();?>">Home</a></li>
    <li><a href="<?= base_url();?>Front/produk">Produk</a></li>
    <li><a href="<?= base_url();?>Front/Pesanan">Daftar Pesanan</a></li>
    <li><a href="<?= base_url();?>Front/kontak">Kontak</a></li>
    <?php if ($this->session->userdata('pelanggan')): ?>
        <li><a href="<?= base_url();?>Front/Profile/<?= $this->session->userdata('pelanggan')->id_pelanggan;?>">Profile</a></li>
    <?php endif ?>
    </ul>
    </div>          
</div>
</header>