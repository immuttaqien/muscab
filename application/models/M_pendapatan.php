<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_pendapatan extends CI_Model {

	public function daftar_pendapatan()
	{
		return $this->db->get('sn_pendapatan');
	}

	public function input_pendapatan($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_pendapatan($pendapatan_id)
	{
		return $this->db->get_where('sn_pendapatan', array('pendapatan_id' => $pendapatan_id));
	}

	public function update_pendapatan($table, $data, $pendapatan_id)
	{
		$this->db->update($table, $data, array('pendapatan_id' => $pendapatan_id));
	}

	public function delete_pendapatan($table, $pendapatan_id){
		$this->db->delete($table, array('pendapatan_id' => $pendapatan_id));
	}
}