<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detailpegawai extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mod_detailpegawai'));
	}

	public function index()
	{
		$this->load->helper('url');
		$this->template->load('layoutbackend', 'detailpegawai');
	}

	public function detail($nip){
 
		$this->load->model('Mod_detailpegawai');
 
		$detail = $this->tampil_m->get_detail($nip);
		$data['detail'] = $detail;
		$this->load->view('page/detail', $data);
 
	}
}
