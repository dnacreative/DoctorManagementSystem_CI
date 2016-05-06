<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Columns_Doctors extends CI_Migration {

    public function up()
    {
        $field_match = array(
            'field_match' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
        );
        if (!$this->db->field_exists('field_match', 'doctors'))
        {
            $this->dbforge->add_column('doctors', $field_match);
        }
    }

    public function down()
    {
        $this->dbforge->drop_column('doctors', 'field_match');
    }
}