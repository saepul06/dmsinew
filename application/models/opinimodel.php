<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class opinimodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
       parent::__construct();
    }
	
	
	
    function get_total_opini() {
       // $id_asosiasi = "100";
       // $this->db->where('id_asosiasi', $id_asosiasi);
        $sql = "SELECT COUNT(*)'total' FROM opini_m";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }

    function get_list_opini_limit() {
        $sql = "SELECT * from opini_m
            ORDER BY tanggal DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_list_opini_terkait() {
        $id_opini = $this->uri->segment(4,0);
        $sql = "SELECT * from opini_m WHERE id_opini <> $id_opini
            ORDER BY id_opini DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_opini_by_id($id) {
        $this->db->where('id_opini', $id);
        $query = $this->db->get('opini_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }
	
	

    function process_opini_add($params) {
        $sql = "INSERT INTO opini_m (judul, content, tanggal, keterangan_gambar, judul_english, content_english, caption_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function process_opini_edit($params) {
        $sql = "UPDATE opini_m SET  judul = ?, content = ?, tanggal = ? ,keterangan_gambar = ?,judul_english = ?, content_english = ? ,caption_picture = ? 
				 WHERE id_opini = ? ";
        return $this->db->query($sql, $params);
    }

    function process_opini_delete($id) {
        $this->db->where('id_opini', $id);
        return $this->db->delete('opini_m');
    }
	
	
	
}