<?php
/*
|--------------------------------------------------
| example new params
|--------------------------------------------------
| $params = array("type"=>"replace",
|                 "message"=>'<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Kode sudah digunakan</font>',
|                 "new_params" => array("id_karyawan" => 124242,
|                                         "id_cabang" => 12313));
*/

    function __response($response, $output){
        foreach($output as $key => $value){
			$response[$key] = $value;
        }

        return $response;
    }


    function __response_save($save = false, $params = null){
        $ci = &get_instance();

        if($save){

            $type    = "save";
            $message = '<font color="#009900"><i class="fa fa-check-square">&nbsp;</i>Data berhasil disimpan</font>';

            if($params !== null){
                if(isset($params['type']) && !empty($params['type'])){
                    $type = $params['type'];
                }

                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }
            }

            $output = array('success'=>true,
                            'type'=>$type,
                            'message'=>$message);
        }else{

            $message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Data gagal disimpan</font>';

            if($params !== null){
                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }
            }

            $output = array('success'=>false,
                            'message'=>$message);
        }

        $response = $ci->MY_response;
        foreach($output as $key => $value){
			$response[$key] = $value;
        }

        if($params !== null && isset($params['new_params'])){
            $response = array_merge($response,$params['new_params']);
        }

        echo json_encode($response);
    }

    function __response_update($update = false, $params = null){
        $ci = &get_instance();
        if($update){
            $type    = "update";
            $message = '<font color="#009900"><i class="fa fa-check-square">&nbsp;</i>Data berhasil diperbarui</font>';

            if($params !== null){
                if(isset($params['type']) && !empty($params['type'])){
                    $type = $params['type'];
                }

                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }

            }

            $output = array('success'=>true,
                            'type'=>$type,
                            'message'=>$message);
        }else{
            $message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Data gagal diperbarui</font>';

            if($params !== null){
                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }
            }

            $output = array('success'=>false,
                            'message'=>$message);
        }

        $response = $ci->MY_response;
        foreach($output as $key => $value){
			$response[$key] = $value;
        }

        if($params !== null && isset($params['new_params'])){
            $response = array_merge($response,$params['new_params']);
        }

        echo json_encode($response);
    }

    function __response_delete($delete = false, $params = null){
        $ci = &get_instance();
        if($delete){
            $message = '<font color="#009900"><i class="fa fa-check-square">&nbsp;</i>Data berhasil dihapus</font>';
            if($params !== null){
                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }
            }

            $output = array('success'=>true,
                            'message'=>$message);
        }else{
            $message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Data gagal dihapus</font>';
            if($params !== null){
                if(isset($params['message']) && !empty($params['message'])){
                    $message = $params['message'];
                }
            }
            $output = array('success'=>false,
                            'message'=>$message);
        }

        $response = $ci->MY_response;
        foreach($output as $key => $value){
			$response[$key] = $value;
        }

        echo json_encode($response);
    }

    function __response_duplicate(){
        $ci = &get_instance();

        $output = array('success'=>false,
                        'message'=>'<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>GAGAL, data sudah ada</font>');

        $response = $ci->MY_response;
        foreach($output as $key => $value){
			$response[$key] = $value;
        }

        echo json_encode($response);
    }

    function __response_update_reimburse($update,$flag){
        $ci = &get_instance();
        if($flag == '3'){
                $message = '<font color="#ff0000"><i class="fa fa-exclamation-triangle">&nbsp;</i>Data reimburse ditolak</font>';
            }elseif($flag == '4'){
                $message = '<font color="#fd7f00"><i class="fa fa-pencil-square-o">&nbsp;</i>Data berhasil diproses, data akan dikembalikan karyawan untuk direvisi</font>';
            }else{
                $message = '<font color="#009900"><i class="fa fa-check-square">&nbsp;</i>Data berhasil diproses</font>';
            }
        if($update){
            $output = array('success'=>true,
                            'message'=>$message);
        }else{
            $output = array('success'=>false,
                            'message'=>'<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Data gagal diproses</font>');
        }

        $response = $ci->MY_response;
        foreach($output as $key => $value){
            $response[$key] = $value;
        }

        echo json_encode($response);
    }
