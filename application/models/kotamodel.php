<?php         if (!defined('BASEPATH')) exit('No direct script access allowed');    class kotamodel extends CI_Model {                function  __construct() {            // Call the Model constructor            parent::__construct();        }                function get_all_propinsi() {            $sql = "SELECT * FROM spt_propinsi_m";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function is_exists_kota($kota) {            $id_propinsi = $this->input->post('id_propinsi');            $sql = "SELECT COUNT(*)'total' FROM spt_kota_m WHERE LOWER(nama_kota) = ?  and id_propinsi = $id_propinsi";            $query = $this->db->query($sql, array($kota));            $result = $query->row_array();            $query->free_result();                        if (isset($result['total']) AND !empty($result['total'])) {                return true;            } else {                return false;            }        }                function get_max_kode_kota() {            $sql = "SELECT (MAX(id_kota)+1)'max_id' FROM spt_kota_m";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function get_total_kota($id_propinsi = '') {            $params = array($id_propinsi);                        if(!empty($id_propinsi))            $sql = "SELECT COUNT(*)'total' FROM spt_kota_m WHERE id_propinsi = ?"; else            $sql = "SELECT COUNT(*)'total' FROM spt_kota_m";            $query = $this->db->query($sql, $params);                        if ($query->num_rows() > 0) {                $result = $query->row_array();                $return = $result["total"];                $query->free_result();                return $return;            } else {                return 0;            }        }                function get_all_kota() {            $sql = "SELECT COUNT(*)'total' FROM spt_kota_m";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function get_data_kota($id_propinsi = '', $limit) {                        if(!empty($id_propinsi)) {                $params  = array_merge(array($id_propinsi), $limit);                $sql = "SELECT a.*, nama_propinsi, admin_name FROM spt_kota_m a                    INNER JOIN spt_propinsi_m c ON a.id_propinsi = c.id_propinsi                    LEFT JOIN administrator_m b ON a.mdb = b.id_user                    WHERE c.id_propinsi = ?                    ORDER BY nama_kota ASC LIMIT ?, ?";            } else {                $params  = $limit;                $sql = "SELECT a.*, nama_propinsi, admin_name FROM spt_kota_m a                    INNER JOIN spt_propinsi_m c ON a.id_propinsi = c.id_propinsi                    LEFT JOIN administrator_m b ON a.mdb = b.id_user                    ORDER BY nama_kota ASC LIMIT ?, ?";            }            $query = $this->db->query($sql, $params);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function get_data_kota_all($id_propinsi = '') {                        if(!empty($id_propinsi)) {                $params  = array_merge(array($id_propinsi));                $sql = "SELECT a.*, nama_propinsi, admin_name FROM spt_kota_m a                    INNER JOIN spt_propinsi_m c ON a.id_propinsi = c.id_propinsi                    LEFT JOIN administrator_m b ON a.mdb = b.id_user                    WHERE c.id_propinsi = ?                    ORDER BY nama_kota ASC ";                $query = $this->db->query($sql, $params);            } else {                $sql = "SELECT a.*, nama_propinsi, admin_name FROM spt_kota_m a                    INNER JOIN spt_propinsi_m c ON a.id_propinsi = c.id_propinsi                    LEFT JOIN administrator_m b ON a.mdb = b.id_user                    ORDER BY nama_kota ASC ";                $query = $this->db->query($sql);            }                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function get_kota_by_id($id) {            $query = $this->db->where(array('id_kota' => $id));            $query = $this->db->get('spt_kota_m');                        if ($query->num_rows() > 0) {                $result = $query->row_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function process_kota_add($params) {            // insert into spt_kota_m            $sql = "INSERT INTO spt_kota_m (id_kota, id_propinsi, nama_kota, mdb, mdd)                VALUES (?, ?, ?, ?, NOW())";            return $this->db->query($sql, $params);        }                function process_kota_edit($params) {            // update into spt_kota_m            $sql = "UPDATE spt_kota_m SET id_propinsi = ?, nama_kota = ?, mdb = ?, mdd = NOW()                WHERE id_kota = ?";            return $this->db->query($sql, $params);        }                function process_kota_delete($id) {                        if(!empty($id)) {                foreach($id as $value) {                    $this->db->where('id_kota', $value);                    $this->db->delete('spt_kota_m');                }            }            return true;        }                function process_kota_delete_one($id) {                        if(!empty($id)) {                $this->db->where('id_kota', $id);                $this->db->delete('spt_kota_m');            }            return true;        }    }