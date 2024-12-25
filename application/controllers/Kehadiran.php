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
        $response['message'] = 'success';
        $response['total_kehadiran'] = $daftar_kehadiran[0]->total_hadir;
        $response['total_pemilihan'] = $daftar_kehadiran[0]->total_pemilihan;

        $i = 0;
        foreach($daftar_kehadiran as $kehadiran){
            $response['jamaah'][$i]['jamaah_id'] = (int)$kehadiran->jamaah_id;
            $response['jamaah'][$i]['nama_jamaah'] = $kehadiran->jamaah;
            $response['jamaah'][$i]['kehadiran'] = (int)$kehadiran->hadir;
            $response['jamaah'][$i]['pemilihan'] = (int)$kehadiran->pemilihan;

            $i++;
        }

        $this->response($response);
    }

    function index_post() {   
        $anggota_id = $this->post('anggota_id');

        if($anggota_id){
            $cek_anggota = $this->m_kehadiran->cek_anggota($anggota_id)->num_rows();

            if($cek_anggota < 1){
                $response['status'] = false;
                $response['code'] = 401;
                $response['message'] = 'ID anggota tidak terdaftar.';

                $this->response($response);
            }else{
                $data = array(
                    'checkin' => '1',
                    'time_checkin' => date('Y-m-d H:i:s')
                );
                $checkin = $this->m_kehadiran->checkin_peserta($data, $anggota_id);

                if($checkin){
                    $response['status'] = true;
                    $response['code'] = 201;
                    $response['message'] = 'Check in kehadiran berhasil.';

                    $this->response($response);
                }else{
                    $response['status'] = false;
                    $response['code'] = 401;
                    $response['message'] = 'Check in kehadiran gagal.';

                    $this->response($response);
                }
            }
        }else{
            $response['status'] = false;
            $response['code'] = 401;
            $response['message'] = 'Silakan lengkapi ID anggota.';

            $this->response($response);
        }
    }
}