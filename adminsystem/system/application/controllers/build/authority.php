<?php
// important * untuk application base dari halaman ini
require_once( APPPATH.'controllers/base/build.layout.class.php' );

class Authority extends ApplicationBase {

    function  __construct() {
        // load application base
        parent::ApplicationBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "web/build/authority-list");
        // assign variable
        // url
        $this->smarty->assign("url_add", site_url("build/authority/add"));
        $this->smarty->assign("url_list", site_url("build/authority"));
        // data
        $data = $this->buildsystem->get_authority_data();
        $this->smarty->assign("no", 1);
        $this->smarty->assign("data", $data);
        // notification

        // display document
        $this->smarty->view( 'web/base/document.html');
    }

    public function add() {
        // template content
        $this->smarty->assign("template_content", "web/build/authority-add");
        // assign variable
        // url
        $this->smarty->assign("url_add", site_url("build/authority/add"));
        $this->smarty->assign("url_list", site_url("build/authority"));
        $this->smarty->assign("url_process", site_url("build/authority/process_add"));
        // --
        $this->smarty->assign("active_add", 'class="tab-nav-active"');
        // data
        // list groups
        $list_group = $this->buildsystem->get_portal_data();
        $this->smarty->assign("groups", $list_group);
        // notification

        // display document
        $this->smarty->view( 'web/base/document.html');
    }

    public function edit() {
        // template content
        $this->smarty->assign("template_content", "web/build/authority-add");
        // assign variable
        // url
        $this->smarty->assign("url_add", site_url("build/authority/add"));
        $this->smarty->assign("url_list", site_url("build/authority"));
        $this->smarty->assign("url_process", site_url("build/authority/process_edit"));
        // --
        $this->smarty->assign("active_edit", '<li><a href="#" class="tab-nav-active">Edit</a></li>');
        // data
        // list groups
        $list_group = $this->buildsystem->get_portal_data();
        $this->smarty->assign("groups", $list_group);
        // detail
        $id_auth = $this->uri->segment(4);
        $data = $this->buildsystem->get_authority_by_id($id_auth);
        if(isset($data[0])) {
            $this->smarty->assign("data", $data[0]);
            $this->smarty->assign("selected", $data[0]->id_group);
        }
        // notification

        // display document
        $this->smarty->view( 'web/base/document.html');
    }

    public function hapus() {
        // template content
        $this->smarty->assign("template_content", "web/build/authority-hapus");
        // assign variable
        // url
        $this->smarty->assign("url_add", site_url("build/authority/add"));
        $this->smarty->assign("url_list", site_url("build/authority"));
        $this->smarty->assign("url_process", site_url("build/authority/process_hapus"));
        // data
        // detail
        $id_auth = $this->uri->segment(4);
        $data = $this->buildsystem->get_authority_by_id($id_auth);
        if(isset($data[0])) {
            $this->smarty->assign("data", $data[0]);
        }
        // notification

        // display document
        $this->smarty->view( 'web/base/document.html');
    }

    // processing

    public function process_add() {
        // load library
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules('id_group', 'Site Portal', 'required');
        $this->form_validation->set_rules('auth_name', 'Nama', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        // run
        if ($this->form_validation->run()) {
            if(!$this->buildsystem->process_authority_add()) {
                $this->form_validation->set_message("Data gagal disimpan");
            }
        }
        // default redirect
        redirect('build/authority/add');
    }

    public function process_edit() {
        // load library
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules('id_group', 'Site Portal', 'required');
        $this->form_validation->set_rules('auth_name', 'Nama', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        // run
        if ($this->form_validation->run()) {
            if(!$this->buildsystem->process_authority_edit()) {
                $this->form_validation->set_message("Data gagal disimpan");
            }
        }
        // default redirect
        redirect('build/authority/edit/'.$this->input->post('id_auth'));
    }

    public function process_hapus() {
        // load library
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules('id_auth', 'Hak akses', 'required');
        // run
        if ($this->form_validation->run()) {
            if(!$this->buildsystem->process_authority_delete()) {
                $this->form_validation->set_message("Data gagal dihapus");
                // redirect
                redirect('build/authority/hapus/'.$this->input->post('id_auth'));
            }
        }
        // default redirect
        redirect('build/authority');
    }
}
?>