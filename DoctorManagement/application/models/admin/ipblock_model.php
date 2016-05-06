<?php
class Ipblock_Model extends CI_Model {

    public function getAllIp($status=0)
    {                         
        $this->db->select('*');     
        $this->db->where('status', $status);      
        $query = $this->db->get('ipblocklist');        
        return $query->result_array();
    }      
    
    public function addBlockedIp($ip, $desc)
    {     
        $data = array(
                'ip' => $ip,
                'description' => $desc
            );      
        $this->db->insert('ipblocklist',$data);
        return $this->db->insert_id();
    }                                
    
    
    public function editBlockedIp($id,$desc)
    {
        $data = array('description' => $desc);
        $this->db->where('id', $id);
        return $this->db->update('ipblocklist',$data);
    }

    public function deleteBlockedIp($id)
    {
        $data = array('status' => 1);
        $this->db->where('id', $id);
        return $this->db->update('ipblocklist',$data);
    } 
    
    
}