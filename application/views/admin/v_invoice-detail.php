<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.pesanan').addClass('active');
      $('.data-pesanan').addClass('active');
  	});

    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-layout bg-c-blue"></i>
					<div class="d-inline">
						<h5>Detail Pesanan Invoice : <?= $invoice->invoice ?></h5>
						<span>Berikut data detail pesanan .</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/produk') ?>">Produk</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/pesanan') ?>">Pesanan</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/pesanan/detail/'.$invoice->invoice) ?>">Detail</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content"  style="margin-top: -20px;margin-bottom: -20px">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<button class="btn btn-danger btn-round" onclick="ExportPdf()"><span class="fa fa-print"></span> Cetak Invoice</button>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row" id="myCanvas">
			            
			            <div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Data Pesanan Produk</h5>
		                            <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive">
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
														<td>
															<a href="<?= site_url('produk/detail/'.$key->slug) ?>">
																<img width="100px" height="100px" src="<?php echo base_url(); ?>assets/assets/img/produk/<?= $key->gambar_produk ?>">
															</a>
														</td>
														<td><?= $key->nama_produk ?></td>
														<td><?= date('d F Y', strtotime($invoice->tgl)) ?></td>
				                                        <td><?= date('d F Y', strtotime($key->tgl_booking)) ?></td>
														<td>
															<?php if ($invoice->payment=='Transfer Bank') {
				                                                echo '<span class="label label-inverse-info">'.$invoice->payment.'</span>';
				                                            } else if ($invoice->payment=='Cash On Delivery') {
				                                                echo '<span class="label label-inverse-warning">'.$invoice->payment.'</span>';
				                                            }?>
														</td>
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
													<th colspan="6" class="text-right"><h4>Total Order</h4></th>
													<th><h4>Rp. <?php echo rupiah($hasil); ?>,00</h4></th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						
			            <div class="col-md-7">
							<div class="card">
								<div class="card-header">
									<h5>Data Pemesan Produk</h5>
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive">
										<table class="table table-sm">
											<?php foreach ($pemesan as $key) { ?>
												<tr>
													<td width="10px">Nama</td>
													<td>: <?= $key->nama ?></td>
												</tr>
												<tr>
				                                    <td>Email</td>
				                                    <td>: <?= $key->email ?></td>
				                                </tr>
				                                <tr>
				                                    <td>No Telepon</td>
				                                    <td>: <?= $key->no_telp ?></td>
												</tr>
												<tr>
				                                    <td>Alamat</td>
				                                    <td>: <?= $key->alamat ?></td>
												</tr>
											<?php } ?>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="card">
								<div class="card-header">
									<h5>Data Pembayaran Produk</h5>
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive">
										<table class="table table-sm">
											<?php foreach ($pemesan as $key) { ?>
											<thead>
												<tr>
													<th>Metode Bayar</th>
													<th>: <?php if ($invoice->payment=='Transfer Bank') { ?>
														<span class="label label-inverse-info"><?= $invoice->payment ?></span> <?php } else { ?>
														<span class="label label-inverse-warning"><?= $invoice->payment ?></span> <?php } ?>
													</th>
												</tr>
												<?php if ($invoice->payment=='Transfer Bank') { ?>
												<tr>
				                                    <th>Bukti Bayar</th>
				                                    <th>:</th>
				                                </tr>
				                                <tr>
				                                    <th colspan="2"><img src="<?= base_url('assets/front_end/inv/') ?><?= $invoice->gambar ?>" alt="Bukti Transfer" width="280px">
				                                    	</th>
				                                </tr>
					                            <?php } ?>
											</thead>
											<?php } ?>
										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div id="styleSelector">
		</div>
	</div>
</div>

<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script type="text/javascript">
     function ExportPdf(){ 
kendo.drawing
    .drawDOM("#myCanvas", 
    { 
        paperSize: "A4",
        margin: { left:"0", right:"0" ,top: "0", bottom: "0" },
        scale: 0.61,
        height: 800
    })
        .then(function(group){
        kendo.drawing.pdf.saveAs(group, "Invoice <?= $invoice->invoice ?>.pdf")
    });
}
</script>