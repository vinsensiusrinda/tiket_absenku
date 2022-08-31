<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	  public function import()
    {
        $company = $this->session->userdata('id_company');
        $where_company = "id_company = '$company'";
        $cabang = $this->input->post('id_cabang');
        $divisi = $this->input->post('id_departemen');
        //$targetFolder = '.template/shift/';
        //$mulai = strtotime($this->convertion->reverse_date2($this->input->post('tanggal_mulai')));
        $mulai = $this->input->post('tanggal_mulai');
        $tgl = date('Y-m-d', $mulai);
        //$selesai = strtotime($this->convertion->reverse_date2($this->input->post('tanggal_akhir')));
        $selesai = $this->input->post('tanggal_akhir');
        //buat array id karyawan
        $karyawan = $this->Pengaturan_shift_m->karyawan($company, $cabang, $divisi);
        $id_karyawan = array();
        $nik_karyawan = array();
        $divisi_karyawan = array();
        foreach ($karyawan->result() as $row) {
          array_push($id_karyawan, $row->id_karyawan);
          array_push($nik_karyawan, $row->nik);
          array_push($divisi_karyawan, $row->id_departemen);
        }

        //buat array shift
        $shift = $this->Pengaturan_shift_m->shift($company, $cabang);
        $id_shift = array();
        $kode_shift = array();
        $insert_shift = array();
        $delete_shift = array();
        foreach ($shift->result() as $row) {
          array_push($id_shift, $row->id_master_shift);
          array_push($kode_shift, $row->kode_shift);
        }

        if (!empty($_FILES['file'])) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetFolder = "./templates/import_shift/";

            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0777, TRUE); //create the folder if it's not already exists
            }
            $name = $_FILES['file']['name'];
            $fileParts = pathinfo($name);
            $nama_company_trim4 = substr(trim($this->Pengaturan_shift_m->nama_company_trim4($company)),0,4);
            $targetName = $company.'_'.$nama_company_trim4.'_'.$cabang.'_'.$mulai.'_'.rand().'.'.$fileParts['extension'];
            $targetFile = $targetFolder . $targetName;
            // Validate the file type
            $fileTypes = array('xls', 'xlsx', 'csv'); // File extensions
            $fileSize = $_FILES['file']['size'];
            for ($seq = 1; file_exists($targetFile); $seq++) {
                if (file_exists($targetFile)) {
                    $targetName = substr($fileParts['basename'], 0, strlen($fileParts['basename']) - strlen($fileParts['extension']) - 1) . '_' . $seq . '.' . $fileParts['extension'];
                    $targetFile = $targetFolder . $targetName;
                }
            }
            if (in_array($fileParts['extension'], $fileTypes)) {
                if (move_uploaded_file($tempFile, $targetFile)) {
                  
                   /* $this->load->library('PHPExcel');

                    $inputFileName = $targetFile;
                    try {
                        require_once APPPATH.'libraries/PHPExcel/IOFactory.php';
                        $objPHPExcel = IOFactory::load($inputFileName);
                    } catch (Exception $e) {
                        echo 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();
                        exit;
                    }*/
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($targetFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($targetFile);
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($dir_file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                    }

                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $error = 0;
                    if( sizeof($sheetData) < 3 OR
                        $sheetData[1]["B"] != "NIP" OR
                        $sheetData[1]["C"] != "Tanggal" OR
                        $sheetData[2]["C"] != "Nama / Hari"){
                        $msg = "format excel tidak sesuai template";
                        $json['status'] = $msg;
                        unlink($inputFileName);
                    } else {
                        $end = sizeof($sheetData);
                        for ($i = 3; $i <= $end; $i++) {
                            if( $sheetData[$i]["B"] == "" AND $sheetData[$i]["C"] == "" AND $sheetData[$i]["D"] == "") {
                                $json['status'] = "berhasil";
                                $json['alert'] = "Berhasil import data shift";
                                break;
                            }
                            $nip = $sheetData[$i]['B'];
                            if ($nip == '') {
                                //hapus file jika tidak sesuai
                                unlink($targetFile);
                                echo "NIP kosong pada baris ke $i";
                                exit;
                            }

                            if (!in_array($nip, $nik_karyawan)) {
                                //hapus file jika tidak sesuai
                                unlink($targetFile);
                                echo "NIP '$nip' tidak ditemukan di sistem";
                                exit;
                            }

                            $num_col = 4;
                            $current = $mulai;
                            $last = $selesai;
                            while ($current <= $last) {
                                $chr_col = $this->getNameFromNumber($num_col);
                                //jika shift addslashes
                                //variabel baris kolom
                                $cell = trim($sheetData[$i][$chr_col]);
                                $cari_array = array_search($cell, $kode_shift);
                                if($cari_array !== false) {
                                  $kode_shift_import = $id_shift[$cari_array];
                                } else {
                                  //jika shift kosong
                                  if($sheetData[$i][$chr_col] == "") {
                                      //hapus file jika tidak sesuai
                                      unlink($targetFile);
                                      echo "Kode shift kolom $chr_col baris ke $i kosong";
                                      exit;
                                  } elseif($sheetData[$i][$chr_col] == "-") {
                                      $kode_shift_import = "-";
                                  } else {
                                      $kode_shift_import = $sheetData[$i][$chr_col];
                                      //hapus file jika tidak sesuai
                                      unlink($targetFile);
                                      echo "Kode shift $kode_shift_import kolom $chr_col baris ke $i tidak ditemukan di dalam sistem, silahkan menambahkan kode shift terlebih dahulu";
                                      exit;
                                  }
                                }

                                //$date = date('Y-m-d', $current);
                                $divisi_array = array_search($nip, $nik_karyawan);
                                if($divisi_array !== false) {
                                  $divisi_import = $divisi_karyawan[$divisi_array];
                                  $id_karyawan_import = $id_karyawan[$divisi_array];
                                } else {
                                  $divisi_import = $divisi;
                                  $id_karyawan_import = $nip;
                                }

                                $data_add = array(
                                    'id_karyawan' => $id_karyawan_import,
                                    'tanggal' => $current,
                                    'id_master_shift' => $kode_shift_import,
                                    'id_company' => $company,
                                    'id_departemen' => $divisi_import,
                                    'id_cabang' => $cabang
                                );
                                //cek jika sudah terdapat shift atau belum di data shift karyawam
                                $query = $this->Pengaturan_shift_m->cek_shift($id_karyawan_import, $current, $company);
                                //jika belum ada
                                if ($query->num_rows() > 0) {
                                  //jika sudah ada maka masuk list hapus
                                  foreach ($query->result() as $row) {
                                      array_push($delete_shift, $row->id_shift_karyawan);
                                  }
                                }
                                array_push($insert_shift, $data_add);
                                $current = strtotime("+1 day", $current);
                                $num_col++;
                            }
                        }
                        //cek shift tidak kosong
                        if(!empty($delete_shift)) {
                          //hapus Multiple
                          $this->Pengaturan_shift_m->hapus_multiple_id_shift($delete_shift);
                        }

                        //insert multiple
                        $this->Pengaturan_shift_m->insert_multiple_shift($insert_shift);

                        $json['status'] = "berhasil";
                        $json['alert'] = "Berhasil import data shift";
                        $this->logger->create_log('daftar shift', 'import', $targetName);
                    }
                } else {
                    $json['status'] = "Gagal Import Data tiga";
                }
            } else {
                $json['status'] = "Gagal Import Data dua";
            }
        } else {
            $json['status'] = "Gagal Import Data satu";
        }
        echo json_encode($json);
    }

     public function import_lawas() {
        $company = $this->session->userdata('id_company');
        $where_company = "id_company = '$company'";

        $this->logger->create_log('daftar shift', 'import');
         $targetFolder = "./templates/import_shift/";

            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0777, TRUE); //create the folder if it's not already exists
            }
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];

            $targetName = $_FILES['file']['name'];
            $targetFile = $targetFolder . $targetName;
            // Validate the file type
            $fileTypes = array('xls', 'xlsx', 'csv'); // File extensions
            $fileParts = pathinfo($_FILES['file']['name']);
            $fileSize = $_FILES['file']['size'];
            for ($seq = 1; file_exists($targetFile); $seq++) {
                if (file_exists($targetFile)) {
                    $targetName = substr($fileParts['basename'], 0, strlen($fileParts['basename']) - strlen($fileParts['extension']) - 1) . '_' . $seq . '.' . $fileParts['extension'];
                    $targetFile = $targetFolder . $targetName;
                }
            }
            if (in_array($fileParts['extension'], $fileTypes)) {
                if (move_uploaded_file($tempFile, $targetFile)) {
                    /** Include path * */
                    //  set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');
                    /** PHPExcel_IOFactory */
                    /*$this->load->library('PHPExcel');

                    $inputFileName = $targetFile;
                    try {
                        require_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
                        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
                    } catch (Exception $e) {
                        echo 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();
                        exit;
                    }*/

                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($targetFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($targetFile);
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($dir_file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                    }

                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    //var_dump($sheetData);

                    for ($i = 3; $i <= sizeof($sheetData); $i++) {
                        if ($sheetData[$i]['B'] == '') {
                            break;
                        }
                        // $current = strtotime($this->convertion->reverse_date2($this->input->post('tgl_mulai_imp')));
                        $current = $this->input->post('tanggal_mulai');
                        // $last = strtotime($this->convertion->reverse_date2($this->input->post('tgl_akhir_imp')));
                        $last = $this->input->post('tanggal_akhir');
                        $num_col = 4;
//                        echo '---'.date('Y-m-d', $last).'---';
                        while ($current <= $last) {
                            $chr_col = $this->getNameFromNumber($num_col);
                            $date = date('Y-m-d', $current);
                            $data_add = array(
                                'id_karyawan' => $sheetData[$i]['B']
                                , 'tanggal' => $current
                                , 'id_master_shift' => (int) $this->fungsi->kode_to_id_shift(trim($sheetData[$i][$chr_col]), $company)
                                , 'id_departemen' => $this->input->post('id_departemen')
                                , 'id_cabang' => $this->input->post('id_cabang')
                                , 'id_company' => $company
                            );

                            $query = $this->db->query("SELECT id_shift_karyawan FROM data_shift_karyawan WHERE id_karyawan = '" . $sheetData[$i]['B'] . "' AND tanggal = '" . $date . "'");
                            $data_shift_exist = $query->row();

                            if (count($data_shift_exist) == 0) {
                                if ($data_add['id__master_shift'] > 0) {
                                    $this->db_model->add('data_shift_karyawan', $data_add);
                                    $this->logger->create_log('data_shift_karyawan', 'add', $this->db->last_query());
                                }
                            } else {
//                            print_r($data_add).'<br>';
                                if ($data_add['id_master_shift'] > 0) {
                                    $this->db_model->update('data_shift_karyawan', $data_add, array('id_shift_karyawan' => $data_shift_exist->id_shift_karyawan));
                                } else if ($data_add['id_shift'] == 0) {
                                    $this->db->where('id_shift_karyawan', $data_shift_exist->id_shift_karyawan)->delete('data_shift_karyawan');
                                }
                            }
                            $current = strtotime("+1 day", $current);
                            $num_col++;
                        }
                    }
//                    exit;
                    unlink($targetFile);
                    $json['status'] = "berhasil";
                    $json['alert'] = "Berhasil import data shift";
                } else {
                   $json['status'] = "Gagal Import Data tiga";
                }
            } else {
                $json['status'] = "Gagal Import Data tiga";
            }
        } else {
            $json['status'] = "Gagal Import Data tiga";
        }
        echo json_encode($json);
    }
}
