<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPegawai extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_pegawai'));
	}

	public function index()
	{
		$data['pegawai'] = $this->Mod_pegawai->get_pegawai($this->session->userdata('username'));
		$data['data_keluarga'] = $this->Mod_pegawai->get_keluarga($this->session->userdata('username'));
		$data['data_pendidikan'] = $this->Mod_pegawai->get_pendidikan($this->session->userdata('username'));
		$data['data_jabatan'] = $this->Mod_pegawai->get_jabatan($this->session->userdata('username'));
		$data['data_pangkat'] = $this->Mod_pegawai->get_pangkat($this->session->userdata('username'));
		$data['data_kgb'] = $this->Mod_pegawai->get_kgb($this->session->userdata('username'));

		$this->load->helper('url');
		$this->template->load('layoutbackend', 'admin/detailpegawai', $data);
		// $this->load->view('detailpegawai', $data);
	}
}
