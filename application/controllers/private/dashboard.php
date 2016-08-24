<?php
// important * untuk application base dari halaman ini

class Dashboard extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
	  
    }
	 public function index(){
		
		$this->dashboard_pusat();
	
    }
	
	private function dashboard_pusat(){
		// template content
        $this->smarty->assign("template_content", "private/dashboard/grafik");
		//-- Highcharts --
		$this->layout->load_javascript("js/charts/highcharts.js");
	    $this->layout->load_javascript("js/charts/modules/exporting.js");
		
		$this->load->model('dashboardmodel');
		//total asosiasi
		$total_asosiasi = $this->dashboardmodel->get_total_asosiasi_terdaftar();
		$this->smarty->assign("total_asosiasi", $total_asosiasi);
		//total album
		$total_album = $this->dashboardmodel->get_total_album();
		$this->smarty->assign("total_album", $total_album);
		//total album
		$total_foto = $this->dashboardmodel->get_total_foto();
		$this->smarty->assign("total_foto", $total_foto);

		//total video
		$total_video = $this->dashboardmodel->get_total_video();
		$this->smarty->assign("total_video", $total_video);
		//total informasi
		$total_informasi = $this->dashboardmodel->get_total_informasi();
		$this->smarty->assign("total_informasi", $total_informasi);
		//total opini
		$total_opini = $this->dashboardmodel->get_total_opini();
		$this->smarty->assign("total_opini", $total_opini);
		//total serba-serbi
		$total_sesebi = $this->dashboardmodel->get_total_sesebi();
		$this->smarty->assign("total_sesebi", $total_sesebi);
		//harga domestik
		$harga_domestik = $this->dashboardmodel->get_harga_domestik();
		$this->smarty->assign("harga_domestik", $harga_domestik);
		//harga ekspor
		$harga_ekspor = $this->dashboardmodel->get_harga_ekspor();
		$this->smarty->assign("harga_ekspor", $harga_ekspor);
		
		//berita anggota
		$berita = $this->dashboardmodel->get_total_berita();
		$this->smarty->assign("berita", $berita);
		//berita dmsi
		$event = $this->dashboardmodel->get_total_event();
		$this->smarty->assign("event", $event);

		//total aspirasi baru
		$total_aspirasi_baru = $this->dashboardmodel->get_total_aspirasi_baru();
		$this->smarty->assign("total_aspirasi_baru", $total_aspirasi_baru);
		//total aspirasi verifikasi
		$total_aspirasi_ver = $this->dashboardmodel->get_total_aspirasi_ver();
		$this->smarty->assign("total_aspirasi_ver", $total_aspirasi_ver);
		//total aspirasi jawab
		$total_aspirasi_jaw = $this->dashboardmodel->get_total_aspirasi_jaw();
		$this->smarty->assign("total_aspirasi_jaw", $total_aspirasi_jaw);

		$this->smarty->assign("url_asosiasi", site_url('private/asosiasi'));
		$this->smarty->assign("url_foto", site_url('private/foto'));
		$this->smarty->assign("url_video", site_url('private/video'));
		$this->smarty->assign("url_informasi", site_url('private/informasi'));
		$this->smarty->assign("url_opini", site_url('private/opini'));
		$this->smarty->assign("url_sesebi", site_url('private/sesebi'));
		$this->smarty->assign("url_berita", site_url('private/berita'));
		$this->smarty->assign("url_event", site_url('private/agenda'));
		$this->smarty->assign("url_aspirasi", site_url('private/aspirasi'));
		$this->smarty->assign("url_aspirasi_ver", site_url('private/aspirasi/verifikasi'));
		$this->smarty->assign("url_aspirasi_jaw", site_url('private/aspirasi/jawaban'));
		
		//grafik
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
		 // display document
        $this->parser->parse('private/base-layout/document.html');
	}


	
	
	
	
	
	
	
	
}