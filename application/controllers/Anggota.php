<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_anggota');
		$this->load->model('m_formulir');
		$this->load->model('m_riwayat');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index($jamaah_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'index',
			'jamaah_id' => $jamaah_id,
			'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			'anggota' => $this->m_anggota->daftar_anggota($jamaah_id)->result()
		);

		$this->load->view('content/v_anggota', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah()
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'tambah',
			'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			'pekerjaan' => $this->m_formulir->daftar_pekerjaan()->result(),
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			'pendapatan' => $this->m_formulir->daftar_pendapatan()->result(),
			'tanggungan' => $this->m_formulir->daftar_tanggungan()->result()
		);

		$this->load->view('content/v_anggota', $data);
		$this->load->view('template/v_footer');
	}

	public function detail($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

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

		$this->load->view('content/v_anggota', $data);
		$this->load->view('template/v_footer');
	}

	public function edit($anggota_id=0)
	{
		$this->load->view('template/v_meta');
		$this->load->view('template/v_header');
		$this->load->view('template/v_menu');

		$data = array(
			'page' => 'edit',
			'anggota_id' => $anggota_id,
			'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			'pekerjaan' => $this->m_formulir->daftar_pekerjaan()->result(),
			'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			'pendapatan' => $this->m_formulir->daftar_pendapatan()->result(),
			'tanggungan' => $this->m_formulir->daftar_tanggungan()->result(),
			'riwayat' => $this->m_riwayat->daftar_riwayat($anggota_id)->result(),
			'edit' => $this->m_anggota->detail_anggota($anggota_id)->row()
		);

		$this->load->view('content/v_anggota', $data);
		$this->load->view('template/v_footer');
	}

	public function tambah_anggota()
	{
		$nomor_anggota = $this->input->post('nomor_anggota');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$status_nikah = $this->input->post('status_nikah');
		$golongan_darah = $this->input->post('golongan_darah');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$whatsapp = $this->input->post('whatsapp');
		$alamat = $this->input->post('alamat');
		$nomor_ktp = $this->input->post('nomor_ktp');
		$tahun_masuk = $this->input->post('tahun_masuk');
		$jamaah = $this->input->post('jamaah');
		$hobi = $this->input->post('hobi');
		$keahlian = $this->input->post('keahlian');
		$pekerjaan = $this->input->post('pekerjaan');
		$pekerjaan_lain = $this->input->post('pekerjaan_lain');
		$nama_instansi = $this->input->post('nama_instansi');
		$sampingan = $this->input->post('sampingan');
		$pekerjaan_sampingan = $this->input->post('pekerjaan_sampingan');
		$pendidikan = $this->input->post('pendidikan');
		$pendapatan = $this->input->post('pendapatan');
		$tanggungan = $this->input->post('tanggungan');
		$organisasi_lain = $this->input->post('organisasi_lain');
		$nama_organisasi = $this->input->post('nama_organisasi');
		$nama_istri = $this->input->post('nama_istri');
		$anggota_otonom = $this->input->post('anggota_otonom');
		$jumlah_anak = $this->input->post('jumlah_anak');

		// $cek_nomor = $this->m_formulir->cek_nomor($nomor_anggota)->num_rows();
		// if($cek_nomor > 0){
		// 	$this->session->set_flashdata('type', 'danger');
		// 	$this->session->set_flashdata('message', 'Nomor anggota sudah dipakai, silakan cek kembali.');

		// 	header('location:'.$_SERVER['HTTP_REFERER']); die();
		// }

		if(isset($_FILES['foto']['name']) && $_FILES['foto']['tmp_name']){
			$config['upload_path'] = './media/foto/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = true;
			 
			$this->load->library('upload', $config);
			 
			if ( ! $this->upload->do_upload('foto')){
				$_SESSION['notify']['type'] = 'danger';
				$_SESSION['notify']['message'] = 'Terjadi kesalahan saat upload foto, silakan ulangi lagi.';

				header('location:'.$_SERVER['HTTP_REFERER']); die();
			}else{
				$foto = $this->upload->data('file_name');
			}
		}else $foto = NULL;		

		$data = array(
			'nomor_anggota' => $nomor_anggota,
			'nama_lengkap' => $nama_lengkap,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'status_nikah' => $status_nikah,
			'golongan_darah' => $golongan_darah,
			'email' => $email,
			'telepon' => $telepon,
			'whatsapp' => $whatsapp,
			'alamat' => $alamat,
			'nomor_ktp' => $nomor_ktp,
			'tahun_masuk' => $tahun_masuk,
			'jamaah_id' => $jamaah,
			'hobi' => $hobi,
			'keahlian' => $keahlian,
			'pekerjaan_id' => $pekerjaan,
			'pekerjaan_lain' => $pekerjaan_lain,
			'nama_instansi' => $nama_instansi,
			'sampingan' => $sampingan,
			'pekerjaan_sampingan' => $pekerjaan_sampingan,
			'pendidikan_id' => $pendidikan,
			'pendapatan_id' => $pendapatan,
			'tanggungan_id' => $tanggungan,
			'organisasi_lain' => $organisasi_lain,
			'nama_organisasi' => $nama_organisasi,
			'nama_istri' => $nama_istri,
			'anggota_otonom' => $anggota_otonom,
			'jumlah_anak' => $jumlah_anak,
			'foto' => $foto
		);

		$anggota_id = $this->m_formulir->input_anggota('sn_anggota', $data);

		redirect('history/index/'.$anggota_id);
	}

	public function edit_anggota($anggota_id=0)
	{
		$nomor_anggota = $this->input->post('nomor_anggota');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$status_nikah = $this->input->post('status_nikah');
		$golongan_darah = $this->input->post('golongan_darah');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$whatsapp = $this->input->post('whatsapp');
		$alamat = $this->input->post('alamat');
		$nomor_ktp = $this->input->post('nomor_ktp');
		$tahun_masuk = $this->input->post('tahun_masuk');
		$jamaah = $this->input->post('jamaah');
		$hobi = $this->input->post('hobi');
		$keahlian = $this->input->post('keahlian');
		$pekerjaan = $this->input->post('pekerjaan');
		$pekerjaan_lain = $this->input->post('pekerjaan_lain');
		$nama_instansi = $this->input->post('nama_instansi');
		$sampingan = $this->input->post('sampingan');
		$pekerjaan_sampingan = $this->input->post('pekerjaan_sampingan');
		$pendidikan = $this->input->post('pendidikan');
		$pendapatan = $this->input->post('pendapatan');
		$tanggungan = $this->input->post('tanggungan');
		$organisasi_lain = $this->input->post('organisasi_lain');
		$nama_organisasi = $this->input->post('nama_organisasi');
		$nama_istri = $this->input->post('nama_istri');
		$anggota_otonom = $this->input->post('anggota_otonom');
		$jumlah_anak = $this->input->post('jumlah_anak');
		$old_foto = $this->input->post('old_foto');

		// $cek_nomor = $this->m_anggota->cek_nomor($nomor_anggota, $anggota_id)->num_rows();
		// if($cek_nomor > 0){
		// 	$this->session->set_flashdata('type', 'danger');
		// 	$this->session->set_flashdata('message', 'Nomor anggota sudah dipakai, silakan cek kembali.');

		// 	header('location:'.$_SERVER['HTTP_REFERER']); die();
		// }

		if(isset($_FILES['foto']['name']) && $_FILES['foto']['tmp_name']){
			$config['upload_path'] = './media/foto/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = true;
			 
			$this->load->library('upload', $config);
			 
			if ( ! $this->upload->do_upload('foto')){
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Terjadi kesalahan saat upload foto, silakan ulangi lagi.');

				header('location:'.$_SERVER['HTTP_REFERER']); die();
			}else{
				$foto = $this->upload->data('file_name');
				unlink($config['upload_path'].$old_foto);
			}
		}else $foto = $old_foto;

		$data = array(
			'nomor_anggota' => $nomor_anggota,
			'nama_lengkap' => $nama_lengkap,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'status_nikah' => $status_nikah,
			'golongan_darah' => $golongan_darah,
			'email' => $email,
			'telepon' => $telepon,
			'whatsapp' => $whatsapp,
			'alamat' => $alamat,
			'nomor_ktp' => $nomor_ktp,
			'tahun_masuk' => $tahun_masuk,
			'jamaah_id' => $jamaah,
			'hobi' => $hobi,
			'keahlian' => $keahlian,
			'pekerjaan_id' => $pekerjaan,
			'pekerjaan_lain' => $pekerjaan_lain,
			'nama_instansi' => $nama_instansi,
			'sampingan' => $sampingan,
			'pekerjaan_sampingan' => $pekerjaan_sampingan,
			'pendidikan_id' => $pendidikan,
			'pendapatan_id' => $pendapatan,
			'tanggungan_id' => $tanggungan,
			'organisasi_lain' => $organisasi_lain,
			'nama_organisasi' => $nama_organisasi,
			'nama_istri' => $nama_istri,
			'anggota_otonom' => $anggota_otonom,
			'jumlah_anak' => $jumlah_anak,
			'foto' => $foto
		);

		$this->m_anggota->update_anggota('sn_anggota', $data, $anggota_id);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data anggota berhasil diedit.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function hapus_anggota($anggota_id=0){
		$foto = $this->m_anggota->get_foto($anggota_id)->row();
		unlink('./media/foto/'.$foto->foto);

		$this->m_anggota->delete_anggota('sn_anggota', $anggota_id);
		$this->m_anggota->delete_riwayat('sn_riwayat', $anggota_id);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Data anggota berhasil dihapus.');

		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function ekspor($jamaah_id=0)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Nomor Anggota');
		$sheet->setCellValue('C1', 'Nama Lengkap');
		$sheet->setCellValue('D1', 'Tempat Lahir');
		$sheet->setCellValue('E1', 'Tanggal Lahir');
		$sheet->setCellValue('F1', 'Status Menikah');
		$sheet->setCellValue('G1', 'Golongan Darah');
		$sheet->setCellValue('H1', 'Email');
		$sheet->setCellValue('I1', 'Nomor Telepon');
		$sheet->setCellValue('J1', 'Nomor WhatsApp');
		$sheet->setCellValue('K1', 'Alamat');
		$sheet->setCellValue('L1', 'Nomor KTP');
		$sheet->setCellValue('M1', 'Tahun Masuk');
		$sheet->setCellValue('N1', 'Jamaah');
		$sheet->setCellValue('O1', 'Hobi');
		$sheet->setCellValue('P1', 'Keahlian');
		$sheet->setCellValue('Q1', 'Pekerjaan Pokok');
		$sheet->setCellValue('R1', 'Instansi Pekerjaan');
		$sheet->setCellValue('S1', 'Pekerjaan Sampingan');
		$sheet->setCellValue('T1', 'Pendidikan');
		$sheet->setCellValue('U1', 'Pendapatan');
		$sheet->setCellValue('V1', 'Tanggungan');
		$sheet->setCellValue('W1', 'Organisasi Lain');
		$sheet->setCellValue('X1', 'Foto');
		$sheet->setCellValue('Y1', 'Nama Istri');
		$sheet->setCellValue('Z1', 'Anggota Otonom Persis');
		$sheet->setCellValue('AA1', 'Jumlah Anak');
		$sheet->setCellValue('AB1', 'Waktu Input');
		
		$anggota = $this->m_anggota->get_anggota($jamaah_id)->result();
		$no = 1; $x = 2;

		// $nikah = ''; $otonom = ''; $pekerjaan = '';
		foreach($anggota as $row){
			if($row->status_nikah=='Y') $nikah = 'Menikah'; else $nikah = 'Belum Menikah';
			if($row->anggota_otonom=='Y') $otonom = 'Ya'; else $otonom = 'Tidak';
			if($row->pekerjaan_id==6) $pekerjaan = $row->pekerjaan_lain; else $pekerjaan = $row->pekerjaan;

			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValueExplicit('B'.$x, $row->nomor_anggota, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('C'.$x, $row->nama_lengkap);
			$sheet->setCellValue('D'.$x, $row->tempat_lahir);
			$sheet->setCellValue('E'.$x, date('d-m-Y', strtotime($row->tanggal_lahir)));
			$sheet->setCellValue('F'.$x, $nikah);
			$sheet->setCellValue('G'.$x, $row->golongan_darah);
			$sheet->setCellValue('H'.$x, $row->email);
			$sheet->setCellValue('I'.$x, $row->telepon);
			$sheet->setCellValue('J'.$x, $row->whatsapp);
			$sheet->setCellValue('K'.$x, $row->alamat);
			$sheet->setCellValueExplicit('L'.$x, $row->nomor_ktp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('M'.$x, $row->tahun_masuk);
			$sheet->setCellValue('N'.$x, $row->jamaah);
			$sheet->setCellValue('O'.$x, $row->hobi);
			$sheet->setCellValue('P'.$x, $row->keahlian);
			$sheet->setCellValue('Q'.$x, $pekerjaan);
			$sheet->setCellValue('R'.$x, $row->nama_instansi);
			$sheet->setCellValue('S'.$x, $row->pekerjaan_sampingan);
			$sheet->setCellValue('T'.$x, $row->pendidikan);
			$sheet->setCellValue('U'.$x, $row->pendapatan);
			$sheet->setCellValue('V'.$x, $row->tanggungan);
			$sheet->setCellValue('W'.$x, $row->nama_organisasi);
			$sheet->setCellValue('X'.$x, $row->foto);
			$sheet->setCellValue('Y'.$x, $row->nama_istri);
			$sheet->setCellValue('Z'.$x, $otonom);
			$sheet->setCellValue('AA'.$x, $row->jumlah_anak);
			$sheet->setCellValue('AB'.$x, $row->time_entry);
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Data Sensus Anggota';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}