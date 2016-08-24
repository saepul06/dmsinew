<?php
// important * untuk application base dari halaman ini
require_once( APPPATH.'controllers/base/build.layout.class.php' );

class Welcome extends ApplicationBase {

    function  __construct() {
        // load application base
        parent::ApplicationBase();
    }

    public function index() {
        // template content
        $this->smarty->assign("template_content", "web/build/welcome");
        // assign variable
        // $this->smarty->assign("nama", "Welly Widodo Sindu Putra");
        // display document
        $this->smarty->view( 'web/base/document.html');
    }
}
?>