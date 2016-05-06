<?php

class Doctors_Model extends CI_Model
{

    public function getDoctorsByField($field, $num = "", $offset = "")
    {
        $this->db->select('*');
        $this->db->where('field', $field);
        if (!empty($num) || !empty($offset)) {
            $this->db->limit($offset, $num);
        }
        $query = $this->db->get('doctors');
        return $query->result_array();
    }
    public function getNumDoctorsByField($field, $num = "", $offset = "")
    {
        $this->db->select('count(*)');
        $this->db->where('field', $field);
        if (!empty($num) || !empty($offset)) {
            $this->db->limit($offset, $num);
        }
        $query = $this->db->get('doctors');
        return $query->result_array();
    }

    public function addNewDoctor($table, $data)
    {       
        if ($table == 'doctors') {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        } else {
            $this->db->insert($table, $data);
        }
    }

    public function getIdByName($table, $name)
    {
        $this->db->select('id');
        $this->db->where('name', $name);
        $resualt = $this->db->get($table)->result_array();
        return $resualt[0]['id'];
    }

    public function getDoctorAllInformation($table, $id)
    {
        $this->db->select('*');
        if ($table == 'doctors') {
            $this->db->where('id', $id);
            $resualt = $this->db->get($table)->result_array();
            return $resualt[0];
        } else {
            $this->db->where('doctor_id', $id);
        }

        $resualt = $this->db->get($table)->result_array();
        return $resualt;
    }

    
    public function deleteDoctorInfo_Without_Id_InArray($table, $tableData, $id)
    {
        //get id array string
        
        $sql = "0, ";
        foreach($tableData as $data)
        {               
            if (empty(trim($data['id'])))
            {
                continue;
            }
            $sql .= $data['id'] . ", ";            
        }   
        $sql = substr($sql, 0, -2);
        
        $sql = "id NOT in (" . $sql . ")";
        
        $this->db->where(array('doctor_id' => $id));
        
        $this->db->delete($table, $sql);
        //exit;
    }
    
    public function editDoctorInfo($table, $data, $id)
    {
        if ($table == 'doctors') {       //var_dump($table, $data, $id);exit;
            $this->db->where('id', $id);
            $this->db->update($table, $data);
        } else {

            $query = $this->db->get_where($table, array('doctor_id' => $id));
            if (empty($data['id'])) {    
                $data['doctor_id'] = $id;
                $this->db->insert($table, $data);
            } else {
                if ($query->num_rows() !== 0) {
                    $rowId = $data['id'];
                    unset($data['id']);
                    $this->db->where(array('doctor_id' => $id));
                    $this->db->where(array('id' => $rowId));
                    $this->db->update($table, $data);
                } else {
                    $this->db->insert($table, $data);
                }

            }
        }
    }

    public function deleteDoctorById($id)
    {
        $sql = "
            DELETE
                awards.*,
                certifications.*,
                education.*,
                hospital_affiliations.*,
                specialties.*,
                masonry.*,
                doctors.*
            FROM
                doctors
            LEFT JOIN awards ON doctors.id = awards.doctor_id
            LEFT JOIN certifications ON doctors.id = certifications.doctor_id
            LEFT JOIN education ON doctors.id = education.doctor_id
            LEFT JOIN hospital_affiliations ON doctors.id = hospital_affiliations.doctor_id
            LEFT JOIN specialties ON doctors.id = specialties.doctor_id
            LEFT JOIN masonry ON doctors.id = masonry.doctor_id
            WHERE
                doctors.id = " . $id . "
        ";
        $this->db->query($sql);
    }

    public function searchProcedures($searchItem)
    {
        $this->db->select('name');
        $this->db->like('name', $searchItem);
        $this->db->limit(5);
        $result = $this->db->get('procedures')->result_array();
        return $result;

    }

    public function deleteInfo($table,$id)
    {
        $this->db->where('id', $id);
        if($this->db->delete($table)){
            return 1;
        }
    }


}