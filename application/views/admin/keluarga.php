<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-red"></i> Data Keluarga Pegawai</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_keluarga()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="keluarga" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-danger">
									<th>No</th>
									<th>NIK</th>
									<th>Pegawai</th>
									<th>Nama Keluarga</th>
									<th>Tempat, Tangal Lahir</th>
									<th>Pendidikan</th>
									<th>Pekerjaan</th>
									<th>Hubungan</th>
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
		table = $("#keluarga").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Keluarga Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('keluarga/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"render": function(data, type, row) {

					return "<a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_keluarga('" + row[1] + "')\"><i class=\"fas fa-edit\"></i></a> <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delete_keluarga('" + row[1] + "')\"><i class=\"fas fa-trash\"></i></a>";

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
	function delete_keluarga(nik) {

		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Anda tidak bisa mengembalikan data yang dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo site_url('keluarga/delete'); ?>",
					type: "POST",
					data: "nik=" + nik,
					cache: false,
					dataType: 'json',
					success: function(respone) {
						if (respone.status == true) {
							reload_table();
							Swal.fire(
								'Terhapus!',
								'Data telah dihapus.',
								'sukses'
							);
						} else {
							Toast.fire({
								icon: 'error',
								title: 'Delete Error!!.'
							});
						}
					}
				});
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal(
					'Dibatalkan',
					'Data berhasil dibatalkan :)',
					'error'
				)
			}


		})
	}



	function add_keluarga() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah keluarga'); // Set Title to Bootstrap modal title
	}

	function edit_keluarga(nik) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('keluarga/edit_keluarga') ?>/" + nik,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="nip"]').val(data.nip);
				$('[name="nama_pegawai"]').val(data.nama_pegawai);
				$('[name="nik"]').val(data.nik);
				$('[name="nik_baru"]').val(data.nik);
				$('[name="nama_keluarga"]').val(data.nama_keluarga);
				$('[name="tempat_lahir"]').val(data.tempat_lahir);
				$('[name="tanggal_lahir"]').val(data.tanggal_lahir);
				$('[name="pendidikan"]').val(data.pendidikan);
				$('[name="pekerjaan"]').val(data.pekerjaan);
				$('[name="hubungan"]').val(data.hubungan);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit keluarga'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error mengambil data ajax');
			}
		});
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
					reload_table();
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
<?php
if (isset($_GET['nik'])) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			edit_keluarga('<?= $_GET['nik']; ?>');
		});
	</script>
<?php
}
?>

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
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="nik" />
					<div class="card-body">
						<div class="form-group row">
							<label for="nip" class="col-sm-3 col-form-label">Pilih Pegawai</label>
							<div class="col-sm-9">
								<select class="form-control" name="nip" id="nip" autocomplete="off" autofocus>
									<option value="">Belum ada pilihan</option>
									<?php
									foreach ($data_pegawai as $pegawai) : ?>
										<option value="<?= $pegawai->nip ?>"><?= $pegawai->nama_pegawai ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="nik" class="col-sm-3 col-form-label">NIK</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nik_baru" id="nik_baru" placeholder="NIK" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_keluarga" class="col-sm-3 col-form-label">Nama Lengkap</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_keluarga" id="nama_keluarga" placeholder="Nama Lengkap" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="ttl" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
							<div class="col">
								<input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" autocomplete="off">
							</div>
							<div class="col">
								<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="form-group row">
							<label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
							<div class="col-sm-9">
								<select class="form-control" name="pendidikan" id="pendidikan" required autocomplete="off">
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
								<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="hubungan" class="col-sm-3 col-form-label">Hubungan</label>
							<div class="col-sm-9">
								<select class="form-control" name="hubungan" id="hubungan" required autocomplete="off">
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
