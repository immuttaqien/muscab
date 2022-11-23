<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jamaah extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_jamaah');

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
			'jamaah' => $this->m_jamaah->daftar_jamaah()->result()
		);

		$this->load->view('content/v_jamaah', $data);
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

		$this->load->view('content/v_jamaah', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($jamaah_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'jamaah_id' => $jamaah_id,
			'edit' => $this->m_jamaah->edit_jamaah($jamaah_id)->row()
		);

		$this->load->view('content/v_jamaah', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_jamaah()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_jamaah->input_jamaah('sn_jamaah', $data);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data jamaah berhasil ditambah.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_jamaah($jamaah_id=0)
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_jamaah->update_jamaah('sn_jamaah', $data, $jamaah_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data jamaah berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_jamaah($jamaah_id=0){
		$this->m_jamaah->delete_jamaah('sn_jamaah', $jamaah_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data jamaah berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}