<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class negaramodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_total_negara() {
        $sql = "SELECT COUNT(*)'total' FROM spt_negara_m";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $return= $result["total"];
            $query->free_result();
            return $return;
        } else {
            return 0;
        }
    }

    function get_data_negara($params) {
        $sql = "SELECT a.*,admin_name FROM spt_negara_m a
                LEFT JOIN administrator_m b ON a.mdb = b.id_user
                ORDER BY nama_negara ASC LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function get_all_negara() {
        $sql = "SELECT * FROM spt_negara_m ORDER BY nama_negara ASC";
        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_negara_by_id($id) {
        $this->db->where('id_negara', $id);
        $query = $this->db->get('spt_negara_m');
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
            $query->free_result();
            return $return;
        }else {
            return false;
        }
    }


    function process_negara_add($params) {
        // insert into spt_negara_m
        $sql = "INSERT INTO spt_negara_m (nama_negara, mdb, mdd)
                VALUES (?, ?, NOW())";        
        return $this->db->query($sql, $params);
    }

    function process_negara_edit($params) {
        // update into spt_negara_m
        $sql = "UPDATE spt_negara_m SET nama_negara = ?, mdb = ?, mdd = NOW()
                WHERE id_negara = ?";        
        return $this->db->query($sql, $params);
    }

    function process_negara_delete($id) {
        foreach($id as $value) {
            $this->db->where('id_negara', $value);
            $this->db->delete('spt_negara_m');
        }
        return true;
    }
	
	function process_negara_delete_one($id) {
        $this->db->where('id_negara', $id);
	    $this->db->delete('spt_negara_m');
        return true;
    }
}