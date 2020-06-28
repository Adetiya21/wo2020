<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$tag = array('Wedding Organizer',$title.'|  Wedding Organizer' ,'Borneo', 'Pontianak', 'Indonesia', 'Sell HENNA','Sell MAKE UP','Sell DECORATION','Sell CATERING','Sell PHOTOGRAPHY','Sell VIDEOGRAPHY' ); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?> - Wedding Organizer</title>
    <meta name="keywords" content="Wedding Organizer, <?= $title ?> | Wedding Organizer ,Borneo, Pontianak, Indonesia, HENNA,MAKE UP,DECORATION,CATERING,PHOTOGRAPHY,VIDEOGRAPHY"/>
    <link rel="canonical" href="<?= $url ?>" />
    <meta property="og:locale" content="id" />
    <meta property="og:type" content="Wedding Organizer" />
    <meta property="og:title" content="<?= $title ?> | Wedding Organizerg" />
    <meta property="og:description" content="
    Wedding Organizer is a ecommerce for botanical herbal, and you can choose which one based on your taste. This herbal domicilated in Indonesia, Province West Kalimantan, Pontianak Cty. For further information you may also look forward to our official accounts, Such as facebook, google plus, and instagram. 
    " />
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:site_name" content="Wedding Organizer" />
    <meta property="article:publisher" content="masterbotanicals.com" />
    <meta property="article:author" content="Admin Wedding Organizer" />
    <?php foreach ($tag as $key): ?>
        <meta property="article:tag" content="<?= $key?>" />  
    <?php endforeach ?>
    <meta property="article:tag" content="Sell <?= $title ?>" />  
    <meta content='Indonesia' name='geo.placename'/>
    <meta content='9BC10956954' name='blogcatalog'/>
    <meta content='Indonesian' name='language'/>
    <meta content='general' name='rating'/>
    <meta content='global' name='distribution'/>
    <meta content='blogger' name='generator'/>
    <meta content='aeiwi, alexa, alltheWeb, altavista, aol netfind, anzwers, canada, directhit, euroseek, excite, overture, go, google, hotbot. infomak, kanoodle, lycos, mastersite, national directory, northern light, searchit, simplesearch, Websmostlinked, webtop, what-u-seek, aol, yahoo, webcrawler, infoseek, excite, magellan, looksmart, bing, cnet, googlebot' name='search engines'/>
    <meta content="index follow" name="robots"/>

    <link href='<?= base_url('') ?>assets/front_end/css/fonts/fontawesome.css' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/front_end/css/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="<?php echo base_url() ?>assets/front_end/css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="<?php echo base_url() ?>assets/front_end/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- search -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/front_end/search/css/main.css" rel="stylesheet" />

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/front_end/images/icon/favicon.ico" type="image/x-icon" />

    <!-- owl carousel css -->

    <link href="<?php echo base_url() ?>assets/front_end/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_end/css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_end/css/style-preloader.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front_end/js/jquery-2.1.4.min.js"></script>

    <!-- Recapcha -->
    <?=  $this->recaptcha->getScriptTag(); ?>
</head>

