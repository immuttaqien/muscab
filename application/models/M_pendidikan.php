<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_pendidikan extends CI_Model {

	public function daftar_pendidikan()
	{
		return $this->db->get('sn_pendidikan');
	}

	public function input_pendidikan($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_pendidikan($pendidikan_id)
	{
		return $this->db->get_where('sn_pendidikan', array('pendidikan_id' => $pendidikan_id));
	}

	public function update_pendidikan($table, $data, $pendidikan_id)
	{
		$this->db->update($table, $data, array('pendidikan_id' => $pendidikan_id));
	}

	public function delete_pendidikan($table, $pendidikan_id){
		$this->db->delete($table, array('pendidikan_id' => $pendidikan_id));
	}
}