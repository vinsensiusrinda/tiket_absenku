<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_kelengkapan_file_m extends CI_Model {
    var $table = 'data_kelengkapan_file';

    public function getDataId($id_kelengkapan_file=null){
        $select = $this->db->select("id_kelengkapan_file,nama_dokumen,file")
                            ->from($this->table)
                            ->where("MD5(id_kelengkapan_file)",$id_kelengkapan_file)
                            ->get()
                            ->row();
        return $select;
    }

    public function getListData($id_karyawan=null){
        $select = $this->db->select("id_kelengkapan_file,nama_dokumen,file")
                            ->from($this->table)
                            ->where("MD5(id_karyawan)",$id_karyawan)
                            ->get()
                            ->result();
        return $select;
    }

    public function save($data,$id = null){
        $id_company = $this->session->userdata('id_company');
        if($id != null){
            $this->db->where('md5(id_kelengkapan_file)',$id);
            $this->db->where('id_company',$id_company);
            $tgl_update = array('tanggal_update' => date("Y-m-d H:i:s"));
            $update = $this->db->update('data_kelengkapan_file',array_merge($data, $tgl_update));
            $new_params["new_params"] = ["file"=>$data["file"]];
            return __response_update($update,$new_params);
        }else{
            $nextId = $this->fungsi->getNextId('data_kelengkapan_file','id_kelengkapan_file',$id_company,4);
            $id_kelengkapan_file = array('id_kelengkapan_file' => $nextId);
            $save = $this->db->insert('data_kelengkapan_file', array_merge($data, $id_kelengkapan_file));
            return __response_save($save);
        }
        
    }

    public function delete($id_kelengkapan_file=null){
        $id_company = $this->session->userdata('id_company');
        $predir_foto = $this->db->select("file")
                                    ->from($this->table)
                                    ->where("md5(id_kelengkapan_file)",$id_kelengkapan_file)
                                    ->where("id_company",$id_company)
                                    ->get()
                                    ->row("file");

        $this->db->where('md5(id_kelengkapan_file)',$id_kelengkapan_file);
        $this->db->where('id_company',$id_company);
        $delete =$this->db->delete($this->table);
        if($delete){                                    
            $this->fungsi->delete_fileupload($predir_foto);
            return __response_delete(true);
        }else{
            return __response_delete(false);
        }
    }

}