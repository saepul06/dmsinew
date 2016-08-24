<?php
class Administrator extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "private/administrator/list");
        // load
        $this->load->model('adminmodel');
		$this->load->model('kotamodel');
        $this->load->library('notification');
		$this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
		$this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
		
        // parse url
        $this->smarty->assign('url_add', site_url('private/administrator/add'));
        $this->smarty->assign('url_list', site_url('private/administrator'));
		$this->smarty->assign('url_edit', site_url('private/administrator/edit'));
		$this->smarty->assign('url_hapus',site_url('private/administrator/hapus'));
		$this->smarty->assign('url_search',site_url('private/administrator/index'));
		$this->smarty->assign('url_delete',site_url('private/administrator/hapus'));
		
		 
		
        // data
        $data = $this->adminmodel->get_administrator_list();
		// parse data
        $this->smarty->assign('no', 1);
        $this->smarty->assign('data', $data);
		$this->smarty->assign('NAMA_INSTANSI', NAMA_INSTANSI);
        // notification
        $arr_notify = $this->notification->get_notification();
		
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
		$this->parser->parse( 'private/base-layout/document.html');
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "private/administrator/add");
        // load
        $this->load->model('adminmodel');
		$this->load->model('kotamodel');
        $this->load->library('notification');
       
        // parse url
        $this->smarty->assign('url_add', site_url('private/administrator/add'));
        $this->smarty->assign('url_list', site_url('private/administrator'));
        $this->smarty->assign('url_process', site_url('private/administrator/process/add'));
		
       // list asosiasi
        $data_asosiasi = $this->adminmodel->get_list_asosiasi();
        $this->smarty->assign('data_asosiasi', $data_asosiasi);

         // list hak akses
        $data_auth = $this->adminmodel->get_list_auth();
        $this->smarty->assign('data_auth', $data_auth);

        // list propinsi
        $data_propinsi = $this->adminmodel->get_list_propinsi();
        $this->smarty->assign('propinsi', $data_propinsi);
		
		
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
			// // list kota
			// $data_kota = $this->kotamodel->get_data_kota_all($arr_notify['post']['id_propinsi']);
			// $this->smarty->assign('data_kota', $data_kota);
			// //list museum 
		
			$this->smarty->assign("data", $arr_notify['post']);
        }
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
		$this->parser->parse( 'private/base-layout/document.html');
    }
	
	
	

    public function edit($id_user = '') {
        // template content
        $this->smarty->assign("template_content", "private/administrator/edit");
        // load
        $this->load->model('adminmodel');
		$this->load->model('kotamodel');
        $this->load->library('notification');
        $this->load->library('cryptosimple');
       
        // parse url
        $this->smarty->assign('url_add', site_url('private/administrator/add'));
        $this->smarty->assign('url_list', site_url('private/administrator'));
        $this->smarty->assign('url_process', site_url('private/administrator/process/edit'));
		$this->smarty->assign('url_kota',site_url('private/administrator/process/kota_by_propinsi'));
	
        // data
               // list asosiasi
        $data_asosiasi = $this->adminmodel->get_list_asosiasi();
        $this->smarty->assign('data_asosiasi', $data_asosiasi);

         // list hak akses
        $data_auth = $this->adminmodel->get_list_auth();
        $this->smarty->assign('data_auth', $data_auth);
        // detail administrator
        $data_admin = $this->adminmodel->get_administrator_by_id($id_user);
        // password
        if($data_admin) {
            $data_admin['user_pass'] = $this->cryptosimple->do_decryption($data_admin['user_pass'], $data_admin['user_key']);
            $this->smarty->assign('data', $data_admin);
        }
   
        // list propinsi
        $data_propinsi = $this->adminmodel->get_list_propinsi();
        $this->smarty->assign('propinsi', $data_propinsi);
		
		if(!empty($data_admin['id_propinsi'])):
			$data_kota = $this->kotamodel->get_data_kota_all($data_admin['id_propinsi']);
			$this->smarty->assign('data_kota', $data_kota);
		endif;
		
		
        // notification
        $arr_notify = $this->notification->get_notification();
			if(!empty($arr_notify['post'])) {
				$this->smarty->assign("data", $arr_notify['post']);
				if(!empty($arr_notify['post']['id_propinsi'])):
					$data_kota = $this->kotamodel->get_data_kota_all($arr_notify['post']['id_propinsi']);
					$this->smarty->assign('data_kota', $data_kota);
				endif;
			
			
        }
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $notification_status = (empty($arr_notify['message_status'])?'red':'green');
        $this->smarty->assign("notification_status", $notification_status);
        // display document
		$this->parser->parse( 'private/base-layout/document.html');
    }

    public function hapus($id_user = '') {
        // template content
        $this->smarty->assign("template_content", "private/administrator/hapus");
        // load
        $this->load->model('adminmodel');
		$this->load->model('kotamodel');
        $this->load->library('notification');
        $this->load->library('cryptosimple');
        // parse url
        $this->smarty->assign('url_add', site_url('private/administrator/add'));
        $this->smarty->assign('url_list', site_url('private/administrator'));
        $this->smarty->assign('url_process', site_url('private/administrator/process/hapus'));
        // data
        // detail administrator
        $data_admin = $this->adminmodel->get_administrator_by_id($id_user);
        // password
        if($data_admin) {
            $data_admin['user_pass'] = $this->cryptosimple->do_decryption($data_admin['user_pass'], $data_admin['user_key']);
            $this->smarty->assign('data', $data_admin);
			// list hak akses
			$data_auth = $this->adminmodel->get_authority_by_group(2);
			$this->smarty->assign('data_auth', $data_auth);
			// list propinsi
			$data_propinsi = $this->adminmodel->get_list_propinsi();
			$this->smarty->assign('propinsi', $data_propinsi);
			
			if(!empty($data_admin['id_propinsi'])):
				$data_kota = $this->kotamodel->get_data_kota_all($data_admin['id_propinsi']);
				$this->smarty->assign('data_kota', $data_kota);
			endif;
			
			
        }
        // notification
        $arr_notify = $this->notification->get_notification();
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $notification_status = (empty($arr_notify['message_status'])?'red':'green');
        $this->smarty->assign("notification_status", $notification_status);
        // display document
		$this->parser->parse( 'private/base-layout/document.html');
    }

    // data processing

    public function process($action) {
        switch($action) {
            case 'add':
                $this->process_add();
                break;
            case 'edit':
                $this->process_edit();
                break;
            case 'hapus':
                $this->process_delete();
                break;
			case 'kota_by_propinsi':
				$this->process_ajax_kota_by_propinsi();
				 break;
			case 'museum_by_kota':
				$this->process_ajax_museum_by_kota();
				 break;
            default :
            // default redirect
                redirect('private/administrator/add');
                break;
        }
    }

    private function process_add() {
        // load
        $this->load->model('adminmodel');
        $this->load->library('notification');
        $this->load->library('cryptosimple');
        // set rules
        $this->notification->check_post('admin_name', 'Nama', 'required');
        $this->notification->check_post('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->notification->check_post('id_asosiasi', 'Hak Akses Asosiasi', 'required');
		
        $this->notification->check_post('user_mail', 'Email', 'required');
        $this->notification->check_post('user_name', 'Username', 'required');
        $this->notification->check_post('user_pass', 'Password', 'required');
        
   //      if($this->input->post('id_auth') == 5) {
   //          $this->notification->check_post('id_propinsi', 'Propinsi', 'required');
			// $this->notification->check_post('id_kota', 'Kota', 'required');
   //      }
        // password
        $user_key = $this->cryptosimple->create_user_key($this->input->post('user_pass'));
        $password = $this->cryptosimple->do_encryption($this->input->post('user_pass'), $user_key);
        // run
        if ($this->notification->valid_input()) {	
			$datauser =  $this->adminmodel->cek_username($this->input->post('user_name'));
			if(!empty($datauser)):
				$this->notification->set_message("Username sudah ada, harap ganti dengan yang lain!");
                $this->notification->sent_notification(false);
				redirect('private/administrator/add');
			endif;
            // params user
          
            $params_user = array(
                "user_name" => $this->input->post('user_name'),
                    "user_pass" => $password,
                    "user_key" => $user_key,
                    "user_status" => 'active',
                    "user_mail" => $this->input->post('user_mail'),
                    "mdb" => $this->id_user);
            // // params admin
            
            $params_admin = array(
                    "admin_name" => $this->input->post('admin_name'),
					"id_asosiasi" => $this->input->post('id_asosiasi'),
					"jenis_kelamin" => $this->input->post('jenis_kelamin'),
                    "jabatan" => $this->input->post('jabatan'),
                    "no_telp" => $this->input->post('no_telp'),
                    "mdb" => $this->id_user);
		
            $params_akses = array("id_auth" => $this->input->post('id_auth'));
            // processing data
			$proses = $this->adminmodel->process_add_administrator($params_user, $params_admin, $params_akses);
            if($proses[0]) {
					$id_data =  $proses[1];
				
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
        redirect('private/administrator/add');
    }

    private function process_edit() {
        // load
        $this->load->model('adminmodel');
        $this->load->library('notification');
        $this->load->library('cryptosimple');
        // set rules
        $this->notification->check_post('admin_name', 'Nama', 'required');
		$this->notification->check_post('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->notification->check_post('no_telp', 'Telepon', 'required');
        $this->notification->check_post('user_mail', 'Email', 'required');
        $this->notification->check_post('user_name', 'Username', 'required');
        $this->notification->check_post('user_pass', 'Password', 'required');
        $this->notification->check_post('id_auth', 'Hak Akses', 'required');
        if($this->input->post('id_auth') == 5) {
            $this->notification->check_post('id_propinsi', 'Propinsi', 'required');
        }
        // password
        $user_key = $this->cryptosimple->create_user_key($this->input->post('user_pass'));
        $password = $this->cryptosimple->do_encryption($this->input->post('user_pass'), $user_key);
        // run
        if ($this->notification->valid_input()) {
            // params user
              $params_user = array(
                "user_name" => $this->input->post('user_name'),
                    "user_pass" => $password,
                    "user_key" => $user_key,
                    "user_status" => 'active',
                    "user_mail" => $this->input->post('user_mail'),
                    "mdb" => $this->id_user,
                    "id_user" => $this->input->post('id_user'));
            // // params admin
            
            $params_admin = array(
                    "admin_name" => $this->input->post('admin_name'),
                    "id_asosiasi" => $this->input->post('id_asosiasi'),
                    "jenis_kelamin" => $this->input->post('jenis_kelamin'),
                    "jabatan" => $this->input->post('jabatan'),
                    "no_telp" => $this->input->post('no_telp'),
                    "mdb" => $this->id_user,
                    "id_user" => $this->input->post('id_user'));
        
            $params_akses = array("id_auth" => $this->input->post('id_auth'),
                "id_user" => $this->input->post('id_user'));
           
            // processing data
            if($this->adminmodel->process_edit_administrator($params_user,$params_admin,$params_akses)) {
					
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
        redirect('private/administrator/edit/' . $this->input->post('id_user'));
    }

    private function process_delete() {
        // load
        $this->load->model('adminmodel');
        $this->load->library('notification');
        // set rules
        $this->notification->check_post('id_user', 'ID USER', 'required');
        // password
        if($this->input->post('id_user') == $this->id_user) {
            $this->notification->set_message('Dilarang menghapus data administrator yang sedang login');
        }
        // run
        if ($this->notification->valid_input()) {
            // processing data
            if($this->adminmodel->process_hapus_administrator(array($this->input->post('id_user')))) {
                $this->notification->clear_post();
                $this->notification->set_message("Data berhasil dihapus");
                $this->notification->sent_notification(true);
                // default redirect
                redirect('private/administrator');
            }else {
                $this->notification->set_message("Data gagal dihapus");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
        // default redirect
        redirect('private/administrator/hapus/' . $this->input->post('id_user'));
    }
}