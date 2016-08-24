<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class informasimodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
       parent::__construct();
    }
	
	function get_list_kategori() {
        $sql = "SELECT * FROM kategori_m";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }

    function get_list_kategori_public() {
        $kategori = $this->uri->segment(4, 0);
        $sql = "SELECT * FROM kategori_m where id_kategori = $kategori";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }
	
    function get_total_informasi() {
       $kategori = $this->uri->segment(4);
        $sql = "SELECT COUNT(*)'total' FROM informasi_m where id_kategori = $kategori";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }

    function get_list_informasi_limit($params) {
        $kategori = $this->uri->segment(4);
        $sql = "SELECT * from informasi_m where id_kategori = $kategori ORDER BY id_informasi DESC LIMIT ?,? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_list_informasi_terkait() {
        $id_kategori = $this->uri->segment(4,0);
        $id_informasi = $this->uri->segment(5,0);
        $sql = "SELECT a.*, s.id_kategori, s.kategori, s.kategori_english
        from informasi_m a 
        LEFT JOIN kategori_m s on a.id_kategori = s.id_kategori
        WHERE a.id_kategori = $id_kategori and a.id_informasi <> $id_informasi  
        ORDER BY a.id_informasi DESC LIMIT 0,3";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    

    function get_list_informasi_limit_private() {
       
        $sql = "SELECT a.*, s.id_kategori, s.kategori, s.kategori_english
        from informasi_m a 
        LEFT JOIN kategori_m s on a.id_kategori = s.id_kategori
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





    function get_informasi_by_id($id) {
        $this->db->where('id_informasi', $id);
        $query = $this->db->get('informasi_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

     
	
	function get_berita_asosiasi_home() {
		 $this->db->select('a.*,nama_asosiasi');
        $this->db->where('a.id_asosiasi <', 100);
		$this->db->join('asosiasi_m b','a.id_asosiasi = b.id_asosiasi');
        $query = $this->db->get('berita_m a',4, 0);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function process_informasi_add($params) {
        $sql = "INSERT INTO informasi_m (id_kategori, judul, content, tanggal, keterangan_gambar, judul_english, content_english, caption_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function process_informasi_edit($params) {
        $sql = "UPDATE informasi_m SET id_kategori = ? , judul = ?, content = ?, tanggal = ? ,keterangan_gambar = ?, 
                judul_english = ?, content_english = ? ,caption_picture = ? 
				 WHERE id_informasi = ? ";
        return $this->db->query($sql, $params);
    }

    function process_informasi_delete($id) {
        $this->db->where('id_informasi', $id);
        return $this->db->delete('informasi_m');
    }
	
	
	
}