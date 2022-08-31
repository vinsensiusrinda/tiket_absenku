<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_not_found extends MY_Controller {

	public function __construct(){
        parent::__construct();
    }

	public function index(){
		$data['judul'] = 'Halaman Tidak Ditemukan';
		$this->load->view('page_not_found');
	}
}
