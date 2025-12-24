<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Npa extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kehadiran');
    }

    function index_get($npa=0) {
        if($npa!=0){
            $cek_npa = $this->m_kehadiran->cek_npa($npa)->num_rows();

            if($cek_npa < 1){
                $response['status'] = false;
                $response['code'] = 401;
                $response['message'] = 'NPA tidak terdaftar.';

                $this->response($response);
            }else{
                $detail = $this->m_kehadiran->data_npa($npa)->row();

                $response['status'] = true;
                $response['code'] = 200;
                $response['message'] = 'success';
                $response['npa'] = $detail->npa;
                $response['nama_lengkap'] = $detail->nama_lengkap;
                $response['jamaah_id'] = $detail->jamaah_id;
                $response['nama_jamaah'] = $detail->nama_jamaah;
                $response['tempat_lahir'] = $detail->tempat_lahir;
                $response['tanggal_lahir'] = $detail->tanggal_lahir;
                $response['email'] = $detail->email;
                $response['handphone'] = $detail->handphone;

                $this->response($response);
            }
        }else{
            $response['status'] = false;
            $response['code'] = 401;
            $response['message'] = 'Silakan lengkapi NPA.';

            $this->response($response);
        }
    }
}