<?php

class Program extends MY_Controller {

     function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "private/program/edit");
        // load
        $this->load->model('programmodel');
        $this->load->library('notification');
		$this->load->library('DateTimeManipulation');
		
         $data = $this->programmodel->get_program_info();
      
        $path = 'doc/program/'.$data['id_program']."/";
        if(is_file($path.$data['image'])){
            $url_hapus = site_url('private/program/process/hapusgambar/')."/".$data['id_program'];
            $data['image'] = '<img src="'.BASEURL.$path.$data['image'].'" border="0" height="200px"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus.'\';">';
            
        }else{
            $data['image']= '-tidak ada gambar- ';
        }
        $this->smarty->assign("image_program", $data['image']);
        // parse url
        $this->smarty->assign("url_process", site_url("private/program/process/edit"));
        // data
        
        $data = $this->programmodel->get_program_info();
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

    // switcher

    

    public function process($action) {
        switch($action) {
            case 'edit':
                $this->process_edit();
                break;
            case 'hapusgambar':
                $this->hapusgambar();
                break;
           
            default :
            // default redirect
                redirect('private/program');
                break;
        }
    }
    
    
	
	public function process_edit() {
        // load library
        $this->load->model('programmodel');
        $this->load->library('notification');
		 $this->load->library("uploader");
        // set rules
		$this->notification->check_post('judul_program', 'Judul', 'required');
        $this->notification->check_post('tanggal', 'Tanggal', 'required');
		 
        
         // run
        if ($this->notification->valid_input()) {
		    // params
            $params = array(
					'judul_program' => $this->input->post('judul_program'),
					'tanggal' => $this->input->post('tanggal'),
                    'judul_english' => $this->input->post('judul_english'));
               if($this->programmodel->process_program_edit($params)) {
                $id_program = '1';
                 if (!empty($_FILES['image_program']['tmp_name'])) {
                        // set file attachment
                        $_FILES['image_program']['name'] = $_FILES['image_program']['name'];
                        $this->uploader->set_file($_FILES['image_program']);
                        // set rules (kosongkan jika tidak menggunakan batasan sama sekali)
                        $rules = array('allowed_filesize' => 5120000);
                        $this->uploader->set_rules($rules);
                        // direktori
                        $dir = 'doc/program/' . $id_program . '/';
                        // proses upload
                        if ($this->uploader->upload_image($dir, 1000)) {
                            $this->db->set("image",$this->uploader->get_file_name());
                            $this->db->where("id_program", $id_program);
                            $this->db->update("program_m");
                            
                        } else {
                            //echo $this->upload->message;
                            $this->notification->set_message("File Gambar gagal diupload");
                            $this->notification->sent_notification(false);
                        }
                    }
                    print_r($this->programmodel->process_program_edit($params));
                }
                
            // execute
            if($this->programmodel->process_program_edit($params)) {
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
        redirect('private/program');
    }

    public function hapusgambar() {
        // load library
        $this->load->library('notification');
        $this->load->library('uploader');
        $this->load->model('programmodel');
        // set rules
        $id_program = '1';
        // run
        if (!empty($id_program)) {
            // params
                $this->db->set('image','');
                $this->db->where('id_program' , $id_program);
                $this->db->update('program_m');
                
                $this->uploader->remove_dir('doc/program/'.$id_program."/");
                $this->notification->set_message("Gambar berhasil dihapus");
                $this->notification->sent_notification(true);
        }
        // default redirect
        redirect('private/program');

    }


}