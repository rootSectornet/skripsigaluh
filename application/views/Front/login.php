
<body>

<!-- LOGIN    -->
<hr/>
<div role="main" class="container checkout">
    <div class="row">
    <div class="span9 checkout-list">
    <ol class="rr">
    <li class="current">
    <h6>Login Atau Daftar</h6>
        <div class="row">
        <div class="span9 content-wrapper clearfix">
            <?php echo $this->session->flashdata('pesan_eror'); ?>
            <div class="left-col">            
            <h6>Belum menjadi member?<br>Silahkan Daftar</h6>
            <p>Jadilah Member untuk mendapatkan berbagai fasilitas menarik</p>
            <a href="<?= base_url();?>Front/daftar" class="btn secondary">
            <span class="gradient">Daftar</span></a>
            </div>
            
            <div class="right-col">    
            <h6>Login</h6>
            <p>
            Already registered
            </p>
            <form method="post" id="form-2">
                <ul class="rr">
                <li>
                <label>
                <input type="text" name="email" placeholder="email anda..." size="30"/>
                </label>
                </li>
                <li>
                <label>
                <input type="password" name="password" placeholder="Password..." size="30"/>
                </label>
                </li>
                </ul>
                <span class="gradient"><input type="submit" class="btn secondary" value="Login"></span>
            </form>
            </div>  
            </div>                      
          </div>
        </li>
      </ol>
    </div>
  </div>
</div>  
</div> 
</div>   
<!-- LOGIN -->

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
