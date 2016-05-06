<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clinics extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'NULL' => TRUE,
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'NULL' => TRUE,
            ),
            'zip' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'national_rank' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'full_rank' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'score' => array(
                'type' => 'VARCHAR',
                'constraint' => 5,
                'NULL' => TRUE,
            ),
            'stars' => array(
                'type' => 'INT',
                'constraint' => 1,
            ),
            'intl_visitor_rank' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('clinics',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('clinics');
    }
}