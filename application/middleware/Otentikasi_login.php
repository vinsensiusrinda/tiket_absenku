<?php
# application/middleware/TestMiddleware.php

class Otentikasi_login implements Luthier\MiddlewareInterface{

    public function run($args = []){
        if(ci()->session->userdata('id_user') === null){
            redirect(route('login'));
        }else{
            return;
        }

    }
}
