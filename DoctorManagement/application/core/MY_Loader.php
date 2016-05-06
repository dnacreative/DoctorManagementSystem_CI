<?php
class MY_Loader extends CI_Loader {

    function __construct() {       
        parent::__construct();
    }

    public function adminView($view,$data = ''){      //var_dump(debug_backtrace()); var_dump("aaa");exit;

        $this->view('admin/header_view');
        $this->view($view,$data);
        $this->view('admin/footer_view');
    }

}