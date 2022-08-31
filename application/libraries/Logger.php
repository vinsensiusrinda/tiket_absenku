<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logger{

    function create_log($module, $action, $query = '', $username_try = '') {
        $CI = & get_instance();
        $CI->load->model('db_model');

        if($username_try != '') {
            $username = $username_try;
        } else {
            $username = $CI->session->userdata('username');
        }
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'username' => $username
            , 'waktu' => date('Y-m-d h:i:s')
            , 'modul' => $module
            , 'action' => $action
            , 'query' => $query
            , 'id_company' => $CI->session->userdata('id_company')
        );

        if ($CI->db_model->add('log_aktivitas', $data)) {
            return true;
        }else{
            return false;
        }
    }

	function log_notifikasi($module, $query = '', $id, $status) {
        $CI = & get_instance();
        $CI->load->model('db_model');

        $data = array(
            'waktu' => date('Y-m-d h:i:s')
            , 'modul' => $module
            , 'query' => $query
			, 'id_karyawan' => $id
			, 'status' => $status
        );

        if ($CI->db_model->add('log_notifikasi', $data)) {
            return true;
        }else{
            return false;
        }
    }

}
