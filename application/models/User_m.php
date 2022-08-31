<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
{
    var $table = 'users';

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }
    private function _get_datatables_query()
    {
        $this->db->select("id_user,
                            username,
                            nama_user,
                            level_user,
                            aktif")
            ->from($this->table);

        $column_search = array('username', 'nama_user', 'level_user');
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

        $column_order = array('', 'username', 'nama_user', 'level_user', 'aktif');

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $order_by = array("tgl_input" => "DESC");
            $this->db->order_by(key($order_by), $order_by[key($order_by)]);
        }
    }

    public function getDataById($id_user = null)
    {
        $this->db->select("id_user,
                            username,
                            nama_user,
                            level_user,
                            aktif");
        $this->db->where("MD5(id_user)", $id_user);
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->row();
    }

    public function save($data, $id_user = '')
    {

        if ($id_user != null) {
            $cek_data = $this->db->select("username")
                ->where("username", $data['username'])
                ->where("MD5(id_user) != '$id_user'")
                ->from($this->table)
                ->get()
                ->num_rows();
            if ($cek_data > 0) {
                return  __response_duplicate();
            } else {
                $this->db->where("md5(id_user)", $id_user);
                $update = $this->db->update($this->table, $data);
                return  __response_update($update);
            }
        } else {
            $cek_data = $this->db->select("username")
                ->where("username", $data['username'])
                ->from($this->table)
                ->get()
                ->num_rows();
            if ($cek_data > 0) {
                return  __response_save(false, ["message" => "<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> GAGAL: Username sudah digunakan</font>"]);
            }

            $id_user = $this->fungsi->getNextId($this->table, 'id_user', 3);
            $this->db->trans_start();
            $options = [
                'cost' => 10,
            ];
            $password       = $data["username"];
            $password_hash  = password_hash($password, PASSWORD_DEFAULT, $options);
            $this->db->insert($this->table, array_merge($data, array('id_user' => $id_user, 'password' => $password_hash)));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return __response_save(false);
            } else {
                $this->db->trans_commit();
                return __response_save(true);
            }
        }
    }

    public function delete($id_user = null)
    {
        $this->db->trans_start();

        $this->db->where(array('md5(id_user)' => $id_user));
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
}
