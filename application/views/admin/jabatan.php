<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-red"></i> Data Jabatan Pegawai</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_jabatan()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="jabatan" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-danger">
									<th>No</th>
									<th>Pegawai</th>
									<th>Jabatan</th>
									<th>Jenis</th>
									<th>Eselon</th>
									<th>TMT</th>
									<th>TST</th>
									<th>Status</th>
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
		table = $("#jabatan").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Jabatan Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('jabatan/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"render": function(data, type, row) {

					return "<a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_jabatan('" + row[8] + "')\"><i class=\"fas fa-edit\"></i></a> <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delete_jabatan('" + row[8] + "')\"><i class=\"fas fa-trash\"></i></a>";

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
	function delete_jabatan(id_jabatan) {

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
					url: "<?php echo site_url('jabatan/delete'); ?>",
					type: "POST",
					data: "id_jabatan=" + id_jabatan,
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



	function add_jabatan() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah jabatan'); // Set Title to Bootstrap modal title
	}

	function edit_jabatan(id_jabatan) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('jabatan/edit_jabatan') ?>/" + id_jabatan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="nip"]').val(data.nip);
				$('[name="id_jabatan"]').val(data.id_jabatan);
				$('[name="nama_jabatan"]').val(data.nama_jabatan);
				$('[name="jenis_jabatan"]').val(data.jenis_jabatan);
				$('[name="eselon"]').val(data.eselon);
				$('[name="tmt"]').val(data.tmt);
				$('[name="sampai_tgl"]').val(data.sampai_tgl);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Jabatan'); // Set title to Bootstrap modal title

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
			url = "<?php echo site_url('jabatan/insert') ?>";
		} else {
			url = "<?php echo site_url('jabatan/update') ?>";
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
if (isset($_GET['id_jabatan'])) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			edit_jabatan('<?= $_GET['id_jabatan']; ?>');
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
					<input type="hidden" name="id_jabatan" />
					<div class="card-body">
						<div class="form-group row">
							<label for="nip" class="col-sm-3 col-form-label">Pilih Pegawai</label>
							<div class="col-sm-9">
								<select class="form-control" name="nip" id="nip"  autofocus>
									<option value="">Belum ada pilihan</option>
									<?php
									foreach ($data_pegawai as $pegawai) : ?>
										<option value="<?= $pegawai->nip ?>"><?= $pegawai->nama_pegawai ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_jabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" required >
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis_jabatan" class="col-sm-3 col-form-label">Jenis Jabatan</label>
							<div class="col-sm-9">
							<select class="form-control" name="jenis_jabatan" id="jenis_jabatan" autofocus>
									<option value="">Belum ada pilihan</option>
									<option value="Fungsional Umum/ Pelaksana">Fungsional Umum/ Pelaksana</option>
									<option value="Fungsional Tertentu">Fungsional Tertentu</option>
									<option value="Struktural">Struktural</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="eselon" class="col-sm-3 col-form-label">Eselon</label>
							<div class="col-sm-9">
								<select class="form-control" name="eselon" id="eselon" autofocus>
									<option value="">Belum ada pilihan</option>
									<option value="I a">I a</option>
									<option value="I b">I b</option>
									<option value="II a">II a</option>
									<option value="II b">II b</option>
									<option value="III a">III a</option>
									<option value="III b">III b</option>
									<option value="IV a">IV a</option>
									<option value="IV b">IV b</option>
								</select>

							</div>
						</div>
						<div class="form-group row">
							<label for="tmt" class="col-sm-3 col-form-label">TMT</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="tmt" placeholder="Tmt" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="sampai_tgl" class="col-sm-3 col-form-label">TST</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="sampai_tgl" placeholder="TST" required>
							</div>
						</div>
						

						<!-- disini tanda tempat form -->


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