<body style="background: #f">
    <!-- Preloader -->
    <script type="text/javascript">
        $(window).load(function() { $("#loading").fadeOut("slow"); })
    </script>

    <!-- <div id="loading">
        <img alt="logo" src="<?php echo base_url() ?>assets/front_end/images/logo/logo.png" align="center" style="position: relative; top: 200px;" width="300"><br><br>
        <img alt="logo" src="<?php echo base_url() ?>assets/front_end/images/logo/loader.gif" align="center" style="position: relative; top: 200px;" width="120">
    </div> -->

    <div id="all">

            <header>
                 <!-- *** TOP ***
                 _________________________________________________________ -->
                 <div id="top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-3 contact">
                                <!-- <input type="text" placeholder="Cari produk" class="form-control"> -->
                                <div class="s128">
                                  <?= form_open('produk/cari'); ?>
                                    <div class="inner-form">
                                      <div class="row">
                                        <div class="input-field second">
                                          <input type="search" placeholder="Cari Produk" name="cari"/>
                                        </div>
                                      </div>
                                    </div>
                                  <?= form_close(); ?>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="login" style="float: right;">
                                    <?php if ($this->session->userdata('user_logged_in') == 'Sudah_Loggin') {
                                        ?>
                                        <div class="dropdown active">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('nama');  ?> <b class="caret"></b></a>
                                            <ul class="dropdown-menu" style="width: 200px">
                                                <li><a href="<?php echo site_url('akun'); ?>"><i class="fa fa-user"></i> <span class=" text-uppercase">Akun</span></a>
                                                </li>
                                                <li><a href="<?php echo site_url('riwayat'); ?>"><i class="fa fa-list"></i><span class=" text-uppercase">Riwayat Belanja</span></a>
                                                </li>
                                                <li><a href="<?php echo site_url('welcome/logout'); ?>"><i class="fa fa-sign-in"></i> <span class=" text-uppercase">Logout</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="javascript:void(0)" onclick="login()"><span class="text-uppercase"><i class=" fa fa-sign-in"></i> <span class="text-uppercase">Login</span></a>
                                        <a href="javascript:void(0)" onclick="tambah()"><span class="text-uppercase"><i class=" fa fa-user"></i> Daftar</span></a>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- *** TOP END *** -->


                <!-- *** NAVBAR ***
                _________________________________________________________ -->

                <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                    <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                        <div class="container">
                            <div class="navbar-header">

                                <a class="navbar-brand home" href="<?php echo site_url(''); ?>">
                                    <img src="<?php echo base_url() ?>assets/front_end/images/logo/logo.png" alt="logo" class="hidden-xs hidden-sm" style="margin-top: -10px; width:100px">
                                    <img src="<?php echo base_url() ?>assets/front_end/images/logo/logo.png" alt="logo" class="visible-xs visible-sm" style="margin-top: -9px; width:100px"><span class="sr-only"></span>
                                </a>
                                <div class="navbar-buttons">
                                    <button type="button" class="navbar-toggle btn-template-main-nav" data-toggle="collapse" data-target="#navigation">
                                        <span class="sr-only">Toggle navigation</span>
                                        <i class="fa fa-align-justify"></i>
                                    </button>
                                </div>
                            </div>
                            <!--/.navbar-header -->

                            <div class="navbar-collapse collapse" id="navigation">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="home">
                                        <a href="<?php echo site_url(''); ?>"><i class="glyphicon glyphicon-home"></i> Home </a>
                                    </li>
                                    <?php
                                        $kategory_produk =  $this->db->order_by('nama', 'asc');
                                        $kategory_produk = $this->DButama->GetDB('tb_kategori_produk');

                                        foreach ($kategory_produk->result() as $key){
                                    ?>
                                    <li class="<?=  $key->slug ?>"><a href="<?php echo site_url('produk/i/'.$key->slug) ?>"></span> <?=  $key->nama ?></a>
                                        <?php } ?>
                                    <?php
                                        $jumlah_cart = $this->cart->total_items();
                                    ?>
                                    <li class="cart hidden-xs hidden-sm">
                                        <a class="btn btn-small" href="<?php echo site_url('welcome/cart'); ?>" style="border-bottom-width: 0px;">
                                            <i class="fa fa-shopping-cart"></i><span><i id="cart-info"></i><?php echo $jumlah_cart; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            $jumlah_cart = $this->cart->total_items();
                            ?>
                            <div align="center" class="cart visible-xs visible-sm">
                                <a class="btn btn-small" href="<?php echo site_url('welcome/cart'); ?>" style="border-bottom-width: 0px;">
                                    <i class="fa fa-shopping-cart"></i>  <span><i id="cart-info"></i>Keranjang Belanja | <?php echo $jumlah_cart; ?></span>
                                </a>
                            </div>
                            <!--/.nav-collapse -->
                        </div>
                    </div>
                            <!-- /#navbar -->
                </div>
                        <!-- *** NAVBAR END *** -->
            </header>
<!-- *** LOGIN MODAL ***
    _________________________________________________________ -->
    <?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') {
        ?>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="width: 340px;">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Form Login Member</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-login" class="form-horizontal">
                            <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id" required/>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required/>
                                    <span class="help-block"></span>
                                </div>   
                            </div><?= $this->recaptcha->getWidget() ?>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                            <button type="button" id="btnLogin" onclick="savelogin()" class="btn btn-block btn-template-main"> Login</button>    
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p>Powered by <a href="<?php echo site_url('') ?>">Wedding Organizer</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

<!-- *** LOGIN MODAL END *** -->

<!-- *** DAFTAR MODAL ***
    _________________________________________________________ -->
    <?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') {
        ?>
        <div class="modal fade" id="daftar-modal" tabindex="-1" role="dialog" aria-labelledby="Daftar" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="width: 340px;">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Daftar">Form Daftar Member</h4>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id" required/>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" required/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required/>
                                    <span class="help-block"></span>
                                </div>   
                            </div><?= $this->recaptcha->getWidget() ?>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-block btn-template-main"> Daftar</button>    
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p>Tertarik menjadi salah satu Vendor WO HMProject? silahkan <a href="<?= site_url('vendor/') ?>"> klik disini !</a> </p>
                        <!-- <p>Powered by <a href="<?php echo site_url('') ?>">Wedding Organizer</a></p> -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

<!-- *** DAFTAR MODAL END *** -->

<script type="text/javascript">
    //fun tambah
    function tambah()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('#daftar-modal').modal('show');
    }

    //fun login
    function login()
    {
        save_method = 'login';
        $('#form-login')[0].reset();
        $('#login-modal').modal('show');
    }

    //fun simpan
    function save()
    {
        refreshTokens();
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        if(save_method == 'add') {
            url = "<?php echo site_url('welcome/tambah')?>";
            // ajax adding data to database
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",

                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#daftar-modal').modal('hide');
                        location.reload();
                        alert("Akun anda berhasil didaftarkan")
                    } 
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Daftar Gagal');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }

    //fun simpan
    function savelogin()
    {
        refreshTokens();
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        if(save_method == 'login') {
            url = "<?php echo site_url('welcome/login')?>";
            // ajax adding data to database
            var formData = new FormData($('#form-login')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",

                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#login-modal').modal('hide');
                        location.reload();
                        // location.replace('<?= site_url('akun'); ?>');
                        alert("Login berhasil");                       
                    } 
                    if(data.status1) //if success close modal and reload ajax table
                    {
                        $('#login-modal').modal('hide');
                        // location.reload();
                        location.replace('<?= site_url('akun'); ?>');
                        alert("Login berhasil");                       
                    } 
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Login Gagal');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }

</script>

<script>
      var btnDelete = document.getElementById('clear');
      var inputFocus = document.getElementById('inputFocus');
      btnDelete.addEventListener('click', function(e)
      {
        e.preventDefault();
        inputFocus.value = ''
      })
      document.addEventListener('click', function(e)
      {
        if (document.getElementById('first').contains(e.target))
        {
          inputFocus.classList.add('isFocus')
        }
        else
        {
          // Clicked outside the box
          inputFocus.classList.remove('isFocus')
        }
      });

    </script>
