<footer id="footer">
  <div class="container">
    <div class="col-md-4 ">
      <h3>TENTANG KAMI</h3>
      <img src="<?php echo base_url() ?>assets/front_end/images/logo/logofooter.png" alt="logo" style="width: 100%">
    </div>
    <div class="col-md-5 operasi">
      <h3>&nbsp;</h3>
      <ul class="alamat">
        <li><i class="glyphicon glyphicon-map-marker"></i><b> WEDDING ORGANIZER</b><span>JL. A YANI 1 Pontianak, Kalimantan Barat</span></li>
        <li><i class="glyphicon glyphicon-envelope"></i><a href="mailto:email@example.com"> email@example.com</a></li>
        <li><i class="glyphicon glyphicon-phone-alt"></i><a href="https://api.whatsapp.com/send?phone=628123456789">+628 123456789</a></li>
        <li><i class="fa fa-facebook-square">&nbsp;</i><a href="#" target="_blank">Facebook</a></li>
        <li><i class="fa fa-instagram">&nbsp;</i><a href="#" target="_blank">Instagram</a></li>
      </ul>
    </div>
    <div class="col-md-3 ">
      <h3>MENU</h3>
      <ul class="infoo">
        <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo site_url('kontak'); ?>"> Kontak Kami</a></li> -->
        <li><i class="fa fa-arrow-right"></i><a href="<?php echo site_url('welcome/cart') ?>"> Keranjang Belanja</a></li>
      <?php if ($this->session->userdata('user_logged_in') == 'Sudah_Loggin') { ?>
        <li><i class="fa fa-arrow-right"></i><a href="<?php echo site_url('riwayat') ?>"> Riwayat Belanja</a></li>
        <li><i class="fa fa-arrow-right"></i><a href="<?php echo site_url('welcome/logout') ?>"> Logout</a></li>
        <?php
      }else{
        ?>
        <li><i class="fa fa-arrow-right"></i><a href="javascript:void(0)" onclick="login()"> Login</a></li>
        <li><i class="fa fa-arrow-right"></i><a href="javascript:void(0)" onclick="tambah()"> Daftar</a></li>
        <?php
      }
      ?>
    </ul>
  </div>
  <div class="clearfix"> </div>
</div>
<!-- /.container -->
</footer>
<!-- /#footer -->

<!-- *** FOOTER END *** -->

        <!-- *** COPYRIGHT ***
          _________________________________________________________ -->

          <div id="copyright">
            <div class="container">
              <div class="col-md-12">
                <p class="pull-left">Copyright &copy; 2020. AllRight Reserved.</p>
                <p class="pull-right"><a href="<?php echo site_url('welcome/about'); ?>">Privacy Policy</a> | <a href="<?php echo site_url('welcome/about'); ?>"> Terms & Conditions</a></p>
              </div>
            </div>
          </div>
          <!-- /#copyright -->

          <!-- *** COPYRIGHT END *** -->



        </div>
        <!-- /#all -->


        <!-- #### JAVASCRIPT FILES ### -->

        <script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url() ?>assets/front_end/js/jquery.cookie.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/js/waypoints.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/js/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/js/jquery.parallax-1.1.3.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/js/front.js"></script>
        <!-- owl carousel -->
        <script src="<?php echo base_url(); ?>assets/front_end/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/js/owl.carousel.min.js"></script>


      </body>

      </html>