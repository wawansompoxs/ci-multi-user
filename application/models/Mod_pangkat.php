<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pangkat extends CI_Model
{
	var $table = 'pangkat';
	var $column_search = array('pangkat.nama_pangkat','pangkat.jenis_pangkat','pangkat.tmt_pangkat','pangkat.sah_sk','pangkat.no_sk','pangkat.status_pangkat','tbl_pegawai.nama_pegawai');
	var $column_order = array('pangkat.nama_pangkat','pangkat.jenis_pangkat','pangkat.tmt_pangkat','pangkat.sah_sk','pangkat.no_sk','pangkat.status_pangkat','tbl_pegawai.nama_pegawai','pangkat.gapok');
	var $order = array('tbl_pegawai.nip' => 'asc');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('tbl_pegawai.nip,tbl_pegawai.nama_pegawai,tbl_pegawai.gelar_dpn,tbl_pegawai.gelar_blkg,pangkat.nama_pangkat,pangkat.jenis_pangkat,pangkat.tmt_pangkat,pangkat.sah_sk,pangkat.nama_pengesah_sk,pangkat.no_sk,pangkat.status_pangkat,pangkat.id_pangkat,pangkat.gapok');
		$this->db->from($this->table);
		$this->db->join('tbl_pegawai', 'tbl_pegawai.nip = pangkat.nip');

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
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
		$this->db->from('pangkat');
		return $this->db->count_all_results();
	}

	function insert_pangkat($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update_pangkat($id_pangkat, $data)
	{
		$this->db->where('id_pangkat', $id_pangkat);
		$this->db->update('pangkat', $data);
	}

	// function update_pangkat_set($id_pangkat, $data)
	// {

	// 	$this->db->where('id_pangkat', $id_pangkat);
	// 	$this->db->update('pangkat', $data);
	// }

	public function update_pangkat_set($id_pangkat,$status_pangkat){
		$data['status_pangkat'] = $status_pangkat;
		$this->db->where('id_pangkat', $id_pangkat);
		$this->db->update('pangkat',$data);
	  }

	function get_pangkat($id_pangkat)
	{
		$this->db->where('id_pangkat', $id_pangkat);
		//$this->db->join('tbl_pegawai', 'tbl_pegawai.nip = pangkat.nip');
		return $this->db->get('pangkat')->row();
	}

	function get_pegawai()
	{
		$this->db->select('nip,nama_pegawai');
		$this->db->from('tbl_pegawai');
		$this->db->order_by('nama_pegawai', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function delete_pangkat($id_pangkat, $table)
	{
		$this->db->where('id_pangkat', $id_pangkat);
		$this->db->delete($table);
	}
}
