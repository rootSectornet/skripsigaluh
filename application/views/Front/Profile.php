
<body>

<!-- DAFTAR    -->
<hr/>
<div role="main" class="container checkout">
  <div class="row">   
  <div class="span9 checkout-list">
    <ol class="rr">
    <li class="current">
    <h6>Data Profile</h6>

      <div class="row">
        <div class="span9 content-wrapper clearfix">
          <?php echo $this->session->flashdata('pesan_eror'); ?>
          <div class="right-col">
          <form method="post">
          <ul class="rr">
          <table border="0" width="700">
          <tr><td valign="top">Nama</td>
          <td>
          <li>
          <label><input type="text" name="username" placeholder="Nama Anda ..." size="50" value="<?= @$item->username;?>" /></label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">password</td>
          <td>
          <li>
          <label>
          <input type="password" name="password" placeholder="Password Anda..." size="50" value="*****" />
          </label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Alamat Pengiriman</td>
          <td>
          <li>
          <label>
          <textarea name='alamat'  class='tbox' style='width: 450px; height: 150px;'><?= @$item->alamat;?></textarea><br>
          *) Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.
          </label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Telepon</td>
          <td>
          <li>
          <label><input type="number" name="telepon" placeholder="Telepon..." size="50" value="<?= @$item->telepon;?>" /></label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Email</td>
          <td>
          <li>
          <label><input type="text" name="email" placeholder="email..." size="50" value="<?= @$item->email;?>"/></label>
          </li>
          </td>
          </tr>
          
          <tr><td></td><td>
          <input type="submit" class="btn secondary" value="Update Profile">
          </td></tr>
          </table>
          </ul>
          </form>
                    
          </div>  
        </div>                      
      </div>
      </li>
      </ol>
    </div>
  </div>
</div>     
<!-- DAFTAR -->

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