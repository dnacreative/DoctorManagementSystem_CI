<?php
if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class About extends CI_Controller {

        public function __construct()
        {
            parent:: __construct();

            if ($this->session->userdata('admin') != 1) {
                redirect('/admin_dev');
            }
        }

        public function index(){
            $this->load->view('admin/header_view');
            $this->load->view('admin/about_view');
            $this->load->view('admin/footer_view');
        }
    }
}