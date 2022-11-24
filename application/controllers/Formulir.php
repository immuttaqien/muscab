<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_formulir');
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
			// 'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			// 'pekerjaan' => $this->m_formulir->daftar_pekerjaan()->result(),
			// 'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			// 'pendapatan' => $this->m_formulir->daftar_pendapatan()->result(),
			// 'tanggungan' => $this->m_formulir->daftar_tanggungan()->result(),
			// 'riwayat' => $this->m_riwayat->daftar_riwayat($anggota_id)->result(),
			'detail' => $this->m_formulir->detail_anggota($anggota_id)->row()
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
		$npa = $this->input->post('npa');
		$email = $this->input->post('email');
		$handphone = $this->input->post('handphone');
		$kehadiran = $this->input->post('kehadiran');
		$alasan = $this->input->post('alasan');	

		if($kehadiran==1){
			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
	 
	        $config['cacheable']    = true; //boolean, the default is true
	        $config['cachedir']     = './media/'; //string, the default is application/cache/
	        $config['errorlog']     = './media/'; //string, the default is application/logs/
	        $config['imagedir']     = './media/qrcode/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);
	 
	        $qrcode = $npa.'.png'; //buat name dari qr code sesuai dengan npa
	        $alasan = NULL;
	 
	        $params['data'] = $npa; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$qrcode; //simpan image QR CODE ke folder assets/images/
	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE	
		}else $qrcode = NULL;

		$data = array(
			'email' => $email,
			'handphone' => $handphone,
			'kehadiran' => $kehadiran,
			'alasan' => $alasan,
			'qrcode' => $qrcode
		);
		$this->m_formulir->update_kehadiran('sn_anggota', $data, $anggota_id);	
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Terima kasih telah melakukan konfirmasi kehadiran.');

		if($kehadiran==1) redirect('formulir/detail/'.$anggota_id); else header('location:'.$_SERVER['HTTP_REFERER']);
	}
}
