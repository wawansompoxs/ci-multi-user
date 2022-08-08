<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_pegawai extends CI_Model
{
	var $table = 'tbl_pegawai';
	var $column_search = array('nip','nama_pegawai','email','no_hp','status_kepegawaian','gelar_dpn','gelar_blkg'); 
	var $column_order = array('nip','nama_pegawai','email','no_hp','status_kepegawaian','gelar_dpn','gelar_blkg');
	var $order = array('nip' => 'asc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

		private function _get_datatables_query()
	{
		
		$this->db->from('tbl_pegawai');
		$i = 0;

	foreach ($this->column_search as $item) // loop column 
	{
	if($_POST['search']['value']) // if datatable send POST for search
	{

	if($i===0) // first loop
	{
	$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	$this->db->like($item, $_POST['search']['value']);
	}
	else
	{
		$this->db->or_like($item, $_POST['search']['value']);
	}

		if(count($this->column_search) - 1 == $i) //last loop
		$this->db->group_end(); //close bracket
	}
	$i++;
	}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('tbl_pegawai');
		return $this->db->count_all_results();
	}

	function insert_pegawai($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

        function update_pegawai($nip, $data)
    {
        $this->db->where('nip', $nip);
        $this->db->update('tbl_pegawai', $data);
    }

        function get_pegawai($nip)
    {   
        $this->db->where('nip',$nip);
        return $this->db->get('tbl_pegawai')->row();
    }

        function delete_pegawai($nip, $table)
    {
        $this->db->where('nip', $nip);
        $this->db->delete($table);
    }

}
