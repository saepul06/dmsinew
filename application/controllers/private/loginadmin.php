<?php
// important * untuk application base dari halaman ini

class Loginadmin extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->Webappbase();
    }
 	public function index() {
		// load library
        $this->load->library('Notification');
		$this->smarty->assign('template_content',"private/loginadmin/loginform.html");
		
		// notification
        $arr_notify = $this->notification->get_notification();
		//print_r($arr_notify);
        
		$this->smarty->assign("notification_msg", $arr_notify['message']);
        $this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':'green'));
        // display document
        $this->parser->parse('web/base-layout/document-frame.html');
	}
	
    public function process_login() {
        // load library
        $this->load->library('Notification');
		
        // set rules
        $this->notification->check_post('userid', 'Username', 'required');
        $this->notification->check_post('password', 'Password', 'required');
		// run
        if ($this->notification->valid_input()) {
            $id_user = $this->sitemodel->get_user_login($this->input->post('userid'), $this->input->post('password'), $this->config->item('admin_portal_id'));
            if($id_user) {
                // set session
                $session_user = $this->session->set_userdata(array('id_user' => $id_user));

                $this->smarty->assign('session_user', $session_user);
                // save login history
                $this->sitemodel->save_user_login($id_user);			
                // default redirect
				redirect('private/dashboard');
            }else {
                $this->notification->set_message("Kombinasi Username dan Password salah");
                $this->notification->sent_notification(false);
            }
        }else {
            $this->notification->sent_notification(false);
			
        }
        // default redirect
        redirect('private/loginadmin');
    }

    public function process_logout_admin() {
        // unset session
        $this->session->unset_userdata('id_user');
		$this->session->sess_destroy();
        // default redirect to login
        redirect('private/loginadmin');
    }
}