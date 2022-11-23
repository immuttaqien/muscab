<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_formulir extends CI_Model {

	public function daftar_jamaah()
	{
		return $this->db->get('sn_jamaah');
	}

	public function daftar_pekerjaan()
	{
		return $this->db->get('sn_pekerjaan');
	}

	public function daftar_pendidikan()
	{
		return $this->db->get('sn_pendidikan');
	}

	public function daftar_pendapatan()
	{
		return $this->db->get('sn_pendapatan');
	}

	public function daftar_tanggungan()
	{
		return $this->db->get('sn_tanggungan');
	}

	public function cek_nomor($nomor)
	{
		$cek_nomor = $this->db->get_where('sn_anggota', array('nomor_anggota' => $nomor));

		return $cek_nomor;
	}

	public function cek_anggota($nomor, $nama, $tempat, $tanggal)
	{
		//$this->db->select('anggota_id')->from('sn_anggota')->where('nomor_anggota', $nomor)->or_like('nama_lengkap', $nama)->like('tempat_lahir', $tempat)->where('tanggal_lahir', $tanggal)->get();

		$this->db->select('anggota_id')->from('sn_anggota');
		if($nomor){
			$this->db->where('nomor_anggota', $nomor);
			$this->db->or_where('tanggal_lahir', $tanggal)->like('nama_lengkap', $nama)->like('tempat_lahir', $tempat);
		}else{
			$this->db->where('tanggal_lahir', $tanggal)->like('nama_lengkap', $nama)->like('tempat_lahir', $tempat);
		}

		$cek_anggota = $this->db->get();

		// $cek_anggota = $this->db->query("SELECT anggota_id FROM sn_anggota WHERE nomor_anggota='$nomor' OR nama_lengkap LIKE '%$nama%' AND tempat_lahir LIKE '%$tempat%' AND tanggal_lahir='$tanggal'");

		return $cek_anggota;
	}

	public function input_anggota($table, $data)
	{
		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}
}