<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_referensi extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function ref_pangkat()
	{
		$this->db->select('pangkat_nama,pangkat_ruang');
		$this->db->from('ref_pangkat');
		$this->db->order_by('pangkat_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function ref_gaji()
	{
		$this->db->from('ref_gaji');
		$this->db->order_by('id_golongan', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

}
