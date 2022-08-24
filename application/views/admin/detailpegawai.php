<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<div class="image">
							<img src="<?php echo base_url(); ?>assets/foto/user/<?php echo ($this->session->userdata['image'] == null) ? "default.png" : $this->session->userdata['image']; ?>" class="img-circle elevation-2" alt="User Image">
						</div>
					</div>
				</div>
			</div>
			<div class="col-8">
				<div class="card">
					<div class="card-body">
						<h2 class="mt-3"><?= strlen($pegawai->gelar_dpn) > 0 ? $pegawai->gelar_dpn . ". " : "" ?><?= ucwords($pegawai->nama_pegawai) ?><?= strlen($pegawai->gelar_blkg) > 0 ? ", " . $pegawai->gelar_blkg : "" ?></h2>
						<span class="text-muted">NIP. <?= $pegawai->nip ?></span>
						<hr>
						<span class="text-info"><i class="fas fa-phone"></i></span>
						<span class="text-info float-right"><?= $pegawai->no_hp ?></span>
						<hr>
						<span class="text-info"><i class="fas fa-envelope"></i></span>
						<span class="text-info float-right"><?= $pegawai->email ?></span>
					</div>

				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-blue"></i> Info</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<nav>
							<div class="nav nav-tabs" id="nav-tab">
								<a class="nav-item nav-link" id="nav-profil-tab" data-toggle="tab" href="#nav-profil" role="tab">Profil</a>
								<a class="nav-item nav-link" id="nav-keluarga-tab" data-toggle="tab" href="#nav-keluarga" role="tab">Keluarga</a>
								<a class="nav-item nav-link" id="nav-pendidikan-tab" data-toggle="tab" href="#nav-pendidikan" role="tab">Pendidikan</a>
								<a class="nav-item nav-link" id="nav-jabatan-tab" data-toggle="tab" href="#nav-jabatan" role="tab">Jabatan</a>
								<a class="nav-item nav-link" id="nav-pangkat-tab" data-toggle="tab" href="#nav-pangkat" role="tab">Pangkat</a>
								<a class="nav-item nav-link" id="nav-kgb-tab" data-toggle="tab" href="#nav-kgb" role="tab">KGB</a>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-profil" role="tabpanel">
								<table class="text-dark mt-3">
									<tr>
										<td>NIP</td>
										<td>:</td>
										<td><?= $pegawai->nip ?></td>
									</tr>
									<tr>
										<td>Nama Lengkap</td>
										<td>:</td>
										<td><?= strlen($pegawai->gelar_dpn) > 0 ? $pegawai->gelar_dpn . ". " : "" ?><?= ucwords($pegawai->nama_pegawai) ?><?= strlen($pegawai->gelar_blkg) > 0 ? ", " . $pegawai->gelar_blkg : "" ?></td>
									</tr>
									<tr>
										<td>Tempat, Tanggal Lahir</td>
										<td>:</td>
										<td><?= ucwords($pegawai->tempat_lahir) . ', ' . date('d-m-Y', strtotime($pegawai->tanggal_lahir)) ?> </td>
									</tr>
									<tr>
										<td>Agama</td>
										<td>:</td>
										<td><?= ucwords($pegawai->agama) ?> </td>
									</tr>
									<tr>
										<td>Usia</td>
										<td>:</td>
										<td> </td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>:</td>
										<td><?= ucwords($pegawai->jenis_kelamin) ?> </td>
									</tr>
									<tr>
										<td>Golongan Darah</td>
										<td>:</td>
										<td><?= strtoupper($pegawai->gol_darah) ?> </td>
									</tr>
									<tr>
										<td>Status Perkawinan</td>
										<td>:</td>
										<td><?= ucwords($pegawai->status_pernikahan) ?> </td>
									</tr>
									<tr>
										<td>NIK</td>
										<td>:</td>
										<td><?= $pegawai->nik ?> </td>
									</tr>
									<tr>
										<td>No. HP</td>
										<td>:</td>
										<td><?= $pegawai->no_hp ?> </td>
									</tr>
									<tr>
										<td>Email</td>
										<td>:</td>
										<td><?= $pegawai->email ?> </td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?= ucwords($pegawai->alamat) ?> </td>
									</tr>
									<tr>
										<td>No. NPWP</td>
										<td>:</td>
										<td><?= $pegawai->npwp ?> </td>
									</tr>
									<tr>
										<td>No. BPJS</td>
										<td>:</td>
										<td><?= $pegawai->bpjs ?> </td>
									</tr>
									<tr>
										<td>Status Kepegawaian</td>
										<td>:</td>
										<td><?= strtoupper($pegawai->status_kepegawaian) ?> </td>
									</tr>
									<tr>
										<td>Karpeg</td>
										<td>:</td>
										<td><?= $pegawai->karpeg ?> </td>
									</tr>
									<tr>
										<td>No. SK CPNS</td>
										<td>:</td>
										<td><?= $pegawai->sk_cpns ?> </td>
									</tr>
									<tr>
										<td>TMT CPNS</td>
										<td>:</td>
										<td><?= date('d-m-Y', strtotime($pegawai->tmt_cpns)) ?> </td>
									</tr>
									<tr>
										<td>No. SK PNS</td>
										<td>:</td>
										<td><?= $pegawai->sk_pns ?> </td>
									</tr>
									<tr>
										<td>TMT PNS</td>
										<td>:</td>
										<td><?= date('d-m-Y', strtotime($pegawai->tmt_pns)) ?> </td>
									</tr>
									<tr>
										<td>Golongan Awal</td>
										<td>:</td>
										<td><?= $pegawai->gol_awal ?> </td>
									</tr>
									<?php
									$awal  = date_create($pegawai->tmt_cpns);
									$akhir = date_create(); // waktu sekarang
									$diff  = date_diff($awal, $akhir);
									?>
									<tr>
										<td>Masa Kerja</td>
										<td>:</td>
										<td><?= $diff->y + $pegawai->mk_thn . ' tahun'; ?> <?= $diff->m + $pegawai->mk_bln . ' bulan'; ?></td>
									</tr>
								</table>
							</div>
							<div class="tab-pane fade" id="nav-keluarga" role="tabpanel">

								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTableKeluarga" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>NIK</th>
												<th>Nama</th>
												<th>Tempat Tanggal Lahir</th>
												<th>Pendidikan</th>
												<th>Pekerjaan</th>
												<th>Status</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody id="show_data_keluarga">
											<!-- <?php
													foreach ($data_keluarga as $keluarga) :
													?>
												<tr>
													<td><?= ucwords($keluarga->nik) ?></td>
													<td><?= ucwords($keluarga->nama_keluarga) ?></td>
													<td><?= ucwords($keluarga->tempat_lahir) . ', ' . date('d-m-Y', strtotime($keluarga->tanggal_lahir)) ?></td>
													<td><?= ucwords($keluarga->pendidikan) ?></td>
													<td><?= ucwords($keluarga->pekerjaan) ?></td>
													<td><?= ucwords($keluarga->hubungan) ?></td>
													<td>
														<a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>keluarga?nik=<?= $keluarga->nik ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a>
													</td>
												</tr>
											<?php endforeach; ?> -->

										</tbody>
									</table>
									<!-- <a href="<?= base_url('keluarga') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Keluarga</a> -->
									<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_keluarga()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-pendidikan" role="tabpanel">

								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTablePendidikan" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Tingkat</th>
												<th>Nama Sekolah</th>
												<th>Lokasi</th>
												<th>Jurusan</th>
												<th>Tanggal Ijazah</th>
												<th>Nomor Ijazah</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($data_pendidikan as $pendidikan) :
											?>
												<tr>
													<td><?= ucwords($pendidikan->tingkat) ?></td>
													<td><?= ucwords($pendidikan->nama_sekolah) ?></td>
													<td><?= ucwords($pendidikan->lokasi) ?></td>
													<td><?= ucwords($pendidikan->jurusan) ?></td>
													<td><?= date('d-m-Y', strtotime($pendidikan->tgl_ijazah)) ?></td>
													<td><?= ucwords($pendidikan->no_ijazah) ?></td>
													<td>
														<a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>pendidikan?id_pendidikan=<?= $pendidikan->id_pendidikan ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('pendidikan') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Pendidikan</a>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-jabatan" role="tabpanel">

								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTableJabatan" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Nama Jabatan</th>
												<th>Jenis Jabatan</th>
												<th>Eselon</th>
												<th>TMT</th>
												<th>TST</th>
												<th>Status Jabatan</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($data_jabatan as $jabatan) :
											?>
												<tr>
													<td><?= ucwords($jabatan->nama_jabatan) ?></td>
													<td><?= ucwords($jabatan->jenis_jabatan) ?></td>
													<td><?= ucwords($jabatan->eselon) ?></td>
													<td><?= date('d-m-Y', strtotime($jabatan->tmt)) ?></td>
													<td><?= $jabatan->sampai_tgl != Null ? date('d-m-Y', strtotime($jabatan->sampai_tgl)) : "" ?></td>
													<td><?= ucwords($jabatan->status_jabatan) ?></td>
													<td>
														<a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>jabatan?id_jabatan=<?= $jabatan->id_jabatan ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a>
														<a href="javascript:void(0)" class="btn btn btn-xs <?php echo ($jabatan->status_jabatan == "aktif") ? "btn-danger" : "btn-success"; ?>" <?php echo ($jabatan->status_jabatan == "tidak aktif") ? "onclick=\"set_jabatan('" . $jabatan->status_jabatan . "','" . $jabatan->id_jabatan . "','" . $jabatan->nip . "')\"" : ""; ?>><i class="fa fa-check"></i> <?php echo ($jabatan->status_jabatan == "aktif") ? "Non Aktifkan" : "Aktifkan"; ?></a>
													</td>
												</tr>

											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('jabatan') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Jabatan</a>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-pangkat" role="tabpanel">
								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTablePangkat" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Pangkat / Golongan</th>
												<th>Nama Pengesah SK</th>
												<th>No SK</th>
												<th>Gaji Pokok</th>
												<th>Status pangkat</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($data_pangkat as $pangkat) :
											?>
												<tr>
													<td><?= ucwords($pangkat->nama_pangkat) ?> - <?= ucwords($pangkat->jenis_pangkat) ?> <br />
														<span class="text-blue font-small">TMT : <?= date('d-m-Y', strtotime($pangkat->tmt_pangkat)) ?> </span>
													</td>
													<td><?= ucwords($pangkat->nama_pengesah_sk) ?></td>
													<td><?= ucwords($pangkat->no_sk) ?> <br />
														<span class="text-blue font-small">Tanggal : <?= date('d-m-Y', strtotime($pangkat->sah_sk)) ?></span>
													</td>
													<td><?= rupiah(ucwords($pangkat->gapok)) ?></td>
													<td><?= ucwords($pangkat->status_pangkat) ?></td>
													<td>
														<a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>pangkat?id_pangkat=<?= $pangkat->id_pangkat ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a>
														<a href="javascript:void(0)" class="btn btn btn-xs <?php echo ($pangkat->status_pangkat == "aktif") ? "btn-danger" : "btn-success"; ?>" <?php echo ($pangkat->status_pangkat == "tidak aktif") ? "onclick=\"set_pangkat('" . $pangkat->status_pangkat . "','" . $pangkat->id_pangkat . "','" . $pangkat->nip . "')\"" : ""; ?>><i class="fa fa-check"></i> <?php echo ($pangkat->status_pangkat == "aktif") ? "Non Aktifkan" : "Aktifkan"; ?></a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('pangkat') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Pangkat</a>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-kgb" role="tabpanel">
								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTableKGB" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Pangkat / Golongan</th>
												<th>Tangal SK</th>
												<th>Nama Pengesah SK</th>
												<th>No SK</th>
												<th>Gaji Pokok</th>
												<th>Masa Kerja</th>
												<th>Status pangkat</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($data_kgb as $kgb) :
											?>
												<tr>
													<td><?= ucwords($kgb->pangkat) ?> <br />
														<span class="text-blue font-small">TMT KGB: <?= date('d-m-Y', strtotime($kgb->tmt_kgb)) ?> </span>
													</td>
													<td><?= ucwords($kgb->nama_pengesah_sk) ?>
													</td>
													<td><?= ucwords($kgb->no_sk) ?> <br />
														<span class="text-blue font-small">Tanggal : <?= date('d-m-Y', strtotime($kgb->tanggal_sk)) ?></span>
													</td>
													<td><?= rupiah(ucwords($kgb->gapok)) ?></td>
													<td><?= ucwords($kgb->mk_thn_kgb) ?> Tahun <?= ucwords($kgb->mk_bln_kgb) ?> Bulan</td>
													<td><?= ucwords($kgb->status_kgb) ?></td>
													<td>
														<a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>kgb?id_kgb=<?= $kgb->id_kgb ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a>
														<a href="<?= base_url('_config/proses_kgb') ?>?set&id=<?= $kgb->id_kgb ?>&nip=<?= $pegawai->nip ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Setup</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('kgb') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah KGB</a>
								</div>

							</div>

						</div>

					</div>

				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->

	</div>
	<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
