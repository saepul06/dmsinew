<?php

class Sistem extends MY_Controller {

    function  __construct() {
        // load application base
       parent::__construct();
	   $this->PrivateAppBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "private/sistem/overview");
        // your code here

        // display document$this->parser->parse( 'private/base-layout/document.html');
    }

    public function settings() {
        // template content
        $this->smarty->assign("template_content", "private/seting/seting");
        // load
        $this->load->library('notification');
        // parse url
        $this->smarty->assign('url_process', site_url('private/sistem/process_settings'));
        // data
        $data = $this->sitemodel->get_aplikasi_settings();
        $this->smarty->assign("data", $data);
        // notification
        $arr_notify = $this->notification->get_notification();
        if(!empty($arr_notify['post'])) {
            $this->smarty->assign("data", $arr_notify['post']);
        }
        // notification
        $this->smarty->assign("notification_msg", $arr_notify['message']);
        $notification_status = (empty($arr_notify['message_status'])?'red':'green');
        $this->smarty->assign("notification_status", $notification_status);
        // display document
        $this->parser->parse( 'private/base-layout/document.html');
    }

    public function process_settings() {
        // load library
        $this->load->library('notification');
        // set rules
        $this->notification->check_post('smtp_name', 'Nama SMPTP', 'required');
        $this->notification->check_post('smtp_host', 'Site Description', 'required');
        $this->notification->check_post('smtp_port', 'Site Description', 'required');
        $this->notification->check_post('smtp_username', 'Site Description', 'required');
        $this->notification->check_post('smtp_password', 'Site Description', 'required');
        $this->notification->check_post('regnas_url', 'Regnas URL', 'required');
        // run
        if ($this->notification->valid_input()) {
            // params
            $params = array(
                    'smtp_name' => $this->input->post('smtp_name'),
                    'smtp_host' => $this->input->post('smtp_host'),
                    'smtp_port' => $this->input->post('smtp_port'),
                    'smtp_username' => $this->input->post('smtp_username'),
                    'smtp_password' => $this->input->post('smtp_password'),
                    'regnas_url' => $this->input->post('regnas_url'),
                    'mdb' => $this->id_user
            );
            // execute
            if($this->sitemodel->process_aplikasi_update($params)) {
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
        redirect('private/sistem/settings');
    }
}