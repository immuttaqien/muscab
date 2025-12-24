<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Data extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_anggota');
    }

    function index_get() {
		$daftar = $this->m_anggota->daftar_anggota(0)->result();
		$this->response($daftar, 200);
    }
}