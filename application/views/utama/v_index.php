<link href="<?php echo base_url() ?>assets/front_end/css/light-carousel1.css" rel="stylesheet" type="text/css">

<div class="sample1">
    <div class="carousel">
        <ul>
            <li> <img src="<?php echo base_url() ?>assets/front_end/images/banner/1.jpg" alt="HMPROJECT"></li>
            <li> <img src="<?php echo base_url() ?>assets/front_end/images/banner/2.jpg" alt="HMPROJECT"> </li>
            <li> <img src="<?php echo base_url() ?>assets/front_end/images/banner/3.JPG" alt="HMPROJECT"> </li>
            <li> <img src="<?php echo base_url() ?>assets/front_end/images/banner/4.JPG" alt="HMPROJECT"></li>
            <li> <img src="<?php echo base_url() ?>assets/front_end/images/banner/5.JPG" alt="HMPROJECT"> </li>
        </ul>
        <div class="controls">
            <div class="prev"></div>
            <div class="next"></div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/front_end/js/jquery.light-carousel1.js"></script>
<script>
    $('.sample1').lightCarousel();
</script>

<section class="">
    <div class="container" style="padding-top:35px;">
        
            <div class="row">
                <?php foreach ($kategory_produk->result() as $key){ ?>
                    <div class="col-md-4">
                        <div class="team-leader">
                            <div class="team-leader-shadow"><a href="<?php echo site_url('produk/i/'.$key->slug) ?>"></a></div>
                            <img src="<?php echo base_url() ?>assets/assets/img/kategori/<?= $key->gambar?>" alt="<?= $key->nama ?>">
                            <div class="team-leader-span"><?= $key->nama ?></div>
                            <ul>
                                <li><a href="<?php echo site_url('produk/i/'.$key->slug) ?>">Lihat Daftar Produk</a></li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- /.products -->
        
    </div>
    <!-- /.container -->
</section>
<!-- /#content -->

<section class="bar background-pentagon no-mb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading text-center">
                    <h2>Produk Baru</h2>
                </div>

                <!-- <p class="des text-center">We already have many customers.<br>See what our customers say about us.</p> -->


                <!-- *** TESTIMONIALS CAROUSEL ***_________________________________________________________ -->
                <ul class="owl-carousel testimonials same-height-row">
                    <?php
                    foreach ($pr->result() as $key1) {
                    ?>
                    <li class="item" style="height: 450px">
                        <a href="<?= site_url('produk/detail/'.$key1->slug) ?>" >
                        <div class="testimonial same-height-always"> 
                            <img src="<?php echo base_url('assets/assets/img/produk/'.$key1->gambar); ?>" alt="gambar" class="img-responsive" style="width: 100%; height: 200px">
                            <div class="text">
                                <h3><?= $key1->nama; ?></h3>
                                <h6 style="margin-top: -10px;margin-bottom: -10px;"><?php
                                    foreach ($ven->result() as $key2) {
                                        if ($key2->id==$key1->id_vendor) {
                                            echo 'By '.$key2->nama;
                                        }}
                                    ?>
                                </h6>
                                <hr>
                                <h6>
                                    <?php foreach ($kategory_produk->result() as $key3) {
                                        if ($key3->id==$key1->id_kategori) {
                                            echo 'Kategori : '.$key3->nama;
                                        }}
                                    ?>
                                </h6>
                                <p><b>Rp. <?php echo rupiah($key1->harga); ?>,00 </b></p>
                            </div>
                            <div class="bottom" align="center">
                                <?php $attributes = array('class' => 'form-item'); ?>
                                <?= form_open('', $attributes); ?>
                                    <input type="hidden" name="id" value="<?php echo $key1->id; ?>">
                                    <a href="<?php echo site_url('produk/detail/'.$key1->slug) ?>" class="btn btn-template-transparent-black"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                                    <button type="submit" class="btn btn-template-transparent-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Order</</button>
                                <?= form_close(); ?>     
                             </div>
                        </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <!-- /.owl-carousel -->
                <!-- *** TESTIMONIALS CAROUSEL END *** -->
            </div>
            <div><a href="<?php echo site_url('produk/semua') ?>"><p style="font-size: 1.5em;" align="center">>> Lihat Semua Produk <<</p></a>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('.home').addClass('active');
    });

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
                button_content.html('<i class="glyphicon glyphicon-shopping-cart"></i> Proceed'); //reset button text to original text
                alert("Produk sudah dimasukkan kekeranjang belanja anda!"); //alert user
                location.reload();
            })
            e.preventDefault();

        });
    });
</script>