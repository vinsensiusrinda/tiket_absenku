<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kelengkapan_file extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Data_kelengkapan_file_m');
        $this->load->library('Uploadfile');
    }

    public function index($id_karyawan = null){
        $data['id_karyawan'] = $id_karyawan;
		$this->load->view('karyawan/data_kelengkapan_file/home', $data);
	}

    public function list_data($id_karyawan = null){
		$data['data'] = $this->Data_kelengkapan_file_m->getListData($id_karyawan);
		$this->load->view('karyawan/data_kelengkapan_file/list_data', $data);
	}

	public function form($id_karyawan=null, $id_kelengkapan_file=null){
		$data['id_karyawan'] = $id_karyawan;
		if($id_kelengkapan_file != null){
			$data['data'] = $this->Data_kelengkapan_file_m->getDataId($id_kelengkapan_file);
		}
		$this->load->view('karyawan/data_kelengkapan_file/form', $data);
	}

	public function save(){
		$id = $this->input->post('id_kelengkapan_file');
        $id_karyawan = $this->fungsi->decrypt_idkaryawan($this->input->post('id_karyawan'));
        $id_company = $this->session->userdata('id_company');
		$nama_dokumen = $this->input->post('nama_dokumen');

		$file_lama = $this->input->post('file_lama');

		$file1 = $_FILES['file'];
        if($file1['name'] == ""){
            $file = $file_lama;
        }else{
            $fileUpload['fname']    = 'file';
            $fileUpload['location'] = 'karyawan/'.$id_karyawan.'/kelengkapan-file';
            $fileUpload['allowed']  = 'jpg|png|jpeg';
            $fileUpload['compress_image']  = true;

            $upload = $this->uploadfile->doUpload($fileUpload);
			if($upload["success"] == true){
				$file = $upload['url'];
				if(!empty($file_lama)){
					if($file != $file_lama){
						$this->fungsi->delete_fileupload($file_lama);
					}
				}
			}else{
				$message = ["message"=>$upload["message"]];
				return __response_save(false,["params"=>$message]);
			}
            
        }

		$data = array('nama_dokumen'	 =>$nama_dokumen,
					'file'				 =>$file,
					'id_company'		 =>$id_company,
					'id_karyawan'		 =>$id_karyawan);
	
		$this->Data_kelengkapan_file_m->save($data,$id); 
	}

	public function delete(){
		$id = $this->input->post("id_kelengkapan_file");
		$this->Data_kelengkapan_file_m->delete($id);
	}
}
