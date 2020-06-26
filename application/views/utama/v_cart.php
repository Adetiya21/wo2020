<script type="text/javascript">
    function isNumberKey (evt) {
        var charCode = (evt.which) ? evt.which :
        event.keyCode
        if (charCode > 31 && (charCode <48 || charCode > 57))

            return false;
        return true;
    };
</script>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="hidden-sm hidden-xs">Keranjang Belanja</h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Keranjang Belanja</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i></a>
                    </li>
                    <li>Keranjang</li>
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
                <p class="text-muted lead">Keranjang anda ada <?= $this->cart->total_items(); ?> item.</p>
                <div class="box">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Nama Produk</th>
                                    <th width="10px">Banyak</th>
                                    <th>Tanggal Boking</th>
                                    <th>Harga</th>
                                    <th >Aksi</th>
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
                                        <td>
                                            <?= form_open('welcome/update_cart'); ?>
                                            <input type="number" name="qty" value="<?= $items['qty'] ?>" onkeypress="return isNumberKey(event)" maxlength="2" class="form-control"></td>
                                        <td>
                                            <input type="date" name="tgl" class="form-control" value="<?= $items['tgl']?>">
                                            <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                        </td>
                                        <td>Rp. <?php echo rupiah($items['price']); ?></td>
                                        <!-- <td>Rp. <?php echo rupiah($items['subtotal']); ?></td> -->
                                        <td>
                                            <button class="btn btn-default" name="update" title="Refresh"><i class="fa fa-refresh"></i> </button>
                                            <?= form_close(); ?>
                                            <a href="<?php echo site_url('welcome/delete_cart/'.$items['rowid']); ?>" class="btn btn-warning" title="Hapus"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"><h4>Total</h4></th>
                                    <th colspan="2"><h4>Rp. <?php echo rupiah($this->cart->total()); ?>,00</h4></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.table-responsive -->

                    <div class="box-footer">
                        <div class="col-md-4">
                            <div align="center">
                                <a href="<?php echo site_url(); ?>" class="btn btn-default" style="width:100%"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div align="center">
                                <a href="<?= site_url("checkout") ?>" class="btn btn-template-main cek" style="width:100%" name="pesan">Proses Checkout <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- /.box -->
            </div>
        </div>
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