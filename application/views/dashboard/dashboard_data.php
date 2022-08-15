<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-12">
		<div class="info-box bg-gradient-danger">
			<span class="info-box-icon"><i class="fas fa-info"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">
					<h2>Selamat Datang <?php echo $this->session->userdata('full_name'); ?></h2>
				</span>
				<span class="info-box-text">Sistem Informasi Kepegawaian Dinas Tenaga Kerja Kabupaten Indramayu</span>
			</div>

		</div>

	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-6">
		<div class="row">
			<div class="col-md-12">
				<div class="info-box">
					<span class="info-box-icon bg-danger"><i class="fas fa-calendar"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Hari / Tanggal</span>
						<span class="info-box-number"><?php echo longdate_indo(date('Y-m-j')); ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-exclamation-triangle"></i>
							Info Penting
						</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-ban"></i> Alert!</h5>
							Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my
							entire
							soul, like these sweet mornings of spring which I enjoy with my whole heart.
						</div>

					</div>

				</div>

			</div>
		</div>
	</div>
	<div class="col-lg-6 col-6">
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">Statistik Pegawai</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove">
						<i class="fas fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
				<div class="row">
					<div class="col-4">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text">Total Pegawai</span>
								<span class="info-box-number"><?= $count_all; ?></span>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text">PNS</span>
								<span class="info-box-number"><?= $count_pns; ?></span>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text">CPNS</span>
								<span class="info-box-number"><?= $count_cpns; ?></span>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text">PPPK</span>
								<span class="info-box-number"><?= $count_pppk; ?></span>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text">Non ASN</span>
								<span class="info-box-number"><?= $count_honor; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- /.row -->
<?php if ($this->session->userdata('id_level') == '2') { ?>
	<!-- Menu Pegawai-->
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="card card-widget widget-user">
				<div class="widget-user-header bg-info">
					<h3 class="widget-user-username"><?= strlen($pegawai->gelar_dpn) > 0 ? $pegawai->gelar_dpn . ". " : "" ?><?= ucwords($pegawai->nama_pegawai) ?><?= strlen($pegawai->gelar_blkg) > 0 ? ", " . $pegawai->gelar_blkg : "" ?></h3>
					<h5 class="widget-user-desc"><?= $pegawai->nama_jabatan; ?></h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle elevation-2" src="<?php echo base_url(); ?>assets/foto/user/<?php echo ($this->session->userdata['image'] == null) ? "default.png" : $this->session->userdata['image']; ?>" alt="User Avatar">
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<span class="description-header">Pangkat</span>
								<h5 class="description-text"><?= $pegawai->nama_pangkat; ?></h5>
							</div>

						</div>

						<div class="col-sm-4 border-right">
							<div class="description-block">
								<span class="description-header">Golongan</span>
								<h5 class="description-text"><?= $pegawai->jenis_pangkat; ?></h5>
							</div>

						</div>

						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header">Gaji</h5>
								<span class="description-text"><?= rupiah($pegawai->gapok); ?></span>
							</div>

						</div>

					</div>

				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-sitemap"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Kenaikan Pangkat Berikutnya</span>
						<span class="info-box-number"> <i class="fa fa-calendar"></i> </span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Kenaikan Gaji Berikutnya</span>
						<span class="info-box-number"> <i class="fa fa-calendar"></i> </span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
	</div>
	<!-- /.row -->
<?php } ?>

<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script>
	//-------------
	//- DONUT CHART -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.
	var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
	var donutData = {
		labels: [
			'PNS',
			'PPPK',
			'CPNS',
			'Honor',
		],
		datasets: [{
			data: [<?= $count_pns ?>, <?= $count_pppk ?>, <?= $count_cpns ?>, <?= $count_honor ?>],
			backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
		}]
	}
	var donutOptions = {
		maintainAspectRatio: false,
		responsive: true,
	}
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	new Chart(donutChartCanvas, {
		type: 'doughnut',
		data: donutData,
		options: donutOptions
	})
</script>
