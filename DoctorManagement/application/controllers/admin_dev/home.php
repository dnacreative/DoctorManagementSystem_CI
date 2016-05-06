<?php
if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class Home extends CI_Controller {

        public function __construct(){
            parent::__construct();
            if ($this->session->userdata('admin') != 1) {
                redirect('/admin_dev');
            }
        }

        public function index(){   //var_dump($this->load);exit;
            $this->load->adminView('admin/home_view');
        }

    }
}