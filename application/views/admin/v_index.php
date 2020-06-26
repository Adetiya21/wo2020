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
						<div class="col-xl-8 col-md-6">
							<a href="<?= site_url('admin/admin') ?>" class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Admin</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $admin ?> <span style="font-size: 0.7em">Admin</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-book text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/mapel') ?>" class="card prod-p-card card-blue">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Mapel</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $mp ?> <span style="font-size: 0.7em">Mapel</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-book text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/guru') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Guru</h6>
											<h3 class="f-w-700 text-c-yellow"><?= $guru ?> Guru</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users bg-c-yellow"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="#" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Siswa</h6>
											<h3 class="f-w-700 text-c-green"><?= $siswa ?> Siswa</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users bg-c-green"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4 col-md-6">
							<a href="<?= site_url('admin/kelas') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Kelas</h6>
											<h3 class="f-w-700 text-c-blue"><?= $kl ?> Kelas</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-book bg-c-blue"></i>
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