<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="hidden-sm hidden-xs">Cari <?php echo $title; ?></h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Product <?php echo $title; ?></h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">

                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i></a>
                    </li>
                    <li><a href="<?php echo site_url('produk/semua') ?>">Daftar Produk</a>
                    </li>
                    <li><?php echo $title; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-3">
        <div class="panel panel-default sidebar-menu">

        <div class="heading">
            <h3>Kategori</h3>
        </div>
        <p><a href="<?= site_url('produk/semua') ?>"><i class="fa fa-book"></i> SEMUA PRODUK</a><hr></p>
        <?php foreach ($kat->result() as $key) { ?>
            <p><a href="<?= site_url('produk/i/'.$key->slug) ?>"><i class="fa fa-book"></i> <?= $key->nama ?></a></p>
        <?php } ?>
    </div>
</div>
    <div class="col-md-9" style="border: 1px solid #e2e2e2">
        <div class="row products" >
            <?php
            foreach ($produk->result() as $key) {
                if ($key->kuantitas_penjualan>0) {
            ?>
            <div class="col-md-4 col-sm-3" data-animate="fadeInUp">
                <div class="box-image" style="width: 100%;">
                    <div class="image">
                        <img src="<?php echo base_url('assets/assets/img/produk/'.$key->gambar); ?>" alt="" class="img-responsive">
                    </div>
                    <div class="bg"></div>
                    <div class="name">
                        <h3><a href="#"><?php echo $key->nama; ?></a></h3>
                    </div>
                    <div class="text">
                        <?php foreach ($ven->result() as $key1) {
                            if ($key1->id==$key->id_vendor) {
                        $attributes = array('class' => 'form-item'); ?>
                        <?= form_open('', $attributes); ?>
                            <input type="hidden" name="id" value="<?php echo $key->id; ?>">
                            <input type="hidden" name="vendor" value="<?php echo $key1->nama; ?>">
                            <input type="hidden" name="tgl" value="00/00/0000">
                            <a href="<?php echo site_url('produk/detail/'.$key->slug) ?>" class="btn btn-template-transparent-black"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                            <button type="submit" class="btn btn-template-transparent-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Order</</button>
                        <?= form_close(); ?>
                    </div>
                </div>
                <div class="name">
                    <h4><?php echo $key->nama; ?></h4>
                    <h6><?php
                                echo 'By '.$key1->nama;
                            }}
                        ?>
                    </h6>
                    <p><b>Rp. <?php echo rupiah($key->harga); ?>,00 </b> </p>
                </div>
            </div>
            <?php
                }}
            ?>
        </div>
        <hr><br>
        <div class="pages">
            <?php echo $halaman; ?> <!--Memanggil variable pagination-->
        </div>
    </div>
    <div class="col-sm-12">
        
    </div>
</div>
<br><br>

<script type="text/javascript">
    $(document).ready(function() {
        $('.<?php echo $slug; ?>').addClass('active');
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
                alert("Produk telah dimasukkan ke keranjang anda"); //alert user
                location.reload();
            })
            e.preventDefault();

        });
    });
</script>