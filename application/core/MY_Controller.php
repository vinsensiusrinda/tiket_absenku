<?php

class MY_Controller extends CI_Controller{
    public $MY_response;
    public function __construct(){
        parent::__construct();
        $this->MY_response['csrf_token'] = $this->security->get_csrf_hash();

        $this->id_user      = $this->session->userdata('id_user');
        $this->nama_user    = $this->session->userdata('nama_user');
        $this->level_user   = $this->session->userdata('level_user');
    }
}