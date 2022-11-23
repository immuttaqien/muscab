<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pendapatan');

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
			'pendapatan' => $this->m_pendapatan->daftar_pendapatan()->result()
		);

		$this->load->view('content/v_pendapatan', $data);
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

		$this->load->view('content/v_pendapatan', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($pendapatan_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'pendapatan_id' => $pendapatan_id,
			'edit' => $this->m_pendapatan->edit_pendapatan($pendapatan_id)->row()
		);

		$this->load->view('content/v_pendapatan', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_pendapatan()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pendapatan->input_pendapatan('sn_pendapatan', $data);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendapatan berhasil ditambah.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_pendapatan($pendapatan_id=0)
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pendapatan->update_pendapatan('sn_pendapatan', $data, $pendapatan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendapatan berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_pendapatan($pendapatan_id=0){
		$this->m_pendapatan->delete_pendapatan('sn_pendapatan', $pendapatan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendapatan berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}