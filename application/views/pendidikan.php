<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-red"></i> Data Pendidikan Pegawai</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_pendidikan()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="pendidikan" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-danger">
									<th>No</th>
									<th>Pegawai</th>
									<th>Tingkat</th>
									<th>Nama Sekolah/ Kampus</th>
									<th>Lokasi</th>
									<th>Program Keahlian</th>
									<th>Tanggal Ijazah</th>
									<th>Nomor Ijazah</th>
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
		table = $("#pendidikan").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Pendidikan Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('pendidikan/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"render": function(data, type, row) {

					return "<a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_pendidikan('" + row[8] + "')\"><i class=\"fas fa-edit\"></i></a> <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delete_pendidikan('" + row[8] + "')\"><i class=\"fas fa-trash\"></i></a>";

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
	function delete_pendidikan(id_pendidikan) {

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
					url: "<?php echo site_url('pendidikan/delete'); ?>",
					type: "POST",
					data: "id_pendidikan=" + id_pendidikan,
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



	function add_pendidikan() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah pendidikan'); // Set Title to Bootstrap modal title
	}

	function edit_pendidikan(id_pendidikan) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pendidikan/edit_pendidikan') ?>/" + id_pendidikan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="nip"]').val(data.nip);
				$('[name="id_pendidikan"]').val(data.id_pendidikan);
				$('[name="tingkat"]').val(data.tingkat);
				$('[name="nama_sekolah"]').val(data.nama_sekolah);
				$('[name="lokasi"]').val(data.lokasi);
				$('[name="jurusan"]').val(data.jurusan);
				$('[name="tgl_ijazah"]').val(data.tgl_ijazah);
				$('[name="no_ijazah"]').val(data.no_ijazah);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit pendidikan'); // Set title to Bootstrap modal title
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
			url = "<?php echo site_url('pendidikan/insert') ?>";
		} else {
			url = "<?php echo site_url('pendidikan/update') ?>";
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
if (isset($_GET['id_pendidikan'])) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			edit_pendidikan('<?= $_GET['id_pendidikan']; ?>');
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
					<input type="hidden" name="id_pendidikan" />
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
							<label for="tingkat" class="col-sm-3 col-form-label">Tingkat</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="tingkat" id="tingkat" placeholder="Tingkat" required >
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_sekolah" class="col-sm-3 col-form-label">Nama Sekolah/Universitas</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah/Universitas" required >
							</div>
						</div>
						<div class="form-group row">
							<label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" required >
							</div>
						</div>
						<div class="form-group row">
							<label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan" required >
							</div>
						</div>
						<div class="form-group row">
							<label for="tgl_ijazah" class="col-sm-3 col-form-label">Tanggal Ijazah</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="tgl_ijazah" placeholder="Tanggal Ijazah" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="no_ijazah" class="col-sm-3 col-form-label">No. Ijazah</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="no_ijazah" id="no_ijazah" placeholder="No Ijazah" required >
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
