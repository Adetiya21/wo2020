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
						<h5>Dashboard Admin</h5>
						<span>Selamat Datang Admin <?= $this->session->userdata('nama')?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Home</a> </li>
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
							<a href="<?= site_url('admin/admin') ?>" class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Admin</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $admin ?> <span style="font-size: 0.7em">Admin</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/vendor') ?>" class="card prod-p-card card-blue">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Vendor</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $vendor ?> <span style="font-size: 0.7em">Vendor</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/member') ?>" class="card prod-p-card card-yellow">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Member</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $member ?> <span style="font-size: 0.7em">Member</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-yellow f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/kategori') ?>" class="card comp-card">
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
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/produk') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Produk</h6>
											<h3 class="f-w-700 text-c-green"><?= $produk ?> Produk</h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-clipboard bg-c-green"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/pesanan') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Invoice</h6>
											<h3 class="f-w-700 text-c-blue"><?= $invoice ?> Pesanan</h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-shopping-cart bg-c-blue"></i>
										</div>
									</div>
								</div>
							</a>
						</div>

						<div class="col-xl-12">
							<div class="card product-progress-card">
								<div class="card-header">
									<h5>Total Vendor : <?= $vendor  ?></h5>
									<div class="card-header-right">
										<ul class="list-unstyled card-option">
											<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
											<li><i class="feather icon-maximize full-card"></i></li>
											<li><i class="feather icon-minus minimize-card"></i></li>
											<li><i class="feather icon-refresh-cw reload-card"></i></li>
											<li><i class="feather icon-trash close-card"></i></li>
											<li><i class="feather icon-chevron-left open-card-option"></i></li>
										</ul>
									</div>
								</div>
								<div class="card-block">
									<div class="row pp-main">
										<div class="col-xl-6 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-hourglass-2 f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-yellow"><?= $ventunggu ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Vendor dengan status "Menunggu"</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-yellow">
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															<?= $ventunggu ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-yellow" style="width:<?= $ventunggu ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-check f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-blue"><?= $venterima ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Vendor dengan status "Diterima"</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-blue">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $venterima ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-blue" style="width:<?= $venterima ?>%"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-12">
							<div class="card product-progress-card">
								<div class="card-header">
									<h5>Total Pesanan : <?= $invoice  ?></h5>
									<div class="card-header-right">
										<ul class="list-unstyled card-option">
											<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
											<li><i class="feather icon-maximize full-card"></i></li>
											<li><i class="feather icon-minus minimize-card"></i></li>
											<li><i class="feather icon-refresh-cw reload-card"></i></li>
											<li><i class="feather icon-trash close-card"></i></li>
											<li><i class="feather icon-chevron-left open-card-option"></i></li>
										</ul>
									</div>
								</div>
								<div class="card-block">
									<div class="row pp-main">
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-yellow"><?= $imp ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Menunggu Pembayaran</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-yellow">
															<!-- <i class="fas fa-long-arrow-alt-up m-r-10"></i> -->
															<?= $imp ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-yellow" style="width:<?= $imp ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-blue"><?= $ip ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Proses</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-blue">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $ip ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-blue" style="width:<?= $ip ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-blue"><?= $ipd ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Pembayaran Dikonfirmasi</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-blue">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $ipd ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-blue" style="width:<?= $ipd ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-12 col-md-12"><hr></div>
										<div class="col-xl-4 col-md-6">
											<div class="" style="padding-left: 15px;padding-right: 15px;">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-green"><?= $idk ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Dikirim</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-green">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $idk ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-green" style="width:<?= $idk ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-info"><?= $isl ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Selesai</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-info">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $isl ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-info" style="width:<?= $isl ?>%"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-md-6">
											<div class="pp-cont">
												<div class="row align-items-center m-b-20">
													<div class="col-auto">
														<i class="fas fa-book f-24 text-mute"></i>
													</div>
													<div class="col text-right">
														<h2 class="m-b-0 text-c-red"><?= $idb ?></h2>
													</div>
												</div>
												<div class="row align-items-center m-b-15">
													<div class="col-auto">
														<p class="m-b-0">Dibatalkan</p>
													</div>
													<div class="col text-right">
														<p class="m-b-0 text-c-red">
															<!-- <i class="fas fa-long-arrow-alt-down m-r-10"></i> -->
														<?= $idb ?></p>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-c-red" style="width:<?= $idb ?>%"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
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