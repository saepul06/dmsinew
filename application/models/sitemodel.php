<?php
class sitemodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // aplikasi

    function get_aplikasi_settings() {
        $query = $this->db->get('sys_settings_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function process_aplikasi_update($params) {
        // update
        $sql = "UPDATE sys_settings_m SET smtp_name = ?, smtp_host = ?, smtp_port = ?, smtp_username = ?,
               smtp_password  = ?, regnas_url = ?,  mdb = ?, mdd = NOW()";
        return $this->db->query($sql, $params);
    }

    // site

    function get_site_data($id_portal) {
        $sql = "SELECT site_name, site_description, site_url, site_email, smtp_host, smtp_port, smtp_username,
                smtp_password, maintenance, maintenance_message, judul_site, meta_desc, meta_key
                FROM sys_settings_m, sys_group_m
                WHERE id_group = ?";
        $query = $this->db->query($sql, array($id_portal));
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_current_page($params) {
        $sql = "SELECT * FROM sys_menu_m a
                WHERE app_path = ? AND module_path = ? AND page_path = ?
                ORDER BY order_num DESC LIMIT 0,1";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_parent_group_by_idnav($int_parent, $limit) {
        $sql = "SELECT a.id_nav, a.id_parent FROM sys_menu_m a WHERE a.id_nav = ?
                ORDER BY order_num ASC LIMIT 0, 1";
        $query = $this->db->query($sql, array($int_parent));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if($result['id_parent'] == $limit) {
                return $result['id_nav'];
            }else {
                return self::get_parent_group_by_idnav($result['id_parent'], $limit);
            }
        }else {
            return $int_parent;
        }
    }

    function get_navigation_by_parent($params) {
        $sql = "SELECT * FROM sys_menu_m
                WHERE id_group = ? AND id_parent = ? AND
                uses = 1 AND displayed = 1 AND page_type = 'view'
                ORDER BY order_num ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_private_navigation_by_parent($params) {
        $sql = "SELECT DISTINCT a.* FROM sys_menu_m a
                INNER JOIN sys_menu_authority_t b ON a.id_nav = b.id_nav
                INNER JOIN sys_authority_m c ON b.id_auth = c.id_auth
                INNER JOIN sys_user_authority_t d ON c.id_auth = d.id_auth
                WHERE d.id_user = ? AND a.id_group = ? AND a.id_parent = ? AND
                uses = 1 AND displayed = 1 AND page_type = 'view'
                ORDER BY order_num ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    // login

    function get_user_login($userid, $pass, $portal) {
        // load library
        $this->load->library('Cryptosimple');
        // queries
        // get user key
        $user_key = "";
        $sql = "SELECT user_key FROM sys_user_m WHERE user_name = ?";
        $query = $this->db->query($sql, array($userid));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $user_key = $result['user_key'];
        }else {
            return false;
        }
        if(!empty($user_key)) {
            $pass = $this->cryptosimple->do_encryption($pass, $user_key);
            $sql = "SELECT a.id_user FROM sys_user_m a
                INNER JOIN sys_user_authority_t b ON a.id_user = b.id_user
                INNER JOIN sys_authority_m c ON b.id_auth = c.id_auth
                WHERE user_name = ? AND user_pass = ? AND c.id_group = ? AND
                user_status = 'active'";
            $query = $this->db->query($sql, array($userid, $pass, $portal));
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                return $result['id_user'];
            }else {
                return false;
            }
        }
    }

     function get_user_login_anggota($userid, $pass) {
        // load library
        $this->load->library('Cryptosimple');
        // queries
        // get user key
        $user_key = "";
        $sql = "SELECT user_key FROM registrasi_m WHERE username = ? and password = ? and user_status = 'aktif'";
        $query = $this->db->query($sql, array($userid, $pass));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $user_key = $result['user_key'];
        }else {
            return false;
        }
        if(!empty($user_key)) {
            $pass = $this->cryptosimple->do_encryption($pass, $user_key);
            $sql = "SELECT * FROM `registrasi_m`";
            $query = $this->db->query($sql, array($userid, $pass));
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                return $result['id_registrasi'];
            }else {
                return false;
            }
        }
    }

     

    function save_user_login($id_user) {
        // delete
        $sql = "DELETE FROM sys_user_login_t WHERE id_user = ?";
        $this->db->query($sql, array($id_user));
        // insert
        $sql = "INSERT INTO sys_user_login_t (id_user, login_date, remote_ip)
                VALUES (?, NOW(), ?)";
        $params = array($id_user, $this->input->ip_address());
        return $this->db->query($sql, $params);
    }

    // check user authority

    function get_user_authority($params) {
        $sql = "SELECT COUNT(DISTINCT(a.id_nav))'allowed' FROM sys_menu_m a
                INNER JOIN sys_menu_authority_t b ON a.id_nav = b.id_nav
                INNER JOIN sys_authority_m c ON b.id_auth = c.id_auth
                INNER JOIN sys_user_authority_t d ON c.id_auth = d.id_auth
                WHERE d.id_user = ? AND a.id_group = ? AND uses = 1 AND
                app_path = ? AND module_path = ? AND page_path = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if(empty($result['allowed']))
                return false;
            else
                return true;
        }else {
            return false;
        }
    }

    // check propinsi authority

   
}