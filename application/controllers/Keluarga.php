<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_keluarga'));
	}

	public function index()
	{
		$data['data_pegawai'] = $this->Mod_keluarga->get_pegawai();
		$this->load->helper('url');
		$this->template->load('layoutbackend', 'admin/keluarga', $data);
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_keluarga->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pel) {
			$tampil_gelar_dpn = strlen($pel->gelar_dpn) > 0 ? $pel->gelar_dpn . '. ' : '';
			$tampil_gelar_blkg = strlen($pel->gelar_blkg) > 0 ? ', ' . $pel->gelar_blkg : '';
			
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $pel->nik;
			$row[] = $tampil_gelar_dpn . $pel->nama_pegawai . $tampil_gelar_blkg;
			$row[] = $pel->nama_keluarga;
			$row[] = $pel->tempat_lahir.", ".$pel->tanggal_lahir;
			$row[] = $pel->pendidikan;
			$row[] = $pel->pekerjaan;
			$row[] = $pel->hubungan;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_keluarga->count_all(),
			"recordsFiltered" => $this->Mod_keluarga->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function edit_keluarga($nik)
	{
		$data = $this->Mod_keluarga->get_keluarga($nik);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->_validate();
		$save  = array(
			'nik' 			=> $this->input->post('nik_baru'),
			'nip' 			=> $this->input->post('nip'),
			'nama_keluarga'	=> $this->input->post('nama_keluarga'),
			'tempat_lahir'	=> $this->input->post('tempat_lahir'),
			'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
			'pendidikan'	=> $this->input->post('pendidikan'),
			'pekerjaan'		=> $this->input->post('pekerjaan'),
			'hubungan'		=> $this->input->post('hubungan')
		);
		$this->Mod_keluarga->insert_keluarga("keluarga", $save);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate();
		$nik      = $this->input->post('nik');
		$save  = array(
			'nik' 			=> $this->input->post('nik_baru'),
			'nip' 			=> $this->input->post('nip'),
			'nama_keluarga'	=> $this->input->post('nama_keluarga'),
			'tempat_lahir'	=> $this->input->post('tempat_lahir'),
			'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
			'pendidikan'	=> $this->input->post('pendidikan'),
			'pekerjaan'		=> $this->input->post('pekerjaan'),
			'hubungan'		=> $this->input->post('hubungan')
			
		);
		$this->Mod_keluarga->update_keluarga($nik, $save);
		echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$nik = $this->input->post('nik');
		$this->Mod_keluarga->delete_keluarga($nik, 'keluarga');
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nik_baru') == '') {
			$data['inputerror'][] = 'nik';
			$data['error_string'][] = 'NIK Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('nip') == '') {
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('nama_keluarga') == '') {
			$data['inputerror'][] = 'nama_keluarga';
			$data['error_string'][] = 'Nama Keluarga Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('tempat_lahir') == '') {
			$data['inputerror'][] = 'tempat_lahir';
			$data['error_string'][] = 'Tempat Lahir Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('tanggal_lahir') == '') {
			$data['inputerror'][] = 'tanggal_lahir';
			$data['error_string'][] = 'Tanggal Lahir Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('pendidikan') == '') {
			$data['inputerror'][] = 'pendidikan';
			$data['error_string'][] = 'Pendidikan Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('pekerjaan') == '') {
			$data['inputerror'][] = 'pekerjaan';
			$data['error_string'][] = 'Pekerjaan Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}
		if ($this->input->post('hubungan') == '') {
			$data['inputerror'][] = 'hubungan';
			$data['error_string'][] = 'Hubungan Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
