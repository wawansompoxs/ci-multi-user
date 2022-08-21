<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_jabatan extends CI_Model
{
	var $table = 'jabatan';
	var $column_search = array('jabatan.nama_jabatan','jabatan.jenis_jabatan','jabatan.eselon','jabatan.tmt','jabatan.sampai_tgl','jabatan.status_jabatan','tbl_pegawai.nama_pegawai');
	var $column_order = array('jabatan.nama_jabatan','jabatan.jenis_jabatan','jabatan.eselon','jabatan.tmt','jabatan.sampai_tgl','jabatan.status_jabatan','tbl_pegawai.nama_pegawai');
	var $order = array('tbl_pegawai.nip' => 'asc');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('tbl_pegawai.nip,tbl_pegawai.nama_pegawai,tbl_pegawai.gelar_dpn,tbl_pegawai.gelar_blkg,jabatan.nama_jabatan,jabatan.jenis_jabatan,jabatan.eselon,jabatan.tmt,jabatan.sampai_tgl,jabatan.status_jabatan,jabatan.id_jabatan');
		$this->db->from($this->table);
		$this->db->join('tbl_pegawai', 'tbl_pegawai.nip = jabatan.nip');

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
		$this->db->from('jabatan');
		return $this->db->count_all_results();
	}

	function insert_jabatan($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update_jabatan($id_jabatan, $data)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan', $data);
	}

	public function update_jabatan_set($id_jabatan,$status_jabatan,$nip){
		$this->db->trans_start();
		$this->db->query("UPDATE jabatan SET status_jabatan='tidak aktif' WHERE nip='$nip'");
		$this->db->query("UPDATE jabatan SET status_jabatan='$status_jabatan' WHERE id_jabatan='$id_jabatan'");
		$this->db->trans_complete();
	  }

	  public function update_pangkat_set($id_pangkat,$status_pangkat,$nip){
		$this->db->trans_start();
		$this->db->query("UPDATE pangkat SET status_pangkat='tidak aktif' WHERE nip='$nip'");
		$this->db->query("UPDATE pangkat SET status_pangkat='$status_pangkat' WHERE id_pangkat='$id_pangkat'");
		$this->db->trans_complete();
	  }

	function get_jabatan($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		//$this->db->join('tbl_pegawai', 'tbl_pegawai.nip = jabatan.nip');
		return $this->db->get('jabatan')->row();
	}

	function get_pegawai()
	{
		$this->db->select('nip,nama_pegawai');
		$this->db->from('tbl_pegawai');
		$this->db->order_by('nama_pegawai', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function delete_jabatan($id_jabatan, $table)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->delete($table);
	}
}
