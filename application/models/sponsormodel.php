<?php         if (!defined('BASEPATH')) exit('No direct script access allowed');    class Sponsormodel extends CI_Model {                function  __construct() {            // Call the Model constructor            parent::__construct();        }                function get_list_sponsor() {            $sql = "SELECT * FROM sponsor_m";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return 0;            }        }        function get_list_iklan_private() {            $id_sponsor = $this->uri->segment(4,0);            $sql = "SELECT * FROM iklan_m                     WHERE id_sponsor = $id_sponsor AND judul <> ''                     ORDER BY id_iklan DESC";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return 0;            }        }        function get_list_iklan_public() {            $sql = "SELECT a.*, b.id_sponsor, b.nama_sponsor, b.image_sponsor FROM iklan_m a            LEFT JOIN sponsor_m b on a.id_sponsor = b.id_sponsor             WHERE a.status = 'aktif'";            $query = $this->db->query($sql);                        if ($query->num_rows() > 0) {                $result = $query->result_array();                $query->free_result();                return $result;            } else {                return 0;            }        }                        function get_sponsor_by_id($id) {            $this->db->where('id_sponsor', $id);            $query = $this->db->get('sponsor_m');                        if ($query->num_rows() > 0) {                $result = $query->row_array();                $query->free_result();                return $result;            } else {                return false;            }        }        function get_iklan_by_id($id) {            $this->db->where('id_iklan', $id);            $query = $this->db->get('iklan_m');                        if ($query->num_rows() > 0) {                $result = $query->row_array();                $query->free_result();                return $result;            } else {                return false;            }        }                function process_sponsor_add($params) {            $sql = "INSERT INTO sponsor_m (nama_sponsor)                VALUES (?)";            return $this->db->query($sql, $params);        }        function process_iklan_add($params) {            $sql = "INSERT INTO iklan_m (id_sponsor, judul, judul_english,status)                VALUES (?,?,?,?)";            return $this->db->query($sql, $params);        }                function process_sponsor_edit($params) {            $sql = "UPDATE sponsor_m SET nama_sponsor = ?                   WHERE id_sponsor = ? ";            return $this->db->query($sql, $params);        }        function process_iklan_edit($params) {            $sql = "UPDATE iklan_m SET judul = ?, judul_english = ?, status = ?                   WHERE id_iklan = ? ";            return $this->db->query($sql, $params);        }                function process_sponsor_delete($id) {            $this->db->where('id_sponsor', $id);            return $this->db->delete('sponsor_m');        }         function process_iklan_delete($id) {            $this->db->where('id_iklan', $id);            return $this->db->delete('iklan_m');        }    }