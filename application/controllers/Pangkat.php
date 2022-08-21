<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkat extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_pangkat','Mod_referensi'));
	}

	public function index()
	{
		$data['data_pegawai'] = $this->Mod_pangkat->get_pegawai();
		$data['ref_pangkat'] = $this->Mod_referensi->ref_pangkat();
		$data['ref_gaji'] = $this->Mod_referensi->ref_gaji();
		// function ini hanya boleh diakses oleh admin 
		if ($this->session->userdata('id_level') == '1') {
			$this->load->helper('url');
			$this->template->load('layoutbackend', 'admin/pangkat', $data);
		} else {
			$this->template->load('error_404');
		}
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_pangkat->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pel) {
			$tampil_gelar_dpn = strlen($pel->gelar_dpn) > 0 ? $pel->gelar_dpn . '. ' : '';
			$tampil_gelar_blkg = strlen($pel->gelar_blkg) > 0 ? ', ' . $pel->gelar_blkg : '';
			
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $tampil_gelar_dpn . $pel->nama_pegawai . $tampil_gelar_blkg;
			$row[] = $pel->nama_pangkat.' - '.$pel->jenis_pangkat.'<br /> TMT : '.$pel->tmt_pangkat;
			$row[] = $pel->nama_pengesah_sk;
			$row[] = $pel->no_sk.'<br /> Tanggal : '.$pel->sah_sk;
			$row[] = rupiah($pel->gapok);
			$row[] = $pel->status_pangkat;
			$row[] = $pel->id_pangkat;
			$row[] = $pel->nip;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_pangkat->count_all(),
			"recordsFiltered" => $this->Mod_pangkat->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function edit_pangkat($id_pangkat)
	{
		$data = $this->Mod_pangkat->get_pangkat($id_pangkat);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->_validate();
		$save  = array(
			'nip' 				=> $this->input->post('nip'),
			'nama_pangkat'		=> $this->input->post('nama_pangkat'),
			'jenis_pangkat'		=> $this->input->post('jenis_pangkat'),
			'tmt_pangkat'		=> $this->input->post('tmt_pangkat'),
			'sah_sk'			=> $this->input->post('sah_sk'),
			'nama_pengesah_sk'	=> $this->input->post('nama_pengesah_sk'),
			'no_sk'				=> $this->input->post('no_sk'),
			'gapok'				=> $this->input->post('gapok')
		);
		$this->Mod_pangkat->insert_pangkat("pangkat", $save);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate();
		$id_pangkat      = $this->input->post('id_pangkat');
		$save  = array(
			'id_pangkat' => $this->input->post('id_pangkat'),
			'nip' 				=> $this->input->post('nip'),
			'nama_pangkat'		=> $this->input->post('nama_pangkat'),
			'jenis_pangkat'		=> $this->input->post('jenis_pangkat'),
			'tmt_pangkat'		=> $this->input->post('tmt_pangkat'),
			'sah_sk'			=> $this->input->post('sah_sk'),
			'nama_pengesah_sk'	=> $this->input->post('nama_pengesah_sk'),
			'no_sk'				=> $this->input->post('no_sk'),
			'gapok'				=> $this->input->post('gapok')
			
		);
		$this->Mod_pangkat->update_pangkat($id_pangkat, $save);
		echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$id_pangkat = $this->input->post('id_pangkat');
		$this->Mod_pangkat->delete_pangkat($id_pangkat, 'pangkat');
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('gapok') == '') {
			$data['inputerror'][] = 'gapok';
			$data['error_string'][] = 'Gaji Pokok Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
