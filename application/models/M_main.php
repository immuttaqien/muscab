<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_main extends CI_Model {

	public function jumlah_anggota()
	{
		return $this->db->get('sn_anggota')->num_rows();
	}

	public function jumlah_jamaah()
	{
		return $this->db->get('sn_jamaah');
	}

	public function jumlah_pekerjaan()
	{
		return $this->db->get('sn_pekerjaan')->num_rows();
	}

	public function jumlah_pendidikan()
	{
		return $this->db->get('sn_pendidikan')->num_rows();
	}

	public function jumlah_pendapatan()
	{
		return $this->db->get('sn_pendapatan')->num_rows();
	}

	public function jumlah_tanggungan()
	{
		return $this->db->get('sn_tanggungan')->num_rows();
	}

	public function stat_jamaah()
	{
		return $this->db->query("SELECT a.nama AS jamaah, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.kehadiran='1') AS hadir FROM sn_jamaah a ORDER BY a.jamaah_id ASC");
	}

	public function stat_seluruh()
	{
		return $this->db->query("SELECT a.nama AS jamaah, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.kehadiran='1') AS hadir, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.kehadiran='2') AS tidak, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.kehadiran='3') AS ragu, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.kehadiran='0') AS alfa FROM sn_jamaah a ORDER BY a.jamaah_id ASC LIMIT 1");
	}

	public function data_jamaah()
	{
		return $this->db->query("SELECT a.nama AS jamaah, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.kehadiran='1') AS hadir, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.kehadiran='2') AS tidak, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.kehadiran='3') AS ragu, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id AND b.kehadiran='0') AS alfa, (SELECT COUNT(b.anggota_id) FROM sn_anggota b WHERE b.jamaah_id=a.jamaah_id) AS total FROM sn_jamaah a ORDER BY a.jamaah_id ASC");
	}
}