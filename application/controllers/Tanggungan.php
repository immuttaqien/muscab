<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggungan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_tanggungan');

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
			'tanggungan' => $this->m_tanggungan->daftar_tanggungan()->result()
		);

		$this->load->view('content/v_tanggungan', $data);
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

		$this->load->view('content/v_tanggungan', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($tanggungan_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'tanggungan_id' => $tanggungan_id,
			'edit' => $this->m_tanggungan->edit_tanggungan($tanggungan_id)->row()
		);

		$this->load->view('content/v_tanggungan', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_tanggungan()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_tanggungan->input_tanggungan('sn_tanggungan', $data);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data tanggungan berhasil ditambah.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_tanggungan($tanggungan_id=0)
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_tanggungan->update_tanggungan('sn_tanggungan', $data, $tanggungan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data tanggungan berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_tanggungan($tanggungan_id=0){
		$this->m_tanggungan->delete_tanggungan('sn_tanggungan', $tanggungan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data tanggungan berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}