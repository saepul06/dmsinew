<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class agendamodel extends CI_Model {

    function  __construct() {
        // Call the Model constructor
       parent::__construct();
    }

    function get_list_asosiasi() {
        $sql = "SELECT * FROM asosiasi_m ORDER BY id_asosiasi DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return 0;
        }
    }
    
	function get_total_agenda($params) {
        $sql = "SELECT COUNT(*)'total' FROM agenda_m a 
			WHERE judul_agenda like ? AND MONTH(tanggal_mulai) LIKE ? AND YEAR(tanggal_mulai) LIKE ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
           $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return false;
        }
    }

    function get_list_agenda() {
        $sql = "SELECT a.*, s.id_asosiasi, s.nama_asosiasi FROM agenda_m a
         LEFT JOIN asosiasi_m s ON a.id_asosiasi = s.id_asosiasi ORDER BY id_agenda DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function get_list_agenda_dmsi() {
        $sql = "SELECT a.*, s.id_asosiasi, s.nama_asosiasi FROM agenda_m a
         LEFT JOIN asosiasi_m s ON a.id_asosiasi = s.id_asosiasi
         WHERE s.id_asosiasi = '100'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_list_agenda_anggota() {
        $sql = "SELECT a.*, s.id_asosiasi, s.nama_asosiasi FROM agenda_m a
         LEFT JOIN asosiasi_m s ON a.id_asosiasi = s.id_asosiasi
         WHERE s.id_asosiasi <> '100'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_agenda_by_id($id) {
		 $this->db->where('id_agenda', $id);
        $query = $this->db->get('agenda_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }
	
	
	
	
	
	
	
	
    function process_agenda_add($params) {
        $sql = "INSERT INTO agenda_m (id_asosiasi, judul_agenda, tanggal_mulai, tanggal_selesai, lokasi, keterangan, judul_english, keterangan_english )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function process_agenda_edit($params) {
        $sql = "UPDATE agenda_m  SET id_asosiasi = ?, judul_agenda = ?, tanggal_mulai = ?, tanggal_selesai = ?,  lokasi = ?, 
			keterangan = ?,  judul_english = ?, 
            keterangan_english = ? WHERE id_agenda = ?";
		$this->db->query($sql, $params);
		return $this->db->query($sql, $params);
    }

   function process_agenda_delete($id) {
        $sql = "DELETE FROM agenda_m where id_agenda = ?";
        return $this->db->query($sql,$id);
    }

	
	/////TAMBAHAN 
	function get_agenda_view_by_id($id) {
        $this->db->where('id_agenda', $id);
        $query = $this->db->get('agenda_view_m');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }
	function gambar_by_id_agenda($id){
		   $sql = "SELECT * FROM agenda_image_m WHERE id_agenda= $id ORDER BY urutan DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            $query->free_result();
            return $return;
        } else {
            return false;
        }
	
	}	
	
	// function process_gambar_save($params) {
 //        $sql = "INSERT INTO agenda_image_m (id_agenda,file_image,keterangan,urutan) VALUES (?,?,?,?)";
 //        return $this->db->query($sql, $params);
 //    }
	// function process_gambar_delete($id) {
 //        $sql = "DELETE FROM agenda_m where id_agenda = ?";
 //        return $this->db->query($sql,$id);
 //    }
	// function process_agenda_view($params) {
 //        $sql = "UPDATE agenda_view_m  SET pandangan_pribadi = ?  WHERE id_agenda = ?";
 //        return $this->db->query($sql, $params);
 //    }
	
	// function process_agenda_view2($params) {
 //        $sql = "INSERT INTO agenda_view_m (id_agenda,pandangan_pribadi) VALUES (?,?)";
 //        return $this->db->query($sql, $params);
 //    }
	
	// function lampiran_by_id_agenda($id){
	// 	   $sql = "SELECT * FROM agenda_lampiran_m WHERE id_agenda= $id ORDER BY id_lampiran DESC";
 //        $query = $this->db->query($sql);
 //        if ($query->num_rows() > 0) {
 //            $return = $query->result_array();
 //            $query->free_result();
 //            return $return;
 //        } else {
 //            return false;
 //        }
	
	// }	
	// function process_add_lampiran($params) {
 //        $sql = "INSERT INTO agenda_lampiran_m (id_agenda, file_lampiran) VALUES (?,?)";
 //        return $this->db->query($sql, $params);
 //    }
	// function process_lampiran_del($params) {
 //        $sql = "DELETE FROM agenda_lampiran_m  WHERE id_lampiran = ?";
 //        return $this->db->query($sql, $params);
 //    }
	
	// GET KATEGORI DATA DR DB UTAMA 
	function get_kategori_utama_by_jenis($jenis){
	    $sql = "SELECT * FROM agenda_kategori_m WHERE jenis = ? ";
        $query = $this->db->query($sql, array($jenis));
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            $query->free_result();
            return $return;
        } else {
            return false;
        }
	
	 }	
	 
	//// --- START KINERJA --- //// 
	function get_count_agendaterencana_all(){
		$sql = "SELECT COUNT(*)'total' FROM agenda_m a 
			WHERE status = 'rencana' AND tanggal_selesai < DATE_FORMAT(NOW(),'%Y-%m-%d') ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return false;
        }
	}
	
	function get_list_agendaterencana($params){
		$sql = "SELECT a.* FROM agenda_m a 
			WHERE status = 'rencana' AND tanggal_selesai < DATE_FORMAT(NOW(),'%Y-%m-%d') 
			ORDER BY tanggal_selesai ASC LIMIT ?, ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
	}
	/// get data untuk dikirim 
	function get_count_agenda_sending_all(){
		$sql = "SELECT COUNT(*)'total' FROM agenda_m a 
			WHERE status = 'selesai') 
			AND status_send <> 'yes' 
			AND tanggal_selesai < DATE_FORMAT(NOW(),'%Y-%m-%d') ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return false;
        }
	}
	
	function get_list_agenda_sending($params){
		$sql = "SELECT a.* FROM agenda_m a 
			WHERE status = 'selesai' 
			AND status_send <> 'yes' AND tanggal_selesai < DATE_FORMAT(NOW(),'%Y-%m-%d') 
			ORDER BY tanggal_selesai ASC LIMIT ?, ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
	}
	
	function get_list_agenda_sending_max($params){
		$sql = "SELECT a.*,b.pandangan_pribadi FROM agenda_m a 
			LEFT JOIN agenda_view_m b ON a.id_agenda = b.id_agenda 
			WHERE status = 'selesai' 
			AND status_send <> 'yes' AND tanggal_selesai < DATE_FORMAT(NOW(),'%Y-%m-%d')
			ORDER BY tanggal_selesai ASC LIMIT ?, ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
	}
	/// PROCESS UPDATE 
	// update status terlaksana
	function process_update_status_kegiatan($params) {
        $sql = "UPDATE agenda_m  SET status = ? WHERE id_agenda = ?";
        return $this->db->query($sql, $params);
    }
	//update status sending 
	function process_update_status_sending($params) {
        $sql = "UPDATE agenda_m  SET status_send = ? WHERE id_agenda = ?";
        return $this->db->query($sql, $params);
    }
	// sending data to pusat 
	function process_sending_agenda($params) {
        $sql = "INSERT INTO agenda_kinerja_m (id_user, id_agenda_asal, id_kategori, judul_agenda, tanggal_mulai, 
			tanggal_selesai, lokasi, keterangan, image_agenda, id_kecamatan, id_kelurahan, status , 
			 nama_kategori,  pandangan_pribadi, tanggal_kirim)VALUES (?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->dbdpd->query($sql, $params);
    }
	
	/// AGENDA PUBLIC PEnCARIAN 
	function get_total_agenda_web($params) {
        $sql = "SELECT COUNT(*)'total' FROM agenda_m a 
			WHERE status = 'selesai' AND judul_agenda like ? AND a.id_kategori LIKE ? AND MONTH(tanggal_mulai) LIKE ? AND YEAR(tanggal_mulai) LIKE ?  ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
           $result = $query->row_array();
            $query->free_result();
            return $result["total"];
        } else {
            return false;
        }
    }
    function get_list_agenda_web($params) {
        $sql = "SELECT a.*  FROM agenda_m a 
			WHERE status = 'selesai' AND judul_agenda like ? AND a.id_kategori LIKE ? AND MONTH(tanggal_mulai) LIKE ? AND YEAR(tanggal_mulai) LIKE ? ORDER BY tanggal_mulai DESC LIMIT ?, ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
}