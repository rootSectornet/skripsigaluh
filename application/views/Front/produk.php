
<!-- PRODUK    -->
<div role="main" class="homepage container">
    <div class="row">
    <div class="span12 main-heading">
    <div class="heading-line"></div>
    <div class="heading-wrapper">
    <h1><?= isset($cari) ? "Pencarian Produk ".$cari : "Daftar Produk";?></h1>
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