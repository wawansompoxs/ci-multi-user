<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_jabatan'));
	}

	public function index()
	{
		$data['data_pegawai'] = $this->Mod_jabatan->get_pegawai();
		// function ini hanya boleh diakses oleh admin 
		if ($this->session->userdata('id_level') == '1') {
			$this->load->helper('url');
			$this->template->load('layoutbackend', 'admin/jabatan', $data);
		} else {
			$this->template->load('error_404');
		}
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_jabatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pel) {
			$tampil_gelar_dpn = strlen($pel->gelar_dpn) > 0 ? $pel->gelar_dpn . '. ' : '';
			$tampil_gelar_blkg = strlen($pel->gelar_blkg) > 0 ? ', ' . $pel->gelar_blkg : '';
			
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $tampil_gelar_dpn . $pel->nama_pegawai . $tampil_gelar_blkg;
			$row[] = $pel->nama_jabatan;
			$row[] = $pel->jenis_jabatan;
			$row[] = $pel->eselon;
			$row[] = $pel->tmt;
			$row[] = $pel->sampai_tgl;
			$row[] = $pel->status_jabatan;
			$row[] = $pel->id_jabatan;
			$row[] = $pel->nip;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_jabatan->count_all(),
			"recordsFiltered" => $this->Mod_jabatan->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function edit_jabatan($id_jabatan)
	{
		$data = $this->Mod_jabatan->get_jabatan($id_jabatan);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->_validate();
		$save  = array(
			'nip' 			=> $this->input->post('nip'),
			'nama_jabatan'	=> $this->input->post('nama_jabatan'),
			'jenis_jabatan'	=> $this->input->post('jenis_jabatan'),
			'eselon'		=> $this->input->post('eselon'),
			'tmt'			=> $this->input->post('tmt'),
			'sampai_tgl'	=> $this->input->post('sampai_tgl')
		);
		$this->Mod_jabatan->insert_jabatan("jabatan", $save);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate();
		$id_jabatan      = $this->input->post('id_jabatan');
		$save  = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'nip' 			=> $this->input->post('nip'),
			'nama_jabatan'	=> $this->input->post('nama_jabatan'),
			'jenis_jabatan'	=> $this->input->post('jenis_jabatan'),
			'eselon'		=> $this->input->post('eselon'),
			'tmt'			=> $this->input->post('tmt'),
			'sampai_tgl'	=> $this->input->post('sampai_tgl')
			
		);
		$this->Mod_jabatan->update_jabatan($id_jabatan, $save);
		echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$id_jabatan = $this->input->post('id_jabatan');
		$this->Mod_jabatan->delete_jabatan($id_jabatan, 'jabatan');
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
