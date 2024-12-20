<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Npa extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kehadiran');
    }

    function index_get($anggota_id=0) {
        if($anggota_id!=0){
            $cek_anggota = $this->m_kehadiran->cek_anggota($anggota_id)->num_rows();

            if($cek_anggota < 1){
                $response['status'] = false;
                $response['code'] = 401;
                $response['message'] = 'ID anggota tidak terdaftar.';

                $this->response($response);
            }else{
                $detail = $this->m_kehadiran->data_anggota($anggota_id)->row();

                $response['status'] = true;
                $response['code'] = 200;
                $response['message'] = 'success';
                $response['niat'] = $detail->npa;
                $response['nama_lengkap'] = $detail->nama_lengkap;
                $response['jamaah_id'] = $detail->jamaah_id;
                $response['nama_jamaah'] = $detail->nama_jamaah;
                $response['checkin'] = $detail->checkin;
                $response['waktu_checkin'] = $detail->time_checkin;
                $response['pemilihan'] = $detail->election;
                $response['waktu_pemilihan'] = $detail->time_election;

                $this->response($response);
            }
        }else{
            $response['status'] = false;
            $response['code'] = 401;
            $response['message'] = 'Silakan lengkapi ID anggota.';

            $this->response($response);
        }
    }
}