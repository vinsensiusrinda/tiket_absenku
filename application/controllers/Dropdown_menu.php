<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropdown_menu extends MY_Controller
{

    public function index()
    {
    }

    public function tipe_pelanggan($search = null)
    {
        $search = $this->input->get("q");

        $this->db->select('*');
        $this->db->from('master_kategori_pelanggan');
        $this->db->where("jenis_registrasi LIKE '%" . $search . "%' ");
        $this->db->group_by('id_tipe_pelanggan', 'ASC');
        $result = $this->db->get()->result();
        // print_r($result);
        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id'    => $rows->jenis_registrasi,
                'text'  => $rows->id_tipe_pelanggan . " - " . $rows->jenis_registrasi
            ];
        }
        echo json_encode($json);
    }

    public function pelanggan($jenis_registrasi = null)
    {
        $search = $this->input->get("q");

        $this->db->select("jenis_registrasi, nama, id_company");
        $this->db->where("jenis_registrasi LIKE '%" . $search . "%' ");
        $this->db->where("jenis_registrasi", $jenis_registrasi);
        $this->db->order_by("jenis_registrasi", "ASC");

        $result = $this->db->get('master_company')->result();
        // print_r($result);
        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id' => $rows->id_company,
                'text' => $rows->nama
                // 'jenis' => $rows->jenis_registrasi
            ];
        }
        echo json_encode($json);
    }

    public function modul($search = null)
    {
        $search = $this->input->get("q");

        $this->db->select('*');
        $this->db->from('master_modul');
        $this->db->where("nama_modul_kategori LIKE '%" . $search . "%' ");
        $result = $this->db->get()->result();
        //print_r($result);
        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id'    => $rows->id_modul_kategori,
                'text'  => $rows->nama_modul_kategori
            ];
        }
        echo json_encode($json);
    }

    public function submodul($id_modul_kategori = null)
    {
        $search = $this->input->get("q");

        $this->db->select('id_modul, nama_modul');
        // $this->db->where("id_modul LIKE '%" . $search . "%' ");
        $this->db->where("id_modul_kategori", $id_modul_kategori);
        $this->db->order_by('id_modul', 'asc');

        $result = $this->db->get('master_kategori_modul')->result();
        // print_r($result);
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_modul, 'text' => $rows->nama_modul];
        }
        echo json_encode($json);
    }

    // public function modul1($searchTerm = null)
    // {
    //     // $query = $this->db->get_where('master_kategori_modul', array('id_module_kategori' => $sub_module));
    //     // return $query->result();
    //     // -$this->db->select('id_modul_kategori, nama_modul_kategori');
    //     // -$this->db->where("nama_modul_kategori");
    //     // -$this->db->order_by('id_modul_kategori', 'asc');
    //     // -$this->db->from('master_modul');
    //     // -$fetched_records = $this->db->get();
    //     // -$datamodul = $fetched_records->result_array();

    //     // -$data = array();
    //     // -foreach ($datamodul as $modul) {
    //     //     $data[] = array("id" => $modul['id_modul_kategori'], "text" => $modul['nama_modul_kategori']);
    //     // -}
    //     // -return $data;
    //     $search = $this->input->get("q");

    //     $this->db->select('*');
    //     $this->db->from('master_modul');
    //     $this->db->where("nama_modul_kategori LIKE '%" . $search . "%' ");
    //     // $this->db->group_start();
    //     // $this->db->like('nama_modul_kategori', $search);
    //     // $this->db->group_end();
    //     // $this->db->order_by('id_modul_kategori', 'ASC');
    //     $result = $this->db->get()->result();

    //     $json = [];
    //     foreach ($result as $rows) {
    //         $json[] = [
    //             'id'    => $rows->id_modul_kategori,
    //             'text'  => $rows->nama_modul_kategori
    //         ];
    //     }
    //     echo json_encode($json);
    // }

    // public function submodul1($id_modul_kategori = null)
    // {
    //     $search = $this->input->get("q");

    //     // $this->db->select('*');
    //     // $this->db->like('nama_modul', $search);
    //     // $this->db->order_by('id_modul', 'ASC');
    //     // $this->db->where('id_modul_kategori', $id_modul_kategori);
    //     $this->db->select('id_modul, nama_modul');
    //     $this->db->where("id_modul LIKE '%" . $search . "%' ");
    //     $this->db->where("id_modul_kategori", $id_modul_kategori);
    //     $this->db->order_by('id_modul', 'asc');

    //     $result = $this->db->get('master_kategori_modul')->result();
    //     // print_r($result);
    //     $json = [];
    //     foreach ($result as $rows) {
    //         $json[] = ['id' => $rows->id_modul, 'text' => $rows->nama_modul];
    //     }
    //     echo json_encode($json);
    // }

    public function jabatan()
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_jabatan, kode_jabatan,level_user');
        $this->db->where('id_company',  $this->id_company);
        $this->db->group_start();
        $this->db->like('nama', $search);
        $this->db->or_like('kode_jabatan', $search);
        $this->db->group_end();
        $this->db->order_by('id_jabatan', 'ASC');

        $result = $this->db->get('master_jabatan')->result();

        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id' => $rows->id_jabatan,
                'leveluser'     => $rows->level_user,
                'kodejabatan'   => $rows->kode_jabatan,
                'namajabatan'   => $rows->nama,
                'text'          => $rows->kode_jabatan . " - " . $rows->nama
            ];
        }
        echo json_encode($json);
    }

    public function jabatan_by_departemen($id_cabang = null, $id_departemen = null)
    {
        $search = $this->input->get("q");

        $this->db->select('master_jabatan.id_jabatan, master_jabatan.nama, master_jabatan.kode_jabatan');
        $this->db->join("data_karyawan", "data_karyawan.id_jabatan = master_jabatan.id_jabatan");
        $this->db->where('data_karyawan.id_company',  $this->id_company);
        $this->db->where('data_karyawan.id_cabang',  $id_cabang);
        $this->db->where('data_karyawan.id_departemen',  $id_departemen);
        $this->db->group_start();
        $this->db->like('master_jabatan.nama', $search);
        $this->db->or_like('master_jabatan.kode_jabatan', $search);
        $this->db->group_end();
        $this->db->order_by('master_jabatan.id_jabatan', 'ASC');
        $this->db->group_by('master_jabatan.id_jabatan');
        $this->db->from('master_jabatan');

        $result = $this->db->get()->result();

        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id' => $rows->id_jabatan,
                'leveluser'     => $rows->level_user,
                'kodejabatan'   => $rows->kode_jabatan,
                'namajabatan'   => $rows->nama,
                'text'          => $rows->kode_jabatan . " - " . $rows->nama
            ];
        }
        echo json_encode($json);
    }

    public function cabang()
    {
        $search = $this->input->get("q");

        if ($this->level_user == "5") { # KEPALA CABANG
            if ($this->multi_cabang == true) {
                $this->db->where_in('id_cabang', $this->id_cabang_arr);
            } else {
                $this->db->where('id_cabang', $this->id_cabang);
            }
        }

        $this->db->select('nama, id_cabang, kode');
        $this->db->where('id_company', $this->id_company);
        $this->db->group_start();
        $this->db->like('nama', $search);
        $this->db->or_like('kode', $search);
        $this->db->group_end();
        $this->db->order_by('id_cabang', 'ASC');

        $result = $this->db->get('master_cabang')->result();
        $json = [];

        foreach ($result as $rows) {
            $json[] = [
                'id'         => $rows->id_cabang,
                'kodecabang' => $rows->kode,
                'namacabang' => $rows->nama,
                'text'      => $rows->kode . " - " . $rows->nama
            ];
        }
        echo json_encode($json);
    }

    public function departemen()
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_departemen, kode');
        $this->db->where('id_company', $this->id_company);

        $this->db->group_start();
        $this->db->like('nama', $search);
        $this->db->or_like('kode', $search);
        $this->db->group_end();
        $this->db->order_by('id_departemen', 'ASC');

        $result = $this->db->get('master_departemen')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id'             => $rows->id_departemen,
                'kodedepartemen' => $rows->kode,
                'namadepartemen' => $rows->nama,
                'text'          => $rows->kode . " - " . $rows->nama
            ];
        }
        echo json_encode($json);
    }

    public function departemen_by_cabang($id_cabang = null)
    {
        $search = $this->input->get("q");

        if ($this->level_user == "2") { # KEPALA DEPARTEMEN
            if ($this->multi_departemen == true) {
                $this->db->where_in('data_karyawan.id_departemen', $this->id_departemen_arr);
            } else {
                $this->db->where('data_karyawan.id_departemen', $this->id_departemen);
            }
        }

        $this->db->select('master_departemen.id_departemen, master_departemen.kode, master_departemen.nama');
        $this->db->join('data_karyawan', 'data_karyawan.id_departemen = master_departemen.id_departemen');
        $this->db->where('master_departemen.id_company', $this->id_company);
        $this->db->where('data_karyawan.id_cabang', $id_cabang);

        $this->db->group_start();
        $this->db->like('master_departemen.nama', $search);
        $this->db->or_like('master_departemen.kode', $search);
        $this->db->group_end();
        $this->db->order_by('master_departemen.kode', 'ASC');
        $this->db->group_by('master_departemen.id_departemen');
        $this->db->from('master_departemen');

        $result = $this->db->get()->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = [
                'id'             => $rows->id_departemen,
                'kodedepartemen' => $rows->kode,
                'namadepartemen' => $rows->nama,
                'text'          => $rows->kode . " - " . $rows->nama
            ];
        }
        echo json_encode($json);
    }

    public function supervisi($id_cabang = null, $id_departemen = null)
    {
        $search = $this->input->get("q");

        $this->db->select('data_karyawan.id_karyawan, data_karyawan.nik, data_karyawan.nama_lengkap');
        $this->db->join('master_jabatan', 'master_jabatan.id_jabatan = data_karyawan.id_jabatan', 'LEFT');
        $this->db->where('master_jabatan.level_user', 7);
        $this->db->where('data_karyawan.id_cabang', $id_cabang);
        $this->db->where('data_karyawan.id_departemen', $id_departemen);
        $this->db->where('data_karyawan.id_company', $this->id_company);
        $this->db->group_start();
        $this->db->like('data_karyawan.nama_lengkap', $search);
        $this->db->or_like('data_karyawan.nik', $search);
        $this->db->group_end();
        $this->db->order_by('data_karyawan.nama_lengkap', 'ASC');

        $result = $this->db->get('data_karyawan')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_karyawan, 'text' => $rows->nik . " - " . $rows->nama_lengkap];
        }
        echo json_encode($json);
    }

    public function karyawan()
    {
        $search = $this->input->get("q");

        $this->db->select('data_karyawan.id_karyawan, data_karyawan.nik, data_karyawan.nama_lengkap');
        $this->db->where('data_karyawan.id_company', $this->id_company);

        if ($this->level_user == "5") { # KEPALA CABANG
            if ($this->multi_cabang == true) {
                $this->db->where_in('data_karyawan.id_cabang', $this->id_cabang_arr);
            } else {
                $this->db->where('data_karyawan.id_cabang', $this->id_cabang);
            }
        } else if ($this->level_user == "2") { # KEPALA DEPARTEMEN
            if ($this->multi_departemen == true) {
                $this->db->where_in('data_karyawan.id_departemen', $this->id_departemen_arr);
            } else {
                $this->db->where('data_karyawan.id_departemen', $this->id_departemen);
            }
        } else if ($this->level_user == "7") { # SUPERVISI
            $this->db->group_start();
            $this->db->where("data_karyawan.supervisi", $this->id_karyawan);
            $this->db->or_where("data_karyawan.id_karyawan", $this->id_karyawan);
            $this->db->group_end();
        } else if ($this->level_user == "3") { # SUPERVISI
            $this->db->where('data_karyawan.id_karyawan', $this->id_karyawan);
        }

        $this->db->group_start();
        $this->db->like('data_karyawan.nama_lengkap', $search);
        $this->db->or_like('data_karyawan.nik', $search);
        $this->db->group_end();
        $this->db->order_by('data_karyawan.nama_lengkap', 'ASC');

        $result = $this->db->get('data_karyawan')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_karyawan, 'text' => $rows->nik . " - " . $rows->nama_lengkap];
        }
        echo json_encode($json);
    }

    public function karyawanAktif($id_cabang = 0)
    {
        $search = $this->input->get("q");

        $this->db->select('data_karyawan.id_karyawan, data_karyawan.nik, data_karyawan.nama_lengkap');
        $this->db->where('data_karyawan.id_company', $this->id_company);
        $this->db->where_in('data_karyawan.status', ['1', '2', '3', '4']);

        if ($id_cabang != 0) {
            $this->db->where('data_karyawan.id_cabang', $id_cabang);
        }

        if ($this->level_user == "5") { # KEPALA CABANG
            if ($this->multi_cabang == true) {
                $this->db->where_in('data_karyawan.id_cabang', $this->id_cabang_arr);
            } else {
                $this->db->where('data_karyawan.id_cabang', $this->id_cabang);
            }
        } else if ($this->level_user == "2") { # KEPALA DEPARTEMEN
            if ($this->multi_departemen == true) {
                $this->db->where_in('data_karyawan.id_departemen', $this->id_departemen_arr);
            } else {
                $this->db->where('data_karyawan.id_departemen', $this->id_departemen);
            }
        } else if ($this->level_user == "7") { # SUPERVISI
            $this->db->group_start();
            $this->db->where("data_karyawan.supervisi", $this->id_karyawan);
            $this->db->or_where("data_karyawan.id_karyawan", $this->id_karyawan);
            $this->db->group_end();
        } else if ($this->level_user == "3") { # STAFF
            $this->db->where('data_karyawan.id_karyawan', $this->id_karyawan);
        }

        $this->db->group_start();
        $this->db->like('data_karyawan.nama_lengkap', $search);
        $this->db->or_like('data_karyawan.nik', $search);
        $this->db->group_end();
        $this->db->order_by('data_karyawan.nama_lengkap', 'ASC');

        $result = $this->db->get('data_karyawan')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_karyawan, 'text' => $rows->nik . " - " . $rows->nama_lengkap];
        }
        echo json_encode($json);
    }

    public function lokasi_absensi()
    {
        $search = $this->input->get("q");
        $id_company = $this->session->userdata("id_company");
        $level_user = $this->session->userdata("level_user");
        $level_khusus = $this->session->userdata("level_khusus");
        $id_cabang = $this->session->userdata("id_cabang");

        if ($level_user != "1" && $level_khusus != "1") {
            $this->db->where("id_cabang", $id_cabang);
        }


        $this->db->select("id_lokasi_kantor,nama_kantor");
        $this->db->from("data_lokasi_kantor");
        $this->db->where("id_company", $id_company);
        $this->db->like('nama_kantor', $search);
        $this->db->order_by('nama_kantor', 'ASC');

        $result = $this->db->get()->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_lokasi_kantor, 'text' => $rows->nama_kantor];
        }
        echo json_encode($json);
    }

    public function provinsi()
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_prov');
        $this->db->like('nama', $search);
        $this->db->order_by('id_prov', 'ASC');

        $result = $this->db->get('master_provinsi')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_prov, 'text' => $rows->nama];
        }
        echo json_encode($json);
    }

    public function kota($id_prov = null)
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_kota');
        $this->db->like('nama', $search);
        $this->db->order_by('id_kota', 'ASC');
        $this->db->where('id_prov', $id_prov);

        $result = $this->db->get('master_kota')->result();
        $json = [];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_kota, 'text' => $rows->nama];
        }
        echo json_encode($json);
    }

    public function kecamatan($id_kota = null)
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_kecamatan');
        $this->db->like('nama', $search);
        $this->db->order_by('id_kecamatan', 'ASC');
        $this->db->where('id_kota', $id_kota);

        $result = $this->db->get('master_kecamatan')->result();
        $json = [];

        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_kecamatan, 'text' => $rows->nama];
        }
        echo json_encode($json);
    }

    public function kelurahan($id_kecamatan = null)
    {
        $search = $this->input->get("q");

        $this->db->select('nama, id_kelurahan');
        $this->db->like('nama', $search);
        $this->db->order_by('id_kelurahan', 'ASC');
        $this->db->where('id_kecamatan', $id_kecamatan);

        $result = $this->db->get('master_kelurahan')->result();
        $json = [];

        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_kelurahan, 'text' => $rows->nama];
        }
        echo json_encode($json);
    }

    // public function getCabang(){
    //     $search = $this->input->get("q");
    //     $this->db->select('id_cabang, kode, nama, flag')
    //             ->where('id_company', $this->id_company)
    //             ->group_start()
    //             ->like('kode', $search)
    //             ->or_like('nama', $search)
    //             ->group_end()
    //             ->order_by('flag, nama', 'ASC');

    //     $result = $this->db->get('master_cabang')->result();
    //     $json = [];
    //     foreach ($result as $rows) {
    //         if($rows->flag == '1'){
    //             $json[] = ['id'=>$rows->id_cabang, 'text'=>$rows->kode." - ".$rows->nama, 'selected'=>'selected'];
    //         }else{
    //             $json[] = ['id'=>$rows->id_cabang, 'text'=>$rows->kode." - ".$rows->nama];
    //         }

    //     }
    //     echo json_encode($json);
    // }

    //  public function getCabang_kepegawaian(){
    //     $search = $this->input->get("q");
    //     $this->db->select('id_cabang, kode, nama, flag')
    //             ->where('id_company', $this->id_company)
    //             ->group_start()
    //             ->like('kode', $search)
    //             ->or_like('nama', $search)
    //             ->group_end()
    //             ->order_by('flag, nama', 'ASC');

    //     $result = $this->db->get('master_cabang')->result();

    //     $json[] = ['id'=>'0', 'text'=>'Semua'];
    //     foreach ($result as $rows) {
    //         if($rows->flag == '1'){
    //             $json[] = ['id'=>$rows->id_cabang, 'text'=>$rows->kode." - ".$rows->nama, 'selected'=>'selected'];
    //         }else{
    //             $json[] = ['id'=>$rows->id_cabang, 'text'=>$rows->kode." - ".$rows->nama];
    //         }

    //     }
    //     echo json_encode($json);
    // }

    // public function getDepartemen($id_cabang = null){
    //     $search = $this->input->get("q");

    //     $this->db->select("master_departemen.id_departemen,
    //                         master_departemen.kode,
    //                         master_departemen.nama,
    //                         master_departemen.id_company");
    //     $this->db->join("data_karyawan","data_karyawan.id_departemen = master_departemen.id_departemen");
    //     $this->db->where('master_departemen.id_company', $this->id_company);
    //     $this->db->group_start();
    //     $this->db->like('master_departemen.nama', $search);
    //     $this->db->or_like('master_departemen.kode', $search);
    //     $this->db->group_end();
    //     $this->db->group_by("master_departemen.id_departemen");
    //     $this->db->order_by('id_departemen', 'ASC');

    //     if(in_array($this->level_user,array('2','3','7'))){
    //         $this->db->where('id_departemen', $id_departemen);
    //     }

    //     if($id != null) {
    //         $this->db->where('data_karyawan.id_cabang', $id_cabang);
    //     }

    //     $result = $this->db->get('master_departemen')->result();

    //     $json = [];
    //     foreach ($result as $rows) {
    //         $json[] = ['id'=>$rows->id_departemen, 'text'=>$rows->kode." - ".$rows->nama];
    //     }

    //     echo json_encode($json);
    // }

    // public function getDepartemen_kepegawaian($id_cabang = null){
    //     $search = $this->input->get("q");

    //     $this->db->select("master_departemen.id_departemen,
    //                         master_departemen.kode,
    //                         master_departemen.nama,
    //                         master_departemen.id_company");
    //     $this->db->join("data_karyawan","data_karyawan.id_departemen = master_departemen.id_departemen");
    //     $this->db->where('master_departemen.id_company', $this->id_company);
    //     $this->db->group_start();
    //     $this->db->like('master_departemen.nama', $search);
    //     $this->db->or_like('master_departemen.kode', $search);
    //     $this->db->group_end();
    //     $this->db->group_by("master_departemen.id_departemen");
    //     $this->db->order_by('id_departemen', 'ASC');

    //     if(in_array($this->level_user,array('2','3','7'))){
    //         $this->db->where('id_departemen', $id_departemen);
    //     }

    //     if($id != null) {
    //         $this->db->where('data_karyawan.id_cabang', $id_cabang);
    //     }

    //     $result = $this->db->get('master_departemen')->result();

    //     $json[] = ['id'=>'0', 'text'=>'Semua'];
    //     foreach ($result as $rows) {
    //         $json[] = ['id'=>$rows->id_departemen, 'text'=>$rows->kode." - ".$rows->nama];
    //     }

    //     echo json_encode($json);
    // }

    function getJamKerja($id_cabang = null)
    {
        $key = $this->input->get("q");

        $this->db->select('nama_shift, id_master_shift, kode_shift');
        $this->db->where('libur', '0');
        $this->db->where('id_company', $this->id_company);
        $this->db->where('id_cabang', $id_cabang);
        $this->db->group_start();
        $this->db->like('nama_shift', $key);
        $this->db->or_like('kode_shift', $key);
        $this->db->group_end();
        $this->db->order_by('kode_shift', 'ASC');

        $result = $this->db->get('master_shift')->result();

        $json[] = ['id' => '0', 'text' => 'Reguler'];
        foreach ($result as $rows) {
            $json[] = ['id' => $rows->id_master_shift, 'text' => $rows->kode_shift . " - " . $rows->nama_shift];
        }

        echo json_encode($json);
    }

    function getJamKerjaKaryawan()
    {
        $shft = $this->input->get('jam_kerja');

        if ($shft == 'reguler') {
            $sl = 'masuk, pulang';
            $fr = 'jam_kerja';
        } else if ($shft == 'shift') {
            $sl = 'jam_masuk as masuk, jam_pulang as pulang';
            $fr = 'master_shift';
        } else {
            $sl = false;
        } // shift

        if ($sl !== false) {
            $q = $this->db->select($sl);
            $q->from($fr);
            $q->where('id_cabang', $this->input->get('id_cabang'));
            $q->where('id_company', $this->id_company);

            if ($shft == 'reguler') {
                $q->where('hari', $this->input->get('index_day'));
            }
            if ($shft == 'shift') {
                $q->where('id_master_shift', $this->input->get('id_master_shift'));
            }

            $result = $q->get()->row();
            // echo $this->db->last_query();
        }


        $respon = ['status' => false, 'data' => null];
        if ($result != null) {
            $respon = ['status' => true, 'data' => ['jam_masuk' => $result->masuk, 'jam_pulang' => $result->pulang]];
        }

        echo json_encode($respon);
    }

    public function getJamShift()
    {
        $result = $this->db->select('id_master_shift, kode_shift, nama_shift, libur')
            ->from('master_shift')
            ->where('id_company', $this->id_company)
            ->where('id_cabang', $this->input->get('id_cabang'))
            ->get()
            ->result();

        $respon = ['status' => false, 'data' => null];
        if ($result != null) {
            $respon = ['status' => true, 'data' => $result];
        }

        echo json_encode($respon);
    }

    public function getNamaShift($id_cabang = "0")
    {
        if ($id_cabang != "0") {
            $this->db->where("id_cabang", $id_cabang);
        }
        $result = $this->db->select('id_master_shift, kode_shift, nama_shift, jam_masuk, jam_pulang')
            ->from('master_shift')
            ->where('id_company', $this->id_company)
            ->get()
            ->result();

        $json[] = ['id' => '0', 'text' => 'Reguler'];
        foreach ($result as $rows) {
            $jam_masuk = date_format(date_create($rows->jam_masuk), "H:i");
            $jam_pulang = date_format(date_create($rows->jam_pulang), "H:i");
            $json[] = ['id' => $rows->id_master_shift, 'text' => $rows->kode_shift . " - " . $rows->nama_shift . "(" . $jam_masuk . " - " . $jam_pulang . ")"];
        }

        echo json_encode($json);
    }

    public function getJenisIzin()
    {
        $result = $this->db->select('id_jenis_izin as id, kode_izin as kode, nama as text, jenis_izin as jenis')
            ->from('master_jenis_izin')
            ->where('id_company', $this->id_company)
            ->get()
            ->result();

        $json = [];
        if ($result != null) {
            foreach ($result as $rows) {
                $json[] = ['id' => $rows->id, 'text' => $rows->kode . " - " . $rows->text, 'jenis' => $rows->jenis];
            }
        }

        echo json_encode($json);
    }

    public function get_kategori_module($searchTerm = "")
    {
        // $query = $this->db->query('SELECT nama_modul_kategori FROM master_modul');
        // return $query->result();

        $this->db->select('*');
        $this->db->where("nama_modul_kategori LIKE '%" . $searchTerm . "%' ");
        $this->db->order_by('id_modul_kategori', 'asc');
        $fetched_records = $this->db->get('master_modul');
        $master_modul = $fetched_records->result_array();

        $data = array();
        foreach ($master_modul as $modul) {
            $data[] = array(
                "id"    => $modul['id_modul_kategori'],
                "text"  => $modul['nama_kategori_modul']
            );
        }
        return $data;
    }
}
