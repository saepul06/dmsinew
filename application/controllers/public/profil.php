<?php	// important * untuk application base dari halaman ini	class Profil extends MY_Controller {				function  __construct() {			// load application base			parent::__construct();			$this->Webappbase();			$this->load->library('datetimemanipulation');		}		// pages		public		function index() {			// template content			$this->smarty->assign('template_content',"web/profil/list.html");			// load			$this->detail();		}		public		function detail(){			$this->smarty->assign('template_content',"web/profil/detail.html");			$this->load->model('profilmodel');			// echo $this->act_lang ;//exit;			$id_profil= $this->uri->segment(4,0);			$this->db->select('*');			$this->db->from('profil_m');			$this->db->order_by('order_num', 'ASC');			$data= $this->db->get()->result_array();						if(!empty($data)):			foreach($data as $k=>$row):						if($this->act_lang == 'en'):			$data[$k]['judul'] = $row['judul_english'];			$data[$k]['content'] = $row['content_english'];			endif;			$data[$k]['url_detail'] = site_url('public/profil/detail/'.$row['id_info'].'/'.url_title($row['judul']));			endforeach;						if($id_profil == 0):			$id_profil = $data[0]['id_info'];			endif;			endif;			$profil = $this->profilmodel->get_profil_by_id($id_profil);						if(!empty($profil)):						if($this->act_lang == 'en'):			$profil['judul'] = $profil['judul_english'];			$profil['content'] = $profil['content_english'];			endif;			$this->smarty->assign("page_name", $profil['judul']);			endif;			$this->smarty->assign("data", $profil);			$this->smarty->assign("profil_list", $data);						if($this->act_lang == 'en'){				$this->smarty->assign("page_modul", 'About Us');			} else {				$this->smarty->assign("page_modul", 'Tentang Kami');			}			$this->smarty->assign("page_modul_url", site_url('public/profil'));			// display document			$this->parser->parse('web/base-layout/document.html');		}	}