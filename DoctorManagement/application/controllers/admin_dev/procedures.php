<?php
if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class Procedures extends CI_Controller {

        public function __construct()
        {
            parent:: __construct();
            $this->load->model('admin/procedures_model');
                                   
            if ($this->session->userdata('admin') != 1)
            {
                redirect('/admin_dev');
            }
        }

        /**
         * @param string $page
         */
        public function index($page='')
        {
            $procedures = $this->procedures_model->getAllProcedures();
            $data['procedures'] = $procedures;
            $this->load->adminView('admin/procedures_view',$data);
        }

        public function add()
        {            
            $this->load->adminView('admin/addNewProcedure_view');
        }

        public function addProcess()
        {
                 
            $data = $this->input->post();
            foreach($data as $key => $value)
            {
                $data[$key] = trim($value);
            }
            $procedure = array(
                'name' => $data['procedure_name'],
                'type' => $data['procedure_type'],
                'procedure_description' => strip_tags(mb_substr($data['procedure_description_full'], 0, 150)) . '...',
                'procedure_description_full' => $data['procedure_description_full'],
                'national_avg' => $data['national_avg']
            );
            $this->procedures_model->addNewProcedure($procedure);
            $this->session->set_flashdata('success_msg','New Procedure successfully added');
            redirect('/admin_dev/procedure/add');
        }


        public function edit($id)
        {            
            $procedure = $this->procedures_model->getProcedureById($id);
            foreach($procedure as $key => $value)
            {
                $procedure[$key] = trim($value);
            }
            $data['procedure'] = $procedure;
            $this->load->adminView('admin/editProcedureInfo_view',$data);
        }

        public function editProcess($id)
        {                         
            $data = $this->input->post();
            foreach($data as $key => $value)
            {
                $data[$key] = trim($value);
            }
            $procedure = array(
                'name' => $data['procedure_name'],
                'type' => $data['procedure_type'],
                'procedure_description' => strip_tags(mb_substr($data['procedure_description_full'], 0, 150)) . '...',
                'procedure_description_full' => $data['procedure_description_full'],
                'national_avg' => $data['national_avg']
            );
            $this->procedures_model->editProcedureInfo($id,$procedure);
            $this->session->set_flashdata('success_msg','Procedure successfully edited');
            redirect('/admin_dev/procedure/edit/'.$id);
        }

        public function deleteProcedureById($id)
        {
            $this->procedures_model->deleteProcedureById($id);
            $this->session->set_flashdata('success_msg','Procedure successfully deleted');
            redirect('/admin_dev/procedures');
        }

    }
}