<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-red"></i> Data Pegawai</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_pegawai()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tbl_pegawai" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-danger">
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>Kontak</th>
									<th>Status Kepegawaian</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
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


<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {

		//datatables
		table = $("#tbl_pegawai").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Pegawai Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('pegawai/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"render": function(data, type, row) {

					return "<a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_pegawai('" + row[4] + "')\"><i class=\"fas fa-edit\"></i></a> <a class=\"btn btn-xs btn-outline-success\" href=\"pegawai/detail/"+ row[4] + "\" title=\"Detail\" nama=\"" + row[1] + "\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"Print\" onclick=\"edit_pegawai(" + row[4] + ")\"><i class=\"fas fa-print\"></i></a>";

				},

				"orderable": false, //set not orderable
			}]
		});

		//set input/textarea/select event when change value, remove class error and remove text help block 
		$("input").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
			$(this).removeClass('is-invalid');
		});
		$("textarea").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
			$(this).removeClass('is-invalid');
		});
		$("select").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
			$(this).removeClass('is-invalid');
		});

	});

	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax 
	}

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});


	//delete
	function delete_pegawai(nip) {

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {

			$.ajax({
				url: "<?php echo site_url('pegawai/delete'); ?>",
				type: "POST",
				data: "nip='" + nip +"'",
				cache: false,
				dataType: 'json',
				success: function(respone) {
					if (respone.status == true) {
						reload_table();
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						);
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Delete Error!!.'
						});
					}
				}
			});
		})
	}



	function add_pegawai() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah Pegawai'); // Set Title to Bootstrap modal title
	}

	function edit_pegawai(nip) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pegawai/edit_pegawai') ?>/" + nip,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="nip"]').val(data.nip);
				$('[name="nama_pegawai"]').val(data.nama_pegawai);
				$('[name="tempat_lahir"]').val(data.tempat_lahir);
				$('[name="tanggal_lahir"]').val(data.tanggal_lahir);
				$('[name="jenis_kelamin"]:checked').val(data.jenis_kelamin);
				$('[name="no_hp"]').val(data.no_hp);
				$('[name="agama"]').val(data.agama);
				$('[name="email"]').val(data.email);
				$('[name="alamat"]').val(data.alamat);
				$('[name="gol_darah"]:checked').val(data.gol_darah);
				$('[name="status_pernikahan"]').val(data.status_pernikahan);
				$('[name="status_kepegawaian"]').val(data.status_kepegawaian);
				$('[name="gelar_dpn"]').val(data.gelar_dpn);
				$('[name="gelar_blkg"]').val(data.gelar_blkg);
				$('[name="nik"]').val(data.nik);
				$('[name="npwp"]').val(data.npwp);
				$('[name="bpjs"]').val(data.bpjs);
				$('[name="karpeg"]').val(data.karpeg);
				$('[name="sk_cpns"]').val(data.sk_cpns);
				$('[name="tmt_cpns"]').val(data.tmt_cpns);
				$('[name="sk_pns"]').val(data.sk_pns);
				$('[name="tmt_pns"]').val(data.tmt_pns);
				$('[name="mk_thn"]').val(data.mk_thn);
				$('[name="mk_bln"]').val(data.mk_bln);
				$('[name="gol_awal"]').val(data.gol_awal);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Pegawai'); // Set title to Bootstrap modal title

				data.jenis_kelamin == 'Laki-laki' ? $('#jenis_kelamin1').prop('checked', true) : '';
				data.jenis_kelamin == 'Perempuan' ? $('#jenis_kelamin2').prop('checked', true) : '';
				data.gol_darah == 'A' ? $('#goldarah1').prop('checked', true) : '';
				data.gol_darah == 'B' ? $('#goldarah2').prop('checked', true) : '';
				data.gol_darah == 'AB' ? $('#goldarah3').prop('checked', true) : '';
				data.gol_darah == 'O' ? $('#goldarah4').prop('checked', true) : '';

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		if (save_method == 'add') {
			url = "<?php echo site_url('pegawai/insert') ?>";
		} else {
			url = "<?php echo site_url('pegawai/update') ?>";
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
					reload_table();
					Toast.fire({
						icon: 'success',
						title: 'Success!!.'
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
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 

			}
		});
	}

</script>



