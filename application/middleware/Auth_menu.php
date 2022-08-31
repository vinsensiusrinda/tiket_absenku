<?php
# application/middleware/TestMiddleware.php

class Auth_menu implements Luthier\MiddlewareInterface{

    public function run($args = []){
        $allow = explode(",",$args);
        $level_user = ci()->session->userdata('level_user');

        if(in_array($level_user,$allow)){
            return;
        }else{
            redirect(route('page.not.found'));
        }
    }
}