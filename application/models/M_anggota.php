<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_anggota extends CI_Model {

	public function daftar_anggota($jamaah_id)
	{
		if($jamaah_id==0) return $this->db->select('a.*, b.nama AS jamaah')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->order_by('a.nama_lengkap', 'ASC')->get();
		else return $this->db->select('a.*, b.nama AS jamaah')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->where('a.jamaah_id', $jamaah_id)->order_by('a.nama_lengkap', 'ASC')->get();
	}

	public function detail_anggota($anggota_id)
	{
		return $this->db->select('a.*, b.nama AS jamaah')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->where('a.anggota_id', $anggota_id)->get();
	}

	public function cek_nomor($nomor, $anggota_id)
	{
		$cek_nomor = $this->db->get_where('sn_anggota', array('nomor_anggota' => $nomor, 'anggota_id !=' => $anggota_id));

		return $cek_nomor;
	}

	public function update_anggota($table, $data, $anggota_id)
	{
		$this->db->update($table, $data, array('anggota_id' => $anggota_id));
	}

	public function get_foto($anggota_id)
	{
		return $this->db->select('foto')->from('sn_anggota')->where('anggota_id', $anggota_id)->get();
	}

	public function delete_anggota($table, $anggota_id){
		$this->db->delete($table, array('anggota_id' => $anggota_id));
	}

	public function delete_riwayat($table, $anggota_id){
		$this->db->delete($table, array('anggota_id' => $anggota_id));
	}

	public function get_anggota($jamaah_id)
     {
     	if($jamaah_id==0){
     		return $this->db->select('a.*, b.nama AS jamaah, c.nama AS pekerjaan, d.nama AS pendidikan, e.nama AS pendapatan, f.nama AS tanggungan')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->join('sn_pekerjaan c', 'c.pekerjaan_id = a.pekerjaan_id', 'left')->join('sn_pendidikan d', 'd.pendidikan_id = a.pendidikan_id', 'left')->join('sn_pendapatan e', 'e.pendapatan_id = a.pendapatan_id', 'left')->join('sn_tanggungan f', 'f.tanggungan_id = a.tanggungan_id', 'left')->order_by('a.nama_lengkap', 'ASC')->get();
     	}else{
     		return $this->db->select('a.*, b.nama AS jamaah, c.nama AS pekerjaan, d.nama AS pendidikan, e.nama AS pendapatan, f.nama AS tanggungan')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->join('sn_pekerjaan c', 'c.pekerjaan_id = a.pekerjaan_id', 'left')->join('sn_pendidikan d', 'd.pendidikan_id = a.pendidikan_id', 'left')->join('sn_pendapatan e', 'e.pendapatan_id = a.pendapatan_id', 'left')->join('sn_tanggungan f', 'f.tanggungan_id = a.tanggungan_id', 'left')->where('a.jamaah_id', $jamaah_id)->order_by('a.nama_lengkap', 'ASC')->get();
     	}
     }
}