<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fungsi
{

    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function delete_fileupload($predir = null)
    {
        $path = _MYPATH . $predir;
        if (is_file($path)) {
            unlink($path);
        }
    }

    public function getNextId($tableName = null, $fieldName = null, $lengthNumber = null)
    {
        $current_month = date('Ym');
        $len_substring = -6 - $lengthNumber;
        $gedId = $this->ci->db->query("SELECT MAX($fieldName) as id
                                        FROM $tableName
                                        WHERE SUBSTRING($fieldName,$len_substring,6) = '$current_month'");

        if ($gedId->num_rows() > 0) {
            $current_id = substr($gedId->row()->id, "-" . $lengthNumber);
            $nextId =  $current_month . sprintf("%0" . $lengthNumber . "d", ((int)$current_id + 1));
        } else {
            $nextId = $current_month . sprintf("%0" . $lengthNumber . "d", 1);
        }

        return $nextId;
    }
}
