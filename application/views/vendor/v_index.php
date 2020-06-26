<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.home').addClass('active');
	});
</script>
<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-home bg-c-blue"></i>
					<div class="d-inline">
						<h5>Dashboard Vendor</h5>
						<span>Selamat Datang <?= $this->session->userdata('nama')?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('vendor/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="<?= site_url('vendor/home') ?>">Home</a> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-xl-4 col-md-6">
							<a href="#" class="card prod-p-card card-blue">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Semua Produk</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $produk ?> <span style="font-size: 0.7em">Produk</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-clipboard text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="#" class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Semua Pesanan</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $pesanan ?> <span style="font-size: 0.7em">Pesanan</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-shopping-cart text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('vendor/pesanan') ?>" class="card prod-p-card card-yellow">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Invoice</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $invoice ?> <span style="font-size: 0.7em"> Pesanan</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-briefcase text-c-yellow f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('vendor/produk') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Produk Saya</h6>
											<h3 class="f-w-700 text-c-blue"><?= $produk_saya ?> Produk</h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-clipboard bg-c-blue"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('vendor/pesanan_produk/saya') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Pesanan Produk Saya</h6>
											<h3 class="f-w-700 text-c-red"><?= $pesanan_saya ?> Pesanan</h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-shopping-cart bg-c-red"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('vendor/kategori') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Kategori Produk</h6>
											<h3 class="f-w-700 text-c-yellow"><?= $kategori ?> Kategori</h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-layout bg-c-yellow"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="styleSelector">
</div>