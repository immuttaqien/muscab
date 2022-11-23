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
			'jamaah' => $this->m_formulir->daftar_jamaah()->result(),
			// 'pekerjaan' => $this->m_formulir->daftar_pekerjaan()->result(),
			// 'pendidikan' => $this->m_formulir->daftar_pendidikan()->result(),
			// 'pendapatan' => $this->m_formulir->daftar_pendapatan()->result(),
			// 'tanggungan' => $this->m_formulir->daftar_tanggungan()->result()
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

		$this->session->sess_destroy();

		redirect('riwayat/index/'.$anggota_id);
	}
}
