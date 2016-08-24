<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class baganmodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
       parent::__construct();
    }

   
    function get_bagan_info() {
        $this->db->limit(1);
        $query = $this->db->get('bagan_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_data_bagan() {
        $sql = "SELECT * FROM bagan_m";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }


  
    function process_bagan_edit($params) {
        $sql = "UPDATE bagan_m SET judul_bagan = ?, tanggal = ?, judul_english = ?  
				 WHERE id_bagan = '1' ";
        return $this->db->query($sql, $params);
    }

  
	
}