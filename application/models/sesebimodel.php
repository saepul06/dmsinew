<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sesebimodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
       parent::__construct();
    }
	
	
	
    function get_total_sesebi() {
       // $id_asosiasi = "100";
       // $this->db->where('id_asosiasi', $id_asosiasi);
        $sql = "SELECT COUNT(*)'total' FROM serbaserbi_m";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }

    function get_list_sesebi_limit() {
        $sql = "SELECT * from serbaserbi_m
            ORDER BY id_sesebi DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_list_sesebi_terkait() {
        $id_sesebi = $this->uri->segment(4, 0);
        $sql = "SELECT * from serbaserbi_m WHERE id_sesebi <> $id_sesebi
            ORDER BY id_sesebi DESC LIMIT 0,3";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

   

    function get_sesebi_by_id($id) {
        $this->db->where('id_sesebi', $id);
        $query = $this->db->get('serbaserbi_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }
	
	

    function process_sesebi_add($params) {
        $sql = "INSERT INTO serbaserbi_m (judul, content, tanggal, keterangan_gambar, judul_english, content_english, caption_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function process_sesebi_edit($params) {
        $sql = "UPDATE serbaserbi_m SET  judul = ?, content = ?, tanggal = ? ,keterangan_gambar = ?, judul_english = ?, 
            content_english = ?, caption_picture = ? 
                 WHERE id_sesebi = ? ";
        return $this->db->query($sql, $params);
    }

    function process_sesebi_delete($id) {
        $this->db->where('id_sesebi', $id);
        return $this->db->delete('serbaserbi_m');
    }
	
	
	
}