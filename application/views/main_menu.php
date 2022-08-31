<?php
    $level_user = $this->session->userdata('level_user');
    if($level_user == 1){
        $this->load->view('menu/level_1', $data, false);
    }else if($level_user == 2){
        $this->load->view('menu/level_2', $data, false);
    }else if($level_user == 3){
        $this->load->view('menu/level_3', $data, false);
    }else if($level_user == 4){
        $this->load->view('menu/level_4', $data, false);
    }else if($level_user == 5){
        $this->load->view('menu/level_5', $data, false);
    }else if($level_user == 6){
        $this->load->view('menu/level_6', $data, false);
    }else if($level_user == 7){
        $this->load->view('menu/level_7', $data, false);
    }
?>