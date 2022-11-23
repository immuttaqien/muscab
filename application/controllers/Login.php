<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('template/v_login');
	}

	public function process(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);

		$cek = $this->m_login->cek_login("sn_admin", $where)->num_rows();

		if($cek > 0){ 
			$data = $this->m_login->cek_login("sn_admin", $where)->result();
			foreach($data as $admin){
				$admin_id = $admin->admin_id;
				$nama = $admin->nama;
			}

			$data_session = array(
				'admin_id' => $admin_id,
				'nama' => $nama,
				'username' => $username,
				'status' => "login"
			);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("main")); 
		}else{
			$_SESSION['notify']['type'] = 'danger';
			$_SESSION['notify']['message'] = 'Username dan password Anda tidak sesuai.';

			header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}
 
	public function logout(){
		$this->session->sess_destroy();

		redirect(base_url('login'));
	}
}
