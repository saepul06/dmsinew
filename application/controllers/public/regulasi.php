<?php
// important * untuk application base dari halaman ini

class Regulasi extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->Webappbase();
	  
    }

    // pages
    public function index() {
		// template content
       $this->smarty->assign('template_content',"web/regulasi/list.html");
        // load
		$this->load->library('pagination');
		$this->load->model('regulasimodel');
		$this->load->helper('text');
	
		// get data
        $data = $this->regulasimodel->get_list_regulasi();
		if(!empty($data)):
			foreach($data as $k=>$row):
				$pathdok = 'doc/regulasi/'.$row['id_regulasi'].'/'.$row['file_regulasi'];
				if(is_file($pathdok)):
					$data[$k]['ukuran'] =  $this->display_ukuran_file(filesize($pathdok));
					$url_download = site_url('public/regulasi/getfile/'.$row['id_regulasi'].'/'.url_title($row['judul']));
					$data[$k]['file_regulasi'] = $url_download;
				else:
					$data[$k]['ukuran'] = '';
					$data[$k]['file_regulasi'] = '-';
				endif;
			endforeach;
		endif;
		
		$this->smarty->assign("regulasi_list", $data);
		$this->smarty->assign("no", 1);
		if($this->act_lang == 'en'){
		$this->smarty->assign("page_modul", 'Download Regulation');
		}else{
		$this->smarty->assign("page_modul", 'Download Regulasi');
		}
		$this->smarty->assign("page_modul_url", site_url('public/regulasi'));
		
        // display document
        $this->parser->parse('web/base-layout/document.html');
    }
	
	function display_ukuran_file($ukuran_file = 0){
		if($ukuran_file >= 1048576):
			$ukuran =  number_format(($ukuran_file/1048576),2,".",",");
			return $ukuran." MB";
		else:
			$ukuran = ceil($ukuran_file/1024);
			return $ukuran." Kb";
		endif;
	}
	
	public function getfile(){
			$this->load->model('regulasimodel');
			$this->load->helper('download');
			// data
			$id_regulasi = $this->uri->segment(4,0);
			$data = $this->regulasimodel->get_regulasi_by_id($id_regulasi);
			$dir = 'doc/regulasi/' . $id_regulasi. '/'.$data['file_regulasi'];
			if(is_file($dir)):
				$filedata = file_get_contents($dir);
				force_download($data['file_regulasi'], $filedata);
			endif;
			redirect('public/regulasi');
	}
   
}