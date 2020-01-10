
<body>
<!-- SLIDE SHOW -->
<div class="main-slideshow hidden-phone">
    <div class="container">
    <div class="row">
    <div class="span12">
            
    <ul class="rr slider" id="main-slider">
    <li class="slide-1 current">
        <div class="slide">
            <figure>
                <img src="<?= base_url();?>assets/img/ph-home-banner-1.png" alt=""/>
            </figure>
            <div class="content-wrapper">
                <div class="content">
                <h1>Honda Vario</h1>
                <p>
                Untuk kenyamanan berkendara matic pilihannya.
                </p>
                </div>
            </div>
        </div>
    </li>
    <li class="slide-2">
        <div class="slide">
            <figure>
                <img src="<?= base_url();?>assets/img/ph-home-banner-2.png" alt=""/>
            </figure>
            <div class="content-wrapper">
                <div class="content">
                <h1>Honda Scoopy</h1>
                <p>
                Untuk keeleganan berkendara dengan style modis masa kini.
                </p>
                </div>
            </div>                    
        </div>
    </li>
    <li class="slide-3">
        <div class="slide">
            <figure>
                <img src="<?= base_url();?>assets/img/ph-home-banner-3.png" alt=""/>
            </figure>
            <div class="content-wrapper">
                <div class="content">
                <h1>Honda Beat</h1>
                <p>
                Temukan kenyamanan berkendara dan sporty.
                </p>
                </div>
            </div>
        </div>
    </li>
    </ul>
    </div>
    </div>
    </div>
        
    <div class="slideshow-bottom">
        <div class="menu-gradient gradient">Gradient</div>
        <div class="menu-wrapper">
        <div class="container">
        <div class="row-fluid">
        <div class="span12">
                
        <ul class="rr slider-menu" id="main-slider-menu">
        <li class="span3 alpha25 current">
            <div class="triangle ir">Triangle</div>
            <div class="button" id="open-slide-1">
            <span class="splitter">Splitter</span>
            Honda Vario
            </div>
        </li>
        <li class="span3 alpha25">                    
            <div class="triangle ir">Triangle</div>
            <div class="button" id="open-slide-2">
            <span class="splitter">Splitter</span>
            Honda Scoopy
            </div>
        </li>
        <li class="span3 alpha25">
            <div class="triangle ir">Triangle</div>
            <div class="button" id="open-slide-3">
            <span class="splitter">Splitter</span>
            Honda Beat
            </div>
        </li>
        </ul>
        </div>
        </div>
        </div>
        </div>   
        </div>
</div>
<!-- SLIDE SHOW -->

<!-- PRODUK    -->
<div role="main" class="homepage container">
    <div class="row">
    <div class="span12 main-heading">
    <div class="heading-line"></div>
    <div class="heading-wrapper">
    <h1>Popular Produk</h1>
    </div>
    </div>
    </div>
    <ul class="row-fluid clearfix rr popular-products grid-display" style="background:#FFF">
        <?php foreach ($produks as $key => $produk): ?>
            <?php if ($produk->stock >= 1): ?>
                <li class="span3 alpha25 desat">
                    <div class= "prod-wrapper"><span class="corner-badge hot-right ir hidden">Hot</span><span class="badge corner-badge off-35 hidden"></span><span class="badge price-badge">
                    <span class="value">
                    <span>Rp.</span><?= IDR($produk->harga);?>
                    </span>
                    </span>    
                    <a href="<?= base_url();?>Front/produk_detail/<?= @$produk->id_produk;?>">
                    <img src="<?= base_url();?>assets/img/<?= $produk->gambar;?>" class="desat-ie" alt="" width="238" height="288" style="border:0px solid #F03;margin-bottom:3px;">
                    </a>
                    <span class="info gradient">
                    <span class="title"><?= $produk->nama_produk;?></span>
                    <span class="add-to-cart clearfix">
                    <span class="icon ir" style="background: url('<?= base_url();?>assets/img/icon-add-cart.png') no-repeat left center;">Cart</span>
                        <a href="<?= base_url();?>Front/Beli/<?= @$produk->id_produk;?>" class="text">Beli</a>
                    </span>
                    </span>
                    </div>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>
<!-- PRODUK -->
</body>
<footer>
<div class="bottom">
    Copyright &copy; 2019. Nisa
</div>
</footer>
<script>window.jQuery || document.write('<script src="<?= base_url();?>assets/front/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
<script src="<?= base_url();?>assets/front/js/plugins.js"></script>
<script src="<?= base_url();?>assets/front/js/main.js"></script>
</body>
</html>
