<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Pegawai extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_pegawai'));
	}

	public function index()
	{
		// function ini hanya boleh diakses oleh admin 
		if ($this->session->userdata('id_level') == '1') {
			$this->load->helper('url');
			$this->template->load('layoutbackend', 'admin/pegawai');
		} else {
			$this->template->load('error_404');
		}
	}


	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_pegawai->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pel) {
			$tampil_gelar_dpn = strlen($pel->gelar_dpn) > 0 ? $pel->gelar_dpn . '. ' : '';
			$tampil_gelar_blkg = strlen($pel->gelar_blkg) > 0 ? ', ' . $pel->gelar_blkg : '';
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $tampil_gelar_dpn . $pel->nama_pegawai . $tampil_gelar_blkg . '<br />NIP. ' . $pel->nip;
			$row[] = 'No HP: ' . $pel->no_hp . '<br />Email: ' . $pel->email;
			$row[] = $pel->status_kepegawaian;
			$row[] = $pel->nip;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_pegawai->count_all(),
			"recordsFiltered" => $this->Mod_pegawai->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function insert()
	{
		$this->_validate();
		$kode = date('ymsi');
		$save  = array(
			'kdbarang'  	=> $kode,
			'nama'			=> $this->input->post('nama'),
			'harga'  		=> $this->input->post('harga'),
			'satuan'   		=> $this->input->post('satuan')
		);
		$this->Mod_pegawai->insert_pegawai("tbl_pegawai", $save);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate();
		$nip      = $this->input->post('nip');
		$save  = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'no_hp' => $this->input->post('no_hp'),
			'agama' => $this->input->post('agama'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'gol_darah' => $this->input->post('gol_darah'),
			'status_pernikahan' => $this->input->post('status_pernikahan'),
			'status_kepegawaian' => $this->input->post('status_kepegawaian'),
			'gelar_dpn' => $this->input->post('gelar_dpn'),
			'gelar_blkg' => $this->input->post('gelar_blkg'),
			'nik' => $this->input->post('nik'),
			'npwp' => $this->input->post('npwp'),
			'bpjs' => $this->input->post('bpjs'),
			'karpeg' => $this->input->post('karpeg'),
			'sk_cpns' => $this->input->post('sk_cpns'),
			'tmt_cpns' => $this->input->post('tmt_cpns'),
			'sk_pns' => $this->input->post('sk_pns'),
			'tmt_pns' => $this->input->post('tmt_pns'),
			'mk_thn' => $this->input->post('mk_thn'),
			'mk_bln' => $this->input->post('mk_bln'),
			'gol_awal' => $this->input->post('gol_awal')
		);
		$this->Mod_pegawai->update_pegawai($nip, $save);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_pegawai($nip)
	{
		$data = $this->Mod_pegawai->get_pegawai($nip);
		echo json_encode($data);
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->Mod_barang->delete_brg($id, 'barang');
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_pegawai') == '') {
			$data['inputerror'][] = 'nama_pegawai';
			$data['error_string'][] = 'Nama Pegawai Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	public function detail($nip)
	{
		$data['pegawai'] = $this->Mod_pegawai->get_pegawai($nip);
		$data['data_keluarga'] = $this->Mod_pegawai->get_keluarga($nip);
		$data['data_pendidikan'] = $this->Mod_pegawai->get_pendidikan($nip);
		$data['data_jabatan'] = $this->Mod_pegawai->get_jabatan($nip);
		$data['data_pangkat'] = $this->Mod_pegawai->get_pangkat($nip);
		$data['data_kgb'] = $this->Mod_pegawai->get_kgb($nip);

		$this->load->helper('url');
		$this->template->load('layoutbackend', 'admin/detailpegawai', $data);
		// $this->load->view('detailpegawai', $data);
	}
}
