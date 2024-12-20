<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_kehadiran extends CI_Model {

	function daftar_kehadiran($jamaah_id=0)
	{
		if($jamaah_id==0){
			return $this->db->query("SELECT a.jamaah_id, a.nama AS jamaah, 
				(SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.checkin='1') AS hadir, 
				(SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.checkin='1') AS total_hadir 
				FROM sn_jamaah a ORDER BY a.jamaah_id ASC");
		}else{
			return $this->db->query("SELECT a.jamaah_id, a.nama AS jamaah, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.checkin='1') AS hadir, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.checkin='1') AS total_hadir FROM sn_jamaah a WHERE a.jamaah_id='$jamaah_id' ORDER BY a.jamaah_id ASC");
		}
	}

	function daftar_pemilihan($jamaah_id=0)
	{
		if($jamaah_id==0){
			return $this->db->query("SELECT a.jamaah_id, a.nama AS jamaah, 
				(SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.election='1') AS hadir, 
				(SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.election='1') AS total_hadir 
				FROM sn_jamaah a ORDER BY a.jamaah_id ASC");
		}else{
			return $this->db->query("SELECT a.jamaah_id, a.nama AS jamaah, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.election='1') AS hadir, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.election='1') AS total_hadir FROM sn_jamaah a WHERE a.jamaah_id='$jamaah_id' ORDER BY a.jamaah_id ASC");
		}
	}

	function data_anggota($anggota_id)
	{
		return $this->db->select('a.*, b.nama AS nama_jamaah')->from('sn_anggota a')->join('sn_jamaah b', 'b.jamaah_id = a.jamaah_id')->where('a.anggota_id', $anggota_id)->get();
	}

	function harga_jual($id_user, $id_barang)
	{
		return $this->db->get_where('barang_level', array('id_user' => $id_user, 'id_barang' => $id_barang));
	}

	function insert_barang($data)
	{
		$this->db->insert('barang', $data);
		return $this->db->insert_id();
	}

	function insert_level($level)
	{
		return $this->db->insert('barang_level', $level);
	}

	function checkin_peserta($data, $anggota_id)
	{
		return $this->db->update('sn_anggota', $data, array('anggota_id' => $anggota_id));
	}

	function cek_data($table, $id_barang)
	{
		return $this->db->get_where($table, array('id_barang' => $id_barang));
	}

	function cek_anggota($anggota_id)
	{
		return $this->db->get_where('sn_anggota', array('anggota_id' => $anggota_id));
	}

	function delete_barang($id_barang){
		return $this->db->delete('barang', array('id_barang' => $id_barang));
	}
}