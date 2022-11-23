<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_riwayat');
		$this->load->model('m_formulir');
	}

	public function index($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'index',
			'anggota_id' => $anggota_id,
			'riwayat' => $this->m_riwayat->daftar_riwayat($anggota_id)->result(),
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
		);

		$this->load->view('content/v_history', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'tambah',
			'anggota_id' => $anggota_id,
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
		);

		$this->load->view('content/v_history', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($riwayat_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'riwayat_id' => $riwayat_id,
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			'edit' => $this->m_riwayat->edit_riwayat($riwayat_id)->row()
		);

		$this->load->view('content/v_history', $data);
		$this->load->view('template/v_footer');
	}
}