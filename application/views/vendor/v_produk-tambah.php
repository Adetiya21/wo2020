<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.produk').addClass('active');
      $('.input-produk').addClass('active');
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
					<i class="feather icon-edit bg-c-blue"></i>
					<div class="d-inline">
						<h5>Form Input Produk</h5>
						<span>Pastikan mengisi data produk dengan benar.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('vendor/produk') ?>">Produk</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('vendor/produk/tambah') ?>">Input Produk</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="card">
						<div class="card-header">
							<h5>Input Produk</h5>
							<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>
						<div class="card-block">
							<div id="wizard">
								<section>
									<?= $this->session->flashdata('pesan'); ?>
									<?= $this->session->flashdata('error'); ?>
									<?php $arb = array('enctype' => "multipart/form-data", );?>
									<?= form_open('vendor/produk/proses',$arb); ?>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Kategori Produk</label>
				                      <div class="col-sm-10">
				                        <select class="form-control select2" name="id_kategori" style="width: 100%;">
							              <option>Pilih Kategori</option>
							              <?php foreach ($kat->result() as $key) {
							                ?>
							                <option value="<?= $key->id ?>"><?= $key->nama ?></option>
							                <?php
							              } ?>
							            </select>
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Nama Produk</label>
				                      <div class="col-sm-10">
				                        <input type="text" class="form-control" placeholder="Nama Produk" name="nama">
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Harga</label>
				                      <div class="col-sm-10">
				                      	<div class="input-group">
				                      		<span class="input-group-prepend" id="basic-addon2">
				                      			<label class="input-group-text">Rp.</label>
				                      		</span>
				                      		<input type="text" name="harga" class="form-control" placeholder="Harga" maxlength="8" onkeypress='return check_int(event)' id="hargaasli">
				                      	</div>
				                      	
			                      		<span style="font-weight: bold" id="jmlh">Anda akan mendapatkan (Rp): <span id="earned_price" class="earned-price">0,00</span>. ~(Komisi Admin 2%)~</span>
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Kuantitas Jual</label>
				                      <div class="col-sm-10">
				                        <input type="number" class="form-control" placeholder="Jumlah" name="kp">
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Deskripsi</label>
				                      <div class="col-sm-10">
				                        <textarea class="form-control" name="deskripsi" rows="5">
				                        </textarea> 
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Gambar Utama Produk</label>
				                      <div class="col-sm-10">
				                        <input id="uploadImage" class="form-control" type="file" name="gambar" onchange="PreviewImage();" value="" />
				                        <div class="form-group" id="photo-preview"></div>
			                                <p class="help-block">Max. 2MB</p>
			                                <img id="uploadPreview" style="width:350px; height:210px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/produk/') ?>" />
				                      </div>
				                    </div>
				                    <hr>
				                    
				                    
				                    <div class="form-group row">
				                      <!-- <label class="col-sm-2"></label> -->
				                      <div class="col-sm-2">
				                        <button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Simpan Data</abutton>
				                      </div>
				                    </div>
				                  <!-- </form> -->
				                  <?= form_close(); ?>
								</section>
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
	
<script type="text/javascript">
 <?php echo $jsArray; ?> 
    function changeValue(item){ 
	    document.getElementById('alamat_toko').value = dtToko[item].alamat_toko; 
	    document.getElementById('harga_sewa').value = dtToko[item].harga_sewa;
	};
</script>
<script>
		//calculate product earned value
		var thousands_separator = ',';
		var commission_rate = '2';
		$(document).on("input keyup paste change", "#hargaasli", function () {
			var input_val = $(this).val();
			input_val = input_val.replace(',', '.');
			var price = parseFloat(input_val);
			commission_rate = parseInt(commission_rate);
			//calculate
			if (!Number.isNaN(price)) {
				var earned_price = price - ((price * commission_rate) / 100);
				var	reverse = earned_price.toString().split('').reverse().join(''),
				ribuan 	= reverse.match(/\d{1,3}/g);
				ribuan	= ribuan.join('.').split('').reverse().join('');
				
				// earned_price = earned_price.toFixed(2);
				// if (thousands_separator == ',') {
				// 	// earned_price = earned_price.replace('.', ',');
				// }
			} else {
				// earned_price = '0' + thousands_separator + '00';
			}
			$("#earned_price").html(ribuan);
		});
	</script>

<script type="0c02f9e383c53a06f1a03b30-text/javascript" src="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="0c02f9e383c53a06f1a03b30-text/javascript" src="<?= base_url('assets/') ?>assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>

<script type="0c02f9e383c53a06f1a03b30-text/javascript" src="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>

<script type="0c02f9e383c53a06f1a03b30-text/javascript" src="<?= base_url('assets/') ?>bower_components/datedropper/js/datedropper.min.js"></script>

<script src="<?= base_url('assets/') ?>assets/pages/waves/js/waves.min.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>

<script src="<?= base_url('assets/') ?>bower_components/jquery.steps/js/jquery.steps.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/jquery-validation/js/jquery.validate.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>

<script type="80e04729b0cb0dda322eaea3-text/javascript" src="<?= base_url('assets/') ?>assets/pages/form-validation/validate.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/datedropper/css/datedropper.min.css" />
<script src="<?= base_url('assets/') ?>assets/pages/forms-wizard-validation/form-wizard.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>

<script src="<?= base_url('assets/') ?>ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="80e04729b0cb0dda322eaea3-|49" defer=""></script></body>

<!-- Mirrored from colorlib.com//polygon/admindek/default/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jun 2020 14:36:31 GMT -->
</html>
