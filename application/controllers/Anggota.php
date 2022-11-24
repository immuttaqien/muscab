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
			'jamaah' => $this->m_anggota->daftar_jamaah()->result(),
			'anggota' => $this->m_anggota->daftar_anggota($jamaah_id)->result()
		);

		$this->load->view('content/v_anggota', $data);
		$this->load->view('template/v_footer');
	}

	public function lihat_alasan()
    {
    	$anggota_id = $this->input->post('anggota_id');
    	$alasan = $this->m_anggota->lihat_alasan($anggota_id)->row();

    	echo $alasan->alasan;
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

	public function download($jamaah_id=0)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'NPA');
		$sheet->setCellValue('C1', 'Nama Lengkap');
		$sheet->setCellValue('D1', 'Jamaah');
		$sheet->setCellValue('E1', 'Email');
		$sheet->setCellValue('F1', 'Nomor HP');
		$sheet->setCellValue('G1', 'Kehadiran');
		$sheet->setCellValue('H1', 'Alasan');
		$sheet->setCellValue('I1', 'Waktu Konfirmasi');
		
		$anggota = $this->m_anggota->daftar_anggota($jamaah_id)->result();
		$no = 1; $x = 2;

		foreach($anggota as $row){
			if($row->kehadiran=='1') $kehadiran = 'Hadir'; elseif($row->kehadiran=='2') $kehadiran = 'Tidak Hadir'; elseif($row->kehadiran=='3') $kehadiran = 'Ragu-Ragu'; else $kehadiran = 'Belum Konfirmasi';
			if($row->alasan) $alasan = $row->alasan; else $alasan = '-';
			if($row->kehadiran==0) $waktu = '-'; else $waktu = $row->time_entry;
			if($row->email) $email = $row->email; else $email = '-';
			if($row->handphone) $handphone = $row->handphone; else $handphone = '-';

			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValueExplicit('B'.$x, $row->npa, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('C'.$x, $row->nama_lengkap);
			$sheet->setCellValue('D'.$x, $row->jamaah);
			$sheet->setCellValue('E'.$x, $email);
			$sheet->setCellValueExplicit('F'.$x, $handphone, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('G'.$x, $kehadiran);
			$sheet->setCellValue('H'.$x, $alasan);
			$sheet->setCellValue('I'.$x, $waktu);
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Daftar Konfirmasi Kehadiran Anggota Musyawarah Cabang XII Pemuda Persis Banjaran';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}