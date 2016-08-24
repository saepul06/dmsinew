<?php

class Harga extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	    $this->Webappbase();
    }

    public function index() {
        // template content
       $this->smarty->assign('template_content',"web/harga/grafik.html");
        // load
        $this->load->library('pagination');

        $this->load->helper('text');
        
        $this->load->model('hargamodel'); 
          // max tahun
        $datamaxtahun = $this->hargamodel->get_max_tahun();
         $this->smarty->assign("datamaxtahun", $datamaxtahun);

        //grafik

         $datagrafik = $this->hargamodel->get_list_harga_grafik();
         $this->smarty->assign("datagrafik", $datagrafik);

         //grafik domestik
        
         $datagrafikdo = $this->hargamodel->get_list_harga_grafik_domestik();
         $this->smarty->assign("datagrafikdo", $datagrafikdo);

          //grafik ekspor
        
         $datagrafikeks = $this->hargamodel->get_list_harga_grafik_ekspor();
         $this->smarty->assign("datagrafikeks", $datagrafikeks);
         // endif;
        
        $this->smarty->assign("page_modul", 'Grafik Harga ');
        $this->smarty->assign("page_modul_url", site_url('public/berita'));
    
        // display document
        $this->parser->parse('web/base-layout/document-list.html');
    }


	
}