<script>
	var url = window.location.href;
	var activeTab = url.substring(url.indexOf("#") + 1);
	$(".tab-pane").removeClass("active in");
	$("#" + activeTab).addClass("active in");
	$('a[href="#' + activeTab + '"]').tab('show')
</script>
<script type="text/javascript">
	$(document).ready(function() {
		tampil_data_keluarga();
		$('#dataTableKeluarga').dataTable();
		function tampil_data_keluarga() {
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>pegawai/data_keluarga/<?= $pegawai->nip ?>',
				async: false,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<tr>' +
							'<td>' + data[i].nik + '</td>' +
							'<td>' + data[i].nama_keluarga + '</td>' +
							'<td>' + data[i].tempat_lahir + ', ' + data[i].tanggal_lahir + '</td>' +
							'<td>' + data[i].pendidikan + '</td>' +
							'<td>' + data[i].pekerjaan + '</td>' +
							'<td>' + data[i].hubungan + '</td>' +
							'<td> Edit </td>' +
							'</tr>';
					}
					$('#show_data_keluarga').html(html);
				}
				// <td><a class="btn btn-xs btn-outline-primary" href="<?= base_url(); ?>keluarga?nik=<?= $keluarga->nik ?>" title="Edit"><i class="fas fa-edit"></i> Edit</a></td>
			});
		}
		
	});

	function set_pangkat(stat, id_pangkat, nips) {
		var id = id_pangkat;
		var nip = nips;
		var status = (stat == 'tidak aktif') ? 'aktif' : 'tidak aktif';
		var msg = (status == 'aktif') ? 'aktif' : 'tidak aktif';
		if (confirm("Are you sure to " + msg)) {
			url = "<?php echo site_url('pegawai/set_pangkat'); ?>";
			$.ajax({
				type: "POST",
				url: url,
				data: {
					"id_pangkat": id,
					"status_pangkat": status,
					"nip": nip
				},
				success: function(data) {
					// if you want reload the page
					function gototab(reload) {
						window.location.hash = '#nav-pangkat';
						window.location.reload(true);
					}
					//location.reload();
					gototab();
				}
			});
		}
	}

	function set_jabatan(stat, id_jabatan, nips) {
		var id = id_jabatan;
		var nip = nips;
		var status = (stat == 'tidak aktif') ? 'aktif' : 'tidak aktif';
		var msg = (status == 'aktif') ? 'aktif' : 'tidak aktif';
		if (confirm("Are you sure to " + msg)) {
			url = "<?php echo site_url('pegawai/set_jabatan'); ?>";
			$.ajax({
				type: "POST",
				url: url,
				data: {
					"id_jabatan": id,
					"status_jabatan": status,
					"nip": nip
				},
				success: function(data) {
					// if you want reload the page
					function gototab(reload) {
						window.location.hash = '#nav-jabatan';
						window.location.reload(true);
					}
					//location.reload();
					gototab();
				}

			});
		}

	}

	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax 
	}

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	function add_keluarga() {
		save_method = 'add';
		act = 'add_keluarga';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah keluarga'); // Set Title to Bootstrap modal title
	}

	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		if (save_method == 'add') {
			url = "<?php echo site_url('keluarga/insert') ?>";
		} else {
			url = "<?php echo site_url('keluarga/update') ?>";
		}

		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data) {

				if (data.status) //if success close modal and reload ajax table
				{
					$('#modal_form').modal('hide');
					if (act == 'add_keluarga') {
						tampil_data_keluarga().call();
					}
					Toast.fire({
						icon: 'success',
						title: 'Berhasil disimpan!!.'
					});
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
					}
				}
				$('#btnSave').text('Simpan'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 


			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error Menambah / Mengupdate data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 

			}
		});
	}
