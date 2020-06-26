<div id="heading-breadcrumbs">
  <div class="container">
   <div class="row">
    <div class="col-md-7">
     <h1 class="hidden-sm hidden-xs">Akun Saya</h1>
     <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Akun Saya</h1>
   </div>
   <div class="col-md-5">
     <ul class="breadcrumb">

      <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i></a>
      </li>
      <li>Akun</li>
    </ul>
  </div>
</div>
</div>
</div>

<div id="content" class="clearfix">

	<div class="container">

		<div class="row">
      <div class="col-md-9 clearfix" id="customer-account">
        <p><?= $this->session->flashdata('error'); ?><?= $this->session->flashdata('pesan'); ?></p>
        <?= form_open('akun/proses_edit'); ?>
        <div class="box" style="padding: 10px">
          <div class="heading">
            <h3 class="text-uppercase">Data Diri</h3>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" value="<?= $users->email ?>" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Nama</label>
                <input class="form-control" name="nama" value="<?= $users->nama ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>No Telp</label>
                <input class="form-control" name="no_telp" placeholder="Masukkan No Telp" value="<?= $users->no_telp ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat"><?= $users->alamat ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-center">
              <button type="submit" class="btn btn-lg btn-template-primary" style="width: 100%"><i class="fa fa-save"></i> Simpan Data</button>
            </div>
          </div>
        </div>
        <?= form_close(); ?>
        <?php if ($users->password == null): ?>
          <div class="box" style="padding: 10px">
            <div class="heading">
              <h3 class="text-uppercase">Tambah Password</h3>
            </div>
            <form method="post" role="form" id="form-addpassword" action="<?php echo site_url('akun/add_password'); ?>">
              <input type="text" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="password_1">Password</label>
                    <input type="password" class="form-control" id="password3" placeholder="" name="password" required=" "><span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="password-login">Konfirmasi Password</label>
                    <input type="password" class="form-control"  placeholder="" required=" " name="cpassword"><span class="help-block" id="error"></span>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-center">
                <button type="submit" class="btn btn-lg btn-template-primary" style="width: 100%"><i class="fa fa-save"></i> Save your Password</button>
              </div>
            </form>
          </div>
          <?php else: ?>
            <br><hr><br>

            <div class="box" style="padding: 10px">
              <div class="heading">
                <h3 class="text-uppercase">Ganti Password</h3>
              </div>
              <form method="post" role="form" id="form-changepassword" action="<?php echo site_url('akun/proses_ganti_password'); ?>">
                <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password_old">Password Lama</label>
                      <input type="password" class="form-control" id="old_password" placeholder="" name="old_password" required=" "><span class="help-block" id="error"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password_1">Password Baru</label>
                      <input type="password" class="form-control" id="password3" placeholder="" name="password" required=" "><span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password-login">Konfirmasi Password Baru</label>
                      <input type="password" class="form-control"  placeholder="" required=" " name="cpassword"><span class="help-block" id="error"></span>
                    </div>
                  </div>
                </div>
                <!-- /.row -->
                <hr>
                <div class="text-center">
                  <button onclick="refreshTokens()"  class="btn btn-lg btn-template-primary" style="width: 100%"><i class="fa fa-save"></i> Simpan Password Baru</button>
                </div>
              </form>

            </div>
          <?php endif ?>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="panel panel-default sidebar-menu">

            <div class="panel-heading">
              <h3 class="panel-title">Profil User</h3>
            </div>

            <div class="panel-body">

              <ul class="nav nav-pills nav-stacked">
                <li class="akun">
                  <a href="<?= site_url('akun') ?>"><i class="fa fa-user"></i> Akun Saya</a>
                </li>
                <li class="riwayat">
                  <a href="<?= site_url('riwayat') ?>"><i class="fa fa-list"></i> Riwayat Belanja</a>
                </li>
                <li>
                  <a href="<?= site_url('welcome/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    <!-- /.row -->

    </div>
  <!-- /.container -->
</div>
<!-- /#content -->
<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front_end/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/front_end/js/owl.carousel.min.js"></script>
<script type="text/javascript">

  function refreshTokens() {
    var url = "<?= base_url()."welcome/get_tokens" ?>";
    $.get(url, function(theResponse) {
      /* you should do some validation of theResponse here too */
      $('#csrfHash').val(theResponse);;
    });
  }

  $("#form-changepassword").validate({
    rules:
    {
      old_password: {
        required: true,
        minlength: 5,
        maxlength: 15,
        remote: {
          url: "<?php echo base_url()."akun/cek_password"; ?>",
          type: "post",
          data: {
            old_password : function() {
              return $( "#old_password" ).val();
            },
            <?= $this->security->get_csrf_token_name(); ?> : function () {
              refreshTokens();
              return $( "#csrfHash" ).val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: 5,
        maxlength: 15,
        remote : function () {
          refreshTokens();
        }
      },
      cpassword: {
        required: true,
        equalTo: '#password3',
        remote : function () {
          refreshTokens();
        }
      },
    },
    messages:
    {
      old_password : {
        required : "Password wajib diisi",
        minlength: "Password minimal 5 karakter",
        remote : "Password tidak ada di database"
      },
      password:{
        required: "Password wajib diisi",
        minlength: "Password minimal 5 karakter"
      }
      ,
      cpassword:{
        required: "Masukkan password kembali",
        equalTo: "Password tidak sama !"
      }
    },
    errorPlacement : function(error, element) {
      $(element).closest('.form-group').find('.help-block').html(error.html());
    },
    highlight : function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).closest('.form-group').removeClass('has-error');
      $(element).closest('.form-group').find('.help-block').html('');
    },


  });
</script>

<script type="text/javascript">
  $("#form-addpassword").validate({
    rules:
    {
      password: {
        required: true,
        minlength: 5,
        maxlength: 15
      },
      cpassword: {
        required: true,
        equalTo: '#password3'
      },
    },
    messages:
    {
      password:{
        required: "Password wajib diisi",
        minlength: "Password minimal 5 karakter"
      }
      ,
      cpassword:{
        required: "Masukkan password kembali",
        equalTo: "Password tidak sama !"
      }
    },
    errorPlacement : function(error, element) {
      $(element).closest('.form-group').find('.help-block').html(error.html());
    },
    highlight : function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).closest('.form-group').removeClass('has-error');
      $(element).closest('.form-group').find('.help-block').html('');
    },


  });
</script>
<script>
  window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.0.min.js"><\/script>')
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.akun').addClass('active');
  });
</script>