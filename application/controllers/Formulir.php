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
			'detail' => $this->m_formulir->detail_anggota($anggota_id)->row()
		);

		$this->load->view('content/v_formulir', $data);
		$this->load->view('template/v_footer');
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
			'qrcode' => $qrcode,
			'time_entry' => date('Y-m-d H:i:s')
		);
		$this->m_formulir->update_kehadiran('sn_anggota', $data, $anggota_id);	
		
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Terima kasih telah melakukan konfirmasi kehadiran.');

		if($kehadiran==1) redirect('formulir/detail/'.$anggota_id); else header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function download($anggota_id){
		$detail = $this->m_formulir->detail_anggota($anggota_id)->row();
	    $data = array(
	        "detail" => $detail
	    );

	    $this->load->library('pdf');
	    $this->pdf->setPaper('A5', 'potrait');
	    $this->pdf->filename = $detail->npa.'_'.$detail->nama_lengkap.'.pdf';
	    $this->pdf->load_view('content/v_download', $data);
	}
}
