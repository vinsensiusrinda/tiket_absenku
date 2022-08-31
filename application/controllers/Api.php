<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

    public function __construct(){
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function mulia_land(){
        $tgl_absensi = $this->input->get('tgl_absensi');
        $kode_cabang = $this->input->get('kode_cabang');
        $header = $this->input->request_headers();
        $token = $header['Token'];
        $id_company = '29000'; //MULIALAND
        // $id_company = '1'; //MULIALAND
        $hari_ini = date('Y-m-d');
        if($token === 'absenku-mulialand'){
            $cek_cabang = $this->db->select('id_cabang')
                                ->from('master_cabang')
                                ->where('kode', $kode_cabang)
                                ->where('id_company',$id_company)
                                ->get();
            if($cek_cabang->num_rows() != 0){
                if($tgl_absensi == $hari_ini){
                    $this->db->select('dk.nik,
                                    dk.nama_lengkap as nama_karyawan,
                                    am.tgl_absen,
                                    DATE_FORMAT(am.jam_absen,"%H:%i") as jam_masuk,
                                    DATE_FORMAT(ap.jam_absen,"%H:%i") as jam_pulang,
                                    am.jenis_absen,
                                    mc.nama as nama_cabang,
                                    md.nama as nama_departemen
                            ')
                            ->join('data_karyawan as dk', 'dk.id_karyawan=am.id_karyawan')
                            ->join('master_cabang as mc', 'mc.id_cabang=dk.id_cabang')
                            ->join('master_departemen as md', 'md.id_departemen=dk.id_departemen','left')
                            ->join('absensi_pulang as ap', 'am.id_absensi_masuk=ap.id_masuk', 'left')
                            ->from('absensi_masuk as am')
                            ->where('am.tgl_absen', $tgl_absensi)
                            ->where('mc.kode', $kode_cabang)
                            ->where('am.id_company', $id_company);
        
                    $data_absensi = $this->db->get();
                    // echo $this->db->last_query();exit;
        
                }else{
                    $this->db->select('nik,
                                    nama_karyawan,
                                    tgl_absen,
                                    DATE_FORMAT(absen_masuk,"%H:%i")  as jam_masuk,
                                    DATE_FORMAT(absen_pulang,"%H:%i")  as jam_pulang,
                                    jenis_absen,
                                    nama_cabang,
                                    nama_departemen
                            ')
                            ->from('r_absensi')
                            ->where('tgl_absen', $tgl_absensi)
                            ->where('kode_cabang', $kode_cabang)
                            ->where('id_company', $id_company);
                    $data_absensi = $this->db->get();
                }
        
                if($data_absensi->num_rows() == 0){
                    $respon['success'] = false;
                    $respon['message'] = 'Data tidak ditemukan';
                }else{
                    $data['jml_data'] = $data_absensi->num_rows();
                    $data['list_data'] = $data_absensi->result_array();
        
                    $respon['success'] = true;
                    $respon['message'] = 'Data ditemukan ';
                    $respon['data'] = $data;
                }
            }else{
                $respon = array(
                    'success' => false,
                    'message' => 'Kode cabang '.$kode_cabang.' tidak ditemukan'
                    );
            }
            
        }else{
            $respon = array(
                'success' => false,
                'message' => 'Token tidak valid'
                );
        }
        
        echo json_encode($respon);
    }

    public function jalan_tol(){
        $tgl_absensi = $this->input->get('tgl_absensi');
        $nik = $this->input->get('nik');
        $header = $this->input->request_headers();
        $token = $header['Token'];
        $id_company = '20697'; //JALANTOL
        // $id_company = '1'; //DESNET
        $hari_ini = date('Y-m-d');

        

        if($token === 'absenku-pt-jalan-tol-seksi-empat'){
            $data_karyawan = $this->db->select('id_karyawan')
                                    ->from('data_karyawan')
                                    ->where('nik', $nik)
                                    ->where('id_company', $id_company)
                                    ->get();

            if($data_karyawan->num_rows() != 0){
                $id_karyawan = $data_karyawan->row()->id_karyawan;
                $nama_jadwal = 'Reguler';
                $jadwal = 'Reguler';
                $lewat_hari = 'Tidak';

                $cek_shift = $this->db->select('dsk.id_shift_karyawan, ms.flag_jam_pulang')
                                        ->from('data_shift_karyawan as dsk')
                                        ->join('master_shift as ms', 'dsk.id_master_shift=ms.id_master_shift')
                                        ->where('dsk.tanggal', $tgl_absensi)
                                        ->where('id_karyawan', $id_karyawan)
                                        ->where('dsk.id_company', $id_company)
                                        ->get();
                if($cek_shift->num_rows() > 0){ // ADA SHIT
                    $lewat_hari = $cek_shift->row()->flag_jam_pulang == '0'?'Tidak':'Ya';
                }
                if($tgl_absensi == $hari_ini){ //HARI INI
                    $this->db->select('dk.nik, dk.nama_lengkap as nama,
                                    am.tgl_absen,
                                    DATE_FORMAT(am.jam_absen,"%H:%i") as waktu_in,
                                    DATE_FORMAT(ap.jam_absen,"%H:%i") as waktu_out,
                                    am.jenis_absen as jadwal,
                                    am.ket_kode as nama_jadwal,
                            ')
                            ->join('data_karyawan as dk', 'dk.id_karyawan=am.id_karyawan')
                            ->join('absensi_pulang as ap', 'am.id_absensi_masuk=ap.id_masuk', 'left')
                            ->from('absensi_masuk as am')
                            ->where('am.tgl_absen', $tgl_absensi)
                            ->where('dk.id_karyawan', $id_karyawan)
                            ->where('am.id_company', $id_company);
        
                    $data_absensi = $this->db->get();
                    if($data_absensi->num_rows() == 0){
                        $respon = array(
                            'status' => false,
                            'message' => 'Data tidak ditemukan'
                        );
                    }else{
                        $data_absensi = $data_absensi->row();
                        $data = array(
                            'nik' => $data_absensi->nik,
                            'nama' => $data_absensi->nama,
                            'tanggal' => $data_absensi->tgl_absen,
                            'waktu_in' => $data_absensi->waktu_in,
                            'waktu_out' => $data_absensi->waktu_out,
                            'jadwal' => $data_absensi->jadwal,
                            'nama_jadwal' => $data_absensi->nama_jadwal,
                            'lewat_hari' => $lewat_hari,
                        );
                        $respon = array(
                            'status'    => true,
                            'message'   => 'Data ditemukan',
                            'data'      => $data
                        );
                    }
                    
                    // echo $this->db->last_query();exit;
        
                }else{ // BUKAN HARI INI
                    $this->db->select('nik,
                                    nama_karyawan,
                                    tgl_absen,
                                    DATE_FORMAT(absen_masuk,"%H:%i")  as waktu_in,
                                    DATE_FORMAT(absen_pulang,"%H:%i")  as waktu_out,
                                    jenis_absen as jadwal,
                                    ket_kode as nama_jadwal
                            ')
                            ->from('r_absensi')
                            ->where('tgl_absen', $tgl_absensi)
                            ->where('id_karyawan', $id_karyawan)
                            ->where('id_company', $id_company);
                    $data_absensi = $this->db->get();
                    if($data_absensi->num_rows() != 0){
                        $data_absensi = $data_absensi->row();
                        $data = array(
                            'nik' => $data_absensi->nik,
                            'nama' => $data_absensi->nama_karyawan,
                            'tanggal' => $data_absensi->tgl_absen,
                            'waktu_in' => $data_absensi->waktu_in,
                            'waktu_out' => $data_absensi->waktu_out,
                            'jadwal' => $data_absensi->jadwal,
                            'nama_jadwal' => $data_absensi->nama_jadwal,
                            'lewat_hari' => $lewat_hari,

                        );
                        $respon = array(
                            'status'    => true,
                            'message'   => 'Data ditemukan',
                            'data'      => $data
                        );
                    }else{
                        $respon = array(
                            'status' => false,
                            'message' => 'Data tidak ditemukan.'
                        );
                    }
                }
            }else{
                $respon = array(
                    'status' => false,
                    'message' => 'Data karyawan tidak ditemukan'
                    );
            }
        }else{
            $respon = array(
                'status' => false,
                'message' => 'Token tidak valid'
                );
        }
        echo json_encode($respon);
    }

    public function mulia_industri(){
        $tgl_absensi = $this->input->get('tgl_absensi');
        $header = $this->input->request_headers();
        $token = $header['Token'];
        $id_company = '12229'; //MULIA INDUSTRY INDO
        // $id_company = '1'; //MULIA INDUSTRY INDO
        $hari_ini = date('Y-m-d');
        if($token === 'absenku-mulia-industry'){
            
            if($tgl_absensi == $hari_ini){
                $this->db->select('dk.nik,
                                dk.nama_lengkap as nama_karyawan,
                                am.tgl_absen,
                                DATE_FORMAT(am.jam_absen,"%H:%i") as jam_masuk,
                                DATE_FORMAT(ap.jam_absen,"%H:%i") as jam_pulang,
                                IF(am.jenis_absen = "reguler" OR am.jenis_absen = "shift","H",
                                    IF(am.jenis_absen = "sakit", "S",
                                        IF(am.jenis_absen = "izin", "I",
                                            IF(am.jenis_absen = "cuti", "C",
                                                IF(am.jenis_absen = "alpha", "A",
                                                    IF(am.jenis_absen = "libur", "L", 
                                                        "Tidak Diketahui"
                                                    )
                                                )
                                            )
                                        )
                                    )
                                ) as jenis_absen,
                                IF(am.jenis_absen = "reguler" OR jenis_absen = "shift","Hadir",am.jenis_absen) as ket_jenis_absen,
                                mc.nama as nama_cabang,
                                md.nama as nama_departemen
                        ')
                        ->join('data_karyawan as dk', 'dk.id_karyawan=am.id_karyawan')
                        ->join('master_cabang as mc', 'mc.id_cabang=dk.id_cabang')
                        ->join('master_departemen as md', 'md.id_departemen=dk.id_departemen','left')
                        ->join('absensi_pulang as ap', 'am.id_absensi_masuk=ap.id_masuk', 'left')
                        ->from('absensi_masuk as am')
                        ->where('am.tgl_absen', $tgl_absensi)
                        ->where('am.id_company', $id_company);
    
                $data_absensi = $this->db->get();
                // echo $this->db->last_query();exit;
    
            }else{
                $this->db->select('nik,
                                nama_karyawan,
                                tgl_absen,
                                DATE_FORMAT(absen_masuk,"%H:%i")  as jam_masuk,
                                DATE_FORMAT(absen_pulang,"%H:%i")  as jam_pulang,
                                IF(jenis_absen = "reguler" OR jenis_absen = "shift","H",
                                    IF(jenis_absen = "sakit", "S",
                                        IF(jenis_absen = "izin", "I",
                                            IF(jenis_absen = "cuti", "C",
                                                IF(jenis_absen = "alpha", "A",
                                                    IF(jenis_absen = "libur", "L", 
                                                        "Tidak Diketahui"
                                                    )
                                                )
                                            )
                                        )
                                    )
                                ) as jenis_absen,
                                IF(jenis_absen = "reguler" OR jenis_absen = "shift","Hadir",jenis_absen) as ket_jenis_absen,
                                nama_cabang,
                                nama_departemen
                        ')
                        ->from('r_absensi')
                        ->where('tgl_absen', $tgl_absensi)
                        ->where('id_company', $id_company);
                $data_absensi = $this->db->get();
            }
    
            if($data_absensi->num_rows() == 0){
                $respon['success'] = false;
                $respon['message'] = 'Data tidak ditemukan';
            }else{
                $data['jml_data'] = $data_absensi->num_rows();
                $data['list_data'] = $data_absensi->result_array();
    
                $respon['success'] = true;
                $respon['message'] = 'Data ditemukan';
                $respon['data'] = $data;
            }
        }else{
            $respon = array(
                'success' => false,
                'message' => 'Token tidak valid'
                );
        }
        
        echo json_encode($respon);
    }

    
}
