<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_main');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');
		
		$data = array(
			'anggota' => $this->m_main->jumlah_anggota(),
			'jamaah' => $this->m_main->jumlah_jamaah(),
			'pekerjaan' => $this->m_main->jumlah_pekerjaan(),
			'pendidikan' => $this->m_main->jumlah_pendidikan(),
			'pendapatan' => $this->m_main->jumlah_pendapatan(),
			'tanggungan' => $this->m_main->jumlah_tanggungan(),
			'stat_jamaah' => $this->m_main->stat_jamaah()->result()
		);

		$this->load->view('content/v_main', $data);
		$this->load->view('template/v_footer');
	}
}