</script>

<!-- Bootstrap modal keluarga -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">

			<div class="modal-header">
				<h3 class="modal-title">Person Form</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="nik" />
					<div class="card-body">
						<div class="form-group row">
							<label for="nip" class="col-sm-3 col-form-label">Pilih Pegawai</label>
							<div class="col-sm-9">
								<select class="form-control" name="nip" id="nip" autofocus>
									<option value="<?= $pegawai->nip ?>"><?= $pegawai->nama_pegawai ?></option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="nik" class="col-sm-3 col-form-label">NIK</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nik_baru" id="nik_baru" placeholder="NIK">
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_keluarga" class="col-sm-3 col-form-label">Nama Lengkap</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_keluarga" id="nama_keluarga" placeholder="Nama Lengkap">
							</div>
						</div>
						<div class="form-group row">
							<label for="ttl" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
							<div class="col">
								<input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
							</div>
							<div class="col">
								<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="form-group row">
							<label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
							<div class="col-sm-9">
								<select class="form-control" name="pendidikan" id="pendidikan" required>
									<option value="">Belum ada pilihan</option>
									<option value="Belum Sekolah">Belum Sekolah</option>
									<option value="SD">SD</option>
									<option value="SMP">SMP</option>
									<option value="SLTP">SLTP</option>
									<option value="SLTA">SLTA</option>
									<option value="D3">D3</option>
									<option value="S1">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan">
							</div>
						</div>
						<div class="form-group row">
							<label for="hubungan" class="col-sm-3 col-form-label">Hubungan</label>
							<div class="col-sm-9">
								<select class="form-control" name="hubungan" id="hubungan" required>
									<option value="">Belum ada pilihan</option>
									<option value="Suami">Suami</option>
									<option value="Istri">Istri</option>
									<option value="Ayah">Ayah</option>
									<option value="Ibu">Ibu</option>
									<option value="Anak">Anak</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
