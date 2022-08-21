<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-red"></i> Data Pangkat Pegawai</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-danger" onclick="add_pangkat()" title="Add Data"><i class="fas fa-plus"></i> Tambah</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="pangkat" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-danger">
									<th>No</th>
									<th>Pegawai</th>
									<th>Pangkat / Golongan</th>
									<th>Nama Pengesah SK</th>
									<th>No SK</th>
									<th>Gaji Pokok</th>
									<th>Status Pangkat</th>
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
		table = $("#pangkat").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Pangkat Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('pangkat/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
					"targets": [-1], //last column
					"render": function(data, type, row) {

						return "<a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_pangkat('" + row[7] + "')\"><i class=\"fas fa-edit\"></i></a> <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delete_pangkat('" + row[7] + "')\"><i class=\"fas fa-trash\"></i></a>";

					},

					"orderable": false, //set not orderable
				},
				{
					"targets": [-2], //last column
					"render": function(data, type, row) {

						if (row[6] == 'aktif') {
							var slide = 'btn-danger'
						} else {
							var slide = 'btn-success'
						};
						if (row[6] == 'aktif') {
							var text = 'Non Aktifkan'
						} else {
							var text = 'Aktifkan'
						};
						return "<a href=\"javascript:void(0)\" class=\"status_checks" + row[0] + " btn btn-xs " + slide + "\" onclick=\"set_pangkats('" + row[6] + "','" + row[7] + "')\">" + text + "</a>"

					},

					"orderable": false, //set not orderable
				}
			]
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
	function delete_pangkat(id_pangkat) {

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
					url: "<?php echo site_url('pangkat/delete'); ?>",
					type: "POST",
					data: "id_pangkat=" + id_pangkat,
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



	function add_pangkat() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Tambah Pangkat'); // Set Title to Bootstrap modal title
	}

	function set_pangkats(stat, id_pangkat) {
		var id = id_pangkat;
		var status = (stat == 'tidak aktif') ? 'aktif' : 'tidak aktif';
		var msg = (status == 'aktif') ? 'aktif' : 'tidak aktif'; 
		if (confirm("Are you sure to " + msg)){
			url = "<?php echo site_url('pegawai/set_pangkat'); ?>";
			$.ajax({
				type: "POST",
				url: url,
				data: {
					"id_pangkat": id,
					"status_pangkat": status
				},
				success: function(data) {
					// if you want reload the page
					location.reload();
				}

			});
		}

	}

	function edit_pangkat(id_pangkat) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pangkat/edit_pangkat') ?>/" + id_pangkat,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="nip"]').val(data.nip);
				$('[name="id_pangkat"]').val(data.id_pangkat);
				$('[name="nama_pangkat"]').val(data.nama_pangkat);
				$('[name="jenis_pangkat"]').val(data.jenis_pangkat);
				$('[name="tmt_pangkat"]').val(data.tmt_pangkat);
				$('[name="sah_sk"]').val(data.sah_sk);
				$('[name="nama_pengesah_sk"]').val(data.nama_pengesah_sk);
				$('[name="no_sk"]').val(data.no_sk);
				$('[name="gapok"]').val(data.gapok);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Pangkat'); // Set title to Bootstrap modal title

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
			url = "<?php echo site_url('pangkat/insert') ?>";
		} else {
			url = "<?php echo site_url('pangkat/update') ?>";
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
if (isset($_GET['id_pangkat'])) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			edit_pangkat('<?= $_GET['id_pangkat']; ?>');
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
					<input type="hidden" name="id_pangkat" />
					<div class="card-body">
						<div class="form-group row">
							<label for="nip" class="col-sm-3 col-form-label">Pilih Pegawai</label>
							<div class="col-sm-9">
								<select class="form-control" name="nip" id="nip" autofocus>
									<option value="">Belum ada pilihan</option>
									<?php
									foreach ($data_pegawai as $pegawai) : ?>
										<option value="<?= $pegawai->nip ?>"><?= $pegawai->nama_pegawai ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Nama Pangkat</label>
							<div class="col-sm-5">
								<select class="form-control" name="nama_pangkat" id="nama_pangkat" autofocus>
									<option value="">Belum ada pilihan</option>
									<?php
									foreach ($ref_pangkat as $r_pangkat) : ?>
										<option value="<?= $r_pangkat->pangkat_nama ?>"><?= $r_pangkat->pangkat_nama ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" name="jenis_pangkat" id="jenis_pangkat" autofocus>
									<option value="">Belum ada pilihan</option>
									<?php
									foreach ($ref_pangkat as $r_pangkat) : ?>
										<option value="<?= $r_pangkat->pangkat_ruang ?>"><?= $r_pangkat->pangkat_ruang ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tmt_pangkat" class="col-sm-3 col-form-label">TMT</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="tmt_pangkat" placeholder="TMT" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="sah_sk" class="col-sm-3 col-form-label">Tanggal SK</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="sah_sk" placeholder="Tanggal" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="no_sk" class="col-sm-3 col-form-label">Nomor SK</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="no_sk" id="no_sk" placeholder="Nomor SK" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_pengesah_sk" class="col-sm-3 col-form-label">Pejabat Penandatangan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama_pengesah_sk" id="nama_pengesah_sk" placeholder="Pejabat Penandatangan" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="gapok" class="col-sm-3 col-form-label">Gaji Pokok</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="gapok" id="gapok" placeholder="Gaji Pokok" required>
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
