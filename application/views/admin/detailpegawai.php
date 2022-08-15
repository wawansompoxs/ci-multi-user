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
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
										<tbody>
											<?php
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
											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('keluarga') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Keluarga</a>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-pendidikan" role="tabpanel">

								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
														<a href="<?= base_url('detail_pegawai/edit_pendidikan') ?>?id=<?= $pendidikan->id_pendidikan ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Nama Jabatan</th>
												<th>Eselon</th>
												<th>TMT</th>
												<th>Sampai Tanggal</th>
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
													<td><?= ucwords($jabatan->eselon) ?></td>
													<td><?= date('d-m-Y', strtotime($jabatan->tmt)) ?></td>
													<td><?= date('d-m-Y', strtotime($jabatan->sampai_tgl)) ?></td>
													<td><?= ucwords($jabatan->status_jabatan) ?></td>
													<td>
														<a href="<?= base_url('detail_pegawai/edit_jabatan') ?>?id=<?= $jabatan->id_jabatan ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
														<a href="<?= base_url('_config/proses_jabatan') ?>?set&id=<?= $jabatan->id_jabatan ?>&nip=<?= $pegawai->nip ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Setup</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<a href="<?= base_url('jabatan') ?>?nip=<?= $pegawai->nip ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Jabatan</a>
								</div>

							</div>
							<div class="tab-pane fade" id="nav-pangkat" role="tabpanel">

								<?php
								// fungsi buatRupiah
								function buatRupiah($angka)
								{
									$hasil = "Rp " . number_format($angka, 0, ',', '.');
									return $hasil;
								}

								?>
								<div class="table-responsive mt-3">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
													<td><?= buatRupiah(ucwords($pangkat->gapok)) ?></td>
													<td><?= ucwords($pangkat->status_pangkat) ?></td>
													<td>
														<a href="<?= base_url('detail_pegawai/edit_pangkat') ?>?id=<?= $pangkat->id_pangkat ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
														<a href="<?= base_url('_config/proses_pangkat') ?>?set&id=<?= $pangkat->id_pangkat ?>&nip=<?= $pegawai->nip ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Setup</a>
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
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
													<td><?= buatRupiah(ucwords($kgb->gapok)) ?></td>
													<td><?= ucwords($kgb->mk_thn_kgb) ?> Tahun <?= ucwords($kgb->mk_bln_kgb) ?> Bulan</td>
													<td><?= ucwords($kgb->status_kgb) ?></td>
													<td>
														<a href="<?= base_url('detail_pegawai/edit_kgb') ?>?id=<?= $kgb->id_kgb ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
