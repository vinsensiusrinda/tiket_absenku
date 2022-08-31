<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Task_m extends CI_Model
{
    var $table = 'task';

    //function untuk cari datatable dr db
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    //function untuk menghitung filter
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    //function untuk menghitung all data
    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }
    private function _get_datatables_query()
    {
        $this->db->select("no_tiket,
                            tgl_pengaduan,
                            tipe,
                            jenis_layanan,
                            id_company,
                            judul,
                            modul,
                            nm_pelanggan,
                            keterangan,
                            platform,
                            pelimpahan,
                            prioritas,
                            tgl_dikerjakan,
                            tgl_selesai,
                            tgl_konfirmasi,
                            status")
            ->from($this->table);

        $column_search = array('no_tiket', 'pelimpahan', 'judul', 'modul', 'nm_pelanggan');
        $i = 0;

        foreach ($column_search as $item) {  // looping awal
            if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST

                if ($i === 0) { // looping awal
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        $column_order = array('', 'no_tiket');

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $order_by = array("tgl_input" => "DESC");
            $this->db->order_by(key($order_by), $order_by[key($order_by)]);
        }
    }

    public function getDataById($no_tiket = null)
    {
        $this->db->select("*");
        $this->db->where("no_tiket", $no_tiket);
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_user()
    {
        $query = $this->db->query('SELECT nama_user, id_user FROM users WHERE level_user="3" AND aktif="1"');
        return $query->result();
    }

    // public function get_pelanggan()
    // {
    //     $query = $this->db->query('SELECT nama FROM master_company');
    //     return $query->result();
    // }

    public function save($data, $no_tiket = '')
    {
        // if ($no_tiket != null) {
        //     $cek_data = $this->db->select("no_tiket")
        //         ->where("no_tiket", $data['no_tiket'])
        //         ->where("MD5(no_tiket) != '$no_tiket'")
        //         ->from($this->table)
        //         ->get()
        //         ->num_rows();
        //     if ($cek_data > 0) {
        //         return  __response_duplicate();
        //     } else {
        //         $this->db->where("md5(no_tiket)", $no_tiket);
        //         $update = $this->db->update($this->table, $data);
        //         return  __response_update($update);
        //     }
        // } else {
        //     $cek_data = $this->db->select("no_tiket")
        //         ->where("no_tiket", $data['no_tiket'])
        //         ->from($this->table)
        //         ->get()
        //         ->num_rows();
        //     if ($cek_data > 0) {
        //         return  __response_save(false, ["message" => "<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> GAGAL: No tiket sudah digunakan</font>"]);
        //     }

        $no_tiket = $this->fungsi->getNextId($this->table, 'no_tiket', 3);

        $this->db->trans_start();
        $this->db->insert($this->table, array_merge($data, array('no_tiket' => $no_tiket)));
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return __response_save(false);
        } else {
            $this->db->trans_commit();
            return __response_save(true);
        }
        // }
    }

    public function delete($no_tiket = null)
    {
        $this->db->trans_start();

        $this->db->where($no_tiket);
        $this->db->delete($this->table);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return __response_delete(false);
        } else {
            $this->db->trans_commit();
            return __response_delete(true);
        }
    }


    // public function delete($id_company = null)
    // {
    //     $this->db->trans_start();

    //     $this->db->where(array('md5(id_user)' => $id_company));
    //     $delete = $this->db->delete($this->table);

    //     $this->db->trans_complete();

    //     if ($this->db->trans_status() === FALSE) {
    //         $this->db->trans_rollback();
    //         return __response_delete(false);
    //     } else {
    //         $this->db->trans_commit();
    //         return __response_delete(true);
    //     }
    // }
}
