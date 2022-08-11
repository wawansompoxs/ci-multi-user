<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
		$this->load->model(array('Mod_dashboard'));
        // backButtonHandle();
    }

    function index()
    {
		$data['count_all'] = $this->Mod_dashboard->count_all();
		$data['count_pns'] = $this->Mod_dashboard->count_pns();
		$data['count_cpns'] = $this->Mod_dashboard->count_cpns();
		$data['count_pppk'] = $this->Mod_dashboard->count_pppk();
		$data['count_honor'] = $this->Mod_dashboard->count_honor();
    	$logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        }else{
        	$this->template->load('layoutbackend','dashboard/dashboard_data',$data);
        }
        
    }

}
/* End of file Controllername.php */
 