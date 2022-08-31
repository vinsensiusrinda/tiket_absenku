<?php
# application/middleware/TestMiddleware.php

class Otentikasi_wizard implements Luthier\MiddlewareInterface{

    public function run($args = []){
        if(ci()->session->userdata('id_karyawan') === null){
            redirect(route('login'));
        }else{
          return;
        }
    }
}
