<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pekerjaan');

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
			'page' => 'index',
			'pekerjaan' => $this->m_pekerjaan->daftar_pekerjaan()->result()
		);

		$this->load->view('content/v_pekerjaan', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah()
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'tambah'
		);

		$this->load->view('content/v_pekerjaan', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($pekerjaan_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'pekerjaan_id' => $pekerjaan_id,
			'edit' => $this->m_pekerjaan->edit_pekerjaan($pekerjaan_id)->row()
		);

		$this->load->view('content/v_pekerjaan', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_pekerjaan()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pekerjaan->input_pekerjaan('sn_pekerjaan', $data);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pekerjaan berhasil ditambah.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_pekerjaan($pekerjaan_id=0)
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pekerjaan->update_pekerjaan('sn_pekerjaan', $data, $pekerjaan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendidikan berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_pekerjaan($pekerjaan_id=0){
		$this->m_pekerjaan->delete_pekerjaan('sn_pekerjaan', $pekerjaan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendidikan berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}