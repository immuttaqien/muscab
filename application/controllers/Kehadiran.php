<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Kehadiran extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kehadiran');
    }

    function index_get($jamaah_id=0) {
        $daftar_kehadiran = $this->m_kehadiran->daftar_kehadiran($jamaah_id)->result();

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = '';
        $response['total_konfirmasi'] = $daftar_kehadiran[0]->total_hadir;
        $response['total_kehadiran'] = $daftar_kehadiran[0]->total_checkin;

        $i = 0;
        foreach($daftar_kehadiran as $kehadiran){
            $response['jamaah'][$i]['jamaah_id'] = (int)$kehadiran->jamaah_id;
            $response['jamaah'][$i]['nama_jamaah'] = $kehadiran->jamaah;
            $response['jamaah'][$i]['konfirmasi'] = (int)$kehadiran->hadir;
            $response['jamaah'][$i]['kehadiran'] = (int)$kehadiran->checkin;

            $i++;
        }

        $this->response($response);
    }

    function index_post() {   
        $npa = $this->post('npa');

        if($npa){
            $cek_npa = $this->m_kehadiran->cek_npa($npa)->num_rows();

            if($cek_npa < 1){
                $response['status'] = false;
                $response['code'] = 401;
                $response['message'] = 'NPA tidak terdaftar.';

                $this->response($response);
            }else{
                $data = array(
                    'checkin' => '1'
                );
                $checkin = $this->m_kehadiran->checkin_peserta($data, $npa);

                if($checkin){
                    $response['status'] = true;
                    $response['code'] = 201;
                    $response['message'] = 'Check in berhasil.';

                    $this->response($response);
                }else{
                    $response['status'] = false;
                    $response['code'] = 401;
                    $response['message'] = 'Check in gagal.';

                    $this->response($response);
                }
            }
        }else{
            $response['status'] = false;
            $response['code'] = 401;
            $response['message'] = 'Silakan lengkapi NPA.';

            $this->response($response);
        }
    }
}