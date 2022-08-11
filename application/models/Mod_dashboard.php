<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function count_all()
	{
		$this->db->from('tbl_pegawai');
		return $this->db->count_all_results();
	}
	function count_pns()
	{
		$this->db->from('tbl_pegawai');
		$this->db->where('status_kepegawaian', 'PNS');
		return $this->db->count_all_results();
	}
	function count_cpns()
	{
		$this->db->from('tbl_pegawai');
		$this->db->where('status_kepegawaian', 'CPNS');
		return $this->db->count_all_results();
	}
	function count_pppk()
	{
		$this->db->from('tbl_pegawai');
		$this->db->where('status_kepegawaian', 'PPPK');
		return $this->db->count_all_results();
	}
	function count_honor()
	{
		$this->db->from('tbl_pegawai');
		$this->db->where('status_kepegawaian', 'honor');
		return $this->db->count_all_results();
	}
	public function get_by_id($nip)
	{
		$this->db->from($this->table);
		$this->db->where('nip', $nip);
		$query = $this->db->get();
		return $query->row();
	}
	
}
