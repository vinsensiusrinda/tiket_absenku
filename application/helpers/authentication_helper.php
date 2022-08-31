<?php

    function check_login(){
        $ci = &get_instance();
        $route = $ci->uri->segment(1);

        if(isset($_SESSION['level_user'])){
            
            $level_user = $_SESSION['level_user'];

            switch($route) {
                case 'master':
                    if(!in_array($level_user,array('1','5','4'))){
                        redirect('dashboard');
                    }
                break;
            }
            
        }else{
            redirect('login');
        }
        
    }