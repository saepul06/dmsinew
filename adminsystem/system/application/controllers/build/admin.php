<?php
// important * untuk application base dari halaman ini
require_once( APPPATH.'controllers/base/build.layout.class.php' );

class Admin extends ApplicationBase {

    function  __construct() {
        // load application base
        parent::ApplicationBase();
    }

    public function index() {

    }

    public function setting() {
        // load library
        $this->load->library('form_validation');
        // template content
        $this->smarty->assign("template_content", "web/build/admin-setting");
        // assign variable
        // url
        $this->smarty->assign("url_process", site_url("build/admin/process_update"));
        // data
        // selected authority
        $id_user = 1;
        $arr_selected = array();
        $result_selected = $this->buildsystem->get_selected_auth_by_admin($id_user);
        if($result_selected) {
            foreach($result_selected as $value) {
                $arr_selected[] = $value->id_auth;
            }
        }
        $this->smarty->assign("id_user", $id_user);
        $this->smarty->assign("selected_id", $arr_selected);
        // list authority
        $data = $this->buildsystem->get_authority_data();
        $this->smarty->assign("data", $data);
        // display document
        $this->smarty->view( 'web/base/document.html');
    }
    
    public function process_update() {
        // load library
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules('id_user', 'User', 'required');
        // run
        if ($this->form_validation->run()) {
            // delete
            $this->buildsystem->process_delete_auth_by_user();
            // insert
            $arr_auth = $this->input->post('id_auth');
            if(!empty($arr_auth)){
                foreach($arr_auth as $id_auth){
                    $this->buildsystem->process_add_auth_user($this->input->post('id_user'), $id_auth);
                }
            }
        }
        // default redirect
        redirect('build/admin/setting');
    }
}
?>