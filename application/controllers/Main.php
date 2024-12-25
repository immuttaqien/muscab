<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_main');

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
			'jumlah_anggota' => $this->m_main->jumlah_anggota(),
			'stat_jamaah' => $this->m_main->stat_jamaah()->result(),
			'stat_seluruh' => $this->m_main->stat_seluruh()->row(),
			'data_jamaah' => $this->m_main->data_jamaah()->result()
		);

		$this->load->view('content/v_main', $data);
		$this->load->view('template/v_footer');
	}

	public function download($jamaah_id=0)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Pimpinan Jamaah');
		$sheet->setCellValue('C1', 'Hadir');
		$sheet->setCellValue('D1', 'Tidak Hadir');
		$sheet->setCellValue('E1', 'Pemilihan');
		$sheet->setCellValue('F1', 'Jumlah Anggota');
		
		$jamaah = $this->m_main->data_jamaah()->result();
		$no = 1; $x = 2;

		foreach($jamaah as $row){
			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValueExplicit('B'.$x, $row->jamaah, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('C'.$x, $row->hadir);
			$sheet->setCellValue('D'.$x, $row->tidak);
			$sheet->setCellValue('E'.$x, $row->pemilihan);
			$sheet->setCellValue('F'.$x, $row->total);
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Daftar Kehadiran Pimpinan Jamaah Musyawarah Cabang IX PC Persis Banjaran';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}