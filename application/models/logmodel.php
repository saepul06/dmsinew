<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class logmodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
		$this->load->library('datetimemanipulation');
    }
   

 
    function get_total_log($params) {
        $sql = "SELECT COUNT(*)'total' FROM log_m WHERE nama_data LIKE ? AND id_data LIKE ? AND aksi LIKE ? 
		AND nama_user LIKE ? AND tanggal >=  ? AND tanggal <= ? AND keterangan LIKE ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return 0;
        }
    }


    function get_list_log_limit($params) {
	    $sql = "SELECT * FROM log_m a WHERE nama_data LIKE ? AND id_data LIKE ? AND aksi LIKE ? 
		AND nama_user LIKE ? AND tanggal >=  ? AND tanggal <= ? AND keterangan LIKE ? ORDER BY id_log DESC LIMIT ?, ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
	
	function get_list_log_objek_limit($params) {
        $sql = "SELECT a.*,b.admin_name FROM log_m a LEFT JOIN 
			administrator_m b ON a.id_user = b.id_user 
			WHERE nama_data LIKE ? ORDER BY id_log DESC LIMIT ?, ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
	
	function get_list_log_objek_id_limit($params) {
        $sql = "SELECT a.*,b.admin_name FROM log_m a LEFT JOIN 
			administrator_m b ON a.id_user = b.id_user 
			WHERE nama_data LIKE ? AND id_data LIKE ? ORDER BY id_log DESC LIMIT ?, ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
	
	function get_list_log_objek_id_bagian_limit($params) {
        $sql = "SELECT a.*,b.admin_name FROM log_m a LEFT JOIN 
			administrator_m b ON a.id_user = b.id_user 
			WHERE nama_data LIKE ? AND id_data LIKE ? AND keterangan LIKE ? ORDER BY id_log DESC LIMIT ?, ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    
	function get_list_nama_data(){
		$sql = "SELECT nama_data FROM log_m GROUP BY nama_data ORDER BY nama_data";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
	}
	
    function get_log_by_id($id) {
        $sql = "SELECT * FROM log_m WHERE id_log = ? ";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else{
            return false;
        }
    }

    function process_log_add($params) {
        // insert into log
        $sql = "INSERT INTO log_m(nama_data, aksi, id_instansi, id_data, id_user, tanggal, keterangan, nama_user)
                VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";
        return $this->db->query($sql, $params);
    }

   

    function process_log_delete($params) {
        // insert into log
        $sql = "DELETE FROM log_m WHERE id_log = ?";
        return $this->db->query($sql, $params);
    }
	
}