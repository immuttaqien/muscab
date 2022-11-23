<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');

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
			'admin' => $this->m_admin->daftar_admin()->result()
		);

		$this->load->view('content/v_admin', $data);
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

		$this->load->view('content/v_admin', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($admin_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'admin_id' => $admin_id,
			'edit' => $this->m_admin->edit_admin($admin_id)->row()
		);

		$this->load->view('content/v_admin', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_admin()
	{
		$nama = $this->input->post('nama');
		$uname = $this->input->post('uname');
		$pswd = $this->input->post('pswd');
		$repswd = $this->input->post('repswd');

		if($pswd==$repswd){
			$data = array(
				'nama' => $nama,
				'username' => $uname,
				'password' => md5($pswd)
			);

			$this->m_admin->input_admin('sn_admin', $data);
		
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Data admin berhasil ditambah.');
		}else{		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Password tidak sama.');
		}

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function edit_admin($admin_id=0)
	{
		$nama = $this->input->post('nama');
		$uname = $this->input->post('uname');
		$pswd = $this->input->post('pswd');
		$repswd = $this->input->post('repswd');

		if($pswd || $repswd){
			if($pswd==$repswd){
				$data = array(
					'nama' => $nama,
					'username' => $uname,
					'password' => md5($pswd)
				);			

				$this->m_admin->update_admin('sn_admin', $data, $admin_id);	
			}else{	
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Password tidak sama.');

				header('location:'.$_SERVER['HTTP_REFERER']); die();
			}
		}else{
			$data = array(
				'nama' => $nama,
				'username' => $uname
			);

			$this->m_admin->update_admin('sn_admin', $data, $admin_id);
		}
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data admin berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_admin($admin_id=0){
		$this->m_admin->delete_admin('sn_admin', $admin_id);
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data admin berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}