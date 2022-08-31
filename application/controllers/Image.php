<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends MY_Controller {
    
    public function index(){
        $location = dirname($_SERVER['DOCUMENT_ROOT']);
        $type = $_GET['_t'];
        $dir = $_GET['_d'];
        $filename    = $location.'/uploads/'.$dir;
		if(empty($dir)){
			$filename = __file_exists($type);
		}else{
			if(file_exists($filename)){ 
				$filename = $filename;
			}else{
				$filename = __file_exists($type);
			}
		}

        $mime = mime_content_type($filename); //<-- detect file type
        switch($mime) {
            case "image/gif": 
                $ctype = "image/gif";
                break;
            case "image/png": 
                $ctype = "image/png";
                break;
            case "image/jpeg":
            case "image/jpg": 
                $ctype = "image/jpeg";
                break;
            case "image/svg": 
                $ctype = "image/svg+xml";
                break;
            default:
        }
        header('Content-Length: '.filesize($filename)); //<-- sends filesize header
        header("Content-Type: $ctype"); //<-- send mime-type header
        header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
        readfile($filename); //<--reads and outputs the file onto the output buffer
    }
}