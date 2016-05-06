<?php
if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class Authorization extends CI_Controller {

        public function index()
        {               //var_dump($this);exit;             
            if ($this->session->userdata('admin') == 1) {
                redirect('/admin_dev/home');
            }
            $this->load->view('admin/login_view');
        }

        public function login()
        {                     
            if($this->input->post('username') == 'anthony@voyagermed.com' && $this->input->post('password') == 'voyagermedpassword' )
            {           
                $this->session->set_userdata('admin','1');
                redirect('admin_dev/home');
            }
            else if($this->input->post('username') == 'emily@voyagermed.com' && $this->input->post('password') == 'China2015!' )
            {           
                $this->session->set_userdata('admin','1');
                redirect('admin_dev/home');
            }
            else
            {           
                $this->session->set_flashdata('error', 'Wrong username or password');
                redirect('/admin_dev');
            }
        }

        public function logout()
        {
            $this->session->unset_userdata('admin');
            redirect('/admin_dev');
        }
    }
}