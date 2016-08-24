k<?php

class Download extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
		
        $this->smarty->assign("template_content", "private/download/list");
        // load
        $this->load->model('downloadmodel');
        $this->load->library('notification');
		 $this->load->library('pagination');
          $this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
        $this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
		
		// get data
        $data = $this->downloadmodel->get_list_download_limit();
		if(!empty($data)):
			foreach($data as $k=>$row):
				$pathdok = 'doc/download/'.$row['id_download'].'/'.$row['file_download'];
				if(is_file($pathdok)):
					$data[$k]['ukuran'] =  $this->display_ukuran_file(filesize($pathdok));
					$url_download = site_url('private/download/process/download/'.$row['id_download']);
					$data[$k]['file_download'] = '<a href="'.$url_download.'">'.$row['file_download'] .'</a>';
				else:
					$data[$k]['ukuran'] = '';
					$data[$k]['file_download'] = '-';
				endif;
			endforeach;
		endif;
		$this->smarty->assign("data", $data);
        $this->smarty->assign("no", 1);
		// $this->smarty->assign("total", $totaldata);
        
        // parse url
        $this->smarty->assign('url_add', site_url('private/download/add'));
        $this->smarty->assign('url_list', site_url('private/download/index'));
		$this->smarty->assign('url_process', site_url('private/download/process/hapus'));
		$this->smarty->assign('url_edit', site_url('private/download/edit'));
        // notification
        $arr_notify = $this->notification->get_notification();
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
       // display document
         $this->parser->parse('private/base-layout/document.html');
    }

    // switcher

    public function process($action) {
        switch($action) {
            case 'add':
                $this->process_add();
                break;
            case 'edit':
                $this->process_edit();
                break;
            case 'hapus':
                $this->process_hapus();
                break;
			case 'download':
				$this->download_lampiran();
				break;
            default :
            // default redirect
                redirect('private/download/add');
                break;
        }
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "private/download/add");
        //load
        $this->load->library('notification');
        // url
        $this->smarty->assign("url_add", site_url("private/download/add"));
        $this->smarty->assign("url_list", site_url("private/download"));
        $this->smarty->assign("url_process", site_url("private/download/process/add"));
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
         $this->parser->parse('private/base-layout/document.html');
    }

    public function process_add() {
        // load library
        $this->load->model('downloadmodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
        $this->notification->check_post('judul', 'Judul', 'required');
        $this->notification->check_post('judul_english', 'Judul English', 'required');
      	// run
        if ($this->notification->valid_input()) {
            // params
            $params = array(
                    'judul' => $this->input->post('judul'),
                    'judul_english' => $this->input->post('judul_english'));
            // execute
            if($this->downloadmodel->process_download_add($params)) {
				$id_download = $this->db->insert_id();
				
					if(!empty($_FILES['file']['name'])){
									$this->load->library("uploader");
									// set file attachment
									$this->uploader->set_file($_FILES['file']);
									// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
									$rules = array('allowed_filesize' => 5242880);
									$this->uploader->set_rules($rules);
									// direktori
									$dir = 'doc/download/'. $id_download.'/';
									if ($this->uploader->upload_file($dir)) {
											$this->db->set("file_download",$this->uploader->get_file_name());
											$this->db->where("id_download", $id_download);
											$this->db->update("download_m");
											
									} else {
										//echo $this->upload->message;
										$this->notification->set_message("File lampiran gagal diupload");
										$this->notification->sent_notification(false);
									}
								}
					
                $this->notification->clear_post();
                $this->notification->set_message("Data berhasil disimpan");
                $this->notification->sent_notification(true);
            }else {
                $this->notification->set_message("Data gagal disimpan");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
        // default redirect
        redirect('private/download/add');
    }
	
    public function edit() {
        // template content
        $this->smarty->assign("template_content", "private/download/edit");
        // load
        $this->load->model('downloadmodel');
        $this->load->library('notification');
		$this->load->library('DateTimeManipulation');
		
        // parse url
        $this->smarty->assign("url_add", site_url("private/download/add"));
        $this->smarty->assign("url_list", site_url("private/download"));
        $this->smarty->assign("url_process", site_url("private/download/process/edit"));
        // data
        $id_download = $this->uri->segment(4, 0);
        $data = $this->downloadmodel->get_download_by_id($id_download);
		if(!empty($data)):
			$pathdok = 'doc/download/'.$data['id_download'].'/'.$data['file_download'];
			if(is_file($pathdok)):
				$ukuran =  $this->display_ukuran_file(filesize($pathdok));
				$url_download = site_url('private/download/process/download/'.$data['id_download']);
				$data['file_download'] = '<br />Download File Lampiran : <a href="'.$url_download.'">'.$data['file_download'].' [ '.$ukuran.']</a><br />';
			endif;
			
		endif;
		 $this->smarty->assign("data", $data);
		
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
         $this->parser->parse('private/base-layout/document.html');
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
	
	public function download_lampiran(){
			$this->load->model('downloadmodel');
			$this->load->helper('download');
			// data
			$id_download = $this->uri->segment(5,0);
			$data = $this->downloadmodel->get_download_by_id($id_download);
			$dir = 'doc/download/' . $id_download. '/'.$data['file_download'];
			if(is_file($dir)):
				$filedata = file_get_contents($dir);
				force_download($data['file_download'], $filedata);
			endif;
			redirect('private/download/edit/'.$id_download);
	}
	
	public function process_edit() {
        // load library
        $this->load->model('downloadmodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
        $this->notification->check_post('id_download', 'Id ', 'required');
        $this->notification->check_post('judul', 'Judul', 'required');
        $this->notification->check_post('judul_english', 'Judul English', 'required');
       
		 // run
        if ($this->notification->valid_input()) {
		    // params
            $params = array(
                    'judul' => $this->input->post('judul'),
                    'judul_english' => $this->input->post('judul_english'),
					 'id_download' => $this->input->post('id_download'));
            // execute
            if($this->downloadmodel->process_download_edit($params)) {
				$id_download = $this->input->post('id_download');
					if(!empty($_FILES['file']['name'])){
									$this->load->library("uploader");
									// set file attachment
                                    $this->uploader->remove_dir('doc/download/'.$id_download."/");
									$this->uploader->set_file($_FILES['file']);
									// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
									$rules = array('allowed_filesize' => 5242880);
									$this->uploader->set_rules($rules);
									// direktori
									$dir = 'doc/download/'.$id_download.'/';
								    
									if ($this->uploader->upload_file($dir)) {

											$this->db->set("file_download",$this->uploader->get_file_name());
											$this->db->where("id_download", $id_download);
											$this->db->update("download_m");
											
									} else {
										//echo $this->upload->message;
										$this->notification->set_message("File gagal diupload");
										$this->notification->sent_notification(false);
									}
								}
					
                $this->notification->clear_post();
                $this->notification->set_message("Data berhasil disimpan");
                $this->notification->sent_notification(true);
            }else {
                $this->notification->set_message("Data gagal disimpan");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
        // default redirect
        redirect('private/download/edit/'.$this->input->post('id_download'));
    }


   

    public function process_hapus() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('downloadmodel');
        // set rules
        $this->notification->check_post('id_download', 'id', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = $this->input->post('id_download');
			if(is_array($params)):
				// execute
				foreach($params as $id):
					$data = $this->downloadmodel->get_download_by_id($id);
					$this->downloadmodel->process_download_delete($id);
					$this->uploader->remove_dir('doc/download/'.$id."/");
					
				endforeach;
				$this->notification->clear_post();
				$this->notification->set_message("Data berhasil dihapus");
				$this->notification->sent_notification(true);
			else:
				$this->notification->set_message("Tidak ada data yang terpilih untuk dihapus!");
				$this->notification->sent_notification(false);
			endif;
        }
        // default redirect
		redirect('private/download');

    }
	
	
}