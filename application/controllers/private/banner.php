<?php

class Banner extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
		
        $this->smarty->assign("template_content", "private/banner/list");
        // load
        $this->load->model('bannermodel');
        $this->load->library('notification');
		 $this->load->library('pagination');
         $this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
        $this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
		
		//get data
        $data = $this->bannermodel->get_list_banner();
		if(!empty($data)):
			foreach($data as $k=>$row):
				$pathdok = 'doc/banner/'.$row['id_banner'].'/'.$row['banner'];
                $pathdok_en = 'doc/banner_en/'.$row['id_banner'].'/'.$row['banner_english'];
				if(!is_file($pathdok)):
					$data[$k]['banner'] = '';
				else:
					$data[$k]['banner'] = BASEURL.$pathdok;
				endif;
				if(!is_file($pathdok_en)):
                    $data[$k]['banner_english'] = '';
                else:
                    $data[$k]['banner_english'] = BASEURL.$pathdok;
                endif;
			endforeach;


		endif;
		$this->smarty->assign("data", $data);
        $this->smarty->assign("no",1);

		// $this->smarty->assign("total", $totaldata);
        
        //parse url
        $this->smarty->assign('url_add', site_url('private/banner/add'));
        $this->smarty->assign('url_list', site_url('private/banner/index'));
		$this->smarty->assign('url_process', site_url('private/banner/process/hapus'));
		$this->smarty->assign('url_edit', site_url('private/banner/edit'));
		
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
            case 'hapusgambar_en':
                $this->hapusgambar_en();
                break;
            default :
            // default redirect
                redirect('private/berita/add');
                break;
        }
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "private/banner/add");
        //load
        $this->load->library('notification');
		$this->load->model('fotomodel');
        // url
		
		
        $this->smarty->assign("url_add", site_url("private/banner/add"));
        $this->smarty->assign("url_list", site_url("private/banner"));
        $this->smarty->assign("url_process", site_url("private/banner/process/add"));
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
      
		
        $this->load->model('bannermodel');
        $this->load->library('notification');
		$this->load->library("uploader");
        // set rules
		
		$this->notification->check_post('nama_banner', 'Nama Banner', 'required');
         $this->notification->check_post('nama_english', 'Nama Album English', 'required');
         $this->notification->check_post('masa_aktif', 'Masa Aktif', 'required');
          if($this->input->post('masa_aktif') == 'sementara'):
            $this->notification->check_post('tanggal_mulai', 'Tanggal Mulai', 'required');
            $this->notification->check_post('tanggal_berakhir', 'Tanggal Berakhir', 'required');
          endif;
         $this->notification->check_post('urutan', 'Urutan', 'required');
         $this->notification->check_post('status', 'Status', 'required');
		// run
        if ($this->notification->valid_input()) {
            // params
            if($this->input->post('masa_aktif') == 'sementara'){
            $params = array(
					'nama_banner' => $this->input->post('nama_banner'),
                    'nama_english' => $this->input->post('nama_english'),
                    'masa_aktif' => $this->input->post('masa_aktif'),
                    'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                    'tanggal_berakhir' => $this->input->post('tanggal_berakhir'),
                    'urutan' => $this->input->post('urutan'),
                    'status' => $this->input->post('status')
                    );
            }else{
                 $params = array(
                    'nama_banner' => $this->input->post('nama_banner'),
                    'nama_english' => $this->input->post('nama_english'),
                    'masa_aktif' => $this->input->post('masa_aktif'),
                     'tanggal_mulai' => '2000-01-01',
                    'tanggal_berakhir' => '9999-12-31',
                    'urutan' => $this->input->post('urutan'),
                    'status' => $this->input->post('status')
                    );
            }
            // execute
            if($this->bannermodel->process_banner_add($params)) {
				$id_banner = $this->db->insert_id();
				 if (!empty($_FILES['banner']['tmp_name'])) {
						// set file attachment
						$_FILES['banner']['name'] = $id_banner.'_'.$_FILES['banner']['name'];
						$this->uploader->set_file($_FILES['banner']);
						// set rules (kosongkan jika tidak menggunakan batasan sama sekali)
						// $rules = array('allowed_filesize' => 307200);
						// $this->uploader->set_rules($rules);
						//$this->uploader->set_file_name();
						// direktori
						$dir = 'doc/banner/' . $id_banner . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 1000)) {
							$this->db->set("banner",$this->uploader->get_file_name());
							$this->db->where("id_banner", $id_banner);
							$this->db->update("banner_m");
							
						} else {
							//echo $this->upload->message;
							$this->notification->set_message("Banner gagal diupload");
							$this->notification->sent_notification(false);
						}
            		}

                    // versi english
                     if (!empty($_FILES['banner_en']['tmp_name'])) {
                        // set file attachment
                        $_FILES['banner_en']['name'] = $id_banner.'_'.$_FILES['banner_en']['name'];
                        $this->uploader->set_file($_FILES['banner_en']);
                        // set rules (kosongkan jika tidak menggunakan batasan sama sekali)
                        // $rules = array('allowed_filesize' => 307200);
                        // $this->uploader->set_rules($rules);
                        //$this->uploader->set_file_name();
                        // direktori
                        $dir = 'doc/banner_en/' . $id_banner . '/';
                        // proses upload
                        if ($this->uploader->upload_image($dir, 5000)) {
                            $this->db->set("banner_english",$this->uploader->get_file_name());
                            $this->db->where("id_banner", $id_banner);
                            $this->db->update("banner_m");
                            
                        } else {
                            //echo $this->upload->message;
                            $this->notification->set_message("Banner gagal diupload");
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
        redirect('private/banner/add');
    }

    
    
	
    public function edit() {
        // template content

        $this->smarty->assign("template_content", "private/banner/edit");
        // load
        $this->load->model('bannermodel');
        $this->load->library('notification');
		$this->load->library('DateTimeManipulation');
		
        // parse url
        $this->smarty->assign("url_add", site_url("private/banner/add"));
        $this->smarty->assign("url_list", site_url("private/banner"));
        $this->smarty->assign("url_process", site_url("private/banner/process/edit"));
        // data
        /// GET DATA album


		$banner = $this->bannermodel->get_list_banner();
		$this->smarty->assign("banner", $banner);

		
        $id_banner = $this->uri->segment(4, 0);
        $data = $this->bannermodel->get_banner_by_id($id_banner);
      	
      
       
      
		$path = 'doc/banner/'.$id_banner."/";
		if(is_file($path.$data['banner'])){
			$url_hapus = site_url('private/banner/process/hapusgambar/')."/".$data['id_banner'];
			$data['banner'] = '<img src="'.BASEURL.$path.$data['banner'].'" border="0"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus.'\';">';


			
		}else{
			$data['banner']= '-tidak ada gambar- ';
		}
		$this->smarty->assign("banner", $data['banner']);

        //banner en
        $path_en = 'doc/banner_en/'.$id_banner."/";
        if(is_file($path_en.$data['banner_english'])){
            $url_hapus_en = site_url('private/banner/process/hapusgambar_en/')."/".$data['id_banner'];
            $data['banner_english'] = '<img src="'.BASEURL.$path_en.$data['banner_english'].'" border="0"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus_en.'\';">';

            
            
        }else{
            $data['banner']= '-tidak ada gambar- ';
        }
        $this->smarty->assign("banner_en", $data['banner_english']);
		///ASIGN DATA variable nya ke smarty
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
    public function process_edit() {
        // load library
        $this->load->model('bannermodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
		
        $this->notification->check_post('nama_banner', 'Nama Banner', 'required');
         $this->notification->check_post('nama_english', 'Nama Album English', 'required');
         $this->notification->check_post('masa_aktif', 'Masa Aktif', 'required');
          if($this->input->post('masa_aktif') == 'sementara'):
            $this->notification->check_post('tanggal_mulai', 'Tanggal Mulai', 'required');
            $this->notification->check_post('tanggal_berakhir', 'Tanggal Berakhir', 'required');
          endif;
         $this->notification->check_post('urutan', 'Urutan', 'required');
         $this->notification->check_post('status', 'Status', 'required');
		 // run
        if ($this->notification->valid_input()) {
		    // params
             if($this->input->post('masa_aktif') == 'sementara'){
            $params = array(
                    'nama_banner' => $this->input->post('nama_banner'),
                    'nama_english' => $this->input->post('nama_english'),
                    'masa_aktif' => $this->input->post('masa_aktif'),
                    'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                    'tanggal_berakhir' => $this->input->post('tanggal_berakhir'),
                    'urutan' => $this->input->post('urutan'),
                    'status' => $this->input->post('status'),
                    'id_banner' => $this->input->post('id_banner')
                    );
            }else{
                 $params = array(
                    'nama_banner' => $this->input->post('nama_banner'),
                    'nama_english' => $this->input->post('nama_english'),
                    'masa_aktif' => $this->input->post('masa_aktif'),
                     'tanggal_mulai' => '2000-01-01',
                    'tanggal_berakhir' => '9999-12-31',
                    'urutan' => $this->input->post('urutan'),
                    'status' => $this->input->post('status'),
                    'id_banner' => $this->input->post('id_banner')
                    );
            }
            // execute
            if($this->bannermodel->process_banner_edit($params)) {
				$id_banner = $this->input->post('id_banner');
				 if (!empty($_FILES['banner']['tmp_name'])) {
                        // set file attachment
                        $_FILES['banner']['name'] = $id_banner.'_'.$_FILES['banner']['name'];
                        $this->uploader->remove_dir('doc/banner/'.$id_banner."/");
                        $this->uploader->set_file($_FILES['banner']);
                        // set rules (kosongkan jika tidak menggunakan batasan sama sekali)
                        // $rules = array('allowed_filesize' => 307200);
                        // $this->uploader->set_rules($rules);
                        //$this->uploader->set_file_name();
                        // direktori
                        $dir = 'doc/banner/' . $id_banner . '/';
                        // proses upload
                       if ($this->uploader->upload_image($dir, 5000))  {
                            $this->db->set("banner",$this->uploader->get_file_name());
                            $this->db->where("id_banner", $id_banner);
                            $this->db->update("banner_m");
                            
                        } else {
                            //echo $this->upload->message;
                            $this->notification->set_message("File Gambar gagal diupload");
                            $this->notification->sent_notification(false);
                        }
                    }

                    // versi english
                     if (!empty($_FILES['banner_en']['tmp_name'])) {
                        // set file attachment
                        $_FILES['banner_en']['name'] = $id_banner.'_'.$_FILES['banner_en']['name'];
                        $this->uploader->remove_dir('doc/banner_en/'.$id_banner."/");
                        $this->uploader->set_file($_FILES['banner_en']);
                        // set rules (kosongkan jika tidak menggunakan batasan sama sekali)
                        // $rules = array('allowed_filesize' => 307200);
                        // $this->uploader->set_rules($rules);
                        //$this->uploader->set_file_name();
                        // direktori
                        $dir = 'doc/banner_en/' . $id_banner . '/';
                        // proses upload
                        if ($this->uploader->upload_image($dir, 5000)) {
                            $this->db->set("banner_english",$this->uploader->get_file_name());
                            $this->db->where("id_banner", $id_banner);
                            $this->db->update("banner_m");
                            
                        } else {
                            //echo $this->upload->message;
                            $this->notification->set_message("Banner gagal diupload");
                            $this->notification->sent_notification(false);
                        }
                    }
					
				  
                $this->notification->clear_post();
                $this->notification->set_message("Data berhasil disimpan");
                $this->notification->sent_notification(true);
                  redirect('private/banner/edit/'.$this->input->post('id_banner'));
            }else {
                $this->notification->set_message("Data gagal disimpan");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
        // default redirect
        redirect('private/banner/edit/'.$this->input->post('id_banner'));
    }
   
    
    

    public function process_hapus() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('bannermodel');
        // set rules
        $this->notification->check_post('id_banner', 'id', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = $this->input->post('id_banner');
			if(is_array($params)):
				// execute
				foreach($params as $id):
					$banner= $this->bannermodel->get_banner_by_id($id);
					$this->bannermodel->process_banner_delete($id);
                    $this->uploader->remove_dir('doc/banner/'.$id."/");
					

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
		redirect('private/banner');

    }

     
	
	public function hapusgambar() {
        // load library
        $this->load->library('notification');
		$this->load->library('uploader');
        $this->load->model('bannermodel');
        // set rules
        $id_banner = $this->uri->segment(5, 0);
        // run
        if (!empty($id_banner)) {
            // params
          		$this->db->set('banner','');
				$this->db->where('id_banner' , $id_banner);
				$this->db->update('banner_m');
				
				$this->uploader->remove_dir('doc/banner/'.$id_banner."/");
				$this->notification->set_message("Gambar berhasil dihapus");
				$this->notification->sent_notification(true);
        }
        // default redirect
		redirect('private/banner/edit/'.$id_banner);

    }

    public function hapusgambar_en() {
        // load library
        $this->load->library('notification');
        $this->load->library('uploader');
        $this->load->model('bannermodel');
        // set rules
        $id_banner = $this->uri->segment(5, 0);
        // run
        if (!empty($id_banner)) {
            // params
                $this->db->set('banner_english','');
                $this->db->where('id_banner' , $id_banner);
                $this->db->update('banner_m');
                
                $this->uploader->remove_dir('doc/banner_en/'.$id_banner."/");
                $this->notification->set_message("Gambar berhasil dihapus");
                $this->notification->sent_notification(true);
        }
        // default redirect
        redirect('private/banner/edit/'.$id_banner);

    }

   
}