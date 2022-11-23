<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_tanggungan extends CI_Model {

	public function daftar_tanggungan()
	{
		return $this->db->get('sn_tanggungan');
	}

	public function input_tanggungan($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_tanggungan($tanggungan_id)
	{
		return $this->db->get_where('sn_tanggungan', array('tanggungan_id' => $tanggungan_id));
	}

	public function update_tanggungan($table, $data, $tanggungan_id)
	{
		$this->db->update($table, $data, array('tanggungan_id' => $tanggungan_id));
	}

	public function delete_tanggungan($table, $tanggungan_id){
		$this->db->delete($table, array('tanggungan_id' => $tanggungan_id));
	}
}