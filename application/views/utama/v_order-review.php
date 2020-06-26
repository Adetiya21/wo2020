<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="hidden-sm hidden-xs">Checkout - View Order</h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Checkout - View Order</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">

                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>Checkout - View Order</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <div class="row">
            <div class="col-md-2 clearfix"></div>
            <div class="col-md-8 clearfix">

                <div class="box">
                    <?= form_open('checkout/proses_checkout4'); ?>
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="<?= site_url('checkout') ?>"><i class="fa fa-money"></i><br>Metode Pembayaran</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Lihat Order</a>
                        </li>
                    </ul>

                    <div class="content" style="padding: 10px">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Produk</th>
                                        <!-- <th>Banyak</th> -->
                                        <th>Tanggal Boking</th>
                                        <!-- <th>Harga</th> -->
                                        <th>Pembayaran</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    foreach ($this->cart->contents() as $items) :
                                        $i++;
                                        ?>

                                        <tr>
                                            <td width="100px">
                                                <a href="<?= site_url('produk/detail/'.$items['slug']) ?>">
                                                    <img src="<?php echo base_url(); ?>assets/assets/img/produk/<?= $items['image'] ?>" width="100%">
                                                </a>
                                            </td>
                                            <td><a href="<?= site_url('produk/detail/'.$items['slug']) ?>"><?= $items['name'] ?></a></td>
                                            <!-- <td><?= $items['qty'] ?></td> -->
                                            <td><?= date('d F Y', strtotime($items['tgl'])) ?></td>
                                            <!-- <td>Rp. <?php echo rupiah($items['price']); ?>,00</td> -->
                                            <td><span class="label label-info"><?= $this->session->userdata('payment') ?></span></td>
                                            <td>Rp. <?php echo rupiah($items['subtotal']); ?>,00</td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4"><h4>Total</h4></th>
                                        <th><h4>Rp. <?php echo rupiah($this->cart->total()); ?>,00</h4></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <div align="center">
                                <a href="<?= site_url('checkout') ?>" class="btn btn-default" style="width:100%"><i class="fa fa-chevron-left"></i>Kembali</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div align="center">
                                <button type="submit" class="btn btn-template-main" style="width:100%">Konfirmasi<i class="fa fa-chevron-right"></i>
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