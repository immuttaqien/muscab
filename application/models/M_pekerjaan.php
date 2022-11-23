<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_pekerjaan extends CI_Model {

	public function daftar_pekerjaan()
	{
		return $this->db->get('sn_pekerjaan');
	}

	public function input_pekerjaan($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_pekerjaan($pekerjaan_id)
	{
		return $this->db->get_where('sn_pekerjaan', array('pekerjaan_id' => $pekerjaan_id));
	}

	public function update_pekerjaan($table, $data, $pekerjaan_id)
	{
		$this->db->update($table, $data, array('pekerjaan_id' => $pekerjaan_id));
	}

	public function delete_pekerjaan($table, $pekerjaan_id){
		$this->db->delete($table, array('pekerjaan_id' => $pekerjaan_id));
	}
}