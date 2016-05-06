<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Delete_Columns_New_Specialties extends CI_Migration {

    public function up()
    {
        if ($this->db->field_exists('name', 'new_specialties'))
        {
            $this->dbforge->drop_column('new_specialties', 'name');
        }
        if ($this->db->field_exists('name_id', 'new_specialties'))
        {
            $this->dbforge->drop_column('new_specialties', 'name_id');
        }
        if ($this->db->field_exists('is_match', 'new_specialties'))
        {
            $this->dbforge->drop_column('new_specialties', 'is_match');
        }
    }

    public function down()
    {
        $name = array(
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            )
        );
        $name_id = array(
            'name_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            )
        );
        $this->dbforge->add_column('new_specialties', $name);
        $this->dbforge->add_column('new_specialties', $name_id);
    }
}