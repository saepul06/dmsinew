<?php
// important * untuk application base dari halaman ini

class Asosiasi extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->Webappbase();
	   $this->load->library('datetimemanipulation');
	   
    }

    // pages
    public function index() {
		// template content
       $this->smarty->assign('template_content',"web/asosiasi/list.html");
        // load
		//$this->load->library('pagination');
		$this->load->model('propinsimodel');
		$this->load->model('dashboardmodel'); 
		$this->load->model('asosiasimodel');
		
		$result = $this->asosiasimodel->get_data_asosiasi_all_public();
		// get data
       if(!empty($result)):
			foreach($result as $key=>$data):
				
				$pathdok = 'doc/asosiasi/'.$data['id_asosiasi'].'/'.$data['logo_asosiasi'];
				if(is_file($pathdok)){
					$result[$key]['logo_asosiasi'] = BASEURL.$pathdok;
				}else{
					$result[$key]['logo_asosiasi']= BASEURL.'doc/images/logo_icon.png';
				}
				$result[$key]['url_detail'] = site_url('public/asosiasi/profil/'.$data['id_asosiasi'].'/'.url_title($data['nama_asosiasi']));
			endforeach;
		endif;
		
		$this->smarty->assign("asosiasilist", $result);
		if($this->act_lang == 'en'){
		$this->smarty->assign("page_modul", 'DMSI Members');
		}else{
		$this->smarty->assign("page_modul", 'Anggota DMSI');
		}
		$this->smarty->assign("page_modul_url", site_url('public/asosiasi'));
	
        // display document
        $this->parser->parse('web/base-layout/document-list.html');
    }
	
	public function profil(){
		$this->smarty->assign('template_content',"web/asosiasi/detail.html");
		$this->load->model('asosiasimodel');
		$this->load->model('dashboardmodel');
		//$this->layout->load_javascript("js/charts/highcharts.js");
	    //$this->layout->load_javascript("js/charts/modules/exporting.js");
		
		$id_asosiasi  = $this->uri->segment(4,0);
		$nama_asosiasi = ''; 
		$data = $this->asosiasimodel->get_asosiasi_by_id($id_asosiasi);
		if(!empty($data)):
				if($this->act_lang  == 'en'):
					$data['profil'] = $data['profil_english'];
				endif;
				//$jml_koleksi = $this->museummodel->get_total_koleksi_museum(array($data['no_regmus']));
				$pathdok = 'doc/asosiasi/'.$data['id_asosiasi'].'/'.$data['logo_asosiasi'];
				if(is_file($pathdok)){
					$data['logo_asosiasi'] = BASEURL.$pathdok;
				}else{
					$data['logo_asosiasi']= BASEURL.'doc/images/logo_icon.png';
				}
				//$data['jml_koleksi'] = $jml_koleksi;
				$nama_asosiasi = $data['nama_asosiasi'];
				//$nama_propinsi = $data['nama_propinsi'];
				//$id_propinsi = $data['id_propinsi'];
		endif;
		$this->smarty->assign("data", $data);
		
		if($this->act_lang == 'en'){
		$this->smarty->assign("page_modul", 'DMSI Members');
		}else{
		$this->smarty->assign("page_modul", 'Anggota DMSI');
		}
		$this->smarty->assign("page_modul_url", site_url('public/asosiasi'));
		$this->smarty->assign("page_name", 'Profil '.$nama_asosiasi);
		// display document
        $this->parser->parse('web/base-layout/document.html');
	}
	
	
	
	
	
	
	
	
   
}