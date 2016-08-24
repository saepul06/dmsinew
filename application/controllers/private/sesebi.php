<?php

class Sesebi extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
		
        $this->smarty->assign("template_content", "private/sesebi/list");
        // load
        $this->load->model('sesebimodel');
        $this->load->library('notification');
		 $this->load->library('pagination');
		  $this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
        $this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
		
		// get data
        $data = $this->sesebimodel->get_list_sesebi_limit();
		if(!empty($data)):
			foreach($data as $k=>$row):
				$pathdok = 'doc/sesebi/'.$row['id_sesebi'].'/'.$row['image'];
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
        $this->smarty->assign('url_add', site_url('private/sesebi/add'));
        $this->smarty->assign('url_list', site_url('private/sesebi/index'));
		$this->smarty->assign('url_process', site_url('private/sesebi/process/hapus'));
		$this->smarty->assign('url_edit', site_url('private/sesebi/edit'));
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
                redirect('private/berita/add');
                break;
        }
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "private/sesebi/add");
        //load
        $this->load->library('notification');
		
        $this->smarty->assign("url_add", site_url("private/sesebi/add"));
        $this->smarty->assign("url_list", site_url("private/sesebi"));
        $this->smarty->assign("url_process", site_url("private/sesebi/process/add"));
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
        $this->load->model('sesebimodel');
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
            if($this->sesebimodel->process_sesebi_add($params)) {
				$id_sesebi = $this->db->insert_id();
				 if (!empty($_FILES['image_sesebi']['tmp_name'])) {
						// set file attachment
						$_FILES['image_sesebi']['name'] = $id_sesebi.'_'.$_FILES['image_sesebi']['name'];
						$this->uploader->set_file($_FILES['image_sesebi']);
						// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
						// $rules = array('allowed_filesize' => 307200);
						// $this->uploader->set_rules($rules);
						//$this->uploader->set_file_name();
						// direktori
						$dir = 'doc/sesebi/' . $id_sesebi . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 400)) {
							$this->db->set("image",$this->uploader->get_file_name());
							$this->db->where("id_sesebi", $id_sesebi);
							$this->db->update("serbaserbi_m");
							$_FILES['image_sesebi']['name'] = 'kecil_'.$_FILES['image_sesebi']['name'];
							$this->uploader->set_file($_FILES['image_sesebi']);
							$this->uploader->upload_image($dir, 120);
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
									$dir = 'doc/sesebi/file/'. $id_sesebi.'/';
								
									if ($this->uploader->upload_file($dir)) {
											$this->db->set("file_lampiran",$this->uploader->get_file_name());
											$this->db->where("id_sesebi", $id_sesebi);
											$this->db->update("serbaserbi_m");
											
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
        redirect('private/sesebi/add');
    }
	
    public function edit() {
        // template content
        $this->smarty->assign("template_content", "private/sesebi/edit");
        // load
        $this->load->model('sesebimodel');
        $this->load->library('notification');
		$this->load->library('DateTimeManipulation');
		
        // parse url
        $this->smarty->assign("url_add", site_url("private/sesebi/add"));
        $this->smarty->assign("url_list", site_url("private/sesebi"));
        $this->smarty->assign("url_process", site_url("private/sesebi/process/edit"));
        // data
        $id_sesebi = $this->uri->segment(4, 0);
        $data = $this->sesebimodel->get_sesebi_by_id($id_sesebi);
      
		$path = 'doc/sesebi/'.$data['id_sesebi']."/";
		if(is_file($path.$data['image'])){
			$url_hapus = site_url('private/sesebi/process/hapusgambar/')."/".$data['id_sesebi'];
			$data['image_sesebi'] = '<img src="'.BASEURL.$path.$data['image'].'" border="0"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus.'\';">';
			
		}else{
			$data['image_sesebi']= '-tidak ada gambar- ';
		}
		$this->smarty->assign("image_sesebi", $data['image_sesebi']);
		
		if(!empty($data)):
			$data = $this->sesebimodel->get_sesebi_by_id($id_sesebi);
			$pathdok = 'doc/sesebi/file/'.$data['id_sesebi'].'/'.$data['file_lampiran'];
			if(is_file($pathdok)):
				$ukuran =  $this->display_ukuran_file(filesize($pathdok));
				$url_download = site_url('private/sesebi/process/download/'.$data['id_sesebi']);
				$data['file_lampiran'] = '<br />Download File Lampiran : <a href="'.$url_download.'">'.$data['file_lampiran'].' [ '.$ukuran.']</a><br />';
			endif;
			
		endif;
		 $this->smarty->assign("data", $data);
		$tanggal_opini = $this->datetimemanipulation->format_full_date($data['tanggal']);
		$this->smarty->assign("tanggal_opini", $tanggal_opini);
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
			$this->load->model('sesebimodel');
			$this->load->helper('download');
			// data
			$id_sesebi = $this->uri->segment(5,0);
			$data = $this->sesebimodel->get_sesebi_by_id($id_sesebi);
			$dir = 'doc/sesebi/file/' . $id_sesebi. '/'.$data['file_lampiran'];
			if(is_file($dir)):
				$filedata = file_get_contents($dir);
				force_download($data['file_lampiran'], $filedata);
			endif;
			redirect('private/sesebi/edit/'.$id_sesebi);
	}
	
	public function process_edit() {
        // load library
        $this->load->model('sesebimodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
		
        $this->notification->check_post('id_sesebi', 'Id Sesebi', 'required');
        $this->notification->check_post('judul', 'Judul', 'required');
        $this->notification->check_post('content', 'Content', 'required');
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
					 'id_sesebi' => $this->input->post('id_sesebi'));
            // execute
            if($this->sesebimodel->process_sesebi_edit($params)) {
				$id_sesebi = $this->input->post('id_sesebi');
				 if (!empty($_FILES['image_sesebi']['name'])) {
						// set file attachment
						$_FILES['image_sesebi']['name'] = $id_sesebi.'_'.$_FILES['image_sesebi']['name'];
						$this->uploader->set_file($_FILES['image_sesebi']);
						// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
						$rules = array('allowed_filesize' => 5120000);
						$this->uploader->set_rules($rules);
						//$this->uploader->set_file_name($id_berita);
						// direktori
						$dir = 'doc/sesebi/' . $id_sesebi . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 1000)) {
							$this->db->set("image", $this->uploader->get_file_name());
							$this->db->where("id_sesebi", $id_sesebi);
							$this->db->update("serbaserbi_m");
							$_FILES['image_sesebi']['name'] = 'kecil_'.$_FILES['image_sesebi']['name'];
							$this->uploader->set_file($_FILES['image_sesebi']);
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
									$dir = 'doc/sesebi/file/'. $id_sesebi.'/';
								
									if ($this->uploader->upload_file($dir)) {
											$this->db->set("file_lampiran",$this->uploader->get_file_name());
											$this->db->where("id_sesebi", $id_sesebi);
											$this->db->update("serbaserbi_m");
											
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
        redirect('private/sesebi/edit/'.$this->input->post('id_sesebi'));
    }


   

    public function process_hapus() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('sesebimodel');
        // set rules
        $this->notification->check_post('id_sesebi', 'id', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = $this->input->post('id_sesebi');
			if(is_array($params)):
				// execute
				foreach($params as $id):
					$sesebi = $this->sesebimodel->get_sesebi_by_id($id);
					$this->sesebimodel->process_sesebi_delete($id);
					$this->uploader->remove_dir('doc/sesebi/'.$id."/");
					

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
		redirect('private/sesebi');

    }
	
	public function hapusgambar() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('sesebimodel');
        // set rules
        $id_sesebi = $this->uri->segment(5, 0);
        // run
        if (!empty($id_sesebi)) {
            // params
          		$this->db->set('image','');
				$this->db->where('id_sesebi' , $id_sesebi);
				$this->db->update('serbaserbi_m');
				
				$this->uploader->remove_dir('doc/sesebi/'.$id_sesebi."/");
				$this->notification->set_message("Gambar berhasil dihapus");
				$this->notification->sent_notification(true);
        }
        // default redirect
		redirect('private/sesebi/edit/'.$id_sesebi);

    }
}