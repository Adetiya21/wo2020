<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="hidden-sm hidden-xs">Checkout - Payment method</h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Checkout - View Order</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">

                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>Checkout - Payment method</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <div class="row">
            <div class="col-md-2 clearfix"></div>
            <div class="col-md-8 clearfix" id="checkout">

                <div class="box">
                    <?= form_open('checkout/proses_checkout3'); ?>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href="#"><i class="fa fa-money"></i><br>Metode Pembayaran</a>
                        </li>
                        <li class="disabled"><a href="shop-checkout4.html"><i class="fa fa-eye"></i><br>Lihat Order</a>
                        </li>
                    </ul>

                    <div class="content" style="padding: 10px">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <div class="box payment-method">
                                    <!-- <h6>Cash on Delivery / COD</h6> -->
                                    <img src="<?php echo base_url() ?>assets/front_end/images/support/cod.png" alt="COD" style="width: 100%;height: 100px;">
                                    <div class="box-footer text-center">
                                        <input type="radio" name="payment" value="Cash on Delivery" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="box payment-method">
                                    <!-- <h6>Cash on Delivery / COD</h6> -->
                                    <img src="<?php echo base_url() ?>assets/front_end/images/support/tf.png" alt="Transfer" style="width: 100%;height: 100px;">
                                    <div class="box-footer text-center">
                                        <input type="radio" name="payment" value="Transfer Bank" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <div align="center">
                                <a href="<?= site_url('welcome/cart') ?>" class="btn btn-default" style="width:220px"><i class="fa fa-chevron-left"></i>Kembali</a>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div align="center">
                                <button type="submit" class="btn btn-template-main" style="width:220px">Proses Order<i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
                <!-- /.box -->
                <br>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->

<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.0.min.js"><\/script>')
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.cart').addClass('active');
    });
</script>