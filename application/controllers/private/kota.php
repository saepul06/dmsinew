<?php
class Kota extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "private/kota/list");
        // load
        $this->load->library('pagination');
        $this->load->model('kotamodel');
        $this->load->library('notification');
        $this->layout->load_javascript("js/utility/checkbox.js");
		$this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");
		$this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");
        // var
        $id_propinsi = intval($this->uri->segment(4, 0));
        
        //pagination
		//$page = intval($this->uri->segment(5, 0));
        /*$config['base_url'] = site_url("private/kota/index/" . $id_propinsi);
        $config['total_rows'] = $this->kotamodel->get_total_kota($id_propinsi);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['num_links'] = 5;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['cur_tag_open'] = ' <a href="#" class="active">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $pagging = $this->pagination->create_links();
        $this->smarty->assign("pagging", $pagging);
        //list data dari DB
        $totaldata = $config['total_rows'];
        $start = $this->uri->segment(5, 0) + 1;
        $end =$this->uri->segment(5, 0) + 10;
        $total = $config['total_rows'];
        if($end > $config['total_rows']) {
            $end = $config['total_rows'];
        }
        $this->smarty->assign("no", $start);
        $this->smarty->assign("start", $start);
        $this->smarty->assign("end", $end);
        // kota
        $limit = array($page, $config['per_page']);
        
        $this->smarty->assign("total", $totaldata);
		*/
		$data = $this->kotamodel->get_data_kota_all($id_propinsi);
        // propinsi
        $datapropinsi = $this->kotamodel->get_all_propinsi();
        $this->smarty->assign("kota", $data);
        $this->smarty->assign("propinsi", $datapropinsi);
        // notification
        $arr_notify = $this->notification->get_notification();
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // parse url
        $this->smarty->assign('url_add', site_url('private/kota/add/' . $id_propinsi));
        $this->smarty->assign('url_process', site_url('private/kota/process/hapus'));
        $this->smarty->assign('url_list', site_url('private/kota/index/' . $id_propinsi));
		$this->smarty->assign('url_edit', site_url('private/kota/edit/' . $id_propinsi));
        $this->smarty->assign('url_edit2', site_url('private/kota/edit/'));
		$this->smarty->assign('url_delete', site_url('private/kota/hapus/' . $id_propinsi));
        $this->smarty->assign('url_search', site_url('private/kota/index/'));
        $this->smarty->assign("propinsi_selected", $id_propinsi);
        // display document
        $this->parser->parse( 'private/base-layout/document.html');
    }

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
            case 'search':
                $this->process_search();
                break;
            default :
            // default redirect
                redirect('private/kota/add');
                break;
        }
    }

    public function process_search() {
        // default redirect
        redirect('private/kota/index/' . $this->input->post('id_propinsi'));
    }

    public function add($id_propinsi = '') {
        // template content
        $this->smarty->assign("template_content", "private/kota/kota-add");
        //load
        $this->load->model('kotamodel');
        $this->load->library('notification');
        // url
        $this->smarty->assign('url_add', site_url('private/kota/add/' . $id_propinsi));
        $this->smarty->assign('url_list', site_url('private/kota/index/' . $id_propinsi));
        $this->smarty->assign("url_process", site_url("private/kota/process/add"));
        // --
        $datapropinsi = $this->kotamodel->get_all_propinsi();
        $this->smarty->assign("propinsi", $datapropinsi);
        $this->smarty->assign("propinsi_selected", $id_propinsi);
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        
        //id kota
        $id_kota = $this->kotamodel->get_max_kode_kota();
        $this->smarty->assign('id_kota',$id_kota);
        
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
        $this->parser->parse( 'private/base-layout/document.html');
    }

    public function process_add() {
        // load library
        $this->load->model('kotamodel');
        $this->load->library('notification');
        // set rules
		
        $this->notification->check_post('id_propinsi', 'id_propinsi', 'required');
        $this->notification->check_post('nama_kota', 'Nama Kota', 'required');
        $nama_kota = $this->input->post('nama_kota');
        // run
        if ($this->notification->valid_input()) {
        if($this->kotamodel->is_exists_kota(strtolower($nama_kota))) {
                    $this->notification->set_message('Nama kota yang diinput di Provinsi ini sudah ada');
                    $this->notification->clear_post();
                }
          }
        if ($this->notification->valid_input()) {
			 $id_kota = $this->input->post('id_kota');
			 $data = $this->kotamodel->get_kota_by_id($id_kota);
			 if(!empty($data)):
			 	 $this->notification->set_message("Kode kota yang dimasukkan sudah ada!");
                 $this->notification->sent_notification(false);
				 redirect('private/kota/add/' . $this->input->post('id_propinsi'));
			 endif;
            // params
            $params = array($this->input->post('id_kota'),$this->input->post('id_propinsi'), $this->input->post('nama_kota'), $this->id_user);
            if($this->kotamodel->process_kota_add($params)) {
					$id_data =  $this->input->post('id_kota');
					$note_aksi = "Tambah Data Kota Oleh ".$this->user_data['admin_name']." dengan rincian, ID : ".$id_data."; Nama Kota : ".$this->input->post('nama_kota').";";
					$paramslog = array(
						"nama_data" => "kota", 
						"aksi" => "add", 
						"id_instansi" => $this->user_data['no_registrasi'],
						"id_data" => $id_data,
						"id_user" => $this->id_user, 
						"keterangan" => $note_aksi,
						'nama_user' => $this->user_data['admin_name']);
					$this->savelog($paramslog);
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
        redirect('private/kota/add/' . $this->input->post('id_propinsi'));
    }

    public function edit($id_propinsi = '', $id_kota = '') {
        // template content
        $this->smarty->assign("template_content", "private/kota/kota-edit");
        // load
        $this->load->model('kotamodel');
        $this->load->library('notification');
        // assign variable
        // url
        $this->smarty->assign('url_add', site_url('private/kota/add/' . $id_propinsi));
        $this->smarty->assign('url_list', site_url('private/kota/index/' . $id_propinsi));
        $this->smarty->assign("url_process", site_url("private/kota/process/edit"));
        // data
        $data = $this->kotamodel->get_kota_by_id($id_kota);
        $this->smarty->assign("data", $data);
        $datapropinsi = $this->kotamodel->get_all_propinsi();
        $this->smarty->assign("propinsi", $datapropinsi);
        $this->smarty->assign("propinsi_selected", $id_propinsi);
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
        $this->parser->parse( 'private/base-layout/document.html');
    }
	
	
	 public function hapus($id_propinsi = '', $id_kota = '') {
        // template content
        $this->smarty->assign("template_content", "private/kota/kota-hapus");
        // load
        $this->load->model('kotamodel');
        $this->load->library('notification');
        // assign variable
        // url
        $this->smarty->assign('url_add', site_url('private/kota/add/' . $id_propinsi));
        $this->smarty->assign('url_list', site_url('private/kota/index/' . $id_propinsi));
        $this->smarty->assign("url_process", site_url("private/kota/process/hapus"));
        // data
        $data = $this->kotamodel->get_kota_by_id($id_kota);
        $this->smarty->assign("data", $data);
        $datapropinsi = $this->kotamodel->get_all_propinsi();
        $this->smarty->assign("propinsi", $datapropinsi);
        $this->smarty->assign("propinsi_selected", $id_propinsi);
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
        $this->parser->parse( 'private/base-layout/document.html');
    }

    public function process_edit() {
        // load library
        $this->load->model('kotamodel');
        $this->load->library('notification');
        // set rules
        $this->notification->check_post('id_kota', 'id_kota', 'required');
        $this->notification->check_post('id_propinsi', 'Nama Propinsi', 'required');
        $this->notification->check_post('nama_kota', 'Nama Kota', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = array($this->input->post('id_propinsi'), $this->input->post('nama_kota'), $this->id_user, $this->input->post('id_kota'));
            // processing
            if($this->kotamodel->process_kota_edit($params)) {
					$id_data =  $this->input->post('id_kota');
					$note_aksi = "Update Data Kota Oleh ".$this->user_data['admin_name']." dengan rincian, ID : ".$id_data."; Nama Kota : ".$this->input->post('nama_kota').";";
					$paramslog = array(
						"nama_data" => "kota", 
						"aksi" => "edit", 
						"id_instansi" => $this->user_data['no_registrasi'],
						"id_data" => $id_data,
						"id_user" => $this->id_user, 
						"keterangan" => $note_aksi,
						'nama_user' => $this->user_data['admin_name']);
					$this->savelog($paramslog);
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
        redirect('private/kota/edit/' . $this->input->post('id_propinsi') . '/' .$this->input->post('id_kota'));
    }

    public function process_hapus() {
        // load library
        $this->load->library('notification');
        $this->load->model('kotamodel');
        // set rules
        $this->notification->check_post('id_kota', 'ID Kota', 'required');
        // run
        $id = $this->input->post('id_kota');
        $banyak = count($id);
        if ($this->notification->valid_input()) {
			$data = $this->kotamodel->get_kota_by_id($id_kota);
            if($this->kotamodel->process_kota_delete_one($id)) {
				$id_data =  $this->input->post('id_kota');
					$note_aksi = "Hapus Data Kota Oleh ".$this->user_data['admin_name']." dengan rincian, ID : ".$id_data."; Nama Kota : ".$data['nama_kota'].";";
					$paramslog = array(
						"nama_data" => "kota", 
						"aksi" => "delete", 
						"id_instansi" => $this->user_data['no_registrasi'],
						"id_data" => $id_data,
						"id_user" => $this->id_user, 
						"keterangan" => $note_aksi,
						'nama_user' => $this->user_data['admin_name']);
					$this->savelog($paramslog);
                $this->notification->clear_post();
                $this->notification->set_message($banyak.' Data berhasil dihapus');
                $this->notification->sent_notification(true);
            }else {
                $this->notification->set_message("Data gagal dihapus");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
        }
        // default redirect
        redirect('private/kota/index/' . $this->input->post('id_propinsi'));
    }
}