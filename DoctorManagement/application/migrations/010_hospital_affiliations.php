<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hospital_Affiliations extends CI_Migration {

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
            'hospital' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'img' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('hospital_affiliations',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('hospital_affiliations');
    }
}