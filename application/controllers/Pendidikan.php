<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pendidikan');

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
			'pendidikan' => $this->m_pendidikan->daftar_pendidikan()->result()
		);

		$this->load->view('content/v_pendidikan', $data);
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

		$this->load->view('content/v_pendidikan', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($pendidikan_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'pendidikan_id' => $pendidikan_id,
			'edit' => $this->m_pendidikan->edit_pendidikan($pendidikan_id)->row()
		);

		$this->load->view('content/v_pendidikan', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_pendidikan()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pendidikan->input_pendidikan('sn_pendidikan', $data);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendidikan berhasil ditambah.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_pendidikan($pendidikan_id=0)
	{
		$nama = $this->input->post('nama');

		$data = array(
			'nama' => $nama
		);

		$this->m_pendidikan->update_pendidikan('sn_pendidikan', $data, $pendidikan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendidikan berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_pendidikan($pendidikan_id=0){
		$this->m_pendidikan->delete_pendidikan('sn_pendidikan', $pendidikan_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data pendidikan berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}