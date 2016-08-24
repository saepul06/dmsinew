<?php
class searchmodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }


    // get total hasil pencarian 
     function get_total_pencarian() {
     
        $sql = "SELECT COUNT(*) as total from berita_m";
       
        $query = $this->db->query($sql);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }
    function get_pencarian_berita_indo($params) {
     
        $sql = "SELECT * from berita_m WHERE judul LIKE ? or content LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_berita_english($params) {
     
        $sql = "SELECT * from berita_m WHERE judul_english LIKE ? or content_english LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    

   function get_pencarian_informasi_indo($params) {
     
        $sql = "SELECT a.*, b.* from informasi_m a
        LEFT JOIN kategori_m b on a.id_kategori = b.id_kategori  WHERE judul LIKE ? or content LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_informasi_english($params) {
     
        $sql = "SELECT a.*, b.* from informasi_m a
        LEFT JOIN kategori_m b on a.id_kategori = b.id_kategori  WHERE judul_english LIKE ? or content_english LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_agenda_indo($params) {
     
        $sql = "SELECT * from agenda_m WHERE judul_agenda LIKE ? or keterangan LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_agenda_english($params) {
     
        $sql = "SELECT * from agenda_m WHERE judul_english LIKE ? or keterangan_english LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_opini_indo($params) {
     
        $sql = "SELECT * from opini_m WHERE judul LIKE ? or content LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_opini_english($params) {
     
        $sql = "SELECT * from opini_m WHERE judul_english LIKE ? or content_english LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_sesebi_indo($params) {
     
        $sql = "SELECT * from serbaserbi_m WHERE judul LIKE ? or content LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pencarian_sesebi_english($params) {
     
        $sql = "SELECT * from serbaserbi_m WHERE judul_english LIKE ? or content_english LIKE ?";
       
        $query = $this->db->query($sql, $params);
       //echo $this->db->last_query(); exit;
       if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }
   
}