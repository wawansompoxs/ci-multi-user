<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_pendidikan'));
	}

	public function index()
	{
		$data['data_pegawai'] = $this->Mod_pendidikan->get_pegawai();
		// function ini hanya boleh diakses oleh admin 
		if ($this->session->userdata('id_level') == '1') {
			$this->load->helper('url');
			$this->template->load('layoutbackend', 'admin/pendidikan', $data);
		} else {
			$this->template->load('error_404');
		}
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_pendidikan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pel) {
			$tampil_gelar_dpn = strlen($pel->gelar_dpn) > 0 ? $pel->gelar_dpn . '. ' : '';
			$tampil_gelar_blkg = strlen($pel->gelar_blkg) > 0 ? ', ' . $pel->gelar_blkg : '';
			
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $tampil_gelar_dpn . $pel->nama_pegawai . $tampil_gelar_blkg;
			$row[] = $pel->tingkat;
			$row[] = $pel->nama_sekolah;
			$row[] = $pel->lokasi;
			$row[] = $pel->jurusan;
			$row[] = $pel->tgl_ijazah;
			$row[] = $pel->no_ijazah;
			$row[] = $pel->id_pendidikan;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_pendidikan->count_all(),
			"recordsFiltered" => $this->Mod_pendidikan->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function edit_pendidikan($id_pendidikan)
	{
		$data = $this->Mod_pendidikan->get_pendidikan($id_pendidikan);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->_validate();
		$save  = array(
			'nip' 			=> $this->input->post('nip'),
			'tingkat'		=> $this->input->post('tingkat'),
			'nama_sekolah'	=> $this->input->post('nama_sekolah'),
			'lokasi'		=> $this->input->post('lokasi'),
			'jurusan'		=> $this->input->post('jurusan'),
			'tgl_ijazah'	=> $this->input->post('tgl_ijazah'),
			'no_ijazah'		=> $this->input->post('no_ijazah')
		);
		$this->Mod_pendidikan->insert_pendidikan("pendidikan", $save);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate();
		$id_pendidikan      = $this->input->post('id_pendidikan');
		$save  = array(
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'nip' 			=> $this->input->post('nip'),
			'tingkat'		=> $this->input->post('tingkat'),
			'nama_sekolah'	=> $this->input->post('nama_sekolah'),
			'lokasi'		=> $this->input->post('lokasi'),
			'jurusan'		=> $this->input->post('jurusan'),
			'tgl_ijazah'	=> $this->input->post('tgl_ijazah'),
			'no_ijazah'		=> $this->input->post('no_ijazah')
			
		);
		$this->Mod_pendidikan->update_pendidikan($id_pendidikan, $save);
		echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$id_pendidikan = $this->input->post('id_pendidikan');
		$this->Mod_pendidikan->delete_pendidikan($id_pendidikan, 'pendidikan');
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
