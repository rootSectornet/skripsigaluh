
<body>

<!-- DAFTAR    -->
<hr/>
<div role="main" class="container checkout">
  <div class="row">   
  <div class="span9 checkout-list">
    <ol class="rr">
    <li class="current">
    <h6>Konfirmasi Pembayaran</h6>

      <div class="row">
        <div class="span9 content-wrapper clearfix">
          <?php echo $this->session->flashdata('pesan_eror'); ?>
          <div class="right-col">
          <form method="post"   enctype="multipart/form-data">
          <ul class="rr">
          <table border="0" width="700">
          <tr><td valign="top">No Pembayaran</td>
          <td>
          <li>
          <label><input type="text" name="ID_Pembayaran" disabled value="<?= $code;?>" /></label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Jumlah *</td>
          <td>
          <li>
          <label>
          <input type="text" name="Jumlah_Bayar" placeholder="jumlah bayar" size="50"/>
          </label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Keterangan : </td>
          <td>
          <li>
          <label>
          <textarea name='Keterangan'  class='tbox' style='width: 450px; height: 150px;'></textarea>
          </label>
          </li>
          </td>
          </tr>
          <tr><td valign="top">Upload Bukti Pembayaran</td>
          <td>
            <input type="file" name="bukti" accept="image/*"  />
          </td>
          </tr>
          
          <tr><td></td><td>
          <input type="submit" class="btn secondary" value="Konfirmasi">
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