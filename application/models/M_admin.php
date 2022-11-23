<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function daftar_admin()
	{
		return $this->db->get('sn_admin');
	}

	public function input_admin($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_admin($admin_id)
	{
		return $this->db->get_where('sn_admin', array('admin_id' => $admin_id));
	}

	public function update_admin($table, $data, $admin_id)
	{
		$this->db->update($table, $data, array('admin_id' => $admin_id));
	}

	public function delete_admin($table, $admin_id){
		$this->db->delete($table, array('admin_id' => $admin_id));
	}
}