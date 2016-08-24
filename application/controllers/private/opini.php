<?php

class Opini extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
		
        $this->smarty->assign("template_content", "private/opini/list");
        // load
        $this->load->model('opinimodel');
        $this->load->library('notification');
		 $this->load->library('pagination');
		 $this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
        $this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
		 
		// get data
        $data = $this->opinimodel->get_list_opini_limit();
		if(!empty($data)):
			foreach($data as $k=>$row):
				$pathdok = 'doc/opini/'.$row['id_opini'].'/'.$row['image'];
				if(!is_file($pathdok)):
					$data[$k]['image'] = '';
				else:
					$data[$k]['image'] = BASEURL.$pathdok;
				endif;

			endforeach;
		endif;
		$this->smarty->assign("data", $data);
		 $this->smarty->assign("no",1);
		// $this->smarty->assign("total", $totaldata);
        
        // parse url
        $this->smarty->assign('url_add', site_url('private/opini/add'));
        $this->smarty->assign('url_list', site_url('private/opini/index'));
		$this->smarty->assign('url_process', site_url('private/opini/process/hapus'));
		$this->smarty->assign('url_edit', site_url('private/opini/edit'));
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
			case 'hapusgambar':
                $this->hapusgambar();
                break;
			case 'download':
				$this->download_lampiran();
				break;
            default :
            // default redirect
                redirect('private/opini/add');
                break;
        }
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "private/opini/add");
        //load
        $this->load->library('notification');
		
        $this->smarty->assign("url_add", site_url("private/opini/add"));
        $this->smarty->assign("url_list", site_url("private/opini"));
        $this->smarty->assign("url_process", site_url("private/opini/process/add"));
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
        $this->load->model('opinimodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
		
        $this->notification->check_post('judul', 'Judul', 'required');
        $this->notification->check_post('content', 'Konten', 'required');
		$this->notification->check_post('tanggal', 'Tanggal', 'required');
		$this->notification->check_post('judul_english', 'Judul English', 'required');
		$this->notification->check_post('content_english', 'Konten English', 'required');
		// run
        if ($this->notification->valid_input()) {
            // params
            $params = array(
                    'judul' => $this->input->post('judul'),
                    'content' => $this->input->post('content'),
                    'tanggal' => $this->input->post('tanggal'),
					'keterangan_gambar' => $this->input->post('keterangan_gambar'),
					'judul_english' => $this->input->post('judul_english'),
                    'content_english' => $this->input->post('content_english'),
                    'caption_picture' => $this->input->post('caption_picture'));
            // execute
            if($this->opinimodel->process_opini_add($params)) {
				$id_opini = $this->db->insert_id();
				 if (!empty($_FILES['image_opini']['tmp_name'])) {
						// set file attachment
						$_FILES['image_opini']['name'] = $id_opini.'_'.$_FILES['image_opini']['name'];
						$this->uploader->set_file($_FILES['image_opini']);
						// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
						$rules = array('allowed_filesize' => 5120000);
						$this->uploader->set_rules($rules);
						//$this->uploader->set_file_name();
						// direktori
						$dir = 'doc/opini/' . $id_opini . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 1000)) {
							$this->db->set("image",$this->uploader->get_file_name());
							$this->db->where("id_opini", $id_opini);
							$this->db->update("opini_m");
							$_FILES['image_opini']['name'] = 'kecil_'.$_FILES['image_opini']['name'];
							$this->uploader->set_file($_FILES['image_opini']);
							$this->uploader->upload_image($dir, 500);
						} else {
							//echo $this->upload->message;
							$this->notification->set_message("File Gambar gagal diupload");
							$this->notification->sent_notification(false);
						}
            		}
					if(!empty($_FILES['file']['name'])){
									$this->load->library("uploader");
									// set file attachment
									$this->uploader->set_file($_FILES['file']);
									// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
									$rules = array('allowed_filesize' => 10000000);
									$this->uploader->set_rules($rules);
									// direktori
									$dir = 'doc/opini/file/'. $id_opini.'/';
								
									if ($this->uploader->upload_file($dir)) {
											$this->db->set("file_lampiran",$this->uploader->get_file_name());
											$this->db->where("id_opini", $id_opini);
											$this->db->update("opini_m");
											
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
        redirect('private/opini/add');
    }
	
    public function edit() {
        // template content
        $this->smarty->assign("template_content", "private/opini/edit");
        // load
        $this->load->model('opinimodel');
        $this->load->library('notification');
		$this->load->library('DateTimeManipulation');
		
        // parse url
        $this->smarty->assign("url_add", site_url("private/opini/add"));
        $this->smarty->assign("url_list", site_url("private/opini"));
        $this->smarty->assign("url_process", site_url("private/opini/process/edit"));
        // data
        $id_opini = $this->uri->segment(4, 0);
        $data = $this->opinimodel->get_opini_by_id($id_opini);
      
		$path = 'doc/opini/'.$data['id_opini']."/";
		if(is_file($path.$data['image'])){
			$url_hapus = site_url('private/opini/process/hapusgambar/')."/".$data['id_opini'];
			$data['image_opini'] = '<img src="'.BASEURL.$path.$data['image'].'" border="0" height="200px"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus.'\';">';
			
		}else{
			$data['image_opini']= '-tidak ada gambar- ';
		}
		$this->smarty->assign("image_opini", $data['image_opini']);
		
		if(!empty($data)):
			$data = $this->opinimodel->get_opini_by_id($id_opini);
			$pathdok = 'doc/opini/file/'.$data['id_opini'].'/'.$data['file_lampiran'];
			if(is_file($pathdok)):
				$ukuran =  $this->display_ukuran_file(filesize($pathdok));
				$url_download = site_url('private/opini/process/download/'.$data['id_opini']);
				$data['file_lampiran'] = '<br />Download File Lampiran : <a href="'.$url_download.'">'.$data['file_lampiran'].' [ '.$ukuran.']</a><br />';
			endif;
			
		endif;
		 $this->smarty->assign("data", $data);
		$tanggal = $this->datetimemanipulation->format_full_date($data['tanggal']);
		$this->smarty->assign("tanggal", $tanggal);
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
			$this->load->model('opinimodel');
			$this->load->helper('download');
			// data
			$id_opini = $this->uri->segment(5,0);
			$data = $this->opinimodel->get_opini_by_id($id_opini);
			$dir = 'doc/opini/file/' . $id_opini. '/'.$data['file_lampiran'];
			if(is_file($dir)):
				$filedata = file_get_contents($dir);
				force_download($data['file_lampiran'], $filedata);
			endif;
			redirect('private/opini/edit/'.$id_opini);
	}
	
	public function process_edit() {
         // load library
        $this->load->model('opinimodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules

          $this->notification->check_post('judul', 'Judul', 'required');
        $this->notification->check_post('content', 'Konten', 'required');
		$this->notification->check_post('tanggal', 'Tanggal', 'required');
		$this->notification->check_post('judul_english', 'Judul English', 'required');
		$this->notification->check_post('content_english', 'Konten English', 'required');
		// run
        if ($this->notification->valid_input()) {
            // params
            $params = array(
                    'judul' => $this->input->post('judul'),
                    'content' => $this->input->post('content'),
                    'tanggal' => $this->input->post('tanggal'),
					'keterangan_gambar' => $this->input->post('keterangan_gambar'),
					'judul_english' => $this->input->post('judul_english'),
                    'content_english' => $this->input->post('content_english'),
                    'caption_picture' => $this->input->post('caption_picture'),
					 'id_opini' => $this->input->post('id_opini'));
            // execute
            if($this->opinimodel->process_opini_edit($params)) {
				$id_opini= $this->input->post('id_opini');
				 if (!empty($_FILES['image_opini']['name'])) {
						// set file attachment
						$_FILES['image_opini']['name'] = $id_opini.'_'.$_FILES['image_opini']['name'];
						$this->uploader->set_file($_FILES['image_opini']);
						// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
						$rules = array('allowed_filesize' => 5120000);
						$this->uploader->set_rules($rules);
						//$this->uploader->set_file_name($id_berita);
						// direktori
						$dir = 'doc/opini/' . $id_opini . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 1000)) {
							$this->db->set("image", $this->uploader->get_file_name());
							$this->db->where("id_opini", $id_opini);
							$this->db->update("opini_m");
							$_FILES['image_opini']['name'] = 'kecil_'.$_FILES['image_opini']['name'];
							$this->uploader->set_file($_FILES['image_opini']);
							$this->uploader->upload_image($dir, 500);
						} else {
							$this->notification->set_message("Data gagal disimpan");
							$this->notification->set_message("File Gambar gagal diupload, ".$this->uploader->message);
							$this->notification->sent_notification(false);
						}
            		}
					if(!empty($_FILES['file']['name'])){
									$this->load->library("uploader");
									// set file attachment
									$this->uploader->set_file($_FILES['file']);
									// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
									$rules = array('allowed_filesize' => 10000000);
									$this->uploader->set_rules($rules);
									// direktori
									$dir = 'doc/opini/file/'.$id_opini.'/';
								
									if ($this->uploader->upload_file($dir)) {
											$this->db->set("file_lampiran",$this->uploader->get_file_name());
											$this->db->where("id_opini", $id_opini);
											$this->db->update("opini_m");
											
									} else {
										//echo $this->upload->message;
										$this->notification->set_message("File Gambar gagal diupload");
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
     
        redirect('private/opini/edit/'.$this->input->post('id_opini'));
    }


   

    public function process_hapus() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('opinimodel');
        // set rules
        $this->notification->check_post('id_opini', 'id', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = $this->input->post('id_opini');
			if(is_array($params)):
				// execute
				foreach($params as $id):
					$opini = $this->opinimodel->get_opini_by_id($id);
					$this->opinimodel->process_opini_delete($id);
					$this->uploader->remove_dir('doc/opini/'.$id."/");
					

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
		redirect('private/opini');

    }
	
	public function hapusgambar() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('opinimodel');
        // set rules
        $id_opini = $this->uri->segment(5, 0);
        // run
        if (!empty($id_opini)) {
            // params
          		$this->db->set('image','');
				$this->db->where('id_opini' , $id_opini);
				$this->db->update('opini_m');
				
				$this->uploader->remove_dir('doc/opini/'.$id_opini."/");
				$this->notification->set_message("Gambar berhasil dihapus");
				$this->notification->sent_notification(true);
        }
        // default redirect
		redirect('private/opini/edit/'.$id_opini);

    }
}