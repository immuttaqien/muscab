<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_riwayat');
		$this->load->model('m_formulir');
		// $this->session->sess_destroy();
	}

	public function index($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_logo');

		$data = array(
			'page' => 'index',
			'anggota_id' => $anggota_id,
			'riwayat' => $this->m_riwayat->daftar_riwayat($anggota_id)->result(),
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
		);

		// $this->session->set_flashdata('type', 'success');
		// $this->session->set_flashdata('message', 'Data pribadi Anda berhasil disimpan. Silakan isi data riwayat pendidikan Anda.');

		$this->load->view('content/v_riwayat', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_logo');

		$data = array(
			'page' => 'tambah',
			'anggota_id' => $anggota_id,
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
		);

		$this->load->view('content/v_riwayat', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($riwayat_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_logo');

		$data = array(
			'page' => 'edit',
			'riwayat_id' => $riwayat_id,
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			'edit' => $this->m_riwayat->edit_riwayat($riwayat_id)->row()
		);

		$this->load->view('content/v_riwayat', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_riwayat($anggota_id=0)
	{
		$tingkat = $this->input->post('tingkat');
		$nama_sekolah = $this->input->post('nama_sekolah');
		$jurusan = $this->input->post('jurusan');
		$tahun_masuk = $this->input->post('tahun_masuk');
		$tahun_lulus = $this->input->post('tahun_lulus');

		$data = array(
			'anggota_id' => $anggota_id,
			'pendidikan_id' => $tingkat,
			'nama_sekolah' => $nama_sekolah,
			'jurusan' => $jurusan,
			'tahun_masuk' => $tahun_masuk,
			'tahun_lulus' => $tahun_lulus
		);

		$this->m_riwayat->input_riwayat('sn_riwayat', $data);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data riwayat pendidikan berhasil ditambahkan.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_riwayat($riwayat_id=0)
	{
		$tingkat = $this->input->post('tingkat');
		$nama_sekolah = $this->input->post('nama_sekolah');
		$jurusan = $this->input->post('jurusan');
		$tahun_masuk = $this->input->post('tahun_masuk');
		$tahun_lulus = $this->input->post('tahun_lulus');

		$data = array(
			'pendidikan_id' => $tingkat,
			'nama_sekolah' => $nama_sekolah,
			'jurusan' => $jurusan,
			'tahun_masuk' => $tahun_masuk,
			'tahun_lulus' => $tahun_lulus
		);

		$this->m_riwayat->update_riwayat('sn_riwayat', $data, $riwayat_id);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data riwayat pendidikan berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_riwayat($riwayat_id=0){
		$this->m_riwayat->delete_riwayat('sn_riwayat', $riwayat_id);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data riwayat pendidikan berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}