<?php
// important * untuk application base dari halaman ini

class Program extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->Webappbase();
	   $this->load->library('datetimemanipulation');
    }

    public function index() {
    	 $this->smarty->assign('template_content',"web/program/list.html");
        // load
		$this->load->model('programmodel');
         $result = $this->programmodel->get_data_program();
	
       if(!empty($result)):
			foreach($result as $key=>$data):
				$path = 'doc/program/'.$data['id_program']."/";
				if(is_file($path.$data['image'])){
					$result[$key]['image'] = BASEURL.$path.$data['image'];
					
				}else{
					$result[$key]['image']= BASEURL.'doc/tmp.default.jpg';
				}
				
			endforeach;
		endif;
		
		$this->smarty->assign("program_list", $result);
		$this->smarty->assign("page_modul", 'program');
		$this->smarty->assign("page_modul_url", site_url('public/program'));
	
        // display document
        $this->parser->parse('web/base-layout/document.html');
    }
  

}