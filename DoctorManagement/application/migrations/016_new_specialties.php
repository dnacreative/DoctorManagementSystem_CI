<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_New_Specialties extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'NULL' => TRUE,
            ),
            'doctor_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'name_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => TRUE,
            ),
            'price' => array(
                'type' => 'VARCHAR',
                'constraint' => 11,
                'NULL' => TRUE,
            ),
            'procedure_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'real_id' => array(
                'type' => 'INT',
                'constraint' => 6,
                'NULL' => TRUE,
            ),
            'is_match' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('new_specialties',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('new_specialties');
    }
}