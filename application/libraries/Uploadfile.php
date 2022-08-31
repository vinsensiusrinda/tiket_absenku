<?php
    // error_reporting(0);
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Uploadfile {

        public function __construct(){
            // parent::__construct();
            $this->_ci = & get_instance();
        }

        public function doUpload($opt){
            if(!empty($_FILES[$opt['fname']]['name'])) {

                $mime_type = mime_content_type($_FILES[$opt['fname']]['tmp_name']);

                // If you want to allow certain files
                $allowed_file_types = ['image/png', 'image/jpeg', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
                if (!in_array($mime_type, $allowed_file_types)) {
                    $respon = ['success' => false,
                                'message' => '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Gagal,file upload tidak diperbolehkan</font>'];
                    return $respon;
                    // exit;
                }

                if($_FILES[$opt['fname']]['type'] == 'image/jpeg'){
                    $this->correctImageOrientation($_FILES[$opt['fname']]['tmp_name']);
                }

                if (isset($opt['location'])){
                    $exp = $opt['location'];
                }else{
                    $exp = 'global';
                }

                // profil-karyawan/id_company/nik-name
                // riwayat-pendidikan/id_company/nik/
                // data-keluarga/id_company/nik/
                // data-sertifikat/id_company/nik/
                // profil-perusahan/id_company/

                // absensi/masuk/tahun/bulan/id_company/absensi_masuk
                // absensi/pulang/tahun/bulan/id_company/absensi_masuk
                // absensi/istitahat-mulai/tahun/bulan/id_company/absensi_masuk
                // absensi/istitahat-selesai/tahun/bulan/id_company/absensi_masuk
                // absensi/lembur-mulai/tahun/bulan/id_company/absensi_masuk
                // absensi/lembur-selesai/tahun/bulan/id_company/absensi_masuk
                // absensi/lembur-selesai/tahun/bulan/id_company/absensi_masuk
                // izin/tahun/bulan/id_company/absensi_masuk


                $tgt = $this->_ci->config->item('base_upload').'/';
                $path = $tgt.$exp;

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // $nm_file = $_FILES[$opt['fname']]['name'];
                $nm_file = $this->gen_uuid_v4();
                if(isset($opt['filename'])){
                    $nm_file = $opt['filename']."-".$nm_file;
                }

                $config['file_name'] = $nm_file;
                $config['upload_path'] = $path;
                $config['allowed_types'] = (isset($opt['allowed'])) ? $opt['allowed'] : 'jpg|jpeg|png';
                if (isset($opt['max'])) {
                    $config['max_size'] = $opt['max'];
                }

                $this->_ci->load->library('upload', $config);
                $this->_ci->upload->initialize($config);

                if(!$this->_ci->upload->do_upload($opt['fname'])) {
                    $respon = ['success' => false,
                                'data' => $this->_ci->upload->display_errors()];
                }else{
                    $fileData = $this->_ci->upload->data();

                    if ($opt['compress_image'] === true) {
                        $cfg['image_library'] = 'gd2';
                        $cfg['source_image'] = $path.'/'.$fileData['file_name'];
                        $cfg['create_thumb'] = FALSE;
                        $cfg['maintain_ratio'] = TRUE;
                        $cfg['quality'] = '70%';
                        $cfg['width'] = 1200;
                        $cfg['new_image'] = $path.'/'.$fileData['file_name'];
                        $this->_ci->load->library('image_lib', $cfg);
                        $this->_ci->image_lib->resize();
                    }

                    $uploadData['file_name'] = $exp.'/'.$fileData['file_name'];
                    $uploadData['ori_name'] = $_FILES[$opt['fname']]['name'];

                    $respon = [
                        'success' => true,
                        'data' => $fileData,
                        'url' => $uploadData['file_name'],
                    ];
                }

                return $respon;
            }else{
                $respon = ['success' => false,
                            'message' => '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Gagal,file upload tidak ditemukan</font>'];

                return $respon;
            }
        }

        function gen_uuid_v4() {
            return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                                // 32 bits for "time_low"
                                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

                                // 16 bits for "time_mid"
                                mt_rand( 0, 0xffff ),

                                // 16 bits for "time_hi_and_version",
                                // four most significant bits holds version number 4
                                mt_rand( 0, 0x0fff ) | 0x4000,

                                // 16 bits, 8 bits for "clk_seq_hi_res",
                                // 8 bits for "clk_seq_low",
                                // two most significant bits holds zero and one for variant DCE1.1
                                mt_rand( 0, 0x3fff ) | 0x8000,

                                // 48 bits for "node"
                                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
                        );
        }

        public function correctImageOrientation($filename){
            if (function_exists('exif_read_data')) {
                $image = file_get_contents($filename);
                $exif = exif_read_data($filename, 'IFD0');
                // dump(file_exists($filename));
                // dump($exif);
                // exit;
                if ($exif && isset($exif['Orientation'])) {
                    $orientation = $exif['Orientation'];
                    if ($orientation != 1) {
                        $img = imagecreatefromjpeg($filename);
                        $deg = 0;
                        switch ($orientation) {
                            case 3:
                                $deg = 180;
                                break;
                            case 6:
                                $deg = 270;
                                break;
                            case 8:
                                $deg = 90;
                                break;
                        }
                        if ($deg) {
                            $img = imagerotate($img, $deg, 0);
                        }
                        // then rewrite the rotated image back to the disk as $filename
                        imagejpeg($img, $filename, 95);
                    } // if there is some rotation necessary
                } // if have the exif orientation info
            } // if function exists

            // $fp = fopen(FCPATH.'uploads/'.$fname.'.json', 'w');
            // fwrite($fp, json_encode($exif, JSON_PRETTY_PRINT));
            // fclose($fp);
        }
    }