<!-- Bootstrap modal -->
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
				<form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id" />
					<div class="card-body">
						<div class="form-group row ">
							<label for="nip" class="col-sm-3 col-form-label">NIP</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" autocomplete="off" required autofocus>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
							<div class="col">
								<input type="text" class="form-control" name="gelar_dpn" placeholder="Gelar Depan" autocomplete="off">
							</div>
							<div class="col">
								<input type="text" class="form-control" name="gelar_blkg" placeholder="Gelar Belakang" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="ttl" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
							<div class="col">
								<input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required autocomplete="off">
							</div>
							<div class="col">
								<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" data-date-format="yyyy/mm/dd" required>
							</div>
						</div>
						<div class="form-group row">
							
								<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
								<div class="col-sm-9">
									<div class="form-check d-inline">
										<input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki">
											Laki-laki
									</div>
									<div class="form-check d-inline">
										<input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan">
											Perempuan
									</div>
								</div>
							
						</div>
						<div class="form-group row">
							<label for="agama" class="col-sm-3 col-form-label">Agama</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="agama" id="agama" placeholder="Agama" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="nik" class="col-sm-3 col-form-label">NIK</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="no_hp" class="col-sm-3 col-form-label">Nomor Handphone</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Handphone" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							
							<label for="gol_darah" class="col-sm-3 col-form-label">Golongan Darah</label>
								<div class="col-sm-9">
									<div class="form-check d-inline mr-3">
										<input class="form-check-input" type="radio" name="gol_darah" id="goldarah1" value="A">
											A
									</div>
									<div class="form-check d-inline mr-3">
										<input class="form-check-input" type="radio" name="gol_darah" id="goldarah2" value="B">
											B
									</div>
									<div class="form-check d-inline mr-3">
										<input class="form-check-input" type="radio" name="gol_darah" id="goldarah3" value="AB">
											AB
									</div>
									<div class="form-check d-inline mr-3">
										<input class="form-check-input" type="radio" name="gol_darah" id="goldarah4" value="O">
											O
									</div>
								</div>
							
						</div>
						<div class="form-group row">
							<label for="status_pernikahan" class="col-sm-3 col-form-label">Status Pernikahan</label>
							<div class="col-sm-9">
								<select class="form-control" name="status_pernikahan" id="status_pernikahan" required autocomplete="off">
									<option value="lajang">Lajang</option>
									<option value="kawin">Menikah</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
							<div class="col-sm-9">
								<textarea name="alamat" class="form-control" id="alamat" cols="10" rows="3" placeholder="Alamat Lengkap" required autocomplete="off"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="npwp" id="npwp" placeholder="No NPWP" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="bpjs" class="col-sm-3 col-form-label">BPJS</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="bpjs" id="bpjs" placeholder="No BPJS" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="status_kepegawaian" class="col-sm-3 col-form-label">Status Kepegawaian</label>
							<div class="col-sm-9">
								<select class="form-control" name="status_kepegawaian" id="status_kepegawaian" required autocomplete="off">
									<option value="CPNS">CPNS</option>
									<option value="PNS">PNS</option>
									<option value="PPPK">PPPK</option>
									<option value="Honor">Honor</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="karpeg" class="col-sm-3 col-form-label">Karpeg</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="karpeg" id="karpeg" placeholder="No Karpeg" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="cpns" class="col-sm-3 col-form-label">No. SK & TMT CPNS</label>
							<div class="col">
								<input type="text" class="form-control" name="sk_cpns" placeholder="No SK CPNS" autocomplete="off">
							</div>
							<div class="col">
								<input type="date" class="form-control" name="tmt_cpns" placeholder="Tanggal SK CPNS">
							</div>
						</div>
						<div class="form-group row">
							<label for="pns" class="col-sm-3 col-form-label">No. SK & TMT PNS</label>
							<div class="col">
								<input type="text" class="form-control" name="sk_pns" placeholder="No SK PNS" autocomplete="off">
							</div>
							<div class="col">
								<input type="date" class="form-control" name="tmt_pns" placeholder="Tanggal SK PNS">
							</div>
						</div>
						<div class="form-group row">
							<label for="mk" class="col-sm-3 col-form-label">Masa Kerja CPNS</label>
							<div class="col">
								<input type="text" class="form-control" name="mk_thn" placeholder="MK Tahun" autocomplete="off">
							</div>
							<div class="col">
								<input type="text" class="form-control" name="mk_bln" placeholder="MK Bulan" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="gol_awal" class="col-sm-3 col-form-label">Gol. Awal</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="gol_awal" id="gol_awal" placeholder="Golongan Awal" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="nip" class="col-sm-3 col-form-label">Pas Photo</label>
							<div class="col-sm-9">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="foto" required>
									<label class="custom-file-label" for="customFile">Tentukan file</label>
								</div>
								<span class="text-info">* Maksimal Ukuran File 1 MB</span>
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
