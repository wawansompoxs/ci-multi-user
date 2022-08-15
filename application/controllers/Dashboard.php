<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('fungsi');
		$this->load->library('user_agent');
		$this->load->helper('myfunction_helper');
		$this->load->model('Mod_dashboard');
		if ($this->session->userdata('id_level') == '2') {
		$this->load->model('Mod_pegawai');
		}
		// backButtonHandle();
	}

	function index()
	{
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in != TRUE || empty($logged_in)) {
			redirect('login');
		} else {
			$data['count_all'] = $this->Mod_dashboard->count_all();
			$data['count_pns'] = $this->Mod_dashboard->count_pns();
			$data['count_cpns'] = $this->Mod_dashboard->count_cpns();
			$data['count_pppk'] = $this->Mod_dashboard->count_pppk();
			$data['count_honor'] = $this->Mod_dashboard->count_honor();

			if ($this->session->userdata('id_level') == '2') {
			$data['pegawai'] = $this->Mod_pegawai->get_pegawai($this->session->userdata('username'));
			$data['data_keluarga'] = $this->Mod_pegawai->get_keluarga($this->session->userdata('username'));
			$data['data_pendidikan'] = $this->Mod_pegawai->get_pendidikan($this->session->userdata('username'));
			$data['data_jabatan'] = $this->Mod_pegawai->get_jabatan($this->session->userdata('username'));
			$data['data_pangkat'] = $this->Mod_pegawai->get_pangkat($this->session->userdata('username'));
			$data['data_kgb'] = $this->Mod_pegawai->get_kgb($this->session->userdata('username'));
			}

			$this->template->load('layoutbackend', 'dashboard/dashboard_data', $data);
		}
	}
}
/* End of file Controllername.php */
