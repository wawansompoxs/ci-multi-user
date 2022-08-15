<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_pegawai extends CI_Model
{
	var $table = 'tbl_pegawai';
	var $column_search = array('nip', 'nama_pegawai', 'email', 'no_hp', 'status_kepegawaian', 'gelar_dpn', 'gelar_blkg');
	var $column_order = array('nip', 'nama_pegawai', 'email', 'no_hp', 'status_kepegawaian', 'gelar_dpn', 'gelar_blkg');
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
		$this->db->from('tbl_pegawai');
		$this->db->join('pangkat', 'pangkat.nip = tbl_pegawai.nip');
		$this->db->join('jabatan', 'jabatan.nip = tbl_pegawai.nip');
		$this->db->where('tbl_pegawai.nip', $nip);
		$this->db->where('pangkat.status_pangkat', 'aktif');
		$this->db->where('jabatan.status_jabatan', 'aktif');
		$query = $this->db->get();
		return $query->row();
	}

	function delete_pegawai($nip, $table)
	{
		$this->db->where('nip', $nip);
		$this->db->delete($table);
	}
	public function get_by_id($nip)
	{
		$this->db->from($this->table);
		$this->db->where('nip', $nip);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_keluarga($nip)
	{
		$this->db->select('tbl_pegawai.nip,keluarga.nik,keluarga.nip,keluarga.nama_keluarga,keluarga.tempat_lahir,keluarga.tanggal_lahir,keluarga.pendidikan,keluarga.pekerjaan,keluarga.hubungan');
		$this->db->from($this->table);
		$this->db->where('keluarga.nip', $nip);
		$this->db->join('keluarga', 'keluarga.nip = tbl_pegawai.nip');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_pendidikan($nip)
	{
		$this->db->select('pendidikan.id_pendidikan,pendidikan.nip,pendidikan.tingkat,pendidikan.nama_sekolah,pendidikan.lokasi,pendidikan.jurusan,pendidikan.tgl_ijazah,pendidikan.no_ijazah');
		$this->db->from($this->table);
		$this->db->where('pendidikan.nip', $nip);
		$this->db->join('pendidikan', 'pendidikan.nip = tbl_pegawai.nip');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_jabatan($nip)
	{
		$this->db->select('jabatan.id_jabatan,jabatan.nip,jabatan.nama_jabatan,jabatan.eselon,jabatan.tmt,jabatan.sampai_tgl,jabatan.status_jabatan');
		$this->db->from($this->table);
		$this->db->where('jabatan.nip', $nip);
		$this->db->join('jabatan', 'jabatan.nip = tbl_pegawai.nip');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_pangkat($nip)
	{
		$this->db->select('pangkat.id_pangkat,pangkat.nip,pangkat.nama_pangkat,pangkat.jenis_pangkat,pangkat.tmt_pangkat,pangkat.sah_sk,pangkat.nama_pengesah_sk,pangkat.no_sk,pangkat.status_pangkat,pangkat.gapok');
		$this->db->from($this->table);
		$this->db->where('pangkat.nip', $nip);
		$this->db->join('pangkat', 'pangkat.nip = tbl_pegawai.nip');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_kgb($nip)
	{
		$this->db->select('kgb.id_kgb,kgb.nip,kgb.pangkat,kgb.no_sk,kgb.tanggal_sk,kgb.tmt_kgb,kgb.mk_thn_kgb,kgb.mk_bln_kgb,kgb.nama_pengesah_sk,kgb.gapok,kgb.status_kgb');
		$this->db->from($this->table);
		$this->db->where('kgb.nip', $nip);
		$this->db->join('kgb', 'kgb.nip = tbl_pegawai.nip');
		$query = $this->db->get();
		return $query->result();
	}
}
