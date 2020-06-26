<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="hidden-sm hidden-xs">Riwayat Belanja</h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Riwayat Belanja</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">

                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i></a>
                    </li>
                    <li>Riwayat</li>
                </ul>

            </div>
        </div>
    </div>
</div>


<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 clearfix">
                <p class="lead">Invoice <b><?= $this->uri->segment(3) ?></b> dipesan pada <strong><?= date('d F Y', strtotime($invoice->tgl)) ?></strong>,
                    status sekarang <strong><?= $invoice->status ?></strong>.</p>
                    <p><b>Hai, silakan kirim bukti pembayaran anda pada form konfirmasi. Dan jika Anda memiliki pertanyaan, silakan <a href="<?php echo site_url('contact') ?>">Hubungi Kami</a>.<br>Happy Shopping!</p>

                <div class="box">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Produk</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hasil = 0;
                                foreach ($orders->result() as $key):
                                    ?>
                                    <tr>
                                        <td width="80px">
                                            <a href="<?= site_url('produk/detail/'.$key->slug) ?>">
                                                <img src="<?php echo base_url(); ?>assets/assets/img/produk/<?= $key->gambar_produk ?>" class="img-thumbnail">
                                            </a>
                                        </td>
                                        <td><a href="<?= site_url('produk/detail/'.$key->slug) ?>"><?= $key->nama_produk ?></a>
                                        </td>
                                        <!-- <td> <?= $key->qty ?></td> -->
                                        <td><?= date('d F Y', strtotime($invoice->tgl)) ?></td>
                                        <td><?= date('d F Y', strtotime($key->tgl_booking)) ?></td>
                                        <td><span class="label label-info"><?= $invoice->payment ?></span></td>
                                        <td>
                                            <?php if ($invoice->status=='Menunggu Pembayaran') {
                                                echo '<span class="label label-warning">'.$invoice->status.'</span>';
                                            } else if ($invoice->status=='Proses') {
                                                echo '<span class="label label-primary">'.$invoice->status.'</span>';
                                            } else if ($invoice->status=='Pembayaran Dikonfirmasi') {
                                                echo '<span class="label label-success">'.$invoice->status.'</span>';
                                            } else if ($invoice->status=='Dikirim') {
                                                echo '<span class="label label-success">'.$invoice->status.'</span>';
                                            } else if ($invoice->status=='Selesai') {
                                                echo '<span class="label label-info">'.$invoice->status.'</span>';
                                            } else if ($invoice->status=='Dibatalkan') {
                                                echo '<span class="label label-danger">'.$invoice->status.'</span>';
                                            }?>    
                                        </td>
                                        <td>Rp. <?php echo rupiah($key->harga_produk*$key->qty); ?>,00</td>
                                    </tr>
                                    <?php
                                    $hasil = ($key->harga_produk*$key->qty)+$hasil;
                                endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right"><h4>Total Order : Rp. <?php echo rupiah($hasil); ?>,00</h4></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.table-responsive -->
                    <hr>
                    <?php if ($invoice->status == 'Menunggu Pembayaran') { ?>
                    <div class="box clearfix" style="padding: 10px">
                        <div class="heading">
                            <h3>Form Konfirmasi Pembayaran</h3>
                        </div><hr>

                        <?php $arb = array('enctype' => "multipart/form-data", );?>
                        <?= form_open('riwayat/addgbrinv',$arb); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">Nama</label>
                                    <input type="text" name="nama" value="<?php echo $this->session->userdata('nama');  ?>" class="form-control" id="firstname" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="<?php echo $this->session->userdata('email');  ?>" class="form-control" id="email" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">No Invoice</label>
                                    <input type="text" name="inv" value="<?= $this->uri->segment(3) ?>" class="form-control" id="email" disabled>
                                    <input type="hidden" name="invoice" value="<?= $this->uri->segment(3) ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Bukti Pembayaran</label><br>
                                      <input id="uploadImage" type="file" name="gambar" class="form-control" onchange="PreviewImage();"/><!-- <i class="fa fa-paperclip pull-right"></i> --><br>

                                      <p style="font-size:10px;color:#bdbdbd">Max. 2MB</p>
                                      <div class="col-sm-6">
                                          <img id="uploadPreview" style="width:100%; height:100%;" alt="Tidak ada gambar" />
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-8 text-center">
                                <button type="submit" class="btn btn-lg btn-template-primary" style="width: 100%"><i class="fa fa-location-arrow"></i> Kirim Data</button>
                            </div>
                            <div class="col-sm-4 text-center">
                                <button type="submit" name="submit_cancel" value="submit_cancel" class="btn btn-lg btn-warning" style="width: 100%"><i class="fa fa-trash-o"></i> Batalkan Pesanan</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                    <?php } ?>
                    <div style="padding-left: 10px">
                        <a href="<?php echo site_url('riwayat') ?>" class="btn btn-default" title="Kembali"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
                    </div>
                </div>                
            </div>            
            <div class="col-md-3">
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading">
                        <h3 class="panel-title">Customer section</h3>
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
    </div>
</div>


<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.0.min.js"><\/script>')
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.riwayat').addClass('active');
    });
</script>
