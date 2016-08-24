<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class propinsimodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_total_propinsi() {
        $sql = "SELECT COUNT(*)'total' FROM spt_propinsi_m";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }
    
     function is_exists_propinsi($propinsi) {
        $sql = "SELECT COUNT(*)'total' FROM spt_propinsi_m WHERE LOWER(nama_propinsi) = ?";
        $query = $this->db->query($sql, array($propinsi));
        $result = $query->row_array();
        $query->free_result();
        if (isset($result['total']) AND !empty($result['total'])) {
            return true;
        }else {
            return false;
        }
    }
    
    function is_exists_propinsi_edit($propinsi) {
    	$id_propinsi = $this->input->post('id_propinsi');
        $sql = "SELECT COUNT(*)'total' FROM spt_propinsi_m WHERE LOWER(nama_propinsi) = ? and id_propinsi <> $id_propinsi";
        $query = $this->db->query($sql, array($propinsi));
        $result = $query->row_array();
        $query->free_result();
        if (isset($result['total']) AND !empty($result['total'])) {
            return true;
        }else {
            return false;
        }
    }
     

    function get_data_propinsi($params) {
        $sql = "SELECT a.*,admin_name FROM spt_propinsi_m a
                LEFT JOIN administrator_m b ON a.mdb = b.id_user
                ORDER BY nama_propinsi ASC LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_all_propinsi() {
        $sql = "SELECT * FROM spt_propinsi_m ORDER BY nama_propinsi ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            $query->free_result();
            return $return;
        } else {
            return false;
        }
    }
	function get_all_propinsi_order_id() {
        $sql = "SELECT * FROM spt_propinsi_m ORDER BY id_propinsi ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            $query->free_result();
            return $return;
        } else {
            return false;
        }
    }

    function get_propinsi_by_id($id) {
        $this->db->where('id_propinsi', $id);
        $query = $this->db->get('spt_propinsi_m');
        if ($query->num_rows() > 0) {
            $return= $query->row_array();
            $query->free_result();
            return $return;
        }else {
            return false;
        }
    }

    function process_propinsi_add($params) {
        // insert into spt_propinsi_m
        $sql = "INSERT INTO spt_propinsi_m (id_negara,nama_propinsi, nama_singkat, mdb, mdd)
                VALUES (?, ?, ?, ?,  NOW())";
        return $this->db->query($sql, $params);
    }

    function process_propinsi_edit($params) {
        // update into spt_propinsi_m
        $sql = "UPDATE spt_propinsi_m SET nama_propinsi = ?, nama_singkat = ?, mdb = ?, mdd = NOW()
                WHERE id_propinsi = ?";
        return $this->db->query($sql, $params);
    }

    function process_propinsi_delete($id) {
        if(!empty($id)) {
            foreach($id as $value) {
                $this->db->where('id_propinsi', $value);
                $this->db->delete('spt_propinsi_m');
            }
        }
        return true;
    }
	
	function process_propinsi_delete_one($id) {
                $this->db->where('id_propinsi', $id);
                return $this->db->delete('spt_propinsi_m');
    }
}