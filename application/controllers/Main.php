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
			'jumlah_anggota' => $this->m_main->jumlah_anggota(),
			'stat_jamaah' => $this->m_main->stat_jamaah()->result(),
			'stat_seluruh' => $this->m_main->stat_seluruh()->row(),
			'data_jamaah' => $this->m_main->data_jamaah()->result()
		);

		$this->load->view('content/v_main', $data);
		$this->load->view('template/v_footer');
	}
}