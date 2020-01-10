
<body>
<!-- PRODUK DETAIL -->
<div role="main" class="container product-details">
    <div class="row">
    <div class="span10">
    <div class="row">              
    <div class="span5 gallery">
    <div class="gallery-sub-wrap clearfix">

    <ul class="rr images">
        <li class="current gal-2">
        <img src="<?= base_url();?>assets/img/<?= @$produk->gambar;?>" alt=""/>
        </li>
    </ul>
    </div>
    </div>
    <div class="span5 product">
    <h1><?= @$produk->nama_produk;?></h1>
    <p class="description" style="text-align:justify"><?= @$produk->keterangan;?></p>
    <hr/>
    <ul class="rr clearfix buy-wrapper">
    <li><span class="add-to-cart clearfix"><span class="icon ir"  style="background: url('<?= base_url();?>assets/img/icon-add-cart.png') no-repeat left center;">Cart</span>
        <a href="" class="text">Beli</a>
    </li> 
    <li class="price-wrapper">
    <span class="price"><span class="currency" style="font-size:25px">Rp.&nbsp;</span><span class="value" style="font-size:25px"><?= @IDR($produk->harga);?></span></span>
    </li>
    </ul>                 
    </div>
    </div>
    <hr/>
    </div>
</div> 

<!-- PRODUK DETAIL -->
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