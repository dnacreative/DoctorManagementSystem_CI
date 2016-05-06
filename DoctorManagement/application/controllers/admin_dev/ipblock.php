<?php
if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class Ipblock extends CI_Controller {

        public function __construct(){
            parent::__construct();
            
            $this->load->model('admin/ipblock_model');
            if ($this->session->userdata('admin') != 1) {
                redirect('/admin_dev');
            }            
        }

        public function index(){   //var_dump($this->load);exit;
            $iplist = $this->ipblock_model->getAllIp();
            $data['ips'] = $iplist;
            $this->load->adminView('admin/ipblock_view', $data);
        }

        public function add(){ 
            $block_ip = $_POST['block_ip'];
            $desc = $_POST['block_description'];
            
            $res = $this->ipblock_model->addBlockedIp($block_ip, $desc);
            
            echo($res);
        }
        
        public function edit(){ 
            $block_id = $_POST['block_id'];
            $block_description = $_POST['block_description'];
            
            $res = $this->ipblock_model->editBlockedIp($block_id, $block_description);
            
            echo($res);
        }
        
        public function delete(){ 
            $block_id = $_POST['block_id'];             
            $res = $this->ipblock_model->deleteBlockedIp($block_id);             
            echo($res);
        }
    }
}