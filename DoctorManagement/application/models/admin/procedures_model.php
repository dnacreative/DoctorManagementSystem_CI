<?php
class Procedures_Model extends CI_Model {

    public function getAllProcedures($num = "",$offset = "")
    {                         
        $this->db->select('*');   
        if(($num!="")&&($offset!=""))
            $this->db->limit($offset,$num);
        $query = $this->db->get('procedures');
        
        $sql = "SELECT p.*, s.doctor_count 
                FROM procedures p 
                LEFT JOIN 
                (SELECT count(id) as doctor_count, name_id FROM new_specialties GROUP BY name_id) s 
                ON p.id=s.name_id";
        $query = $this->db->query($sql, array($doctor_id));
        //var_dump($query->result_array());exit;
                    
        return $query->result_array();
    }
    
    public function getAllProceduresIdName()
    {
        $this->db->select('id, name');                      
        $query = $this->db->get('procedures');
        return $query->result_array();
    }

    public function addNewProcedure($data)
    {
        $this->db->insert('procedures',$data);
    }

    public function getProcedureById($id)
    {
        $this->db->select('*');
        $this->db->from('procedures');
        $this->db->where('id',$id);
        $resualt = $this->db->get()->result_array();
        return $resualt[0];
    }

    public function editProcedureInfo($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('procedures',$data);
    }

    public function deleteProcedureById($id)
    {
        $this->db->delete('procedures', array('id' => $id));
    }


}