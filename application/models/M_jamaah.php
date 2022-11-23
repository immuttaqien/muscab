<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_jamaah extends CI_Model {

	public function daftar_jamaah()
	{
		return $this->db->get('sn_jamaah');
	}

	public function input_jamaah($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_jamaah($jamaah_id)
	{
		return $this->db->get_where('sn_jamaah', array('jamaah_id' => $jamaah_id));
	}

	public function update_jamaah($table, $data, $jamaah_id)
	{
		$this->db->update($table, $data, array('jamaah_id' => $jamaah_id));
	}

	public function delete_jamaah($table, $jamaah_id){
		$this->db->delete($table, array('jamaah_id' => $jamaah_id));
	}
}