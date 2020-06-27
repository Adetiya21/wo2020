<?php error_reporting(0) ?>
<link href="<?php echo base_url() ?>assets/front_end/css/light-carousel.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/front_end/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front_end/css/video-js.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front_end/css/style-rating.css" type="text/css">

<?php foreach ($produk->result() as $key) {
    ?>
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="hidden-sm hidden-xs"><?php echo $key->nama ?></h1>
                    <h1 class="hidden-md hidden-lg" style="font-size: 18pt;"><?php echo $key->nama ?></h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i> </a>
                        </li>
                        <li>Detail Produk - <?php echo $key->nama ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="container" style="background: #fff;border-radius: 10px;border: 1px solid #ddd;padding-top: 10px">
        <div class="row">
            <div class="heading text-center">
                <h2>Detail Produk</h2><br><br>
            </div>
            <div class="col-md-5 clearfix">
                <div class="sample1">
                    <div class="carousel">
                        <ul>
                            <li> <img src="<?php echo base_url().'assets/assets/img/produk/'.$key->gambar?>" alt="Picture"> </li>
                            <?php
                            if ($gambar_produk->num_rows() >= 1) {
                              foreach ($gambar_produk->result() as $key2) {
                                  ?>
                                  <li> <img src="<?php echo base_url().'assets/assets/img/produk/'.$key2->gambar ?>" alt=""> </li>
                                  <?php
                              }
                            }
                            ?>
                            <?php
                            if ($video_produk->num_rows() >= 1) {
                              foreach ($video_produk->result() as $key2) {
                                  ?>
                                  <li>
                                    <video controls>
                                      <source src="<?php echo base_url().'assets/assets/video/produk/'.$key2->video ?>">
                                    </video>
                                   <!-- <img src="<?php echo base_url().'assets/assets/video/produk/'.$key2->video ?>" alt=""> </li> -->
                                  <?php
                              }
                            }
                            ?>
                      </ul>
                      <div class="controls">
                        <div class="prev"></div>
                        <div class="next"></div>
                    </div>
                </div>
                <div class="thumbnails">
                    <ul>
                        <li> <img src="<?php echo base_url().'assets/assets/img/produk/'.$key->gambar?>" alt=" "> </li>
                        <?php
                        if ($gambar_produk->num_rows() >= 1) {
                          foreach ($gambar_produk->result() as $key2) {
                              ?>
                              <li> <img src="<?php echo base_url().'assets/assets/img/produk/'.$key2->gambar ?>" alt=""> </li>
                              <?php
                          }
                        }
                        ?>
                        <?php
                        if ($video_produk->num_rows() >= 1) {
                          foreach ($video_produk->result() as $key2) {
                              ?>
                              <li>
                                <video width="95px">
                                  <source src="<?php echo base_url().'assets/assets/video/produk/'.$key2->video ?>">
                                </video>
                               <!-- <img src="<?php echo base_url().'assets/assets/video/produk/'.$key2->video ?>" alt=""> </li> -->
                              <?php
                          }
                        }
                        ?>
                  </ul>
              </div>
          </div>
          <script src="<?php echo base_url() ?>assets/front_end/js/jquery.light-carousel.js"></script>
          <script>
            $('.sample1').lightCarousel();
        </script>
        <br>
        <div>
            <button onclick="history.go(-1)" class="btn btn-default" title="Back"><i class="glyphicon glyphicon-chevron-left"></i> Back</button>
        </div><br>
    </div>

    <div class="col-md-7 clearfix">
        <div class="tabs">
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a href="#tab2-1" data-toggle="tab">Info Produk</a>
                </li>
                            <li class=""><a href="#tab2-2" data-toggle="tab">Review</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-inverse">
                            <div class="tab-pane active" id="tab2-1">
                              <div class="row" style="padding-left: 10px;">
                                <div class="col-md-6">
                                    <h5>Nama Vendor</h5>
                                    <p>
                                      <?php
                                      foreach ($ven->result() as $key1) {
                                          if ($key1->id==$key->id_vendor) {
                                              echo $key1->nama;
                                      ?>
                                    </p>
                                    <h5>Alamat</h5>
                                    <p><?php echo $key1->alamat; }}?></p>
                                    <h5>Tanggal Posting</h5>
                                    <p> <?php echo date('d F Y', strtotime($key->tgl)); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Kategori Produk</h4>
                                    <p><?php echo $key->nama_kategory ?></p>
                                    <h4>Harga</h4>
                                    <p>Rp. <?php echo rupiah($key->harga) ?></p>
                                    <h5>Stok</h5>
                                    <p><?php echo rupiah($key->kuantitas_penjualan) ?></p>
                                </div>
                                <div class="col-md-12">
                                    <h5>Deskripsi Produk</h5>
                                    <p class="text-justify">
                                        <?php echo $key->deskripsi ?>
                                    </p>
                                </div>
                              </div>
                                
                            </div>
                            <div class="tab-pane" id="tab2-2">
                                <div class="row">
                                    <!-- total rating ulasan -->
                                    <div class="col-sm-6">
                                        <div class="rating-block">
                                            <h4>Review Ratings</h4>
                                            <h2 class="bold padding-bottom-7">
                                                <?php
                                                $j=0;
                                                if($jumlah>$j){
                                                    echo $jumlah;
                                                    echo '<small>/ 5</small>';
                                                } else { echo $j;
                                                   echo '<small>/ 5<br>No Reviews</small>'; }?>
                                               </h2>
                                               <?php if($jumlah>=5) { ?>
                                               <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if($jumlah>=4) { ?>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if($jumlah>=3) { ?>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if($jumlah>=2) { ?>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if($jumlah>=1) { ?>
                                              <button type="button" class="btn btn-template-primary btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if($jumlah<1) { ?>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-sm" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } ?>
                                          </div>
                                      </div>
                                      <!-- rating bintang -->
                                      <div class="col-sm-6">
                                        <h4>Ratings</h4>
                                        <br><br>
                                        <div class="pull-left">
                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                            </div>
                                            <?php
                                            $ps=$r5*10;
                                            if($ps>1000){
                                                $ps/100;
                                            } else if($ps>100){
                                                $ps=$ps/10;
                                            }
                                            ?>
                                            <div class="pull-left" style="width:180px;">
                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $ps ?>%">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="pull-right" style="margin-left:10px;"><?php echo $r5 ?></div>
                                      </div>

                                      <div class="pull-left">
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                        </div>
                                        <?php
                                        $ps1=$r4*10;
                                        if($ps1>1000){
                                            $ps1/100;
                                        } else if($ps1>100){
                                            $ps1=$ps1/10;
                                        }
                                        ?>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $ps1 ?>%">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="pull-right" style="margin-left:10px;"><?php echo $r4 ?></div>
                                  </div>

                                  <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                    </div>
                                    <?php
                                    $ps2=$r3*10;
                                    if($ps2>1000){
                                        $ps2/100;
                                    } else if($ps2>100){
                                        $ps2=$ps2/10;
                                    }
                                    ?>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $ps2 ?>%">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="pull-right" style="margin-left:10px;"><?php echo $r3 ?></div>
                              </div>
                              <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <?php
                                $ps3=$r2*10;
                                if($ps3>1000){
                                    $ps3/100;
                                } else if($ps3>100){
                                    $ps3=$ps3/10;
                                }
                                ?>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $ps3 ?>%">
                                      </div>
                                  </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;"><?php echo $r2 ?></div>
                          </div>
                          <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <?php
                            $ps4=$r1*10;
                            if($ps4>1000){
                                $ps4/100;
                            } else if($ps4>100){
                                $ps4=$ps4/10;
                            }
                            ?>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $ps4 ?>%">
                                  </div>
                              </div>
                          </div>
                          <div class="pull-right" style="margin-left:10px;"><?php echo $r1 ?></div>
                      </div><br><br><br>
                  </div>
                  <!-- ulasan user -->
                  <div class="col-sm-12">
                    <hr>
                    <div class="home-carousel1">
                        <div class="row">
                            <div class="homepage owl-carousel">
                                <?php foreach ($ulasan->result() as $key1)
                                {
                                    ?>
                                    <div class="item">
                                        <div class="col-sm-12 text-center">
                                            <h4 style="text-transform: capitalize;"><?php echo $key1->nama ?></h4>
                                            <p><a href="mailto:<?php echo $key1->email ?>" title="email"><?php echo $key1->email ?></a></p>
                                            <p style="font-size: 10px"><?php echo date('d F Y', strtotime($key1->tgl)) ?></p>
                                            <p><?php echo $key1->ulasan ?></p>
                                            <div class="review-block-rate">
                                                <?php if ($key1->rating_5=='1') {  ?>
                                                <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>

                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if ($key1->rating_4=='1') {  ?>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>

                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if ($key1->rating_3=='1') {  ?>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>

                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if ($key1->rating_2=='1') {  ?>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>

                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } else if ($key1->rating_1=='1') {  ?>
                                              <button type="button" class="btn btn-template-primary btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>

                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-template-gray btn-xs" aria-label="Left Align">
                                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                              </button>
                                              <?php } ?>
                                          </div>
                                      </div>
                                  </div>
                                  <?php } ?>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-12">
                    <hr>
                    <!-- form ulasan -->
                    <?= form_open('produk/tambah_ulasan', '', $hidden); ?>
                    <div class="row">
                        <?php if ($this->session->userdata('user_logged_in') == 'Sudah_Loggin') { ?>
                        <div class="col-sm-12">
                            <h5>Tulis komentar tentang produk ini</h5>
                        </div>
                        <div class="col-sm-12">
                            <!-- <input type="text" name="id_produk" value="<?php echo $this->uri->segment(3);  ?>" class="form-control" id="firstname"> -->
                            <input type="hidden" name="id_produk" value="<?= $key->id;  ?>" class="form-control" id="firstname">
                            <input type="hidden" name="nama" value="<?php echo $this->session->userdata('nama');  ?>" class="form-control" id="firstname">
                            <input type="hidden" name="email" value="<?php echo $this->session->userdata('email');  ?>" class="form-control" id="email">
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message">Rating</label>
                                <div class="stars">
                                    <input type="radio" name="star" class="star-1" id="star-1" value="1" />
                                    <label class="star-1" for="star-1">1</label>
                                    <input type="radio" name="star" class="star-2" id="star-2" value="2" />
                                    <label class="star-2" for="star-2">2</label>
                                    <input type="radio" name="star" class="star-3" id="star-3" value="3" />
                                    <label class="star-3" for="star-3">3</label>
                                    <input type="radio" name="star" class="star-4" id="star-4" value="4" />
                                    <label class="star-4" for="star-4">4</label>
                                    <input type="radio" name="star" class="star-5" id="star-5" value="5" />
                                    <label class="star-5" for="star-5">5</label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message">Reviews</label>
                                <textarea id="message" name="ulasan" class="form-control" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <hr>
                            <button type="submit" class="btn btn-lg btn-warning" style="width: 100%"><i class="fa fa-location-arrow"></i> Kirim Reviews</button>

                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.row -->
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.tab -->
    </div>
</div>
<hr>
<div >
    <?php
    $attributes = array('class' => 'form-item');
    ?>
    <h5>Atur Pesanan Anda</h5>
    <?= form_open('', $attributes); ?>
    <input type="hidden" name="id" value="<?php echo $key->id; ?>">
    <div class="col-md-3">
      <label> Tanggal </label> 
    </div>  
    <div class="col-md-9">
      <input type="date" name="tgl" class="form-control"> 
    </div>  
    <div class="col-md-12">
      <?php foreach ($ven->result() as $key1) {
                            if ($key1->id==$key->id_vendor) {
                              echo '<input type="hidden" name="vendor" value="'.$key1->nama.'">';
                            }}?>
    <hr>
  </div>
    <button type="submit" class="btn btn-lg btn-template-main" style="width: 100%"><i class="glyphicon glyphicon-shopping-cart"></i> Pesan Sekarang</</button>
    <?= form_close(); ?>
</div>
<br><br>
</div>
</div>
</div>
<?php } ?>
<br><br>

<!-- Load file ajax.js yang ada di folder js -->        
<script src="<?php echo base_url() ?>assets/front_end/js/video.js"></script>        
<script>            
  /*memanggil file video-js-swf yang ada di folder js */            
  videojs.options.flash.swf = "<?php echo base_url() ?>assets/front_end/js/video-js.swf";        
</script>
<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.0.min.js"><\/script>')
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Adding...'); //Loading button text

            $.ajax({ //make ajax request to cart_process.php
                url: "<?php echo base_url().'welcome/add_cart'; ?>",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data){ //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('<i class="glyphicon glyphicon-shopping-cart"></i> Proses..'); //reset button text to original text
                alert("Produk telah dimasukkan ke keranjang anda"); //alert user
                location.reload();
            })
            e.preventDefault();
        });
    });
    $(document).ready(function() {
        $('.produk').addClass('active');
    });
</script>