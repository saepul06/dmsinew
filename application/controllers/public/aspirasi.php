<?php
// important * untuk application base dari halaman ini

class Aspirasi extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->Webappbase();
	   $this->load->library('datetimemanipulation');
    }

    // pages
    public function index() {
		// template content
       $this->smarty->assign('template_content',"web/aspirasi/aspirasi.html");
        // load
		$this->load->library('notification');
		 $this->load->model('aspirasimodel');
		//get data foto
        
		
		// notification
        $arr_notify = $this->notification->get_notification();
		if (!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
			
        }

       
         // get data asosiasi
      	$listasosiasi = $this->aspirasimodel->get_list_asosiasi();
		$this->smarty->assign('listasosiasi', $listasosiasi);


        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
		
		if($this->act_lang == 'en'){
			$this->smarty->assign("page_modul", 'Aspiration');
		}else{
			$this->smarty->assign("page_modul", 'Aspirasi');
		}
		
		
		$this->smarty->assign("page_modul_url", site_url('public/aspirasi'));
		$this->smarty->assign("url_process_aspirasi", site_url('public/aspirasi/send'));
		
		$this->smarty->assign("url_captcha", site_url('public/aspirasi/captcha'));
	
        // display document
        $this->parser->parse('web/base-layout/document-full.html');
    }
	public function send() {
          // load library
        $this->load->model('aspirasimodel');
        $this->load->library('notification');
		$this->load->library("uploader");

		// run
		
        if ($this->notification->valid_input()) {
        	if(!$this->cekvalidasi()):
				$this->notification->set_message("Kode Validasi yang dimasukkan tidak benar, harap ulangi kembali!");
				$this->notification->sent_notification(false);
				redirect('public/aspirasi');
			endif;
			
          
            // params
            $params = array(
					'id_asosiasi' => $this->input->post('id_asosiasi'),
                    'nama_pengirim' => $this->input->post('nama_pengirim'),
                    'pekerjaan' => $this->input->post('pekerjaan'),
                    'email' => $this->input->post('email'),
                    'judul' => $this->input->post('judul'),
                    'isi_aspirasi' => $this->input->post('isi_aspirasi'),
                    'tanggal' => $this->input->post('tanggal'));
            // executs
              if($this->aspirasimodel->process_aspirasi_send($params)) {
					$id_aspirasi = $this->db->insert_id();
				 if (!empty($_FILES['foto']['tmp_name'])) {
						// set file attachment
						$_FILES['foto']['name'] = $id_aspirasi.'_'.$_FILES['foto']['name'];
						$this->uploader->set_file($_FILES['foto']);
						
						// direktori
						$dir = 'doc/aspirasi/' . $id_aspirasi . '/';
						// proses upload
						if ($this->uploader->upload_image($dir, 400)) {
							$this->db->set("foto",$this->uploader->get_file_name());
							$this->db->where("id_aspirasi", $id_aspirasi);
							$this->db->update("aspirasi_m");
							// $_FILES['foto']['name'] = 'kecil_'.$_FILES['foto']['name'];
							// $this->uploader->set_file($_FILES['foto']);
							// $this->uploader->upload_image($dir, 120);
						} else {
							//echo $this->upload->message;
							$this->notification->set_message("File Gambar gagal diupload");
							$this->notification->sent_notification(false);
						}
            		}
					
				    
                $this->notification->clear_post();
                $this->notification->set_message("Data berhasil dikirim");
                $this->notification->sent_notification(true);
            }else {
                $this->notification->set_message("Data gagal dikirim");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
   
        // default redirect
        redirect('public/aspirasi/');
    }
	
	public function cekvalidasi(){
		//cek kode validasi 
			$captcha_string  = strtolower($this->session->userdata('random_number'));
			//echo $captcha_string.'==='.$this->input->post("kode_validasi"); exit;
			 if(strtolower($this->input->post("kode_validasi")) == $captcha_string){  
			 	return true;
			}else{
				return false;
			}
			
	}
	
	
	//create captcha 
	public function captcha(){
		$string = '';

		for ($i = 0; $i < 5; $i++) {
			$string .= chr(rand(97, 122));
		}
		
		
		//$_SESSION['random_number'] = $string;
		$this->session->set_userdata('random_number', $string);
		
		//echo $this->session->userdata('random_number');exit;
		
		$dir = 'themes/fonts/';
		
		$image = imagecreatetruecolor(165, 50);
		
		// random number 1 or 2
		$num = rand(1,2);
		if($num==1)
		{
			$font = "Capture it 2.ttf"; // font style
		}
		else
		{
			$font = "Molot.otf";// font style
		}
		
		// random number 1 or 2
		$num2 = rand(1,2);
		if($num2==1)
		{
			$color = imagecolorallocate($image, 113, 193, 217);// color
		}
		else
		{
			$color = imagecolorallocate($image, 163, 197, 82);// color
		}
		
		$white = imagecolorallocate($image, 255, 255, 255); // background color white
		imagefilledrectangle($image,0,0,399,99,$white);
		
		imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $this->session->userdata('random_number') );
		
		header("Content-type: image/png");
		imagepng($image);
	}
	
	
	
	
}