<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_formulir');
		$this->load->model('m_riwayat');
		$this->load->model('m_anggota');
		// $this->session->sess_destroy();
	}

	public function index()
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_logo');
		
		$data = array(
			'page' => 'index',
			'anggota' => $this->m_formulir->daftar_anggota()->result(),
		);

		$this->load->view('content/v_formulir', $data);
		$this->load->view('template/v_footer');
	}

	public function detail($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_logo');

		$data = array(
			'page' => 'detail',
			'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			'pekerjaan' => $this->m_formulir->daftar_pekerjaan()->result(),
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			'pendapatan' => $this->m_formulir->daftar_pendapatan()->result(),
			'tanggungan' => $this->m_formulir->daftar_tanggungan()->result(),
			'riwayat' => $this->m_riwayat->daftar_riwayat($anggota_id)->result(),
			'detail' => $this->m_anggota->detail_anggota($anggota_id)->row()
		);

		$this->load->view('content/v_formulir', $data);
		$this->load->view('template/v_footer');
	}

	public function cek_anggota()
	{
		$nomor_anggota = $this->input->post('nomor_anggota');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');

		$cek_anggota = $this->m_formulir->cek_anggota($nomor_anggota, $nama_lengkap, $tempat_lahir, $tanggal_lahir)->num_rows();
		if($cek_anggota > 0){
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Data Anda sudah ada di sistem. Terimakasih.');

			header('location:'.$_SERVER['HTTP_REFERER']);

			// $anggota = $this->m_formulir->cek_anggota($nomor_anggota, $nama_lengkap, $tempat_lahir, $tanggal_lahir)->row();

			// redirect(base_url('formulir/detail/'.$anggota->anggota_id));
		}else{
			$data_session = array(
				'nomor_anggota' => $nomor_anggota,
				'nama_lengkap' => $nama_lengkap,
				'tempat_lahir' => $tempat_lahir,
				'tanggal_lahir' => $tanggal_lahir,
				'lanjut' => true
			);
 
			$this->session->set_userdata($data_session);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Silakan lengkapi form dibawah ini.');
 
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}

	public function simpan_kehadiran()
	{
		$anggota_id = $this->input->post('anggota_id');
		$email = $this->input->post('email');
		$handphone = $this->input->post('handphone');
		$kehadiran = $this->input->post('kehadiran');
		$alasan = $this->input->post('alasan');	

		$data = array(
			'email' => $email,
			'handphone' => $handphone,
			'kehadiran' => $kehadiran,
			'alasan' => $alasan
		);
		$this->m_formulir->update_kehadiran('sn_anggota', $data, $anggota_id);	
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Terima kasih telah melakukan konfirmasi kehadiran.');

		header('location:'.$_SERVER['HTTP_REFERER']);

		// redirect('riwayat/index/'.$anggota_id);
	}
}
